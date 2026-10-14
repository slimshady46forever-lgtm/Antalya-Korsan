#!/usr/bin/env python3
"""
fix_i18n.py — fixes hardcoded Turkish strings that leak into EN/DE/RU pages.

Fixes:
  index.html:
    - adds  nav.about          to all 4 language dicts
    - adds  common.waShort / common.waHero  to all 4 language dicts
    - adds  data-i18n to the header WhatsApp button
    - adds  data-i18n to the hero  WhatsApp button
  hakkimizda.html:
    - adds  common.waShort     to all 4 language dicts
    - adds  data-i18n to the header WhatsApp button
  transfer.html:
    - adds  nav.about          to all 4 language dicts
    - adds  footer.altLine     to all 4 language dicts
    - adds  data-i18n to the footer "Alt hat" link and the WhatsApp footer link

Safe to run twice (idempotent). Backs up every file it modifies.
"""

import shutil
import time
from pathlib import Path

ROOT = Path(__file__).parent.resolve()
BACKUP = ROOT / f"_backup_i18n_{int(time.time())}"


def backup(path: Path) -> None:
    dest = BACKUP / path.relative_to(ROOT)
    dest.parent.mkdir(parents=True, exist_ok=True)
    shutil.copy2(path, dest)


def log(msg: str) -> None:
    print(f"  {msg}")


# ---------------------------------------------------------------------------
# 1) index.html
# ---------------------------------------------------------------------------
def fix_index(path: Path) -> bool:
    if not path.exists():
        log("index.html not found — skipping")
        return False
    s = path.read_text(encoding="utf-8")
    orig = s

    # --- nav.about in each language dict ---
    pairs_nav = [
        (
            'nav: { services:"Hizmetler", prices:"Fiyat Hesapla", routes:"Güzergâhlar", fleet:"Araçlarımız", faq:"S.S.S.", blog:"Blog" },',
            'nav: { services:"Hizmetler", prices:"Fiyat Hesapla", routes:"Güzergâhlar", fleet:"Araçlarımız", faq:"S.S.S.", blog:"Blog", about:"Hakkımızda" },',
        ),
        (
            'nav:{ services:"Services", prices:"Fare Calculator", routes:"Routes", fleet:"Our Fleet", faq:"FAQ", blog:"Blog" },',
            'nav:{ services:"Services", prices:"Fare Calculator", routes:"Routes", fleet:"Our Fleet", faq:"FAQ", blog:"Blog", about:"About Us" },',
        ),
        (
            'nav:{ services:"Услуги", prices:"Калькулятор", routes:"Маршруты", fleet:"Автопарк", faq:"Вопросы", blog:"Блог" },',
            'nav:{ services:"Услуги", prices:"Калькулятор", routes:"Маршруты", fleet:"Автопарк", faq:"Вопросы", blog:"Блог", about:"О нас" },',
        ),
        (
            'nav:{ services:"Leistungen", prices:"Preis berechnen", routes:"Routen", fleet:"Unsere Flotte", faq:"FAQ", blog:"Blog" },',
            'nav:{ services:"Leistungen", prices:"Preis berechnen", routes:"Routen", fleet:"Unsere Flotte", faq:"FAQ", blog:"Blog", about:"Über uns" },',
        ),
    ]
    for old, new in pairs_nav:
        s = s.replace(old, new)

    # --- common.waShort / common.waHero in each language dict ---
    pairs_common = [
        (
            'common:{ wa:"WhatsApp", call:"Hemen Ara", callMobile:"Ara", pricesMobile:"Fiyat", priceAsk:"Fiyat Al →" },',
            'common:{ wa:"WhatsApp", call:"Hemen Ara", callMobile:"Ara", pricesMobile:"Fiyat", priceAsk:"Fiyat Al →", waShort:"WhatsApp\'tan Fiyat Al ↗", waHero:"WhatsApp\'tan Fiyat Al →" },',
        ),
        (
            'common:{ wa:"WhatsApp", call:"Call Now", callMobile:"Call", pricesMobile:"Prices", priceAsk:"Get a Quote →" },',
            'common:{ wa:"WhatsApp", call:"Call Now", callMobile:"Call", pricesMobile:"Prices", priceAsk:"Get a Quote →", waShort:"Get a Quote on WhatsApp ↗", waHero:"Get a Quote on WhatsApp →" },',
        ),
        (
            'common:{ wa:"WhatsApp", call:"Позвонить", callMobile:"Звонок", pricesMobile:"Цены", priceAsk:"Узнать цену →" },',
            'common:{ wa:"WhatsApp", call:"Позвонить", callMobile:"Звонок", pricesMobile:"Цены", priceAsk:"Узнать цену →", waShort:"Узнать цену в WhatsApp ↗", waHero:"Узнать цену в WhatsApp →" },',
        ),
        (
            'common:{ wa:"WhatsApp", call:"Jetzt anrufen", callMobile:"Anrufen", pricesMobile:"Preise", priceAsk:"Preis anfragen →" },',
            'common:{ wa:"WhatsApp", call:"Jetzt anrufen", callMobile:"Anrufen", pricesMobile:"Preise", priceAsk:"Preis anfragen →", waShort:"Preis per WhatsApp anfragen ↗", waHero:"Preis per WhatsApp anfragen →" },',
        ),
    ]
    for old, new in pairs_common:
        s = s.replace(old, new)

    # --- header WhatsApp button ---
    s = s.replace(
        '<a class="btn" data-wa="header" href="#">WhatsApp\'tan Fiyat Al ↗</a>',
        '<a class="btn" data-wa="header" href="#" data-i18n="common.waShort">WhatsApp\'tan Fiyat Al ↗</a>',
    )

    # --- hero WhatsApp button ---
    s = s.replace(
        '<a class="btn" data-wa="hero" href="#">WhatsApp\'tan Fiyat Al →</a>',
        '<a class="btn" data-wa="hero" href="#" data-i18n="common.waHero">WhatsApp\'tan Fiyat Al →</a>',
    )

    if s != orig:
        backup(path)
        path.write_text(s, encoding="utf-8")
        log("index.html — added nav.about, common.waShort/waHero, data-i18n on header+hero buttons")
        return True
    log("index.html — nothing to change")
    return False


