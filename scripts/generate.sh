#!/usr/bin/env bash
# =============================================================================
# generate-routes.sh — Antalya Korsan route pages + index.html + sitemap.xml
#
# Usage:
#   ./generate-routes.sh            # preview into routes-new/
#   ./generate-routes.sh --deploy   # overwrite real files (with .bak backups)
#   ./generate-routes.sh --help
# =============================================================================

set -euo pipefail

SITE_ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
WA="905316922578"
BASE="https://antalyakorsan.com"
TODAY="$(date +%Y-%m-%d)"

DEPLOY=0
for arg in "$@"; do
  case "$arg" in
    --deploy) DEPLOY=1 ;;
    --help|-h) sed -n '2,10p' "$0" | sed 's/^# \{0,1\}//'; exit 0 ;;
  esac
done

if [ "$DEPLOY" -eq 1 ]; then
  OUT_DIR="$SITE_ROOT"
else
  OUT_DIR="$SITE_ROOT/routes-new"
  mkdir -p "$OUT_DIR"
fi

html_escape() {
  local s="$1"
  s="${s//&/&amp;}"
  s="${s//</&lt;}"
  s="${s//>/&gt;}"
  s="${s//\"/&quot;}"
  printf '%s' "$s"
}

# ---------------------------------------------------------------------------
# ROUTE DATA — one row per route, fields separated by |
#   slug|name|km|mins|intro|attrs|luxury|budget|faqs
#   sub-lists: //   |   FAQ pairs: //   |   Q vs A: ~
# ---------------------------------------------------------------------------
ROWS=(
"kundu|Kundu|15|20|Kundu, Antalya Havalimanı'na en yakın tatil bölgelerinden biridir. Lüks oteller ve geniş plajları ile öne çıkar. Havalimanından 15 km uzaklıkta olması nedeniyle transfer süresi oldukça kısadır.|Kundu Plajı//Aksu Çayı//Terra City AVM|Regnum Carya//Titanic Deluxe Belek//Kaya Palazzo Golf Resort|Kundu Garden Hotel//Aska Lara Resort//Limak Lara Deluxe|Antalya Havalimanı'ndan Kundu'ya ne kadar sürer?~Trafik durumuna göre 15-25 dakika arası sürer.//Kundu'da hangi oteller bulunur?~Regnum Carya, Titanic Deluxe ve Kaya Palazzo gibi lüks tesisler çevredeki popüler seçeneklerdir.//Kundu'ya toplu taşımayla ulaşabilir miyim?~Havaş ve belediye otobüsleri kısmen hizmet verir ancak otelinizin kapısına kadar götürmez.//Kundu transferi için çocuk koltuğu sağlıyor musunuz?~Evet, rezervasyon sırasında WhatsApp üzerinden talep edebilirsiniz."
"lara|Lara|12|18|Lara, Antalya'nın en bilinen sahil bölgelerinden biridir. Geniş kumlu plajı, lüks tatil köyleri ve Düden Şelalesi'ne yakınlığı ile tatilcilerin favorisidir.|Lara Plajı//Düden Şelalesi//Sandland Kum Heykel Müzesi|Titanic Beach Lara//Delphin Imperial//Royal Seginus|Lara Garden Hotel//Club Hotel Sera//Lara Dinc Hotel|Lara'ya havalimanından transfer süresi ne kadar?~Ortalama 15-20 dakika. Lara, havalimanına en yakın tatil bölgelerinden biridir.//Lara'da öne çıkan oteller hangileri?~Titanic Beach Lara, Delphin Imperial ve Royal Seginus en çok tercih edilen lüks tesisler arasındadır.//Düden Şelalesi'ne Lara'dan nasıl gidilir?~Şelaleye araçla yaklaşık 10-15 dakika mesafededir.//Lara transferinde bagaj limiti var mı?~Standart yolcularda 2-3 büyük valiz sorun olmaz."
"side|Side|65|60|Side, antik kalıntıları ve uzun kumlu plajlarıyla ünlü bir tatil bölgesidir. Apollon Tapınağı ve antik tiyatro gibi tarihi zenginlikleriyle kültür ve deniz tatilini birleştirir.|Apollon Tapınağı//Side Antik Tiyatrosu//Side Müzesi|Barut Hemera//Acanthus Cennet//Paloma Finesse|Side Star Hotel//Hotel Turquoise//Selenium Hotel|Antalya Havalimanı'ndan Side'ye kaç saat sürer?~Yaklaşık 60-75 dakika. Mesafe 65 km'dir.//Side'de gezilecek yerler nereler?~Apollon Tapınağı, Side Antik Tiyatrosu, Side Müzesi ve Side Antik Kenti en öne çıkan yerlerdir.//Side transferi sırasında mola veriliyor mu?~Uzun mesafelerde talep etmeniz halinde kısa bir mola verebiliriz.//Side'ye gece transferi yapıyor musunuz?~Evet, 7/24 hizmet veriyoruz ve gece de sabit fiyat uygulanır."
"belek|Belek|35|40|Belek, golf sahaları ve lüks tatil köyleriyle ünlü bir bölgedir. Aspendos Antik Tiyatrosu ve Land of Legends tema parkına yakınlığı ile hem aileler hem de golf tutkunları için idealdir.|The Land of Legends//Aspendos Antik Tiyatrosu//Belek Plajı|Regnum Carya//Maxx Royal Belek//Gloria Serenity|Belconti Resort//Papillon Belvil//Crystal Waterworld|Antalya Havalimanı'ndan Belek'e transfer süresi?~Yaklaşık 35-45 dakika. Belek, havalimanına 35 km uzaklıktadır.//Belek'te golf sahalarına transfer yapıyor musunuz?~Evet. Golf sahalarına doğrudan transfer hizmeti veriyoruz.//The Land of Legends'a Belek'ten nasıl gidilir?~Tema parkına araçla 10-15 dakika mesafededir.//Belek transferi için önceden rezervasyon şart mı?~Yoğun sezonda en az 24 saat önceden rezervasyon öneririz."
"kemer|Kemer|55|55|Kemer, Toros Dağları'nın eteklerinde, turkuaz koyları ve doğal güzellikleriyle öne çıkan bir sahil bölgesidir. Olympos Teleferik ve Phaselis Antik Kenti gibi gezilecek yerlere yakındır.|Phaselis Antik Kenti//Olympos Teleferik//Göynük Kanyonu|Akra Kemer//Maxx Royal Kemer//Swandor Kemer|Kemer Hotel//Miramor Hotel//Orange County|Antalya Havalimanı'ndan Kemer'e kaç saat sürer?~Yaklaşık 55-70 dakika. Mesafe 55 km'dir.//Kemer'de gezilecek yerler nereler?~Phaselis Antik Kenti, Olympos Teleferik, Göynük Kanyonu ve Yörük Parkı en popüler yerlerdir.//Kemer transferinde mola veriliyor mu?~Talep etmeniz halinde kısa bir mola verebiliriz.//Kemer'e kışın transfer yapıyor musunuz?~Evet, yıl boyunca hizmet veriyoruz ve fiyatlar sabittir."
"alanya|Alanya|135|130|Alanya, Kızıl Kule, Alanya Kalesi ve Kleopatra Plajı gibi simge yapılarıyla Antalya'nın en doğusundaki büyük tatil bölgesidir. Havalimanına uzak olmasına rağmen popülerliği yüksektir.|Alanya Kalesi//Kızıl Kule//Kleopatra Plajı//Damlataş Mağarası|Royalisa Palmiye//Kirman Alanya//Labranda Alantur|Alanya Hotel//Kleopatra Life Hotel//Sunprime Alanya|Antalya Havalimanı'ndan Alanya'ya kaç saat sürer?~Yaklaşık 2 saat 10 dakika. Mesafe 135 km'dir.//Alanya transferinde mola veriliyor mu?~Evet, uzun mesafe nedeniyle kısa bir mola verebiliriz.//Alanya'da gezilecek yerler nereler?~Alanya Kalesi, Kızıl Kule, Kleopatra Plajı ve Dim Çayı en popüler yerlerdir.//Alanya'ya gece transferi mümkün mü?~Evet, 7/24 hizmet veriyoruz ve gece de sabit fiyat uygulanır."
"manavgat|Manavgat|75|70|Manavgat, ünlü Manavgat Şelalesi ve Side'ye yakınlığıyla bilinen bir tatil bölgesidir. Doğa ve kültür tatilini bir arada sunar.|Manavgat Şelalesi//Side Antik Kenti//Köprülü Kanyon|Kirman Premium//Sidemarin//Barut GOIA|Manavgat Hotel//Side Moon Palace//A Hotel Side|Antalya Havalimanı'ndan Manavgat'a kaç saat sürer?~Yaklaşık 70-85 dakika. Mesafe 75 km'dir.//Manavgat Şelalesi'ne transfer yapıyor musunuz?~Evet. Şelaleye doğrudan transfer hizmeti veriyoruz.//Manavgat'ta hangi oteller öne çıkar?~Kirman Premium, Sidemarin ve Barut GOIA en çok tercih edilen lüks tesislerdir.//Manavgat transferi için erken rezervasyon gerekli mi?~Yoğun sezonda en az 24 saat önceden önerilir."
"konyaalti|Konyaaltı|18|25|Konyaaltı, Antalya şehir merkezine yakın, uzun çakıl plajı ve sahil parkuruyla öne çıkan bir sahil semtidir. Şehir hayatı ile deniz tatilini birleştirmek isteyenler için idealdir.|Konyaaltı Plajı//Antalya Müzesi//Beach Park//Aktur Park|Rixos Downtown//Akra Hotel//Divan Antalya|Antalya Inn Hotel//Hotel SU//Latanya Hotel|Antalya Havalimanı'ndan Konyaaltı'na ne kadar sürer?~Yaklaşık 25-35 dakika. Mesafe 18 km'dir.//Konyaaltı'nda gezilecek yerler nereler?~Konyaaltı Plajı, Antalya Müzesi, Beach Park ve Aktur Park öne çıkan yerlerdir.//Konyaaltı şehir merkezine ne kadar uzak?~Yaklaşık 10 dakika mesafededir.//Konyaaltı'na gece transferi yapıyor musunuz?~Evet, 7/24 hizmet veriyoruz."
"kaleici|Kaleiçi|12|20|Kaleiçi, Antalya'nın tarihi kalbi olan eski şehirdir. Dar sokakları, restore edilmiş Osmanlı evleri, Hadrian Kapısı ve eski limanıyla kültür tatili için idealdir.|Hadrian Kapısı//Hıdırlık Kulesi//Eski Liman//Kesik Minare|Tuvana Hotel//Alp Paşa Hotel//Mediterra Hotel|White Garden Pansiyon//Sabah Pansiyon//Kaleiçi Lodge|Antalya Havalimanı'ndan Kaleiçi'ne nasıl gidilir?~Transfer ile yaklaşık 20-25 dakika sürer.//Kaleiçi'nde arabayla gezilebilir mi?~Birçok sokak yayalara ayrılmıştır; araç girişi sınırlıdır.//Kaleiçi'nde gezilecek yerler nereler?~Hadrian Kapısı, Hıdırlık Kulesi, Eski Liman ve Kesik Minare öne çıkan yerlerdir.//Kaleiçi'ne gece transferi mümkün mü?~Evet, gece de hizmet veriyoruz ve fiyat sabittir."
"muratpasa|Muratpaşa|13|22|Muratpaşa, Antalya şehir merkezinin kalbinde yer alan bir ilçedir. Kaleiçi, Antalya Müzesi ve alışveriş bölgeleri buraya yakındır.|Kaleiçi//Hadrian Kapısı//Antalya Müzesi|Tuvana Hotel//Alp Paşa Hotel//Mediterra Hotel|White Garden Pansiyon//Sabah Pansiyon//Kaleiçi Lodge|Antalya Havalimanı'ndan Muratpaşa'ya ne kadar sürer?~Yaklaşık 20-30 dakika. Mesafe 13 km'dir.//Muratpaşa'da gezilecek yerler nereler?~Kaleiçi, Hadrian Kapısı ve Antalya Müzesi öne çıkan yerlerdir.//Muratpaşa şehir merkezine yürüme mesafesinde mi?~Evet, merkeze yürüme mesafesindedir.//Muratpaşa transferi için erken rezervasyon gerekli mi?~Hayır, ancak yoğun sezonda önceden planlamanızı öneririz."
"kepez|Kepez|15|25|Kepez, Antalya'nın merkez ilçelerinden biridir. Şehir hayatına yakın, ekonomik konaklama seçenekleri sunar.|Düden Şelalesi//Antalya Hayvanat Bahçesi//Konyaaltı Plajı|Rixos Downtown//Akra Hotel//Divan Antalya|Antalya Inn Hotel//Hotel SU//Latanya Hotel|Antalya Havalimanı'ndan Kepez'e ne kadar sürer?~Yaklaşık 25-35 dakika. Mesafe 15 km'dir.//Kepez'de gezilecek yerler nereler?~Düden Şelalesi, Antalya Hayvanat Bahçesi ve Konyaaltı Plajı öne çıkan yerlerdir.//Kepez merkezi bir konumda mı?~Evet, şehir merkezine ve havalimanına yakındır.//Kepez transferi sabit fiyatlı mı?~Evet, tüm transferlerimizde olduğu gibi Kepez'de de fiyat sabittir."
"dosemealti|Döşemealtı|25|35|Döşemealtı, Antalya'nın kuzeyinde yer alan, doğal güzellikleri ve sakin atmosferiyle bilinen bir ilçedir. Termessos Antik Kenti'ne yakındır.|Termessos Antik Kenti//Düden Şelalesi//Antalya Müzesi|Rixos Downtown//Akra Hotel//Divan Antalya|Antalya Inn Hotel//Hotel SU//Latanya Hotel|Antalya Havalimanı'ndan Döşemealtı'na kaç saat sürer?~Yaklaşık 35-45 dakika. Mesafe 25 km'dir.//Döşemealtı'nda gezilecek yerler nereler?~Termessos Antik Kenti, Düden Şelalesi ve Antalya Müzesi öne çıkan yerlerdir.//Termessos'a Döşemealtı'ndan nasıl gidilir?~Araçla yaklaşık 30-40 dakika mesafededir.//Döşemealtı transferi sabit fiyatlı mı?~Evet, trafik veya bekleme fiyatı değiştirmez."
"aksu|Aksu|10|15|Aksu, Antalya Havalimanı'na en yakın ilçelerden biridir. Antalya Expo Center burada bulunur ve Kundu bölgesine komşudur.|Antalya Expo Center//Kundu Plajı//Aksu Çayı|Regnum Carya//Titanic Deluxe Belek//Kaya Palazzo Golf Resort|Kundu Garden Hotel//Aska Lara Resort//Limak Lara Deluxe|Antalya Havalimanı'ndan Aksu'ya ne kadar sürer?~Yaklaşık 15-20 dakika. Aksu, havalimanına en yakın ilçelerden biridir.//Antalya Expo Center'a transfer yapıyor musunuz?~Evet. Fuar dönemlerinde Expo Center'a özel transfer hizmeti veriyoruz.//Aksu'da gezilecek yerler nereler?~Antalya Expo Center, Kundu Plajı ve Aksu Çayı çevresi öne çıkar.//Aksu transferi için rezervasyon şart mı?~Önceden rezervasyon öneririz, ancak müsaitlik durumunda kısa sürede de organize ederiz."
"serik|Serik|45|45|Serik, Belek ve Side arasında yer alan, Aspendos Antik Tiyatrosu'na ev sahipliği yapan bir ilçedir. Tarih ve doğa severler için idealdir.|Aspendos Antik Tiyatrosu//Perge Antik Kenti//Belek Plajı|Regnum Carya//Maxx Royal Belek//Gloria Serenity|Belconti Resort//Papillon Belvil//Crystal Waterworld|Antalya Havalimanı'ndan Serik'e kaç saat sürer?~Yaklaşık 45-60 dakika. Mesafe 45 km'dir.//Aspendos'a transfer yapıyor musunuz?~Evet. Aspendos Antik Tiyatrosu'na doğrudan transfer hizmeti veriyoruz.//Serik'te hangi antik kentler var?~Aspendos ve Perge en öne çıkan antik kentlerdir.//Serik transferi için önceden rezervasyon gerekli mi?~Yoğun sezonda öneririz."
"kizilagac|Kızılağaç|80|75|Kızılağaç, Side ve Manavgat arasında yer alan, uzun kumlu plajı ve huzurlu atmosferiyle bilinen bir tatil bölgesidir.|Kızılağaç Plajı//Manavgat Şelalesi//Side Antik Kenti|Kirman Premium//Sidemarin//Barut GOIA|Kizilagac Hotel//Side Moon Palace//A Hotel Side|Antalya Havalimanı'ndan Kızılağaç'a kaç saat sürer?~Yaklaşık 75-90 dakika. Mesafe 80 km'dir.//Kızılağaç'ta gezilecek yerler nereler?~Kızılağaç Plajı, Manavgat Şelalesi ve Side Antik Kenti öne çıkan yerlerdir.//Kızılağaç'a mola veriliyor mu?~Evet, uzun mesafelerde kısa bir mola verebiliriz.//Kızılağaç transferi sabit fiyatlı mı?~Evet. Trafik veya bekleme fiyatı değiştirmez."
"titreyengol|Titreyengöl|78|72|Titreyengöl, Side'ye yakın, adını ünlü gölünden alan sakin bir tatil bölgesidir. Doğa ve huzur arayanlar için idealdir.|Titreyengöl Gölü//Side Antik Kenti//Manavgat Şelalesi|Kirman Premium//Sidemarin//Barut GOIA|Titreyengol Hotel//Side Moon Palace//A Hotel Side|Antalya Havalimanı'ndan Titreyengöl'e ne kadar sürer?~Yaklaşık 70-85 dakika. Mesafe 78 km'dir.//Titreyengöl Gölü'nde neler yapılabilir?~Göl çevresinde yürüyüş, bisiklet ve doğa gözlemciliği yapılabilir.//Titreyengöl'de hangi oteller var?~Kirman Premium, Sidemarin ve Barut GOIA popüler lüks tesislerdir.//Titreyengöl transferi gece yapılıyor mu?~Evet, 7/24 hizmet veriyoruz."
"okurcalar|Okurcalar|95|90|Okurcalar, Alanya'ya yakın, uzun sahil şeridi ve huzurlu atmosferiyle öne çıkan bir tatil bölgesidir. Aileler için idealdir.|Okurcalar Plajı//Alara Kalesi//Manavgat Şelalesi|Kirman Sidera//Eftalia Resort//Long Beach Resort|Okurcalar Hotel//Alara Hotel//Sunmelia Hotel|Antalya Havalimanı'ndan Okurcalar'a kaç saat sürer?~Yaklaşık 90-105 dakika. Mesafe 95 km'dir.//Okurcalar'da gezilecek yerler nereler?~Okurcalar Plajı, Alara Kalesi ve Manavgat Şelalesi öne çıkan yerlerdir.//Okurcalar'a mola veriliyor mu?~Evet, uzun mesafede kısa bir mola verebiliriz.//Okurcalar transferi için erken rezervasyon gerekli mi?~Yoğun sezonda en az 24 saat önceden önerilir."
"avsallar|Avsallar|105|100|Avsallar, Alanya'ya yakın, İncekum Plajı ile ünlü bir tatil bölgesidir. Berrak denizi ve ince kumu ile öne çıkar.|İncekum Plajı//Alara Kalesi//Avsallar Çarşısı|Kirman Sidera//Eftalia Resort//Long Beach Resort|Avsallar Hotel//Incekum Beach Hotel//Mysea Hotel|Antalya Havalimanı'ndan Avsallar'a kaç saat sürer?~Yaklaşık 100-115 dakika. Mesafe 105 km'dir.//İncekum Plajı'na transfer yapıyor musunuz?~Evet. Doğrudan transfer hizmeti veriyoruz.//Avsallar'da hangi oteller var?~Kirman Sidera, Eftalia Resort ve Long Beach Resort popüler tesislerdir.//Avsallar transferi gece yapılıyor mu?~Evet, 7/24 hizmet veriyoruz."
"konakli|Konaklı|120|115|Konaklı, Alanya'ya yakın bir tatil bölgesidir. Geniş plajları ve aile dostu otelleriyle öne çıkar.|Konaklı Plajı//Alanya Kalesi//Damlataş Mağarası|Eftalia Aqua Resort//Kirman Alanya//Long Beach|Konakli Hotel//Blue Bay Hotel//Sunmelia Hotel|Antalya Havalimanı'ndan Konaklı'ya kaç saat sürer?~Yaklaşık 110-125 dakika. Mesafe 120 km'dir.//Konaklı'da gezilecek yerler nereler?~Konaklı Plajı, Alanya Kalesi ve Damlataş Mağarası öne çıkan yerlerdir.//Konaklı'ya mola veriliyor mu?~Evet, uzun mesafede kısa bir mola verebiliriz.//Konaklı transferi için erken rezervasyon gerekli mi?~Yoğun sezonda en az 24 saat önceden öneririz."
"mahmutlar|Mahmutlar|130|125|Mahmutlar, Alanya'nın doğusunda yer alan, uzun sahil şeridi ve modern konaklama tesisleriyle öne çıkan bir tatil bölgesidir.|Mahmutlar Plajı//Alanya Kalesi//Kleopatra Plajı|Meryan Hotel//Kirman Alanya//Royalisa|Mahmutlar Hotel//Gold City Hotel//Sunpark Hotel|Antalya Havalimanı'ndan Mahmutlar'a kaç saat sürer?~Yaklaşık 125-140 dakika. Mesafe 130 km'dir.//Mahmutlar'da gezilecek yerler nereler?~Mahmutlar Plajı, Alanya Kalesi ve Kleopatra Plajı öne çıkan yerlerdir.//Mahmutlar'a gece transferi yapıyor musunuz?~Evet, 7/24 hizmet veriyoruz.//Mahmutlar transferi için rezervasyon nasıl yapılır?~WhatsApp üzerinden tarih, saat, yolcu sayısı ve otel bilginizi paylaşmanız yeterlidir."
"gazipasa|Gazipaşa|180|160|Gazipaşa, Antalya'nın en doğusunda yer alan, sakin atmosferi ve doğal güzellikleriyle bilinen bir ilçedir. Gazipaşa Havalimanı (GZP) burada bulunur.|Gazipaşa Kalesi//Selinus Antik Kenti//Yalan Dünya Mağarası|Gazipasa Resort//Selinus Hotel//Kestel Hotel|Gazipasa Pansiyon//Antik Hotel//Zeytin Hotel|Antalya Havalimanı'ndan Gazipaşa'ya kaç saat sürer?~Yaklaşık 2 saat 40 dakika. Mesafe 180 km'dir.//Gazipaşa Havalimanı'na transfer yapıyor musunuz?~Evet. Gazipaşa Havalimanı (GZP) için de hizmet veriyoruz.//Gazipaşa'da gezilecek yerler nereler?~Gazipaşa Kalesi, Selinus Antik Kenti ve Yalan Dünya Mağarası öne çıkan yerlerdir.//Gazipaşa transferinde mola veriliyor mu?~Evet, uzun mesafede mola verebiliriz."
"belconti|Belconti|35|40|Belconti, Belek bölgesinde yer alan, lüks tatil köyleri ve golf sahalarıyla çevrili bir tatil alanıdır.|The Land of Legends//Aspendos Antik Tiyatrosu//Belek Plajı|Belconti Resort//Papillon Belvil//Crystal Waterworld|Belconti Resort//Belek Beach Resort//Sueno Hotels|Antalya Havalimanı'ndan Belconti'ye ne kadar sürer?~Yaklaşık 35-45 dakika. Mesafe 35 km'dir.//Belconti'de hangi oteller var?~Belconti Resort, Papillon Belvil ve Crystal Waterworld popüler tesislerdir.//The Land of Legends'a Belconti'den nasıl gidilir?~Araçla yaklaşık 10-15 dakika mesafededir.//Belconti transferi için önceden rezervasyon gerekli mi?~Yoğun sezonda en az 24 saat önceden öneririz."
"beldibi|Beldibi|40|40|Beldibi, Kemer'in kuzeyinde yer alan, doğayla iç içe sakin bir tatil bölgesidir. Göynük Kanyonu ve Phaselis Antik Kenti'ne yakındır.|Beldibi Plajı//Göynük Kanyonu//Phaselis Antik Kenti|Akra Kemer//Maxx Royal Kemer//Swandor Kemer|Beldibi Hotel//Miramor Hotel//Orange County|Antalya Havalimanı'ndan Beldibi'ye ne kadar sürer?~Yaklaşık 40-50 dakika. Mesafe 40 km'dir.//Beldibi'nde gezilecek yerler nereler?~Beldibi Plajı, Göynük Kanyonu ve Phaselis Antik Kenti öne çıkan yerlerdir.//Göynük Kanyonu'na transfer yapıyor musunuz?~Evet. Kanyon girişine doğrudan transfer hizmeti veriyoruz.//Beldibi'ne gece transferi mümkün mü?~Evet, 7/24 hizmet veriyoruz."
"goynuk|Göynük|42|42|Göynük, Kemer'in kuzeyinde yer alan, ünlü Göynük Kanyonu'na ev sahipliği yapan bir tatil bölgesidir. Doğa ve deniz tatilini birleştirir.|Göynük Kanyonu//Göynük Plajı//Phaselis Antik Kenti|Akra Kemer//Maxx Royal Kemer//Swandor Kemer|Goynuk Hotel//Miramor Hotel//Orange County|Antalya Havalimanı'ndan Göynük'e ne kadar sürer?~Yaklaşık 42-52 dakika. Mesafe 42 km'dir.//Göynük Kanyonu'na transfer yapıyor musunuz?~Evet. Kanyon girişine doğrudan transfer hizmeti veriyoruz.//Göynük'te gezilecek yerler nereler?~Göynük Kanyonu, Göynük Plajı ve Phaselis Antik Kenti öne çıkan yerlerdir.//Göynük transferi için erken rezervasyon gerekli mi?~Yoğun sezonda öneririz, ancak kısa sürede de organize edebiliriz."
)

