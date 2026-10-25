#!/usr/bin/env python3
"""Add a photo to the WordPress media library as a resized WebP with its metadata removed.

Usage: python3 content/add-image.py <photo> <name> "<alt text>"

<name> becomes the file name (pari-chowk-auto-stand -> pari-chowk-auto-stand.webp). The server turns the photo
upright, strips EXIF (including GPS location), scales it to at most 1600 px wide and saves it as WebP, then imports
it with the alt text. Prints the attachment ID and URL to use in the post's image block.
"""
import json, pathlib, subprocess, sys

ROOT = pathlib.Path(__file__).resolve().parent.parent
REMOTE = str(ROOT / "server/remote.sh")
WP = "cd /var/www/knowledgeparkguide.in && sudo -u www-data wp"
QUIET = '2>&1 | grep -vE "HTTP_HOST|wp-cli/cache"'


def main():
    if len(sys.argv) != 4:
        sys.exit(__doc__)
    photo, name, alt = pathlib.Path(sys.argv[1]), sys.argv[2], sys.argv[3]
    job = json.dumps({"name": name, "alt": alt}, ensure_ascii=False).encode()
    # Both go over stdin, so neither the photo nor the alt text ends up in the command log.
    subprocess.run([REMOTE, "cat > /tmp/kpg-image.json"], input=job, check=True)
    subprocess.run([REMOTE, "cat > /tmp/kpg-image-src"], input=photo.read_bytes(), check=True)
    with open(ROOT / "server/wordpress/import-image.php", "rb") as php:
        subprocess.run([REMOTE, f"{WP} eval-file - {QUIET}; rm -f /tmp/kpg-image-src /tmp/kpg-image.json"],
                       stdin=php, check=True)


if __name__ == "__main__":
    main()