# ---------------------------------------------------------------------------
# 2) hakkimizda.html
# ---------------------------------------------------------------------------
def fix_hakkimizda(path: Path) -> bool:
    if not path.exists():
        log("hakkimizda.html not found — skipping")
        return False
    s = path.read_text(encoding="utf-8")
    orig = s

    # --- common.waShort in each language dict ---
    pairs_common = [
        (
            'common:{ wa:"WhatsApp", callMobile:"Ara", homeMobile:"Ana Sayfa" },',
            'common:{ wa:"WhatsApp", callMobile:"Ara", homeMobile:"Ana Sayfa", waShort:"WhatsApp\'tan Fiyat Al ↗" },',
        ),
        (
            'common:{ wa:"WhatsApp", callMobile:"Call", homeMobile:"Home" },',
            'common:{ wa:"WhatsApp", callMobile:"Call", homeMobile:"Home", waShort:"Get a Quote on WhatsApp ↗" },',
        ),
        (
            'common:{ wa:"WhatsApp", callMobile:"Звонок", homeMobile:"Главная" },',
            'common:{ wa:"WhatsApp", callMobile:"Звонок", homeMobile:"Главная", waShort:"Узнать цену в WhatsApp ↗" },',
        ),
        (
            'common:{ wa:"WhatsApp", callMobile:"Anrufen", homeMobile:"Startseite" },',
            'common:{ wa:"WhatsApp", callMobile:"Anrufen", homeMobile:"Startseite", waShort:"Preis per WhatsApp anfragen ↗" },',
        ),
    ]
    for old, new in pairs_common:
        s = s.replace(old, new)

    # --- header WhatsApp button ---
    s = s.replace(
        '<a class="btn" data-wa="header" href="#">WhatsApp\'tan Fiyat Al ↗</a>',
        '<a class="btn" data-wa="header" href="#" data-i18n="common.waShort">WhatsApp\'tan Fiyat Al ↗</a>',
    )

    if s != orig:
        backup(path)
        path.write_text(s, encoding="utf-8")
        log("hakkimizda.html — added common.waShort, data-i18n on header button")
        return True
    log("hakkimizda.html — nothing to change")
    return False


