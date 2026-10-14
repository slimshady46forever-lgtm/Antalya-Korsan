#!/usr/bin/env python3
"""
fix_site.py — one-shot fixer for antalyakorsan.com

Fixes applied:
  1.  Remove invalid GA4 ID  (G-eqCMz7r5gdEPzEoexE)
  2.  Add Google Ads conversion ID (AW-18480652924)
  3.  Decode HTML entities inside <script type="application/ld+json"> blocks
  4.  Inject cookie consent banner/dialog into route + blog pages
  5.  Fix multilingual links (?lang=xx preserved on EN/DE/RU pages)
  6.  Fix blog language-picker overlapping the sticky header
  7.  Fix index.html cookie-consent tracking bug (window.__track ordering)
  8.  Remove invalid gtag('set','user_data',{country:'TR'}) call
  9.  Add GA4 + consent block to hakkimizda.html (it had none)
  10. robots.txt: add Disallow: /build-blog.php
  11. llms.txt:  drop the dead #cookies anchor link
  12. build-blog.php: use json_encode() for JSON-LD (no more &#039;)

Usage:
    python3 fix_site.py
A timestamped backup of every modified file is written to ./_backup_<ts>/
"""

import os
import re
import sys
import time
import shutil
from pathlib import Path

ROOT = Path(__file__).parent.resolve()
BACKUP = ROOT / f"_backup_{int(time.time())}"

INVALID_GA_ID = "G-eqCMz7r5gdEPzEoexE"
GA4_ID        = "G-L5YM12ZQ63"
ADS_ID        = "AW-18480652924"

SKIP_HTML = {"index.html", "transfer.html", "hakkimizda.html", "404.html"}

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
    # fall back to path
    parts = path.parts
    for l in ("en", "de", "ru"):
        if l in parts:
            return l
    return "tr"


def add_shared_assets(content: str) -> str:
    if '/assets/site.css' in content:
        content = content.replace('/route.css', '/assets/site.css') if '/route.css' in content else content
    else:
        if '/route.css' in content:
            content = content.replace('<link rel="stylesheet" href="/route.css">', '<link rel="stylesheet" href="/assets/site.css">', 1)
        elif '</head>' in content:
            content = content.replace('</head>', '  <link rel="stylesheet" href="/assets/site.css">\n</head>', 1)

    if '/assets/site.js' not in content and '</body>' in content:
        content = content.replace('</body>', '  <script src="/assets/site.js" defer></script>\n</body>', 1)

    return content


def is_route_page(path: Path) -> bool:
    return (
        path.parent == ROOT
        and path.suffix == ".html"
        and path.name not in SKIP_HTML
    )

def is_blog_page(path: Path) -> bool:
    try:
        path.relative_to(ROOT / "blog")
        return path.suffix == ".html"
    except ValueError:
        return False

# ---------------------------------------------------------------------------
# 1 & 2 — GA4 cleanup + Google Ads ID
# ---------------------------------------------------------------------------
def fix_ga_ids(content: str) -> str:
    # remove the invalid config call
    content = re.sub(
        r"\s*gtag\(\s*'config'\s*,\s*'" + re.escape(INVALID_GA_ID) + r"'\s*\)\s*;",
        "",
        content,
    )
    # remove the invalid ID from any JS array / string literal too
    content = content.replace(INVALID_GA_ID, "")

    # add Google Ads config right after GA4 config (only once)
    if ADS_ID not in content:
        pattern = re.compile(
            r"(gtag\(\s*'config'\s*,\s*'" + re.escape(GA4_ID) + r"'\s*\)\s*;)"
        )
        def _add(match):
            return match.group(1) + f"\n  gtag('config', '{ADS_ID}');"
        content, n = pattern.subn(_add, content, count=1)
        if n == 0:
            # GA4 config not in this file (e.g. hakkimizda.html) — handled later
            pass
    return content

