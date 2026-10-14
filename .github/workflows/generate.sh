#!/bin/bash

# ==============================================================================
# ANTALYA KORSAN - MULTILINGUAL SEO ROUTE PAGE GENERATOR (TR/EN/RU/DE)
# ==============================================================================

# Routes: slug|Turkish Name|English Name|Russian Name|German Name
ROUTES=(
  "kundu|Kundu|Kundu|Кунду|Kundu"
  "lara|Lara|Lara|Лара|Lara"
  "side|Side|Side|Сиде|Side"
  "belek|Belek|Belek|Белек|Belek"
  "kemer|Kemer|Kemer|Кемер|Kemer"
  "alanya|Alanya|Alanya|Аланья|Alanya"
  "manavgat|Manavgat|Manavgat|Манавгат|Manavgat"
  "konyaalti|Konyaaltı|Konyaaltı|Коньяалты|Konyaaltı"
  "kaleici|Kaleiçi|Kaleiçi|Калеичи|Kaleiçi"
  "muratpasa|Muratpaşa|Muratpaşa|Муратпаша|Muratpaşa"
  "kepez|Kepez|Kepez|Кепез|Kepez"
  "dosemealti|Döşemealtı|Döşemealtı|Дёшемеалты|Döşemealtı"
  "aksu|Aksu|Aksu|Аксу|Aksu"
  "serik|Serik|Serik|Серик|Serik"
  "kizilagac|Kızılağaç|Kızılağaç|Кызылагач|Kızılağaç"
  "titreyengol|Titreyengöl|Titreyengöl|Титреенгёль|Titreyengöl"
  "okurcalar|Okurcalar|Okurcalar|Окурджалар|Okurcalar"
  "avsallar|Avsallar|Avsallar|Авсаллар|Avsallar"
  "konakli|Konaklı|Konaklı|Конаклы|Konaklı"
  "mahmutlar|Mahmutlar|Mahmutlar|Махмутлар|Mahmutlar"
  "gazipasa|Gazipaşa|Gazipaşa|Газипаша|Gazipaşa"
  "belconti|Belconti|Belconti|Бельконти|Belconti"
  "beldibi|Beldibi|Beldibi|Бельдиби|Beldibi"
  "goynuk|Göynük|Göynük|Гёйнюк|Göynük"
)

LANGS=("tr" "en" "ru" "de")
BASE_URL="https://antalyakorsan.com"
WA_NUMBER="905316922578"

# SEO data per language
declare -A SEO_TITLE_TR="Antalya Havalimanı %s VIP Transfer | Sabit Fiyatlı Lisanslı Servis"
declare -A SEO_TITLE_EN="Antalya Airport %s VIP Transfer | Fixed-Price Licensed Service"
declare -A SEO_TITLE_RU="VIP Трансфер из Аэропорта Анталии в %s | Фиксированная Цена"
declare -A SEO_TITLE_DE="Flughafentransfer Antalya nach %s | Festpreis & Lizenziert"

declare -A SEO_DESC_TR="Antalya Havalimanı'ndan %s bölgesine lisanslı, sigortalı ve sabit fiyatlı VIP transfer hizmeti. 7/24 WhatsApp ile anında fiyat teklifi alın. Nakit ödeme."
declare -A SEO_DESC_EN="Licensed, insured and fixed-price VIP transfer from Antalya Airport to %s. Get an instant quote on WhatsApp 24/7. Cash payment."
declare -A SEO_DESC_RU="Лицензированный, застрахованный VIP-трансфер из аэропорта Анталии в %s по фиксированной цене. Круглосуточно WhatsApp. Оплата наличными."
declare -A SEO_DESC_DE="Lizenzierter, versicherter VIP-Transfer vom Flughafen Antalya nach %s zum Festpreis. 24/7 WhatsApp-Angebot. Barzahlung."

echo "🚀 Starting multilingual SEO page generation..."

for ROUTE in "${ROUTES[@]}"; do
  IFS='|' read -r SLUG TR_NAME EN_NAME RU_NAME DE_NAME <<< "$ROUTE"

  # Determine output directory per language
  for LANG in "${LANGS[@]}"; do
    case "$LANG" in
      "tr") DIR="."; LANG_NAME="$TR_NAME"; LANGS_OTHER="en ru de";;
      "en") DIR="en"; LANG_NAME="$EN_NAME"; LANGS_OTHER="tr ru de";;
      "ru") DIR="ru"; LANG_NAME="$RU_NAME"; LANGS_OTHER="tr en de";;
      "de") DIR="de"; LANG_NAME="$DE_NAME"; LANGS_OTHER="tr en ru";;
    esac

    mkdir -p "$DIR"
    FILENAME="$DIR/${SLUG}.html"

    # Get localized SEO title and description
    case "$LANG" in
      "tr") TITLE=$(printf "$SEO_TITLE_TR" "$TR_NAME"); DESC=$(printf "$SEO_DESC_TR" "$TR_NAME");; 
      "en") TITLE=$(printf "$SEO_TITLE_EN" "$EN_NAME"); DESC=$(printf "$SEO_DESC_EN" "$EN_NAME");; 
      "ru") TITLE=$(printf "$SEO_TITLE_RU" "$RU_NAME"); DESC=$(printf "$SEO_DESC_RU" "$RU_NAME");; 
      "de") TITLE=$(printf "$SEO_TITLE_DE" "$DE_NAME"); DESC=$(printf "$SEO_DESC_DE" "$DE_NAME");; 
    esac

    # Build hreflang block
    HREFLANG=""
    for L in "${LANGS[@]}"; do
      if [ "$L" = "tr" ]; then
        HREFLANG+="<link rel=\"alternate\" hreflang=\"tr\" href=\"${BASE_URL}/${SLUG}.html\">\n"
      else
        HREFLANG+="<link rel=\"alternate\" hreflang=\"${L}\" href=\"${BASE_URL}/${L}/${SLUG}.html\">\n"
      fi
    done
    HREFLANG+="<link rel=\"alternate\" hreflang=\"x-default\" href=\"${BASE_URL}/${SLUG}.html\">"

    cat <<EOF > "$FILENAME"
