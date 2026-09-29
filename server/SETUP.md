# Server Setup Runbook: knowledgeparkguide.in

Stack: Azure for Students VM (Central India) · Ubuntu 24.04 LTS · Nginx · PHP 8.3-FPM · MariaDB 10.11 · WordPress (WP-CLI) · Let's Encrypt (Certbot DNS-01) · Cloudflare Full (strict)

Replace `<IP>` with your VM's public IP. Commands in `$` blocks run on your **laptop**; everything else runs **on the server** unless marked otherwise.

> **Evidence rule:** start every server session with `script -a ~/kpg-server-log.txt` on your laptop **before** you `ssh`. That records the whole session to one log file for the report. **Never print secrets while recording.** The commands below read passwords and tokens into variables so they never appear in the log.

---

## A. Domain + Cloudflare (Week 2)

1. **Spaceship:** buy `knowledgeparkguide.in`. Complete the **.in KYC** from the email or at kyc.nixi.in straight away. Screenshot the receipt and the KYC approval.
2. **Cloudflare:** Add a domain → `knowledgeparkguide.in` → **Free** plan. Copy the 2 nameservers it gives you. *Assigned 26 Sep 2026: `jim.ns.cloudflare.com`, `maleah.ns.cloudflare.com`. Spaceship parking A records deleted at import; Bot Preference Sync turned off.*
3. **Spaceship:** Domain → Nameservers → **Custom** → paste the 2 Cloudflare nameservers.
4. Wait for Cloudflare to email you that the domain is **Active** (minutes to a few hours). Screenshot it.
5. Check from your laptop: `dig +short NS knowledgeparkguide.in`. You should see the 2 `*.ns.cloudflare.com` names. Also screenshot dnschecker.org → NS.

## B. Create the VM (Azure portal)

**SSH key first** (on your Fedora laptop). Screenshot this step; it's handbook video 4:
```bash
ssh-keygen -t ed25519 -C "kpg-azure" -f ~/.ssh/kpg_azure
cat ~/.ssh/kpg_azure.pub
```

**Virtual machines → Create → Azure virtual machine.** Use exactly these settings:

| Tab | Setting | Value |
|---|---|---|
| Basics | Subscription | Azure for Students |
| | Resource group | Create new → `kpg-rg` |
| | VM name | `kpg-web` |
| | Region | **(Asia Pacific) Central India** |
| | Availability options | No infrastructure redundancy required |
| | Security type | Trusted launch (default) |
| | Image | **Ubuntu Server 24.04 LTS - x64 Gen2** |
| | Size | **Standard_B2ats_v2** (2 vCPU, 1 GiB). It must show **"Free services eligible"**. If it's unavailable, use Standard_B1s. **Do not pick anything bigger** |
| | Authentication | SSH public key · Username `<KPG_USER>` · "Use existing public key" → paste `kpg_azure.pub` |
| | Inbound ports | Allow **SSH (22), HTTP (80), HTTPS (443)**. HTTP/HTTPS are narrowed to Cloudflare's IP ranges in Part E once the proxy is live |
| Disks | OS disk | **Premium SSD (LRS)**, size **64 GiB (P6)** · ✅ Delete with VM. The free services include 2 × P6 64 GB disks, so exactly P6 is free |
| Networking | Public IP | New (default, Standard = static) · ✅ Delete public IP and NIC when VM is deleted |
| Management | **Auto-shutdown** | **OFF.** A website must stay up 24/7 |
| Monitoring | Boot diagnostics | Enable with managed storage account (default) |

Review + create → screenshot the summary → note the **public IP**.

*Created 26 Sep 2026 03:44 UTC: `kpg-web`, Standard B2ats v2, Central India, Ubuntu 24.04, 64 GiB Premium SSD (P6). **Public IP: kept in `server/.env` (not committed; Cloudflare hides the origin IP)**. SSH answered with `OpenSSH_9.6p1 Ubuntu-3ubuntu13.1`.*