# ---------------------------------------------------------------------------
# 3 — JSON-LD entity decoding
# ---------------------------------------------------------------------------
def decode_json_ld_entities(content: str) -> str:
    def replacer(match: re.Match) -> str:
        inner = match.group(1)
        # decode the HTML entities that htmlspecialchars() produced
        inner = (
            inner.replace("&#039;", "'")
                 .replace("&#39;", "'")
                 .replace("&quot;", '"')
                 .replace("&amp;", "&")
                 .replace("&lt;", "<")
                 .replace("&gt;", ">")
        )
        # re-escape the required JSON characters
        inner = inner.replace("\\", "\\\\").replace("'", "\\u0027") if False else inner
        return '<script type="application/ld+json">' + inner + "</script>"

    return re.sub(
        r'<script type="application/ld\+json"[^>]*>(.*?)</script>',
        replacer,
        content,
        flags=re.DOTALL,
    )

# ---------------------------------------------------------------------------
# 5 — Multilingual link fixing (EN / DE / RU pages)
# ---------------------------------------------------------------------------
def fix_multilingual_links(content: str, lang: str) -> str:
    if lang == "tr":
        return content

    # /#section  →  /?lang=xx#section
    content = re.sub(
        r'href="/#([A-Za-z0-9_\-]+)"',
        lambda m: f'href="/?lang={lang}#{m.group(1)}"',
        content,
    )

    # /hakkimizda.html  →  /hakkimizda.html?lang=xx  (only if not already parameterised)
    content = re.sub(
        r'href="/hakkimizda\.html(?![?])"',
        f'href="/hakkimizda.html?lang={lang}"',
        content,
    )

    return content

# ---------------------------------------------------------------------------
# 6 — Blog language-picker position
# ---------------------------------------------------------------------------
def fix_blog_lang_picker(content: str) -> str:
    # The blog pages use this rule; shift it below the sticky header
    content = content.replace(
        ".lang-bar{position:fixed;top:16px;right:16px;z-index:10}",
        ".lang-bar{position:fixed;top:100px;right:16px;z-index:9}\n"
        "@media(max-width:780px){.lang-bar{top:80px;right:10px;z-index:9}}",
    )
    return content

# ---------------------------------------------------------------------------
# 7 & 8 — index.html specific
# ---------------------------------------------------------------------------
def fix_index_tracking_bug(content: str) -> str:
    # remove the __track call that runs before __track is defined
    content = content.replace(
        "    if (window.__track && window.__track.ga4) {\n"
        "      window.__track.ga4('cookie_consent_update', { analytics: state.analytics, marketing: state.marketing });\n"
        "    }\n",
        "",
    )
    return content

def fix_user_data(content: str) -> str:
    content = re.sub(
        r"\s*gtag\(\s*'set'\s*,\s*'user_data'\s*,\s*\{\s*country\s*:\s*'[A-Z]+'\s*\}\s*\)\s*;",
        "",
        content,
    )
    return content

# ---------------------------------------------------------------------------
# 9 — hakkimizda.html: add consent + GA4 + Ads block
# ---------------------------------------------------------------------------
GA_BLOCK = """<script>
window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}
gtag('consent','default',{analytics_storage:'denied',ad_storage:'denied',ad_user_data:'denied',ad_personalization:'denied',wait_for_update:500});
</script>
<script async src="https://www.googletagmanager.com/gtag/js?id=%(ga)s"></script>
<script>
  gtag('js', new Date());
  gtag('config', '%(ga)s');
  gtag('config', '%(ads)s');
</script>
""" % {"ga": GA4_ID, "ads": ADS_ID}

def add_ga_to_hakkimizda(content: str) -> str:
    if GA4_ID in content:
        return content
    # insert right after <head>
    content = re.sub(
        r"(<head>\s*\n)",
        r"\1" + GA_BLOCK,
        content,
        count=1,
    )
    return content

