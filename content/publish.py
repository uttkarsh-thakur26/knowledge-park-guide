#!/usr/bin/env python3
"""Push a guide from content/posts/ to WordPress.

Usage: python3 content/publish.py <slug> [draft|publish]

Reads content/posts/<slug>.json (title, category, focus_keyword, meta_title, meta_description,
excerpt, faq[]) and content/posts/<slug>.html (body blocks), appends a Rank Math FAQ block
(which emits FAQPage schema), uploads the bundle and runs server/wordpress/apply-content.php.
"""
import html, json, pathlib, subprocess, sys

ROOT = pathlib.Path(__file__).resolve().parent.parent
REMOTE = str(ROOT / "server/remote.sh")


def block_attrs(attrs):
    # Same escaping as WordPress's serialize_block_attributes(), so the editor parses it cleanly.
    s = json.dumps(attrs, ensure_ascii=False)
    for a, b in (("\\\"", "\\u0022"), ("--", "\\u002d\\u002d"), ("<", "\\u003c"), (">", "\\u003e"), ("&", "\\u0026")):
        s = s.replace(a, b)
    return s


def faq_block(faq):
    qs = [{"id": f"faq-question-{i}", "title": f["question"], "content": f["answer"], "visible": True} for i, f in enumerate(faq, 1)]
    items = "".join(
        f'<div class="rank-math-faq-item"><h3 class="rank-math-question">{html.escape(q["title"])}</h3>'
        f'<div class="rank-math-answer">{html.escape(q["content"])}</div></div>' for q in qs)
    return ('\n\n<!-- wp:heading -->\n<h2 class="wp-block-heading">Frequently asked questions</h2>\n<!-- /wp:heading -->\n\n'
            f'<!-- wp:rank-math/faq-block {block_attrs({"questions": qs})} -->\n'
            f'<div class="wp-block-rank-math-faq-block">{items}</div>\n<!-- /wp:rank-math/faq-block -->\n')


def main():
    slug, status = sys.argv[1], (sys.argv[2] if len(sys.argv) > 2 else "draft")
    assert status in ("draft", "publish"), status
    meta = json.loads((ROOT / f"content/posts/{slug}.json").read_text())
    body = (ROOT / f"content/posts/{slug}.html").read_text().rstrip()
    content = body + (faq_block(meta["faq"]) if meta.get("faq") else "\n")
    post = {k: meta[k] for k in ("title", "category", "focus_keyword", "meta_title", "meta_description", "excerpt")}
    post.update(slug=slug, status=status, content=content)
    payload = json.dumps({"posts": [post]}, ensure_ascii=False).encode()
    subprocess.run([REMOTE, "cat > /tmp/kpg-content.json"], input=payload, check=True)
    with open(ROOT / "server/wordpress/apply-content.php", "rb") as php:
        subprocess.run([REMOTE, "cd /var/www/knowledgeparkguide.in && sudo -u www-data wp eval-file - 2>&1 | grep -v HTTP_HOST; rm -f /tmp/kpg-content.json"], stdin=php, check=True)
    if status == "publish":
        # Rank Math's sitemap cache doesn't refresh on WP-CLI saves; without this the new post is missing from sitemap_index.xml.
        subprocess.run([REMOTE, "cd /var/www/knowledgeparkguide.in && sudo -u www-data wp rankmath sitemap generate 2>&1 | grep -v HTTP_HOST >/dev/null; echo sitemap regenerated"], check=True)


if __name__ == "__main__":
    main()