# ---------------------------------------------------------------------------
# Helpers
# ---------------------------------------------------------------------------
split_li() {
  local s="$1" out="" item
  local IFS='//'
  for item in $s; do
    [ -z "$item" ] && continue
    out+="<li>$(html_escape "$item")</li>"$'\n'
  done
  printf '%s' "$out"
}

build_faq_html() {
  local s="$1" out="" pair q a
  local IFS='//'
  for pair in $s; do
    [ -z "$pair" ] && continue
    q="${pair%%~*}"
    a="${pair#*~}"
    out+="<details><summary>$(html_escape "$q")</summary><p>$(html_escape "$a")</p></details>"$'\n'
  done
  printf '%s' "$out"
}

build_faq_jsonld() {
  local s="$1" out="" pair q a first=1
  local IFS='//'
  for pair in $s; do
    [ -z "$pair" ] && continue
    q="${pair%%~*}" ; a="${pair#*~}"
    q="${q//\\/\\\\}" ; q="${q//\"/\\\"}"
    a="${a//\\/\\\\}" ; a="${a//\"/\\\"}"
    [ "$first" -eq 1 ] || out+=","
    first=0
    out+="{\"@type\":\"Question\",\"name\":\"${q}\",\"acceptedAnswer\":{\"@type\":\"Answer\",\"text\":\"${a}\"}}"
  done
  printf '%s' "$out"
}

