#!/usr/bin/env python3
"""
fix_optional.py — optional improvements for antalyakorsan.com

  1. Restores id="schema*" attributes in transfer.html
  2. Makes the injected cookie banner/dialog language-aware on route pages
  3. Adds <lastmod> to every <url> block in sitemap.xml

Safe to run multiple times. Backs up every modified file.
"""

import re
import sys
import time
import shutil
from pathlib import Path

ROOT = Path(__file__).parent.resolve()
BACKUP = ROOT / f"_backup_optional_{int(time.time())}"

SKIP = {"index.html", "transfer.html", "hakkimizda.html", "404.html"}

# ---------------------------------------------------------------------------
# helpers
# ---------------------------------------------------------------------------
def backup(path: Path) -> None:
    rel = path.relative_to(ROOT)
    dest = BACKUP / rel
    dest.parent.mkdir(parents=True, exist_ok=True)
    shutil.copy2(path, dest)

def log(msg: str) -> None:
    print(f"  {msg}")

def detect_lang(content: str, path: Path) -> str:
    m = re.search(r'<html\s+lang="([a-z]{2})"', content, re.I)
    if m:
        return m.group(1).lower()
    for l in ("en", "de", "ru"):
        if l in path.parts:
            return l
    return "tr"

# ---------------------------------------------------------------------------
# 1 — transfer.html: restore schema ids
# ---------------------------------------------------------------------------
SCHEMA_IDS = {
    "schemaService":    "Service",
    "schemaFaq":        "FAQPage",
    "schemaBreadcrumb": "BreadcrumbList",
}

def fix_transfer_schema_ids(path: Path) -> bool:
    if not path.exists():
        log("transfer.html not found — skipping")
        return False
    content = path.read_text(encoding="utf-8")
    if 'id="schemaService"' in content and 'id="schemaFaq"' in content \
       and 'id="schemaBreadcrumb"' in content:
        log("transfer.html — schema ids already present")
        return False
    if '<script type="application/ld+json">{}</script>' not in content:
        log("transfer.html — no empty schema block found; skipping")
        return False

    # Replace the three consecutive empty script tags, in order
    ids = ["schemaService", "schemaFaq", "schemaBreadcrumb"]
    idx = {"i": 0}

    def repl(match: re.Match) -> str:
        if idx["i"] < len(ids):
            i = ids[idx["i"]]
            idx["i"] += 1
            return f'<script type="application/ld+json" id="{i}">{{}}</script>'
        return match.group(0)

    new_content = re.sub(
        r'<script type="application/ld\+json">\{\}</script>',
        repl,
        content,
        count=3,
    )

    if new_content != content:
        backup(path)
        path.write_text(new_content, encoding="utf-8")
        log("transfer.html — restored schema ids")
        return True
    log("transfer.html — nothing to change")
    return False

# ---------------------------------------------------------------------------
# 2 — route pages: localize the injected cookie banner
# ---------------------------------------------------------------------------
COOKIE_STRINGS = {
    "tr": {
        "title": "Gizliliğiniz, sizin seçiminiz.",
        "desc":  "Analitik ve reklam çerezleri isteğe bağlıdır. Tercihlerinizi istediğiniz zaman değiştirebilirsiniz.",
        "reject":"Sadece Zorunlu",
        "prefs": "Tercihler",
        "accept":"Tümünü Kabul Et",
        "dialog_title": "Gizliliğiniz, sizin seçiminiz.",
        "dialog_desc":  "Dil ve görünüm için zorunlu depolama kullanıyoruz. Analitik ve reklam dönüşüm çerezleri seçimlerinize bağlıdır.",
        "necessary":    "Zorunlu / her zaman açık",
        "analytics":    "Analitik ve performans",
        "marketing":    "Reklam dönüşüm ölçümü (Google Ads)",
        "save":         "Tercihleri Kaydet",
    },
    "en": {
        "title": "Your privacy, your choice.",
        "desc":  "Analytics and ad cookies are optional. You can change your choices at any time.",
        "reject":"Essential only",
        "prefs": "Preferences",
        "accept":"Accept all",
        "dialog_title": "Your privacy, your choice.",
        "dialog_desc":  "We use essential storage for language and appearance. Analytics and ad conversion cookies depend on your choices.",
        "necessary":    "Essential / always enabled",
        "analytics":    "Analytics and performance",
        "marketing":    "Ad conversion measurement (Google Ads)",
        "save":         "Save preferences",
    },
    "de": {
        "title": "Ihre Privatsphäre, Ihre Wahl.",
        "desc":  "Analyse- und Werbe-Cookies sind optional. Sie können Ihre Auswahl jederzeit ändern.",
        "reject":"Nur notwendige",
        "prefs": "Einstellungen",
        "accept":"Alle akzeptieren",
        "dialog_title": "Ihre Privatsphäre, Ihre Wahl.",
        "dialog_desc":  "Wir verwenden notwendige Speicher für Sprache und Darstellung. Analyse- und Werbe-Conversion-Cookies hängen von Ihrer Auswahl ab.",
        "necessary":    "Notwendig / immer aktiv",
        "analytics":    "Analyse und Leistung",
        "marketing":    "Werbe-Conversion-Messung (Google Ads)",
        "save":         "Einstellungen speichern",
    },
    "ru": {
        "title": "Ваша приватность — ваш выбор.",
        "desc":  "Аналитические и рекламные файлы cookie — опциональны. Изменить выбор можно в любое время.",
        "reject":"Только необходимые",
        "prefs": "Настройки",
        "accept":"Принять все",
        "dialog_title": "Ваша приватность — ваш выбор.",
        "dialog_desc":  "Мы используем обязательное хранилище для языка и оформления. Аналитические и рекламные файлы cookie зависят от вашего выбора.",
        "necessary":    "Обязательные / всегда вкл.",
        "analytics":    "Аналитика и производительность",
        "marketing":    "Измерение рекламных конверсий (Google Ads)",
        "save":         "Сохранить настройки",
    },
}