**Cost guard:** confirmed on the subscription's Free services page (26 Sep): B2ats v2 VM (750 h/month) and P6 64 GB disks (×2) are free for 12 months. Only the public IP costs anything, about $3.65/month from your $100 credit. Check the balance monthly in the **Education hub → Overview** (or the Microsoft Azure Sponsorships page), and log in at least once a month.

## C. Base server (Week 3)

```bash
# laptop
script -a ~/kpg-server-log.txt
ssh -i ~/.ssh/kpg_azure <KPG_USER>@<IP>
```

```bash
# 1) swap FIRST: 1 GiB RAM without swap gets MariaDB killed during upgrades
sudo fallocate -l 2G /swapfile && sudo chmod 600 /swapfile
sudo mkswap /swapfile && sudo swapon /swapfile
echo '/swapfile none swap sw 0 0' | sudo tee -a /etc/fstab
echo 'vm.swappiness=10' | sudo tee /etc/sysctl.d/99-swappiness.conf && sudo sysctl --system
free -h

# 2) updates + timezone
sudo apt update && sudo apt -y full-upgrade
sudo timedatectl set-timezone Asia/Kolkata

# 3) LEMP
sudo apt -y install nginx mariadb-server \
  php8.3-fpm php8.3-mysql php8.3-curl php8.3-gd php8.3-intl php8.3-mbstring \
  php8.3-xml php8.3-zip php8.3-opcache php-imagick
nginx -v && php -v && mariadb --version
```

**Tune for 1 GiB RAM:**
```bash
# PHP: WordPress limits + small FPM pool
sudo tee /etc/php/8.3/fpm/conf.d/99-kpg.ini >/dev/null <<'EOF'
memory_limit = 256M
upload_max_filesize = 64M
post_max_size = 64M
max_execution_time = 120
EOF
sudo sed -i -e 's/^pm = .*/pm = ondemand/' -e 's/^pm.max_children = .*/pm.max_children = 5/' \
  /etc/php/8.3/fpm/pool.d/www.conf

# MariaDB: small memory footprint
sudo tee /etc/mysql/mariadb.conf.d/99-kpg.cnf >/dev/null <<'EOF'
[mysqld]
innodb_buffer_pool_size = 128M
performance_schema = OFF
max_connections = 30
EOF
sudo systemctl restart php8.3-fpm mariadb
```

**Secure MariaDB:** `sudo mariadb-secure-installation`. Answers: current root password → Enter · unix_socket → **n** · change root password → **n** · remove anonymous users → **Y** · disallow remote root → **Y** · remove test DB → **Y** · reload → **Y**.

## D. WordPress (same SSH session, don't disconnect between steps)

*Done 26 Sep 2026: WordPress 7.1.2, admin account created (login name kept private). The initial admin password is in root-only `/root/wp-admin-initial-password.txt`; delete it after you change the password. Timezone Asia/Kolkata, permalinks `/%category%/%postname%/`, sample post and page deleted, DISALLOW_FILE_EDIT on. One slip was fixed: the DB user's password was accidentally reset to empty, then regenerated and synced to wp-config with `wp config set --quiet`.*

```bash
# database: the password is generated into a variable and never printed
DBPASS=$(openssl rand -base64 24)
sudo mariadb -e "CREATE DATABASE kpg_wp CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'kpg_wp'@'localhost' IDENTIFIED BY '$DBPASS';
GRANT ALL PRIVILEGES ON kpg_wp.* TO 'kpg_wp'@'localhost'; FLUSH PRIVILEGES;"

# WP-CLI (official build)
curl -sO https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
php wp-cli.phar --info && chmod +x wp-cli.phar && sudo mv wp-cli.phar /usr/local/bin/wp

# download + configure WordPress
sudo mkdir -p /var/www/knowledgeparkguide.in && sudo chown www-data:www-data /var/www/knowledgeparkguide.in
cd /var/www/knowledgeparkguide.in
sudo -u www-data wp core download
sudo -u www-data wp config create --dbname=kpg_wp --dbuser=kpg_wp --dbpass="$DBPASS" --dbhost=localhost
sudo chmod 640 wp-config.php
sudo -u www-data wp core install --url=https://knowledgeparkguide.in --title="Knowledge Park Guide" \
  --admin_user=<pick-a-username-not-admin> --admin_email=<your-email>
```
`wp core install` prints a generated admin password. Save it in your password manager, then **change it after your first login**, because the old one is in the log. (Harmless "cache directory" warnings from WP-CLI can be ignored.)

