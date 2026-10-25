#!/usr/bin/env python3
"""Push static pages and category hub intros from content/ to WordPress.

Usage: python3 content/publish-pages.py [--check] [slug ...]

content/meta.json lists every page and hub: entries with kind "page" read content/pages/<slug>.html,
entries with kind "category" read content/categories/<slug>.html. With no slugs, all of them are sent.
--check uploads the same bundle but only reports which items differ from the live site; nothing changes.
Guides (posts) go through content/publish.py instead.
"""
import json, pathlib, subprocess, sys

ROOT = pathlib.Path(__file__).resolve().parent.parent
REMOTE = str(ROOT / "server/remote.sh")
WP = "cd /var/www/knowledgeparkguide.in && sudo -u www-data wp"
QUIET = '2>&1 | grep -vE "HTTP_HOST|wp-cli/cache"'


def bundle(slugs):
    meta = json.loads((ROOT / "content/meta.json").read_text(encoding="utf-8"))
    unknown = [s for s in slugs if s not in meta]
    if unknown:
        sys.exit(f"not in content/meta.json: {', '.join(unknown)}")
    out = {"pages": [], "categories": []}
    for slug in slugs or meta:
        m = meta[slug]
        kind = "pages" if m["kind"] == "page" else "categories"
        out[kind].append({
            "slug": slug, "title": m["title"],
            "content": (ROOT / f"content/{kind}/{slug}.html").read_text(encoding="utf-8"),
            "meta_title": m["meta_title"], "meta_description": m["meta_description"],
            "focus_keyword": m["focus_keyword"]})
    # Only send the keys that have items: a "pages" key also re-asserts the front page and posts page.
    return {k: v for k, v in out.items() if v}


def main():
    args = sys.argv[1:]
    check = "--check" in args
    payload = json.dumps(bundle([a for a in args if a != "--check"]), ensure_ascii=False).encode()
    subprocess.run([REMOTE, "cat > /tmp/kpg-content.json"], input=payload, check=True)
    script = "check-content.php" if check else "apply-content.php"
    with open(ROOT / "server/wordpress" / script, "rb") as php:
        subprocess.run([REMOTE, f"{WP} eval-file - {QUIET}; rm -f /tmp/kpg-content.json"], stdin=php, check=True)
    if not check:
        # Rank Math's sitemap cache doesn't refresh on WP-CLI saves, so the page dates in it would go stale.
        subprocess.run([REMOTE, f"{WP} rankmath sitemap generate {QUIET} >/dev/null; echo sitemap regenerated"], check=True)


if __name__ == "__main__":
    main()