build_related() {
  local slug="$1" out="" n=${#SLUGS[@]} found=0 i idx rs
  for i in "${!SLUGS[@]}"; do [ "${SLUGS[$i]}" = "$slug" ] && found=$i && break; done
  for offset in 1 2 3 4; do
    idx=$(( (found + offset) % n ))
    rs="${SLUGS[$idx]}"
    out+="<a href=\"/${rs}.html\">$(html_escape "${NAMES[$rs]}")</a>"$'\n'
  done
  printf '%s' "$out"
}

# Populate associative arrays from ROWS
declare -a SLUGS=()
declare -A NAMES KMS MINS INTRS ATTRS LUXS BUDS FAQS
for row in "${ROWS[@]}"; do
  IFS='|' read -r slug name km mins intro attrs lux bud faqs <<< "$row"
  SLUGS+=("$slug")
  NAMES[$slug]="$name"
  KMS[$slug]="$km"
  MINS[$slug]="$mins"
  INTRS[$slug]="$intro"
  ATTRS[$slug]="$attrs"
  LUXS[$slug]="$lux"
  BUDS[$slug]="$bud"
  FAQS[$slug]="$faqs"
done

# ---------------------------------------------------------------------------
# Route page builder
# ---------------------------------------------------------------------------
build_page() {
  local slug="$1"
  local name="${NAMES[$slug]}"
  local km="${KMS[$slug]}"
  local mins="${MINS[$slug]}"
  local intro="${INTRS[$slug]}"
  local name_upper
  name_upper="$(printf '%s' "$name" | LC_ALL=C tr 'a-z' 'A-Z')"

  local esc_name esc_intro
  esc_name="$(html_escape "$name")"
  esc_intro="$(html_escape "$intro")"

  local luxury_html budget_html attractions_html faq_html faq_jsonld related_html
  luxury_html="$(split_li "${LUXS[$slug]}")"
  budget_html="$(split_li "${BUDS[$slug]}")"
  attractions_html="$(split_li "${ATTRS[$slug]}")"
  faq_html="$(build_faq_html "${FAQS[$slug]}")"
  faq_jsonld="$(build_faq_jsonld "${FAQS[$slug]}")"
  related_html="$(build_related "$slug")"

  cat <<HTML
<!doctype html>
<html lang="tr">
<head>
<meta charset="utf-8">
<script>
window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}
gtag('consent','default',{analytics_storage:'denied',ad_storage:'denied',ad_user_data:'denied',ad_personalization:'denied',wait_for_update:500});
</script>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-L5YM12ZQ63"></script>
<script>gtag('js',new Date());gtag('config','G-L5YM12ZQ63');gtag('config','AW-18480652924');</script>
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="theme-color" content="#101114">
<title>${esc_name} Transfer | Antalya Havalimanı - ${esc_name} VIP Transfer</title>
<meta name="description" content="Antalya Havalimanı'ndan ${esc_name} bölgesine lisanslı, sigortalı ve sabit fiyatlı VIP transfer. ${km} km mesafe, ~${mins} dakika. 7/24 WhatsApp ile anında fiyat teklifi.">
<meta name="robots" content="index,follow">
<link rel="canonical" href="${BASE}/${slug}.html">
<link rel="alternate" hreflang="tr" href="${BASE}/${slug}.html">
<link rel="alternate" hreflang="en" href="${BASE}/transfer.html?rota=${slug}&amp;lang=en">
<link rel="alternate" hreflang="de" href="${BASE}/transfer.html?rota=${slug}&amp;lang=de">
<link rel="alternate" hreflang="ru" href="${BASE}/transfer.html?rota=${slug}&amp;lang=ru">
<link rel="alternate" hreflang="x-default" href="${BASE}/${slug}.html">
<link rel="icon" type="image/png" href="/logo.png">
<link rel="shortcut icon" href="/logo.png">
<link rel="apple-touch-icon" href="/logo.png">
<meta property="og:type" content="website">
<meta property="og:title" content="${esc_name} Transfer | Antalya Havalimanı VIP Transfer">
<meta property="og:description" content="Antalya Havalimanı'ndan ${esc_name} bölgesine sabit fiyatlı, lisanslı VIP transfer. ${km} km, ~${mins} dakika.">
<meta property="og:url" content="${BASE}/${slug}.html">
<meta property="og:image" content="${BASE}/logo.png">
<meta name="twitter:card" content="summary_large_image">
<script type="application/ld+json">
{"@context":"https://schema.org","@graph":[
{"@type":"Service","name":"Antalya Havalimanı ${esc_name} VIP Transfer","serviceType":"Havalimanı Transferi","provider":{"@type":"LocalBusiness","name":"Antalya Korsan VIP Transfer","url":"${BASE}/","image":"${BASE}/logo.png","telephone":"+${WA}","priceRange":"₺₺"},"areaServed":{"@type":"Place","name":"${esc_name}, Antalya"},"url":"${BASE}/${slug}.html"},
{"@type":"BreadcrumbList","itemListElement":[
{"@type":"ListItem","position":1,"name":"Ana Sayfa","item":"${BASE}/"},
{"@type":"ListItem","position":2,"name":"Güzergâhlar","item":"${BASE}/#guzergahlar"},
{"@type":"ListItem","position":3,"name":"${esc_name}","item":"${BASE}/${slug}.html"}
]},
{"@type":"FAQPage","mainEntity":[${faq_jsonld}]}
]}
</script>
<link rel="stylesheet" href="/route.css">
<style>
.lang-bar{position:fixed;top:100px;right:16px;z-index:9}
@media(max-width:780px){.lang-bar{top:80px;right:10px}}
.lang-bar select{appearance:none;-webkit-appearance:none;background:#1c1d21;color:#fff;border:1px solid #333;border-radius:10px;padding:9px 34px 9px 14px;font:inherit;font-size:13px;font-weight:800;cursor:pointer;outline:none}
.lang-bar select:hover{border-color:#ffcc00}
.detail-block ul{margin:0;padding-left:22px;color:#d0d0d3}
.detail-block li{margin-bottom:8px}
.other-routes a{padding:10px 15px;background:#1b1c20;border:1px solid #33353a;border-radius:9px;font-size:13px;font-weight:700;color:#fff;text-decoration:none}
.other-routes a:hover{border-color:#ffcc00;color:#ffcc00}
</style>
</head>
<body data-slug="${slug}" data-name="${esc_name}" data-wa="${WA}">

<div class="lang-bar">
<select id="langSwitch" aria-label="Language">
<option value="tr" selected>TR</option>
<option value="en">EN</option>
<option value="de">DE</option>
<option value="ru">RU</option>
</select>
</div>

<header><div class="wrap"><nav class="top">
<a href="/" class="brand"><img src="/logo.png" alt="Antalya Korsan"><span>ANTALYA <span>KORSAN</span></span></a>
<div class="links">
<a href="/#hizmetler">Hizmetler</a>
<a href="/#guzergahlar">Güzergâhlar</a>
<a href="/blog/">Blog</a>
<a href="/#sss">S.S.S.</a>
<a class="btn" data-wa="header" href="#">Fiyat Al ↗</a>
</div></nav></div></header>

<div class="wrap"><nav class="breadcrumb">
<a href="${BASE}/">Ana Sayfa</a><span>›</span>
<a href="${BASE}/#guzergahlar">Güzergâhlar</a><span>›</span>
<strong style="color:#fff">${esc_name} Transfer</strong>
</nav></div>

<div class="hero"><div class="wrap">
<div class="eyebrow">ANTALYA HAVALİMANI • ${name_upper} TRANSFER</div>
<h1>Antalya Havalimanı - <em>${esc_name}</em> VIP Transfer</h1>
<p class="lead">${esc_intro}</p>
<div class="hero-cta">
<a class="btn wa" data-wa="hero" href="#">WhatsApp'tan Fiyat Al →</a>
<a class="btn outline" href="/#fiyatlar">Fiyat Hesapla</a>
</div>
</div></div>

<section style="padding:0 0 40px"><div class="wrap">
<div class="info-cards">
<div class="info-card"><strong>${km} km</strong><span>Antalya Havalimanı'ndan mesafe</span></div>
<div class="info-card"><strong>~${mins} dk</strong><span>Tahmini transfer süresi</span></div>
<div class="info-card"><strong>7/24</strong><span>Hizmet saatleri</span></div>
</div>
</div></section>

<section style="padding:20px 0 40px"><div class="wrap">
<h2>${esc_name} Bölgesinde Popüler Oteller</h2>
<div class="detail-block">
<h3>Lüks Oteller</h3>
<ul>${luxury_html}</ul>
<h3>Ekonomik / Fiyat-Performans Oteller</h3>
<ul>${budget_html}</ul>
</div>
</div></section>

<section style="padding:20px 0 40px"><div class="wrap">
<h2>${esc_name} Çevresinde Gezilecek Yerler</h2>
<div class="detail-block">
<ul>${attractions_html}</ul>
</div>
</div></section>

<section style="padding:20px 0 40px"><div class="wrap">
<h2>Sıkça Sorulan Sorular</h2>
${faq_html}
</div></section>

<section style="padding:20px 0 60px"><div class="wrap">
<h2>Diğer Güzergâhlar</h2>
<div class="other-routes">${related_html}</div>
</div></section>

<div class="cta"><div class="wrap">
<div><h2>${esc_name} transferinizi planlayalım.</h2><p>WhatsApp'tan yazın, dakikalar içinde sabit fiyat teklifinizi alın.</p></div>
<a class="btn" data-wa="cta" href="#">WhatsApp'tan Yaz →</a>
</div></div>

<footer><div class="wrap">
<span>© <span id="year">2026</span> Antalya Korsan VIP Transfer</span>
<a href="/">antalyakorsan.com</a>
</div></footer>

<div class="floating-contact">
<a class="contact-phone" href="tel:+${WA}" aria-label="Phone">📞</a>
<a class="contact-wa" data-wa="floating" href="#" aria-label="WhatsApp">💬</a>
</div>

<div class="mobile-cta-bar">
<a class="m-wa" data-wa="mobile" href="#">💬 WhatsApp</a>
<a class="m-call" href="tel:+${WA}">📞 Ara</a>
</div>

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

HTML

  cat <<'JSEOF'
<script>
(function(){
  var B = document.body;
  var WA = B.dataset.wa;
  var SLUG = B.dataset.slug;
  var NAME = B.dataset.name;
  var LANG_URLS = {
    tr: "/" + SLUG + ".html",
    en: "/transfer.html?rota=" + SLUG + "&lang=en",
    de: "/transfer.html?rota=" + SLUG + "&lang=de",
    ru: "/transfer.html?rota=" + SLUG + "&lang=ru"
  };
  var messages = {
    header:  "Merhaba, Antalya Havalimanı " + NAME + " transferi için fiyat almak istiyorum.",
    hero:    "Merhaba, " + NAME + " transferi için fiyat almak istiyorum.\nTarih: \nSaat: \nYolcu sayısı: \nOtel: ",
    cta:     "Merhaba, " + NAME + " transferi için fiyat almak istiyorum.",
    floating:"Merhaba, " + NAME + " transferi için fiyat almak istiyorum.",
    mobile:  "Merhaba, " + NAME + " transferi için fiyat almak istiyorum."
  };
  document.querySelectorAll('[data-wa]').forEach(function(a){
    var key = a.getAttribute('data-wa') || 'hero';
    var msg = messages[key] || messages.hero;
    a.setAttribute('href', 'https://wa.me/' + WA + '?text=' + encodeURIComponent(msg));
    a.setAttribute('target', '_blank');
    a.setAttribute('rel', 'noopener');
  });
  document.getElementById('langSwitch').addEventListener('change', function(e){
    var l = e.target.value;
    if (LANG_URLS[l]) location.href = LANG_URLS[l];
  });
  document.getElementById('year').textContent = new Date().getFullYear();
  document.addEventListener('click', function(e){
    var a = e.target.closest('a[href*="wa.me"]');
    if (a && typeof gtag === 'function') {
      gtag('event', 'generate_lead', { method: 'whatsapp', page: 'route_' + SLUG, lang: 'tr' });
    }
  }, true);

  var KEY = 'cookie_consent_v1';
  var banner = document.getElementById('cookieBanner');
  var dialog = document.getElementById('cookieDialog');
  var analyticsToggle = document.getElementById('consentAnalytics');
  var marketingToggle = document.getElementById('consentMarketing');
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
  if (stored) applyConsent(stored); else banner.hidden = false;
  banner.addEventListener('click', function(e){
    var btn = e.target.closest('[data-consent]');
    if (!btn) return;
    if (btn.dataset.consent === 'accept') saveConsent({analytics:true, marketing:true});
    else saveConsent({analytics:false, marketing:false});
  });
  document.getElementById('openCookiePrefs').addEventListener('click', function(){
    var s = loadConsent() || {analytics:false, marketing:false};
    analyticsToggle.checked = !!s.analytics;
    marketingToggle.checked = !!s.marketing;
    dialog.showModal();
  });
  document.getElementById('closeCookieDialog').addEventListener('click', function(){ dialog.close(); });
  dialog.addEventListener('click', function(e){ if (e.target === dialog) dialog.close(); });
  document.getElementById('saveCookiePrefs').addEventListener('click', function(){
    saveConsent({analytics: analyticsToggle.checked, marketing: marketingToggle.checked});
    dialog.close();
  });
})();
</script>
<script src="/assets/site.js" defer></script>
</body>
</html>
JSEOF
}

# ---------------------------------------------------------------------------
# index.html updater
# ---------------------------------------------------------------------------
update_index_html() {
  local target="$1"
  [ -f "$target" ] || { echo "  ⚠ index.html not found — skipping"; return 1; }

  local grid="" slug
  for slug in "${SLUGS[@]}"; do
    grid+="      <a class=\"route-tile\" data-route=\"${slug}\" href=\"/${slug}.html\">"
    grid+="<span class=\"route-pin\" aria-hidden=\"true\">📍</span>"
    grid+="<span class=\"rt-body\"><span class=\"rt-name\">$(html_escape "${NAMES[$slug]}")</span>"
    grid+="<span class=\"rt-meta\">${KMS[$slug]} km · ~${MINS[$slug]} dk</span></span>"
    grid+="</a>"$'\n'
  done

  local tmp
  tmp="$(mktemp)"
  printf '%s' "$grid" > "$tmp"

  [ "$DEPLOY" -eq 1 ] && cp "$target" "${target}.bak"

  GRID_FILE="$tmp" perl -0777 -i -pe '
    BEGIN {
      local $/;
      open my $fh, "<", $ENV{GRID_FILE} or die "Cannot open grid file: $!";
      $grid = <$fh>;
      close $fh;
    }
    s{(<div\s+class="route-grid"[^>]*>).*?(</div>\s*<p id="route-empty")}{$1\n$grid      $2}gs;
  ' "$target"

  rm -f "$tmp"

  if ! grep -q 'id="rt-meta-css"' "$target"; then
    perl -0777 -i -pe '
      s{(</style>)}{$1
<style id="rt-meta-css">.route-tile .rt-body{display:flex;flex-direction:column;gap:2px;min-width:0}.route-tile .rt-name{font-weight:700}.route-tile .rt-meta{font-size:11px;font-weight:500;color:#a9a9ac;letter-spacing:.2px}.route-tile:hover .rt-meta{color:#ffcc00}</style>
}s;
    ' "$target"
  fi

  echo "  ✓ index.html updated"
}

# ---------------------------------------------------------------------------
# sitemap.xml updater
# ---------------------------------------------------------------------------
update_sitemap() {
  local sitemap="$1"
  [ -f "$sitemap" ] || { echo "  ⚠ sitemap.xml not found — skipping"; return 1; }
  [ "$DEPLOY" -eq 1 ] && cp "$sitemap" "${sitemap}.bak"

  local blocks_file slug
  blocks_file="$(mktemp)"
  for slug in "${SLUGS[@]}"; do
    cat >> "$blocks_file" <<EOF

  <!-- ${NAMES[$slug]} -->
  <url>
    <loc>${BASE}/${slug}.html</loc>
    <lastmod>${TODAY}</lastmod>
    <xhtml:link rel="alternate" hreflang="tr" href="${BASE}/${slug}.html"/>
    <xhtml:link rel="alternate" hreflang="en" href="${BASE}/transfer.html?rota=${slug}&amp;lang=en"/>
    <xhtml:link rel="alternate" hreflang="ru" href="${BASE}/transfer.html?rota=${slug}&amp;lang=ru"/>
    <xhtml:link rel="alternate" hreflang="de" href="${BASE}/transfer.html?rota=${slug}&amp;lang=de"/>
    <xhtml:link rel="alternate" hreflang="x-default" href="${BASE}/${slug}.html"/>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>
EOF
  done

  local slug_re="" s
  for s in "${SLUGS[@]}"; do
    [ -n "$slug_re" ] && slug_re+="|"
    slug_re+=$(printf '%s' "$s" | sed -e 's/[][\.*^$()+?{}|]/\\&/g')
  done

  SLUG_RE="$slug_re" BLOCKS_FILE="$blocks_file" perl -0777 -i -pe '
    open my $fh, "<", $ENV{BLOCKS_FILE} or die "Cannot open blocks: $!";
    local $/;
    my $blocks = <$fh>;
    close $fh;
    my $slug_re = $ENV{SLUG_RE};
    s{<url>\s*<loc>https://antalyakorsan\.com/(?:$slug_re)\.html</loc>.*?</url>\s*}{}gs;
    s{(\s*)</urlset>}{$blocks$1</urlset>};
  ' "$sitemap"

  rm -f "$blocks_file"
  echo "  ✓ sitemap.xml updated"
}

# ---------------------------------------------------------------------------
# Main
# ---------------------------------------------------------------------------
echo ""
echo "════════════════════════════════════════════"
if [ "$DEPLOY" -eq 1 ]; then echo "  MODE: DEPLOY (overwriting real files)";
else echo "  MODE: PREVIEW (writing to routes-new/)"; fi
echo "  Output: $OUT_DIR"
echo "════════════════════════════════════════════"
echo ""

count=0
for slug in "${SLUGS[@]}"; do
  build_page "$slug" > "$OUT_DIR/${slug}.html"
  printf "  ✓ %s\n" "${OUT_DIR#"$SITE_ROOT/"}/${slug}.html"
  count=$((count + 1))
done
echo ""
echo "Generated $count route pages."

if [ "$DEPLOY" -eq 1 ]; then
  echo "Updating index.html..."; update_index_html "$SITE_ROOT/index.html"
  echo "Updating sitemap.xml..."; update_sitemap "$SITE_ROOT/sitemap.xml"
else
  if [ -f "$SITE_ROOT/index.html" ]; then
    echo "Updating routes-new/index.html (preview)..."
    cp "$SITE_ROOT/index.html" "$OUT_DIR/index.html"
    update_index_html "$OUT_DIR/index.html"
  fi
  if [ -f "$SITE_ROOT/sitemap.xml" ]; then
    echo "Updating routes-new/sitemap.xml (preview)..."
    cp "$SITE_ROOT/sitemap.xml" "$OUT_DIR/sitemap.xml"
    update_sitemap "$OUT_DIR/sitemap.xml"
  fi
fi

echo ""
echo "────────────────────────────────────────────"
echo "  Done."
echo "────────────────────────────────────────────"
echo ""
if [ "$DEPLOY" -eq 0 ]; then
  echo "Preview files written to: $OUT_DIR/"
  echo "  1) Open routes-new/kundu.html in a browser"
  echo "  2) Diff routes-new/index.html against your live index.html"
  echo "  3) When happy: ./generate-routes.sh --deploy"
else
  echo "Backups created:"
  echo "  - index.html.bak"
  echo "  - sitemap.xml.bak"
  echo ""
  echo "Verify rich results:"
  echo "  https://search.google.com/test/rich-results"
  echo "Validate sitemap:"
  echo "  xmllint --noout sitemap.xml"
  echo "Ping Google:"
  echo "  https://www.google.com/ping?sitemap=${BASE}/sitemap.xml"
fi
echo ""