# ---------------------------------------------------------------------------
# 4 — Cookie banner injection into route + blog pages
# ---------------------------------------------------------------------------
COOKIE_HTML = r"""
<!-- Cookie consent (injected by fix_site.py) -->
<aside id="cookieBanner" class="cookie-banner" hidden aria-label="Cookie consent">
  <strong>Gizliliğiniz, sizin seçiminiz.</strong>
  <p>Analitik ve reklam çerezleri isteğe bağlıdır. Tercihlerinizi istediğiniz zaman değiştirebilirsiniz.</p>
  <div>
    <button type="button" class="cb-outline" data-consent="reject">Sadece Zorunlu</button>
    <button type="button" class="cb-outline" id="openCookiePrefs">Tercihler</button>
    <button type="button" class="cb-accept" data-consent="accept">Tümünü Kabul Et</button>
  </div>
</aside>

<dialog id="cookieDialog">
  <button class="dialog-close" id="closeCookieDialog" aria-label="Kapat">×</button>
  <h2>Gizliliğiniz, sizin seçiminiz.</h2>
  <p>Dil ve görünüm için zorunlu depolama kullanıyoruz. Analitik ve reklam dönüşüm çerezleri seçimlerinize bağlıdır.</p>
  <label class="consent-option"><span>Zorunlu / her zaman açık</span><input type="checkbox" checked disabled></label>
  <label class="consent-option"><span>Analitik ve performans</span><input type="checkbox" id="consentAnalytics"></label>
  <label class="consent-option"><span>Reklam dönüşüm ölçümü (Google Ads)</span><input type="checkbox" id="consentMarketing"></label>
  <div class="cookie-dialog-actions"><button type="button" id="saveCookiePrefs">Tercihleri Kaydet</button></div>
</dialog>

<script>
(function(){
  var KEY = 'cookie_consent_v1';
  var banner = document.getElementById('cookieBanner');
  var dialog = document.getElementById('cookieDialog');
  var analyticsToggle = document.getElementById('consentAnalytics');
  var marketingToggle = document.getElementById('consentMarketing');
  if (!banner || !dialog) return;
  function applyConsent(state){
    if (typeof gtag !== 'function') return;
    gtag('consent', 'update', {
      analytics_storage: state.analytics ? 'granted' : 'denied',
      ad_storage: state.marketing ? 'granted' : 'denied',
      ad_user_data: state.marketing ? 'granted' : 'denied',
      ad_personalization: state.marketing ? 'granted' : 'denied'
    });
  }
  function saveConsent(state){
    try { localStorage.setItem(KEY, JSON.stringify({analytics:!!state.analytics, marketing:!!state.marketing, ts:Date.now()})); } catch(e){}
    applyConsent(state);
    banner.hidden = true;
  }
  function loadConsent(){
    try { var raw = localStorage.getItem(KEY); return raw ? JSON.parse(raw) : null; } catch(e){ return null; }
  }
  var stored = loadConsent();
  if (stored) applyConsent(stored);
  else banner.hidden = false;

  banner.addEventListener('click', function(e){
    var btn = e.target.closest('[data-consent]');
    if (!btn) return;
    if (btn.dataset.consent === 'accept') saveConsent({analytics:true, marketing:true});
    else saveConsent({analytics:false, marketing:false});
  });
  var openBtn = document.getElementById('openCookiePrefs');
  if (openBtn) openBtn.addEventListener('click', function(){
    var s = loadConsent() || {analytics:false, marketing:false};
    analyticsToggle.checked = !!s.analytics;
    marketingToggle.checked = !!s.marketing;
    dialog.showModal();
  });
  var closeBtn = document.getElementById('closeCookieDialog');
  if (closeBtn) closeBtn.addEventListener('click', function(){ dialog.close(); });
  dialog.addEventListener('click', function(e){ if (e.target === dialog) dialog.close(); });
  var saveBtn = document.getElementById('saveCookiePrefs');
  if (saveBtn) saveBtn.addEventListener('click', function(){
    saveConsent({analytics: analyticsToggle.checked, marketing: marketingToggle.checked});
    dialog.close();
  });
})();
</script>
"""

def inject_cookie_banner(content: str) -> str:
    if 'id="cookieBanner"' in content:
        return content  # already there
    return content.replace("</body>", COOKIE_HTML + "\n</body>", 1)