<!doctype html>
<html lang="${LANG}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>${TITLE}</title>
<meta name="description" content="${DESC}">
<meta name="robots" content="index,follow">
<link rel="canonical" href="${BASE_URL}/${LANG}/${SLUG}.html">
${HREFLANG}

<!-- Open Graph -->
<meta property="og:type" content="website">
<meta property="og:title" content="${TITLE}">
<meta property="og:description" content="${DESC}">
<meta property="og:url" content="${BASE_URL}/${LANG}/${SLUG}.html">
<meta property="og:image" content="${BASE_URL}/logo.png">

<!-- Schema.org Route Service -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Service",
  "name": "${TITLE}",
  "description": "${DESC}",
  "provider": {
    "@type": "LocalBusiness",
    "name": "Antalya Korsan VIP Transfer",
    "image": "${BASE_URL}/logo.png",
    "telephone": "+90${WA_NUMBER}",
    "priceRange": "₺₺"
  },
  "areaServed": { "@type": "Place", "name": "${LANG_NAME}, Antalya" },
  "serviceType": "Airport Transfer"
}
</script>

<link rel="stylesheet" href="/assets/site.css">
<style>
  body{background:#101114;color:#fff;font-family:Arial,Helvetica,sans-serif;padding:40px 20px;max-width:800px;margin:0 auto;line-height:1.7}
  h1{color:#ffcc00;font-size:32px;margin-bottom:20px}
  h2{color:#ffcc00;font-size:24px;margin-top:40px;border-bottom:1px solid #333;padding-bottom:10px}
  .btn{display:inline-block;padding:16px 28px;background:#ffcc00;color:#101114;text-decoration:none;font-weight:800;border-radius:9px;margin-top:20px;transition:.3s}
  .btn:hover{background:#ffe061;transform:translateY(-3px);box-shadow:0 0 16px #ffcc0088}
  .back-link{display:block;margin-top:40px;color:#a9a9ac;text-decoration:none}
  .back-link:hover{color:#ffcc00}
  ul{padding-left:20px;color:#b4b4b9}
  li{margin-bottom:10px}
  .lang-nav{margin:20px 0;font-size:14px}
  .lang-nav a{color:#ffcc00;margin-right:12px;text-decoration:none}
</style>
</head>
<body>

  <a href="/" class="back-link">← ${LANG:+"Ana Sayfa"}</a>

  <div class="lang-nav">
    <a href="/${SLUG}.html">TR</a>
    <a href="/en/${SLUG}.html">EN</a>
    <a href="/ru/${SLUG}.html">RU</a>
    <a href="/de/${SLUG}.html">DE</a>
  </div>

  <h1>Antalya Havalimanı - ${LANG_NAME} VIP Transfer</h1>

  <p>Antalya Havalimanı'ndan <strong>${LANG_NAME}</strong> bölgesine lisanslı, sigortalı ve profesyonel şoförler eşliğinde <strong>sabit fiyatlı VIP transfer</strong> hizmeti sunuyoruz.</p>

  <h2>Neden Antalya Korsan VIP Transfer?</h2>
  <ul>
    <li><strong>Sabit Fiyat Garantisi:</strong> Trafikte veya beklemede fiyat değişmez.</li>
    <li><strong>Lisanslı ve Sigortalı:</strong> Tüm araçlarımız tam sigortalıdır.</li>
    <li><strong>Uçuş Takibi:</strong> Uçuşunuz gecikirse, şoförünüz sizi bekler. Ek ücret alınmaz.</li>
    <li><strong>Nakit Ödeme:</strong> Ödemeyi araç içinde ₺, USD veya EUR olarak nakit yapabilirsiniz.</li>
  </ul>

  <a href="https://wa.me/${WA_NUMBER}?text=Merhaba%2C%20Antalya%20Havaliman%C4%B1%20${TR_NAME}%20transfer%20i%C3%A7in%20fiyat%20almak%20istiyorum." class="btn" target="_blank" rel="noopener">WhatsApp'tan Fiyat Al →</a>

  <p style="margin-top:40px;font-size:13px;color:#666;">© 2026 Antalya Korsan VIP Transfer. Tüm hakları saklıdır.</p>

</body>
</html>
EOF

    echo "  ✅ $FILENAME"
  done
done

echo ""
echo "✅ All multilingual pages generated!"
echo "➡️ Run: git add . && git commit -m 'Add multilingual SEO route pages' && git push"
