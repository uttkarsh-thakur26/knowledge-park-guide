# Knowledge Park Guide

**Live:** https://knowledgeparkguide.in

This repo holds the infrastructure, theme, tooling and research behind **knowledgeparkguide.in**, an independent, first-hand student guide to Knowledge Park, Greater Noida (getting there, housing, food, safety). It runs as a production WordPress site on a self-managed **Azure VM** behind **Cloudflare**. The repo is the source of truth, and everything is deployed over SSH with small Python, Bash and PHP tools.

It started as an individual project for an SEO course (CSET489, Bennett University). The course requires a live site on a self-managed VPS, technical and on-page SEO, analytics and an audit.

## Highlights
- **₹0 compute:** Ubuntu 24.04 on a 1 GiB Azure VM (free-tier VM and disk). The LEMP stack is tuned for low memory: swap, on-demand PHP-FPM workers and a 128 MB InnoDB pool.
- **Hardened:**
  - Cloudflare **Full (strict)** TLS, with Let's Encrypt certificates issued via a **DNS-01** challenge using a zone-scoped API token, and auto-renewal;
  - 301 canonical redirects, key-only SSH, `xmlrpc` blocked, the dashboard file editor disabled;
  - secrets never written to logs.
- **Fast and accessible:** a custom block theme with system fonts and WCAG-AA contrast checked in code. PageSpeed launch snapshot:

  | | Performance | Accessibility | Best Practices | LCP | CLS | TBT |
  |---|---|---|---|---|---|---|
  | Mobile | 99 | 100 | 100 | 1.5 s | 0 | 0 ms |
  | Desktop | 100 | 100 | 100 | 0.4 s | 0 | 0 ms |

- **Structured data:** Organization, WebSite, BlogPosting (with a Person author), FAQPage and BreadcrumbList JSON-LD. Topical hub URLs were fixed before launch, with sitemaps submitted to Search Console.
- **Measured:** GA4 through a tiny must-use plugin (no second tag, internal traffic excluded), plus Google Search Console.
- **Data-checked content:** Google Autocomplete harvesting, SERP analysis, and OpenStreetMap/OSRM routing to verify distance claims before publishing.

## Architecture

```
Browser ──HTTPS/HTTP3──► Cloudflare (DNS, CDN proxy, edge TLS)
                              │  Full (strict) TLS
                              ▼
              Azure VM · Ubuntu 24.04 · 2 vCPU / 1 GiB · NSG: 22 (keys only), 80, 443
              Nginx ──FastCGI──► PHP 8.3-FPM ──► WordPress 7.1 ──► MariaDB 10.11
              Certbot (DNS-01 via Cloudflare API, systemd timer renewals)
              Rank Math (sitemaps, JSON-LD, redirects, 404 monitor)

This repo ──(tar / WP-CLI eval-file over SSH, every command logged)──► VM
```

## Repository layout

| Path | What it is |
|---|---|
| `server/SETUP.md` | Step-by-step runbook: domain, Cloudflare, VM, LEMP, WordPress, TLS, verification |
| `server/remote.sh` | Runs a command on the VM via ssh-agent and appends command + output to dated audit logs |
| `server/nginx/` | Live Nginx server block (HTTPS, redirects, access rules, static-asset caching) |
| `server/wordpress/themes/kpg/` | Custom block child theme: `theme.json` design system, templates, header/footer |
| `server/wordpress/mu-plugins/kpg-ga4.php` | GA4 tag as a must-use plugin that skips logged-in users |
| `server/wordpress/rank-math-setup.php` | Idempotent SEO-plugin configuration, including creating its DB tables |
| `server/wordpress/apply-content.php` | Idempotent upsert of pages, posts and category hubs with SEO metadata |
| `content/publish.py` | Publishing pipeline: block markup + FAQ schema block → upload → upsert → sitemap refresh |
| `content/` | Page, hub and guide sources (HTML blocks + JSON metadata) |
| `research/` | Autocomplete harvester and data, keyword map, SERP & competitor analysis |
| `evidence/pagespeed.md` | PageSpeed results over time |

## How deployment works
- **Server:** provisioned by following `server/SETUP.md`. Copy `server/.env.example` to `server/.env`, then load the SSH key into ssh-agent.
- **Theme:** `tar -C server/wordpress/themes -czf - kpg | server/remote.sh 'sudo -u www-data tar -C /var/www/knowledgeparkguide.in/wp-content/themes -xzf -'`
- **SEO plugin config:** `server/remote.sh 'cd /var/www/knowledgeparkguide.in && sudo -u www-data wp eval-file -' < server/wordpress/rank-math-setup.php`
- **A guide:** `python3 content/publish.py <slug> draft`, then `publish` once reviewed. It's idempotent, matching by slug, and regenerates the sitemap on publish.

## Engineering notes
- **502s on URLs with query strings.** Nginx logged `upstream sent too big header` after a flood of PHP database errors. The cause was plugin modules enabled by writing their option directly, which skipped their table creation. It's fixed in `rank-math-setup.php` by calling the plugin's own installer.
- **TLS behind a proxy.** DNS-01 avoids the HTTP-01 / 526 chicken-and-egg problem under Full (strict), and the API token is scoped to one zone.
- **Stale sitemap after CLI publishing.** The plugin's sitemap cache doesn't invalidate on WP-CLI saves, so `publish.py` regenerates it.
- **WordPress strips HTML from category descriptions for every user.** Hub intros are plain paragraphs rendered by `wpautop`, so they survive dashboard edits.
- **Directional distances.** OSRM showed station→campus and campus→station road distances differ by up to 2 km because of one-way roads. Both are published.

## Built with
Ubuntu, Nginx, PHP 8.3, MariaDB, WordPress + WP-CLI, Certbot, Cloudflare, Azure, Rank Math, Python 3, Bash.

Site content (text in `content/`) © Uttkarsh Thakur.