# ---------------------------------------------------------------------------
# 3) transfer.html
# ---------------------------------------------------------------------------
def fix_transfer(path: Path) -> bool:
    if not path.exists():
        log("transfer.html not found — skipping")
        return False
    s = path.read_text(encoding="utf-8")
    orig = s

    # --- nav.about in each language dict ---
    pairs_nav = [
        (
            'nav:{ services:"Hizmetler", routes:"Güzergâhlar", fleet:"Araçlarımız", faq:"S.S.S." },',
            'nav:{ services:"Hizmetler", routes:"Güzergâhlar", fleet:"Araçlarımız", faq:"S.S.S.", about:"Hakkımızda" },',
        ),
        (
            'nav:{ services:"Services", routes:"Routes", fleet:"Our Fleet", faq:"FAQ" },',
            'nav:{ services:"Services", routes:"Routes", fleet:"Our Fleet", faq:"FAQ", about:"About Us" },',
        ),
        (
            'nav:{ services:"Услуги", routes:"Маршруты", fleet:"Автопарк", faq:"Вопросы" },',
            'nav:{ services:"Услуги", routes:"Маршруты", fleet:"Автопарк", faq:"Вопросы", about:"О нас" },',
        ),
        (
            'nav:{ services:"Leistungen", routes:"Routen", fleet:"Unsere Flotte", faq:"FAQ" },',
            'nav:{ services:"Leistungen", routes:"Routen", fleet:"Unsere Flotte", faq:"FAQ", about:"Über uns" },',
        ),
    ]
    for old, new in pairs_nav:
        s = s.replace(old, new)

    # --- footer.altLine in each language dict ---
    pairs_footer = [
        (
            'quick:"Hızlı Bağlantılar", contact:"İletişim", waLabel:"WhatsApp: +90 531 692 25 78",',
            'quick:"Hızlı Bağlantılar", contact:"İletişim", waLabel:"WhatsApp: +90 531 692 25 78", altLine:"Alt hat: +63 975 261 1743",',
        ),
        (
            'quick:"Quick Links", contact:"Contact", waLabel:"WhatsApp: +90 531 692 25 78",',
            'quick:"Quick Links", contact:"Contact", waLabel:"WhatsApp: +90 531 692 25 78", altLine:"Alt line: +63 975 261 1743",',
        ),
        (
            'quick:"Быстрые ссылки", contact:"Контакты", waLabel:"WhatsApp: +90 531 692 25 78",',
            'quick:"Быстрые ссылки", contact:"Контакты", waLabel:"WhatsApp: +90 531 692 25 78", altLine:"Доп. линия: +63 975 261 1743",',
        ),
        (
            'quick:"Schnellzugriff", contact:"Kontakt", waLabel:"WhatsApp: +90 531 692 25 78",',
            'quick:"Schnellzugriff", contact:"Kontakt", waLabel:"WhatsApp: +90 531 692 25 78", altLine:"Alt. Leitung: +63 975 261 1743",',
        ),
    ]
    for old, new in pairs_footer:
        s = s.replace(old, new)

    # --- footer "Alt hat" link: add data-i18n ---
    s = s.replace(
        '<a href="https://wa.me/639752611743" target="_blank" rel="noopener" style="color:#a9a9ac">Alt hat: +63 975 261 1743</a>',
        '<a href="https://wa.me/639752611743" target="_blank" rel="noopener" style="color:#a9a9ac" data-i18n="footer.altLine">Alt hat: +63 975 261 1743</a>',
    )
    # --- footer WhatsApp number link: add data-i18n (keeps number consistent) ---
    s = s.replace(
        '<a href="https://wa.me/905316922578" target="_blank" rel="noopener" style="color:#ffcc00;font-weight:800">WhatsApp: +90 531 692 25 78</a>',
        '<a href="https://wa.me/905316922578" target="_blank" rel="noopener" style="color:#ffcc00;font-weight:800" data-i18n="footer.waLabel">WhatsApp: +90 531 692 25 78</a>',
    )

    if s != orig:
        backup(path)
        path.write_text(s, encoding="utf-8")
        log("transfer.html — added nav.about, footer.altLine, data-i18n on footer links")
        return True
    log("transfer.html — nothing to change")
    return False


# ---------------------------------------------------------------------------
# main
# ---------------------------------------------------------------------------
def main() -> int:
    print("Antalya Korsan — i18n hardcoded-Turkish fixer")
    print(f"Project root: {ROOT}")
    print(f"Backups:      {BACKUP}")
    print()

    changed = 0
    if fix_index(ROOT / "index.html"):          changed += 1
    if fix_hakkimizda(ROOT / "hakkimizda.html"): changed += 1
    if fix_transfer(ROOT / "transfer.html"):    changed += 1

    print()
    if changed == 0:
        print("Nothing to change — files already fixed.")
    else:
        print(f"Done — {changed} file(s) modified.")
        print(f"Backups in: {BACKUP}")
    return 0


if __name__ == "__main__":
    raise SystemExit(main())