# ---------------------------------------------------------------------------
# route.css — add the cookie-banner CSS once
# ---------------------------------------------------------------------------
COOKIE_CSS = """

/* ===== Cookie consent (added by fix_site.py) ===== */
.cookie-banner{position:fixed;bottom:16px;left:16px;right:16px;max-width:520px;background:#1c1d21;border:1px solid #333;border-radius:14px;padding:22px;z-index:60;box-shadow:0 12px 40px #0009}
.cookie-banner[hidden]{display:none}
.cookie-banner strong{display:block;font-size:15px;margin-bottom:8px;color:#fff}
.cookie-banner p{font-size:13px;color:#b5b5b9;margin:0 0 16px;line-height:1.6}
.cookie-banner > div{display:flex;flex-wrap:wrap;gap:8px}
.cookie-banner button{flex:1;min-width:120px;padding:12px 14px;border-radius:9px;font-weight:800;font-size:12px;font-family:inherit;cursor:pointer;border:1px solid transparent;transition:.2s}
.cookie-banner .cb-accept{background:var(--yellow);color:#101114;border-color:var(--yellow)}
.cookie-banner .cb-accept:hover{background:#ffe061}
.cookie-banner .cb-outline{background:transparent;color:#fff;border-color:#555}
.cookie-banner .cb-outline:hover{border-color:var(--yellow);color:var(--yellow)}
@media(max-width:600px){
  .cookie-banner{left:12px;right:12px;bottom:90px;padding:18px}
  .cookie-banner button{min-width:100px;padding:11px 10px;font-size:11px}
}
dialog#cookieDialog{background:#1c1d21;color:#fff;border:1px solid #333;border-radius:16px;padding:28px;max-width:520px;width:calc(100% - 32px);box-shadow:0 20px 60px #000a}
dialog#cookieDialog::backdrop{background:rgba(0,0,0,.72);backdrop-filter:blur(4px)}
dialog#cookieDialog h2{font-size:22px;margin:8px 0 14px}
dialog#cookieDialog > p{font-size:13px;color:#b5b5b9;line-height:1.7;margin:0 0 18px}
dialog#cookieDialog .dialog-close{position:absolute;top:14px;right:14px;background:transparent;border:0;color:#999;font-size:26px;cursor:pointer;line-height:1;padding:0 6px}
.consent-option{display:flex;justify-content:space-between;align-items:center;padding:14px 0;border-bottom:1px solid #333;font-size:14px;cursor:pointer}
.consent-option span{color:#ddd}
.consent-option input[type=checkbox]{width:20px;height:20px;accent-color:#ffcc00;cursor:pointer}
.consent-option input:disabled{cursor:not-allowed;opacity:.6}
.cookie-dialog-actions{display:flex;gap:10px;margin-top:22px}
.cookie-dialog-actions button{flex:1;padding:14px;border-radius:9px;font-weight:800;font-family:inherit;font-size:14px;cursor:pointer;border:0;background:var(--yellow);color:#101114}
/* ===== end cookie consent ===== */
"""

def patch_route_css(path: Path) -> None:
    if not path.exists():
        log(f"route.css not found — skipping")
        return
    content = path.read_text(encoding="utf-8")
    if "Cookie consent (added by fix_site.py)" in content:
        return
    backup(path)
    path.write_text(content + COOKIE_CSS, encoding="utf-8")
    log("route.css — cookie CSS appended")

# ---------------------------------------------------------------------------
# 10 — robots.txt
# ---------------------------------------------------------------------------
def patch_robots(path: Path) -> None:
    if not path.exists():
        log("robots.txt not found — skipping")
        return
    content = path.read_text(encoding="utf-8")
    if "build-blog.php" in content:
        return
    backup(path)
    content = content.replace(
        "Disallow: /build.py",
        "Disallow: /build.py\nDisallow: /build-blog.php",
    )
    if "build-blog.php" not in content:
        # no /build.py line found; append at end of User-agent:* block
        content = content.replace(
            "Disallow: /build.php",
            "Disallow: /build.php\nDisallow: /build-blog.php",
        )
    path.write_text(content, encoding="utf-8")
    log("robots.txt — build-blog.php disallowed")