**Nginx site:**
```bash
sudo tee /etc/nginx/sites-available/knowledgeparkguide.in >/dev/null <<'EOF'
server {
    listen 80;
    listen [::]:80;
    server_name knowledgeparkguide.in www.knowledgeparkguide.in;
    root /var/www/knowledgeparkguide.in;
    index index.php;
    client_max_body_size 64M;

    location / { try_files $uri $uri/ /index.php?$args; }
    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.3-fpm.sock;
    }
    location = /xmlrpc.php { deny all; }
    location ~ /\.(?!well-known) { deny all; }
    location ~* \.(css|js|jpg|jpeg|png|gif|webp|avif|svg|ico|woff2?)$ { expires 30d; access_log off; }
}
EOF
sudo ln -s /etc/nginx/sites-available/knowledgeparkguide.in /etc/nginx/sites-enabled/
sudo rm /etc/nginx/sites-enabled/default
sudo nginx -t && sudo systemctl reload nginx
```

## E. SSL + Cloudflare (needs the domain Active in Cloudflare)

*Done 26 Sep 2026 (run over SSH via `server/remote.sh`; every command logged to `server/logs/`). DNS: A @ → origin IP and CNAME www, both proxied. Certificate: Let's Encrypt (YE1 intermediate) for the apex and www, 26 Sep–25 Dec 2026, installed into Nginx with an HTTP→HTTPS redirect. `certbot renew --dry-run` passed; snap.certbot.renew.timer is active. The LE account has no email (your choice). WordPress 301-redirects www to the apex. The live Nginx config is saved in `server/nginx/`.*

**Cloudflare DNS** (dashboard → DNS → Records):
- `A` · `@` · `<IP>` · **Proxied** (orange)
- `CNAME` · `www` · `knowledgeparkguide.in` · **Proxied**

**Cloudflare API token** (for Certbot): My Profile → API Tokens → Create Token → template **"Edit zone DNS"** → Zone Resources: Include · Specific zone · `knowledgeparkguide.in` → Create. Copy it. Cloudflare shows it only once.

```bash
# Certbot from snap (current version) + Cloudflare DNS plugin
sudo snap install --classic certbot
sudo ln -sf /snap/bin/certbot /usr/bin/certbot
sudo snap set certbot trust-plugin-with-root=ok
sudo snap install certbot-dns-cloudflare

# store the token without it appearing in the log: paste it, press Enter (nothing is shown)
sudo mkdir -p /root/.secrets && read -rs CF_TOKEN
echo "dns_cloudflare_api_token = $CF_TOKEN" | sudo tee /root/.secrets/cloudflare.ini >/dev/null
sudo chmod 600 /root/.secrets/cloudflare.ini && unset CF_TOKEN

# get the cert via DNS-01 and let certbot add the 443 block to nginx
sudo certbot -a dns-cloudflare -i nginx \
  --dns-cloudflare-credentials /root/.secrets/cloudflare.ini \
  -d knowledgeparkguide.in -d www.knowledgeparkguide.in --redirect
sudo certbot renew --dry-run
systemctl list-timers | grep -i certbot
```
Let's Encrypt no longer emails expiry warnings. The snap timer shown above is what renews the cert, so screenshot it.

**Cloudflare settings (Milestone I baseline):**
- SSL/TLS → Overview → **Full (strict)**
- SSL/TLS → Edge Certificates → **Always Use HTTPS: On** · Minimum TLS 1.2 · Automatic HTTPS Rewrites: On
- Speed → Settings → **HTTP/3: On**
- Caching → Tiered Cache → **Smart Tiered Cache: On**
- *Not yet:* Cache Rules, Rocket Loader, WordPress cache plugins. These are Milestone II optimizations, so the "before" PageSpeed test must run without them.
- Report note: Cloudflare **removed Auto Minify on 5 Aug 2024**. Minification is done in WordPress (Milestone II).

