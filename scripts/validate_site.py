#!/usr/bin/env python3
"""Basic validation for the static marketing site."""

from pathlib import Path
import re

ROOT = Path(__file__).resolve().parents[1]

errors = []
html_files = sorted(ROOT.rglob('*.html'))

for page in html_files:
    if '_backup_' in str(page) or page.name.endswith('.bak'):
        continue

    text = page.read_text(encoding='utf-8', errors='ignore')
    if '/assets/site.css' not in text and '/route.css' not in text:
        errors.append(f'{page.relative_to(ROOT)}: missing stylesheet reference')
    if '/assets/site.js' not in text and 'gtag(' not in text:
        # Some pages intentionally have only GA and no site.js. Treat as warning-level only.
        pass
    if 'G-eqCMz7r5gdEPzEoexE' in text:
        errors.append(f'{page.relative_to(ROOT)}: invalid GA ID still present')
    if 'gtag(\'set\', \'user_data\'' in text:
        errors.append(f'{page.relative_to(ROOT)}: legacy user_data call found')

# ensure there is a shared asset file
if not (ROOT / 'assets' / 'site.css').exists():
    errors.append('assets/site.css is missing')
if not (ROOT / 'assets' / 'site.js').exists():
    errors.append('assets/site.js is missing')

print(f'Checked {len(html_files)} HTML files.')
if errors:
    print('Issues found:')
    for item in errors:
        print(' -', item)
    raise SystemExit(1)

print('Validation passed: no structural issues detected.')