# ---------------------------------------------------------------------------
# 11 — llms.txt
# ---------------------------------------------------------------------------
def patch_llms(path: Path) -> None:
    if not path.exists():
        log("llms.txt not found — skipping")
        return
    content = path.read_text(encoding="utf-8")
    if "#cookies" not in content:
        return
    backup(path)
    content = re.sub(
        r"^- \[Gizlilik ve çerez politikası\]\([^\)]+\)\s*\n?",
        "",
        content,
        flags=re.MULTILINE,
    )
    path.write_text(content, encoding="utf-8")
    log("llms.txt — dead #cookies link removed")

# ---------------------------------------------------------------------------
# 12 — build-blog.php JSON-LD fix
# ---------------------------------------------------------------------------
def patch_build_blog(path: Path) -> None:
    if not path.exists():
        log("build-blog.php not found — skipping")
        return
    content = path.read_text(encoding="utf-8")
    if "JSON_UNESCAPED_UNICODE" in content and "json_encode($faqItems" in content:
        return
    backup(path)

    # --- replace FAQ item building ---
    old_faq = """  // FAQ JSON-LD schema
  $faqItems = [];
  foreach ($p['faqs'] as $f) {
    $faqItems[] = '{"@type":"Question","name":"' . esc($f['q']) . '","acceptedAnswer":{"@type":"Answer","text":"' . esc($f['a']) . '"}}';
  }
  $faqSchema = implode(',', $faqItems);"""
    new_faq = """  // FAQ JSON-LD schema (built as array → json_encode)
  $faqItems = [];
  foreach ($p['faqs'] as $f) {
    $faqItems[] = [
      "@type" => "Question",
      "name" => $f['q'],
      "acceptedAnswer" => ["@type" => "Answer", "text" => $f['a']],
    ];
  }
  $faqSchema = json_encode($faqItems, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);"""
    content = content.replace(old_faq, new_faq)

    # --- replace breadcrumb + graph building ---
    old_graph = """  // JSON-LD schema
  $bcItem1 = '{"@type":"ListItem","position":1,"name":"' . esc($u['home']) . '","item":"' . $homeUrl . '"}';
  $bcItem2 = '{"@type":"ListItem","position":2,"name":"' . esc($u['blogHome']) . '","item":"' . $blogIndexUrl . '"}';
  $bcItem3 = '{"@type":"ListItem","position":3,"name":"' . $title . '"}';
  $articleSchema = '{"@type":"Article","headline":"' . $title . '","description":"' . $metaDesc . '","author":{"@type":"Organization","name":"Antalya Korsan VIP Transfer"},"publisher":{"@type":"Organization","name":"Antalya Korsan VIP Transfer","logo":{"@type":"ImageObject","url":"' . $SITE . '/logo.png"}},"datePublished":"' . $date . '","dateModified":"' . $date . '","mainEntityOfPage":"' . $postUrl . '"}';
  $bcSchema = '{"@type":"BreadcrumbList","itemListElement":[' . $bcItem1 . ',' . $bcItem2 . ',' . $bcItem3 . ']}';
  $faqSchemaFull = '{"@type":"FAQPage","mainEntity":[' . $faqSchema . ']}';
  $graphSchema = '{"@context":"https://schema.org","@graph":[' . $articleSchema . ',' . $bcSchema . ',' . $faqSchemaFull . ']}';"""
    new_graph = """  // JSON-LD schema (built as arrays → json_encode, no HTML entities)
  $bcSchema = json_encode([
    "@type" => "BreadcrumbList",
    "itemListElement" => [
      ["@type" => "ListItem", "position" => 1, "name" => $u['home'],     "item" => $homeUrl],
      ["@type" => "ListItem", "position" => 2, "name" => $u['blogHome'], "item" => $blogIndexUrl],
      ["@type" => "ListItem", "position" => 3, "name" => $title],
    ],
  ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
  $articleSchema = json_encode([
    "@type" => "Article",
    "headline" => $title,
    "description" => $metaDesc,
    "author" => ["@type" => "Organization", "name" => "Antalya Korsan VIP Transfer"],
    "publisher" => [
      "@type" => "Organization",
      "name" => "Antalya Korsan VIP Transfer",
      "logo" => ["@type" => "ImageObject", "url" => $SITE . "/logo.png"],
    ],
    "datePublished" => $date,
    "dateModified" => $date,
    "mainEntityOfPage" => $postUrl,
  ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
  $faqSchemaFull = '{"@type":"FAQPage","mainEntity":' . $faqSchema . '}';
  $graphSchema = '{"@context":"https://schema.org","@graph":[' . $articleSchema . ',' . $bcSchema . ',' . $faqSchemaFull . ']}';"""
    content = content.replace(old_graph, new_graph)

    # --- blog index schema is fine, no change needed ---

    path.write_text(content, encoding="utf-8")
    log("build-blog.php — JSON-LD now built via json_encode()")