**Lock the origin to Cloudflare (Azure NSG).** With the proxy on, every real visitor reaches the VM through Cloudflare, so ports 80 and 443 only need to accept Cloudflare's addresses. Left open, anyone who finds the origin IP can skip Cloudflare's TLS, caching and DDoS protection. Port 22 stays as it is (key-only login).

*Done 29 Sep 2026: in `kpg-web-nsg`, the **HTTP** (priority 300) and **HTTPS** (320) rules went from Source "Any" to Cloudflare's 15 IPv4 ranges. SSH (340) is unchanged. IPv6 ranges aren't needed because Cloudflare reaches the origin only through the IPv4 `A` record.*

1. Get the current list from https://www.cloudflare.com/ips-v4 (the same list is served at `https://api.cloudflare.com/client/v4/ips`). On 29 Sep 2026 it was:
   ```
   173.245.48.0/20,103.21.244.0/22,103.22.200.0/22,103.31.4.0/22,141.101.64.0/18,108.162.192.0/18,190.93.240.0/20,188.114.96.0/20,197.234.240.0/22,198.41.128.0/17,162.158.0.0/15,104.16.0.0/13,104.24.0.0/14,172.64.0.0/13,131.0.72.0/22
   ```
2. Azure portal → Network security groups → `kpg-web-nsg` → Settings → **Inbound security rules** → **HTTP** → Source: **IP Addresses** → paste the comma-separated list into *Source IP addresses/CIDR ranges* → **Save**. Repeat for **HTTPS**. Screenshot the rules list before and after.
3. Verify from your laptop, which is not a Cloudflare IP:
   ```bash
   # laptop: straight to the origin. Must fail to connect now (before the change: 301 on port 80, 200 on 443)
   curl -sk --connect-timeout 10 -o /dev/null -w '%{http_code}\n' --resolve knowledgeparkguide.in:443:<IP> https://knowledgeparkguide.in/
   # laptop: through Cloudflare. Must still be 200, and cf-cache-status: DYNAMIC shows it was fetched from the origin
   curl -sI https://knowledgeparkguide.in/ | grep -iE '^(HTTP|server|cf-cache-status)'
   ```
   Result on 29 Sep 2026: direct to the origin, ports 80 and 443 got no connection within 10 s. Through Cloudflare the site returned 200. SSH on port 22 still answered.
4. Cloudflare changes these ranges rarely. When it does, any edge server using a new range can't reach the origin. Re-check the list every few months and update both rules.

- *Not yet:* Nginx now sees every request as coming from a Cloudflare IP. Logging real visitor IPs needs `set_real_ip_from` for each range plus `real_ip_header CF-Connecting-IP;` (Milestone II).

## F. Verify + capture evidence

```bash
curl -sI https://knowledgeparkguide.in | head -n 12     # expect: HTTP/2 200, server: cloudflare, cf-ray
sudo certbot certificates
sudo nginx -t
systemctl status nginx php8.3-fpm mariadb --no-pager | grep -E 'Active|Loaded'
free -h && swapon --show
exit   # leave ssh, then type `exit` again to stop `script`
```
Screenshots:
- The site in a browser with the padlock
- Cloudflare SSL mode
- dnschecker.org for **A** records (they show Cloudflare IPs because the proxy is on, which is expected)
- WordPress dashboard

## G. Right after launch (don't wait for Milestone II)

1. **PageSpeed "before":** pagespeed.web.dev → mobile + desktop → save both as screenshots or PDF.
2. **Google Search Console:** Domain property → verify via **DNS TXT** (add it in Cloudflare DNS) → screenshot.
3. **GA4:** create a property + web data stream, then deploy the tag with the must-use plugin `server/wordpress/mu-plugins/kpg-ga4.php`.
4. Settings → Permalinks → Custom structure **`/%category%/%postname%/`**. Set this **before publishing anything**, because changing URLs after Google indexes them costs rankings.