# Map: for each UI string, which HTML slot it lives in
BANNER_REPLACEMENTS = {
    # banner strong (title)
    "banner_title": lambda S: (
        f'<strong>{S["title"]}</strong>'
    ),
    # banner p (desc)
    "banner_desc": lambda S: (
        f'<p>{S["desc"]}</p>'
    ),
    # reject button
    "banner_reject": lambda S: (
        f'<button type="button" class="cb-outline" data-consent="reject">{S["reject"]}</button>'
    ),
    # prefs button
    "banner_prefs": lambda S: (
        f'<button type="button" class="cb-outline" id="openCookiePrefs">{S["prefs"]}</button>'
    ),
    # accept button
    "banner_accept": lambda S: (
        f'<button type="button" class="cb-accept" data-consent="accept">{S["accept"]}</button>'
    ),
    # dialog h2
    "dialog_title": lambda S: (
        f'<h2>{S["dialog_title"]}</h2>'
    ),
    # dialog p
    "dialog_desc": lambda S: (
        f'<p>{S["dialog_desc"]}</p>'
    ),
    # consent option - necessary
    "dialog_necessary": lambda S: (
        f'<span>{S["necessary"]}</span>'
    ),
    # consent option - analytics
    "dialog_analytics": lambda S: (
        f'<span>{S["analytics"]}</span>'
    ),
    # consent option - marketing
    "dialog_marketing": lambda S: (
        f'<span>{S["marketing"]}</span>'
    ),
    # save button
    "dialog_save": lambda S: (
        f'<button type="button" id="saveCookiePrefs">{S["save"]}</button>'
    ),
}