# ---------------------------------------------------------------------------
# MAIN
# ---------------------------------------------------------------------------
def process_html(path: Path) -> None:
    original = path.read_text(encoding="utf-8")
    content = original
    lang = detect_lang(content, path)
    fixes = []

    # universal
    before = content
    content = add_shared_assets(content)
    content = fix_ga_ids(content);        fixes.append("GA-IDs")
    content = decode_json_ld_entities(content); fixes.append("JSON-LD")
    content = fix_user_data(content);     fixes.append("user_data")
    if content != before:
        pass

    # language-aware link fix (only non-TR)
    if lang != "tr":
        before = content
        content = fix_multilingual_links(content, lang)
        if content != before:
            fixes.append(f"links({lang})")

    # blog-only: picker position
    if is_blog_page(path):
        before = content
        content = fix_blog_lang_picker(content)
        if content != before:
            fixes.append("lang-picker")

    # route + blog: inject cookie banner
    if is_route_page(path) or is_blog_page(path):
        if 'id="cookieBanner"' not in content:
            content = inject_cookie_banner(content)
            fixes.append("cookie-banner")

    # special: index.html
    if path.name == "index.html" and path.parent == ROOT:
        before = content
        content = fix_index_tracking_bug(content)
        if content != before:
            fixes.append("index-tracking")

    # special: hakkimizda.html
    if path.name == "hakkimizda.html" and path.parent == ROOT:
        before = content
        content = add_ga_to_hakkimizda(content)
        if content != before:
            fixes.append("hakkimizda-GA")

    if content != original:
        backup(path)
        path.write_text(content, encoding="utf-8")
        log(f"{path.relative_to(ROOT)}  →  {', '.join(fixes)}")


def main() -> int:
    print("Antalya Korsan — one-shot site fixer")
    print(f"Project root: {ROOT}")
    print(f"Backups will be written to: {BACKUP}")
    print()

    # walk every .html file
    html_files = sorted(ROOT.rglob("*.html"))
    if not html_files:
        print("No HTML files found. Are you in the right folder?")
        return 1

    print(f"Found {len(html_files)} HTML files.\n")
    for p in html_files:
        process_html(p)

    print()
    # non-HTML files
    patch_route_css(ROOT / "route.css")
    patch_robots(ROOT / "robots.txt")
    patch_llms(ROOT / "llms.txt")
    patch_build_blog(ROOT / "build-blog.php")

    print()
    print("Done.")
    if BACKUP.exists():
        print(f"Backups are in: {BACKUP}")
    print()
    print("Next steps:")
    print("  1. Spot-check a route page and a blog page in the browser.")
    print("  2. Regenerate the blog if you edited build-blog.php, then delete it:")
    print("       php build-blog.php && rm build-blog.php")
    print("  3. Upload the modified files to your server.")
    return 0


if __name__ == "__main__":
    sys.exit(main())