#!/usr/bin/env python3
"""Normalize shared asset references across the static site."""

from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]


def patch_html(path: Path) -> None:
    text = path.read_text(encoding='utf-8')
    changed = False

    if '/assets/site.css' not in text and '/route.css' in text:
        text = text.replace('<link rel="stylesheet" href="/route.css">', '<link rel="stylesheet" href="/assets/site.css">', 1)
        changed = True
    elif '/assets/site.css' not in text:
        marker = '</head>'
        insert = '  <link rel="stylesheet" href="/assets/site.css">\n'
        if marker in text:
            text = text.replace(marker, insert + marker, 1)
            changed = True

    if '/assets/site.js' not in text:
        marker = '</body>'
        insert = '  <script src="/assets/site.js" defer></script>\n'
        if marker in text:
            text = text.replace(marker, insert + marker, 1)
            changed = True

    if changed:
        path.write_text(text, encoding='utf-8')
        print(f'updated: {path.relative_to(ROOT)}')


if __name__ == '__main__':
    for p in sorted(ROOT.rglob('*.html')):
        patch_html(p)
    print(f'processed {len(list(ROOT.rglob("*.html")))} html files')