def localize_cookie_block(content: str, lang: str) -> str:
    """
    Rewrite the injected cookie banner/dialog in place, using the given lang.
    Uses simple, unique anchors around each element.
    """
    S = COOKIE_STRINGS[lang]

    # banner <aside>...</aside>
    aside_pat = re.compile(
        r'<aside id="cookieBanner"[^>]*>.*?</aside>',
        re.DOTALL,
    )
    def repl_aside(m: re.Match) -> str:
        block = m.group(0)
        block = re.sub(r'<strong>.*?</strong>', BANNER_REPLACEMENTS["banner_title"](S), block, count=1, flags=re.DOTALL)
        block = re.sub(r'<p>.*?</p>', BANNER_REPLACEMENTS["banner_desc"](S), block, count=1, flags=re.DOTALL)
        block = re.sub(
            r'<button[^>]*data-consent="reject"[^>]*>.*?</button>',
            BANNER_REPLACEMENTS["banner_reject"](S), block, count=1, flags=re.DOTALL)
        block = re.sub(
            r'<button[^>]*id="openCookiePrefs"[^>]*>.*?</button>',
            BANNER_REPLACEMENTS["banner_prefs"](S), block, count=1, flags=re.DOTALL)
        block = re.sub(
            r'<button[^>]*data-consent="accept"[^>]*>.*?</button>',
            BANNER_REPLACEMENTS["banner_accept"](S), block, count=1, flags=re.DOTALL)
        return block
    content = aside_pat.sub(repl_aside, content, count=1)

    # dialog <dialog id="cookieDialog">...</dialog>
    dialog_pat = re.compile(
        r'<dialog id="cookieDialog">.*?</dialog>',
        re.DOTALL,
    )
    def repl_dialog(m: re.Match) -> str:
        block = m.group(0)
        block = re.sub(r'<h2>.*?</h2>', BANNER_REPLACEMENTS["dialog_title"](S), block, count=1, flags=re.DOTALL)
        # first <p> inside dialog is the description
        block = re.sub(r'<p>.*?</p>', BANNER_REPLACEMENTS["dialog_desc"](S), block, count=1, flags=re.DOTALL)

        # Rewrite each consent-option <span> in order
        span_iter = iter(["dialog_necessary", "dialog_analytics", "dialog_marketing"])
        def repl_span(sm: re.Match) -> str:
            try:
                key = next(span_iter)
            except StopIteration:
                return sm.group(0)
            return BANNER_REPLACEMENTS[key](S)
        block = re.sub(r'<span>.*?</span>', repl_span, block, flags=re.DOTALL)

        # save button
        block = re.sub(
            r'<button[^>]*id="saveCookiePrefs"[^>]*>.*?</button>',
            BANNER_REPLACEMENTS["dialog_save"](S), block, count=1, flags=re.DOTALL)
        return block
    content = dialog_pat.sub(repl_dialog, content, count=1)

    # mark as localized so re-runs are cheap
    content = re.sub(
        r'<aside id="cookieBanner"',
        f'<aside id="cookieBanner" data-cookie-lang="{lang}"',
        content, count=1,
    )
    return content

def fix_route_cookie_lang(path: Path) -> bool:
    content = path.read_text(encoding="utf-8")
    if 'id="cookieBanner"' not in content:
        return False  # no banner injected here; nothing to do

    lang = detect_lang(content, path)

    m = re.search(r'<aside id="cookieBanner"\s+data-cookie-lang="([a-z]{2})"', content)
    if m and m.group(1) == lang:
        return False  # already localized correctly

    new_content = localize_cookie_block(content, lang)
    if new_content != content:
        backup(path)
        path.write_text(new_content, encoding="utf-8")
        log(f"{path.name} — cookie banner localized to {lang}")
        return True
    return False

# ---------------------------------------------------------------------------
# 3 — sitemap.xml: add <lastmod> to every <url>
# ---------------------------------------------------------------------------
def fix_sitemap(path: Path) -> bool:
    if not path.exists():
        log("sitemap.xml not found — skipping")
        return False
    content = path.read_text(encoding="utf-8")
    if "<lastmod>" in content:
        log("sitemap.xml — already has <lastmod>")
        return False

    today = time.strftime("%Y-%m-%d")

    def repl_url(m: re.Match) -> str:
        block = m.group(0)
        # insert <lastmod> right after </loc> if not present
        if "<lastmod>" in block:
            return block
        return re.sub(
            r'(</loc>)',
            rf'\1\n    <lastmod>{today}</lastmod>',
            block, count=1,
        )

    new_content = re.sub(
        r'<url>.*?</url>',
        repl_url,
        content,
        flags=re.DOTALL,
    )
    if new_content != content:
        backup(path)
        path.write_text(new_content, encoding="utf-8")
        log(f"sitemap.xml — <lastmod>{today}</lastmod> added to every <url>")
        return True
    return False

# ---------------------------------------------------------------------------
# main
# ---------------------------------------------------------------------------
def main() -> int:
    print("Antalya Korsan — optional improvements")
    print(f"Project root: {ROOT}")
    print(f"Backups:      {BACKUP}")
    print()

    changed = 0

    # 1
    if fix_transfer_schema_ids(ROOT / "transfer.html"):
        changed += 1

    # 2
    for p in sorted(ROOT.glob("*.html")):
        if p.name in SKIP:
            continue
        if fix_route_cookie_lang(p):
            changed += 1

    # 3
    if fix_sitemap(ROOT / "sitemap.xml"):
        changed += 1

    print()
    if changed == 0:
        print("Nothing to change.")
    else:
        print(f"Done — {changed} file(s) modified.")
        print(f"Backups in: {BACKUP}")

    print()
    print("Blog pages are not touched by this script.")
    print("To regenerate them with clean JSON-LD:")
    print("  php build-blog.php")
    print("  rm build-blog.php")
    print("  # then re-run fix_site.py (it is idempotent) to re-apply small fixes")
    return 0


if __name__ == "__main__":
    sys.exit(main())