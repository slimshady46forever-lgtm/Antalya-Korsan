<?php
/* ============================================================
   build-blog.php — Generates 6 blog posts + index in TR/EN/DE/RU
   Run via SSH: php build-blog.php
   Then DELETE this file.
   ============================================================ */

$WA = "905316922578";
$SITE = "https://antalyakorsan.com";
$YEAR = date('Y');
$LANGS = ['tr','en','de','ru'];

/* ============================================================
   UI STRINGS
   ============================================================ */

$UI = [
  'tr' => [
    'eyebrow' => 'ANTALYA TRANSFER REHBERİ',
    'readMore' => 'Devamını oku →',
    'otherPosts' => 'Diğer Yazılar',
    'blogTitle' => 'Antalya Transfer ve Tatil Rehberi',
    'blogSubtitle' => "Havalimanı ulaşımı, transfer fiyatları, tatil bölgeleri karşılaştırması ve aile ipuçları. Antalya'ya seyahatinizi kolaylaştıran rehber yazıları.",
    'blogHome' => 'Blog',
    'home' => 'Ana Sayfa',
    'ctaTitle' => 'Transfer rezervasyonu yapalım mı?',
    'ctaSub' => "WhatsApp'tan yazın, dakikalar içinde sabit fiyat teklifinizi alın.",
    'ctaBtn' => "WhatsApp'tan Yaz →",
    'waMsg' => 'Merhaba, blog yazınızı okudum ve transfer hakkında bilgi almak istiyorum.',
    'readTime' => '5 dk okuma',
    'services' => 'Hizmetler',
    'routes' => 'Güzergâhlar',
    'faq' => 'S.S.S.',
    'priceBtn' => 'Fiyat Al ↗'
  ],
  'en' => [
    'eyebrow' => 'ANTALYA TRANSFER GUIDE',
    'readMore' => 'Read more →',
    'otherPosts' => 'Other Articles',
    'blogTitle' => 'Antalya Transfer & Travel Guide',
    'blogSubtitle' => 'Airport transportation, transfer prices, resort area comparisons, and family tips. Articles to make your Antalya trip easier.',
    'blogHome' => 'Blog',
    'home' => 'Home',
    'ctaTitle' => 'Ready to book your transfer?',
    'ctaSub' => 'Message us on WhatsApp and get your fixed-price quote in minutes.',
    'ctaBtn' => 'Chat on WhatsApp →',
    'waMsg' => 'Hi, I read your blog and would like to get information about transfers.',
    'readTime' => '5 min read',
    'services' => 'Services',
    'routes' => 'Routes',
    'faq' => 'FAQ',
    'priceBtn' => 'Get a Quote ↗'
  ],
  'de' => [
    'eyebrow' => 'ANTALYA TRANSFER-RATGEBER',
    'readMore' => 'Weiterlesen →',
    'otherPosts' => 'Weitere Artikel',
    'blogTitle' => 'Antalya Transfer- & Reiseführer',
    'blogSubtitle' => 'Flughafentransfer, Preise, Vergleich der Urlaubsorte und Tipps für Familien. Artikel, die Ihre Antalya-Reise einfacher machen.',
    'blogHome' => 'Blog',
    'home' => 'Startseite',
    'ctaTitle' => 'Transfer buchen?',
    'ctaSub' => 'Schreiben Sie uns per WhatsApp und erhalten Sie Ihr Festpreisangebot in Minuten.',
    'ctaBtn' => 'Auf WhatsApp schreiben →',
    'waMsg' => 'Hallo, ich habe Ihren Blog gelesen und möchte Informationen zum Transfer erhalten.',
    'readTime' => '5 Min. Lesezeit',
    'services' => 'Leistungen',
    'routes' => 'Routen',
    'faq' => 'FAQ',
    'priceBtn' => 'Preis anfragen ↗'
  ],
  'ru' => [
    'eyebrow' => 'ГИД ПО ТРАНСФЕРУ АНТАЛИЯ',
    'readMore' => 'Читать далее →',
    'otherPosts' => 'Другие статьи',
    'blogTitle' => 'Гид по трансферу и отдыху в Анталии',
    'blogSubtitle' => 'Транспорт из аэропорта, цены на трансфер, сравнение курортов и советы для семей. Статьи, которые сделают вашу поездку в Анталию проще.',
    'blogHome' => 'Блог',
    'home' => 'Главная',
    'ctaTitle' => 'Готовы забронировать трансфер?',
    'ctaSub' => 'Напишите нам в WhatsApp и получите цену за минуты.',
    'ctaBtn' => 'Написать в WhatsApp →',
    'waMsg' => 'Здравствуйте, я прочитал ваш блог и хочу получить информацию о трансфере.',
    'readTime' => '5 мин чтения',
    'services' => 'Услуги',
    'routes' => 'Маршруты',
    'faq' => 'Вопросы',
    'priceBtn' => 'Узнать цену ↗'
  ]
];

/* ============================================================
   POSTS — 6 posts, each with TR/EN/DE/RU content
   ============================================================ */

$posts = [];

/* ==================== POST 1 ==================== */
$posts['antalya-havalimani-otelinize-nasil-gidilir'] = [
  'date' => '2026-01-15',
  'tr' => [
    'cat' => 'Ulaşım Rehberi',
    'title' => "Antalya Havalimanından Otelinize Nasıl Gidilir? (2026 Rehberi)",
    'metaTitle' => "Antalya Havalimanından Otelinize Nasıl Gidilir? 2026",
    'metaDesc' => "Antalya Havalimanı'ndan otelinize ulaşmanın 4 yolu: Havaş otobüsü, taksi, VIP transfer ve araç kiralama. Fiyat, süre ve konfor karşılaştırması.",
    'excerpt' => "Antalya Havalimanı'na indikten sonra otelinize 4 farklı şekilde ulaşabilirsiniz. Her birinin avantajı, dezavantajı ve maliyeti farklı. İşte 2026 yılı için güncel karşılaştırma.",
    'body' => '<p>Antalya Havalimanı (AYT) Türkiye\'nin en yoğun turistik havalimanlarından biridir. Yılda 30 milyondan fazla yolcu geçer ve bunların büyük çoğunluğu tatil bölgelerine transfer olur. Uçuşunuz indiğinde otelinize ulaşmak için <strong>4 farklı seçeneğiniz</strong> var — ve bu seçim, ilk gününüzün geri kalanını belirler.</p>

<h2>1. Havaş / Otobüs</h2>
<p>Havaş, Antalya Havalimanı\'ndan şehir merkezine ve bazı turistik bölgelere otobüs seferi düzenler. Havalimanı çıkışının hemen dışında bulunur.</p>
<ul>
  <li><strong>Fiyat:</strong> Kişi başı 100–250 ₺ (mesafeye göre)</li>
  <li><strong>Artıları:</strong> En ekonomik seçenek. Otobüsler klimalı ve düzenli.</li>
  <li><strong>Eksileri:</strong> Belirli duraklara gider, otelinizin kapısına kadar götürmez. Bagajla otobüsten inmek, sonra taksi/otobüs transferi gerekebilir. Grup için pratik değildir.</li>
  <li><strong>Kimin için uygun:</strong> Tek başına seyahat eden, bütçesi kısıtlı, ve şehir merkezine giden yolcular.</li>
</ul>

<h2>2. Taksi</h2>
<p>Havalimanı çıkışında her zaman hazır taksi bulunur. Antalya\'da taksiler taksimetreyle çalışır ancak uzun mesafelerde sürücüyle pazarlık yapılabilir.</p>
<ul>
  <li><strong>Fiyat:</strong> Kundu/Lara için 400–700 ₺, Side/Belek için 1.200–1.800 ₺, Alanya için 3.500–4.500 ₺</li>
  <li><strong>Artıları:</strong> Anında mevcut. Kapıdan kapıya.</li>
  <li><strong>Eksileri:</strong> Yabancı turistlere zaman zaman yüksek fiyat söylenebilir. Bagajın sığmadığı durumlar olabilir. Nakit gerektirir. Önceden fiyat teyidi yoktur.</li>
  <li><strong>Kimin için uygun:</strong> Kısa mesafe (Kundu, Lara) ve tek yolcu için düşünülebilir.</li>
</ul>

<h2>3. VIP Transfer (Özel Şoförlü Araç)</h2>
<p>Önceden rezervasyonla gelen, sizi isminizle karşılayan, doğrudan otelinize bırakan özel araç hizmetidir.</p>
<ul>
  <li><strong>Fiyat:</strong> Sedan VIP 480 ₺\'den başlar (Kundu), Alanya gibi uzak bölgeler için 4.000 ₺ civarı</li>
  <li><strong>Artıları:</strong> Fiyat önceden bellidir, sürpriz yoktur. Sürücü sizi isminizle karşılar. Bagajınıza yardım edilir. Uçuş takibi yapılır. Klimalı, konforlu araç. Kapıdan kapıya.</li>
  <li><strong>Eksileri:</strong> Önceden rezervasyon gerektirir (genelde 2 saat öncesinden).</li>
  <li><strong>Kimin için uygun:</strong> Aile, grup, iş seyahati, ilk defa gelenler ve konfor arayan herkes.</li>
</ul>

<h2>4. Araç Kiralama</h2>
<p>Havalimanında birçok araç kiralama şirketi bulunur. Uzun süreli tatiller için tercih edilebilir.</p>
<ul>
  <li><strong>Fiyat:</strong> Günlük 800 ₺\'den başlar + yakıt + sigorta</li>
  <li><strong>Artıları:</strong> Tam özgürlük.</li>
  <li><strong>Eksileri:</strong> Yorgunken araba kullanmak zorunda kalırsınız. Park sorunu. Yerel trafiği bilmeniz gerekir.</li>
  <li><strong>Kimin için uygun:</strong> 1 haftadan uzun kalan, gezmeyi sevenler.</li>
</ul>

<h2>Karşılaştırma Tablosu</h2>
<table>
  <thead><tr><th>Seçenek</th><th>Fiyat</th><th>Kapıdan Kapıya</th><th>Rezervasyon</th><th>Önerilen</th></tr></thead>
  <tbody>
    <tr><td>Havaş / Otobüs</td><td>100–250 ₺</td><td>Hayır</td><td>Gerekmez</td><td>Bütçe yolcuları</td></tr>
    <tr><td>Taksi</td><td>400–4.500 ₺</td><td>Evet</td><td>Hayır</td><td>Kısa mesafe</td></tr>
    <tr><td><strong>VIP Transfer</strong></td><td><strong>480–5.500 ₺</strong></td><td><strong>Evet</strong></td><td><strong>Gerekir</strong></td><td><strong>Herkes</strong></td></tr>
    <tr><td>Araç Kiralama</td><td>800 ₺/gün +</td><td>—</td><td>Gerekir</td><td>Uzun tatiller</td></tr>
  </tbody>
</table>

<h2>Havalimanına İndikten Sonra İlk Adımlar</h2>
<ol>
  <li>Pasaport kontrolü (20–40 dk, yoğun saatte 1 saati bulabilir)</li>
  <li>Bagaj alımı</li>
  <li>Gümrük kontrolü</li>
  <li>Karşılama salonu — şoförünüz isminizin yazdığı tabelayla sizi bekler</li>
</ol>
<p>VIP transfer rezervasyonu yaptıysanız <strong>uçuş kodunuzu WhatsApp üzerinden paylaşmanız</strong> çok önemlidir.</p>

<h2>Hangi Seçeneği Seçmelisiniz?</h2>
<p>Aile ve gruplar için <strong>VIP transfer en mantıklı seçenektir</strong>. Fiyat önceden belli, bagaj yardımı var, isimle karşılama yapılır. <strong>Çocuk koltuğu ihtiyacınız varsa rezervasyon sırasında WhatsApp üzerinden önceden sorun</strong> — uygunluk ve ücret o sırada teyit edilir.</p>',
    'faqs' => [
      ['q'=>'Antalya Havalimanından otele en ucuz nasıl gidilir?','a'=>'Havaş otobüsü en ekonomik seçenektir (kişi başı 100-250 ₺). Ancak otelinizin kapısına kadar götürmediği için sonrasında ek ulaşım gerekebilir.'],
      ['q'=>'Havalimanında taksimetre dışında pazarlık yapılabilir mi?','a'=>'Uzun mesafelerde sürücüyle pazarlık yapılabilir ancak kesin fiyat teyidi yoktur. VIP transferde fiyat önceden bellidir.'],
      ['q'=>'VIP transfer kaç saat önce rezerve edilmeli?','a'=>'En az 2 saat öncesinden. Yoğun sezonda 24 saat önceden öneririz.'],
      ['q'=>'Çocuk koltuğu sağlıyor musunuz?','a'=>'Çocuk koltuğu talebini WhatsApp üzerinden önceden iletmeniz gerekir. Uygunluk ve ücret rezervasyon sırasında teyit edilir.']
    ]
  ],
  'en' => [
    'cat' => 'Transport Guide',
    'title' => "How to Get from Antalya Airport to Your Hotel (2026 Guide)",
    'metaTitle' => "Antalya Airport to Hotel: 4 Options Compared (2026)",
    'metaDesc' => "4 ways to get from Antalya Airport to your hotel: Havaş bus, taxi, VIP transfer and car rental. Prices, duration and comfort compared.",
    'excerpt' => "Once you land at Antalya Airport, you have 4 ways to reach your hotel. Each has different pros, cons and costs. Here's the 2026 comparison.",
    'body' => '<p>Antalya Airport (AYT) is one of Turkey\'s busiest tourist airports, handling over 30 million passengers a year — most of them headed to resort areas. Once you land, you have <strong>4 ways</strong> to reach your hotel. Your choice affects how the rest of your first day goes.</p>

<h2>1. Havaş Bus</h2>
<p>Havaş runs bus services from the airport to the city center and some resort areas. You\'ll find them right outside the arrivals exit.</p>
<ul>
  <li><strong>Price:</strong> 100–250 ₺ per person</li>
  <li><strong>Pros:</strong> Cheapest option. Air-conditioned, on schedule.</li>
  <li><strong>Cons:</strong> Goes to specific stops, not to your hotel door. You may need a second transfer. Not practical for groups.</li>
  <li><strong>Best for:</strong> Solo travelers on a budget heading to the city center.</li>
</ul>

<h2>2. Taxi</h2>
<p>There\'s always a taxi available at the arrivals exit. Antalya taxis run on meters, but long-distance fares are negotiable.</p>
<ul>
  <li><strong>Price:</strong> 400–700 ₺ for Kundu/Lara, 1,200–1,800 ₺ for Side/Belek, 3,500–4,500 ₺ for Alanya</li>
  <li><strong>Pros:</strong> Available instantly. Door to door.</li>
  <li><strong>Cons:</strong> Foreign tourists may be quoted higher prices. Luggage space is limited. Cash required. No price guarantee in advance.</li>
  <li><strong>Best for:</strong> Short distances (Kundu, Lara) and single travelers.</li>
</ul>

<h2>3. VIP Transfer (Private Chauffeur)</h2>
<p>Booked in advance, meets you with your name on a sign, drops you directly at your hotel.</p>
<ul>
  <li><strong>Price:</strong> Sedan VIP from 480 ₺ (Kundu), around 4,000 ₺ for far destinations like Alanya</li>
  <li><strong>Pros:</strong> Price is fixed upfront — no surprises. Driver meets you by name. Luggage assistance included. Flight tracking. Air-conditioned, comfortable car. Door to door.</li>
  <li><strong>Cons:</strong> Requires advance booking (usually 2 hours ahead).</li>
  <li><strong>Best for:</strong> Families, groups, business travelers, first-time visitors, anyone who wants comfort.</li>
</ul>

<h2>4. Car Rental</h2>
<p>Several rental agencies operate at the airport. Best for longer stays.</p>
<ul>
  <li><strong>Price:</strong> From 800 ₺ per day + fuel + insurance</li>
  <li><strong>Pros:</strong> Total freedom.</li>
  <li><strong>Cons:</strong> You drive while tired. Parking hassles. You need to know local traffic.</li>
  <li><strong>Best for:</strong> Stays longer than a week, travelers who like to explore.</li>
</ul>

<h2>Comparison Table</h2>
<table>
  <thead><tr><th>Option</th><th>Price</th><th>Door-to-door</th><th>Reservation</th><th>Best for</th></tr></thead>
  <tbody>
    <tr><td>Havaş Bus</td><td>100–250 ₺</td><td>No</td><td>Not needed</td><td>Budget travelers</td></tr>
    <tr><td>Taxi</td><td>400–4,500 ₺</td><td>Yes</td><td>No</td><td>Short distances</td></tr>
    <tr><td><strong>VIP Transfer</strong></td><td><strong>480–5,500 ₺</strong></td><td><strong>Yes</strong></td><td><strong>Required</strong></td><td><strong>Everyone</strong></td></tr>
    <tr><td>Car Rental</td><td>800 ₺/day +</td><td>—</td><td>Required</td><td>Long holidays</td></tr>
  </tbody>
</table>

<h2>Steps After Landing</h2>
<ol>
  <li>Passport control (20–40 min, up to an hour at peak times)</li>
  <li>Baggage claim</li>
  <li>Customs</li>
  <li>Arrivals hall — your driver waits with a sign showing your name</li>
</ol>
<p>If you booked VIP transfer, <strong>sharing your flight code on WhatsApp matters</strong> — we track your flight, so delays cost nothing extra.</p>

<h2>Which Should You Choose?</h2>
<p>For families and groups, <strong>VIP transfer makes the most sense</strong>. Price fixed upfront, luggage help, meet-by-name. <strong>If you need a child seat, ask in advance on WhatsApp</strong> — availability and fee are confirmed during booking.</p>',
    'faqs' => [
      ['q'=>'What is the cheapest way from Antalya Airport to my hotel?','a'=>'The Havaş bus is the cheapest (100-250 ₺ per person). However, it doesn\'t take you to your hotel door, so you may need additional transport.'],
      ['q'=>'Can I negotiate taxi fares at the airport?','a'=>'For long distances you can negotiate, but there\'s no price guarantee. With VIP transfer, the price is fixed upfront.'],
      ['q'=>'How far in advance should I book VIP transfer?','a'=>'At least 2 hours. In peak season, we recommend 24 hours in advance.'],
      ['q'=>'Do you provide child seats?','a'=>'Child seat requests must be submitted in advance via WhatsApp. Availability and fee are confirmed during booking.']
    ]
  ],
  'de' => [
    'cat' => 'Transport-Ratgeber',
    'title' => "Vom Flughafen Antalya zum Hotel — So geht's (2026)",
    'metaTitle' => "Flughafen Antalya zum Hotel: 4 Optionen im Vergleich",
    'metaDesc' => "4 Wege vom Flughafen Antalya zum Hotel: Havaş-Bus, Taxi, VIP-Transfer und Mietwagen. Preise, Dauer und Komfort im Vergleich.",
    'excerpt' => "Nach der Landung am Flughafen Antalya haben Sie 4 Wege zum Hotel. Jede Option hat Vor- und Nachteile. Hier der Vergleich für 2026.",
    'body' => '<p>Der Flughafen Antalya (AYT) ist einer der verkehrsreichsten Touristenflughäfen der Türkei — über 30 Millionen Passagiere pro Jahr. Nach der Landung haben Sie <strong>4 Optionen</strong>, um zum Hotel zu kommen. Ihre Wahl beeinflusst den Rest Ihres ersten Tages.</p>

<h2>1. Havaş-Bus</h2>
<p>Havaş betreibt Busverbindungen vom Flughafen in die Innenstadt und einige Urlaubsgebiete. Die Haltestelle liegt direkt vor dem Ankunftsausgang.</p>
<ul>
  <li><strong>Preis:</strong> 100–250 ₺ pro Person</li>
  <li><strong>Vorteile:</strong> Günstigste Option. Klimatisiert, pünktlich.</li>
  <li><strong>Nachteile:</strong> Hält an bestimmten Stationen, nicht an Ihrem Hotel. Eventuell zweiter Transfer nötig. Für Gruppen unpraktisch.</li>
  <li><strong>Am besten für:</strong> Alleinreisende mit knappem Budget, Innenstadt.</li>
</ul>

<h2>2. Taxi</h2>
<p>Am Ankunftsausgang steht immer ein Taxi bereit. Antalya-Taxis fahren mit Taxameter, aber für längere Strecken ist der Preis verhandelbar.</p>
<ul>
  <li><strong>Preis:</strong> 400–700 ₺ für Kundu/Lara, 1.200–1.800 ₺ für Side/Belek, 3.500–4.500 ₺ für Alanya</li>
  <li><strong>Vorteile:</strong> Sofort verfügbar. Tür zu Tür.</li>
  <li><strong>Nachteile:</strong> Ausländische Touristen erhalten manchmal höhere Preise. Begrenzter Kofferraum. Bargeld erforderlich. Keine Preisgarantie im Voraus.</li>
  <li><strong>Am besten für:</strong> Kurze Strecken (Kundu, Lara), Alleinreisende.</li>
</ul>

<h2>3. VIP-Transfer (Privatfahrer)</h2>
<p>Vorab gebucht, Empfang mit Namensschild, Fahrt direkt zum Hotel.</p>
<ul>
  <li><strong>Preis:</strong> Sedan VIP ab 480 ₺ (Kundu), etwa 4.000 ₺ für entfernte Ziele wie Alanya</li>
  <li><strong>Vorteile:</strong> Festpreis von Anfang an. Fahrer empfängt Sie namentlich. Gepäckhilfe inklusive. Flugverfolgung. Klimatisiertes, komfortables Fahrzeug. Tür zu Tür.</li>
  <li><strong>Nachteile:</strong> Vorab-Buchung erforderlich (meist 2 Stunden vorher).</li>
  <li><strong>Am besten für:</strong> Familien, Gruppen, Geschäftsreisende, Erstbesucher, alle die Komfort wollen.</li>
</ul>

<h2>4. Mietwagen</h2>
<p>Mehrere Vermieter sind am Flughafen. Ideal für längere Aufenthalte.</p>
<ul>
  <li><strong>Preis:</strong> Ab 800 ₺ pro Tag + Kraftstoff + Versicherung</li>
  <li><strong>Vorteile:</strong> Völlige Freiheit.</li>
  <li><strong>Nachteile:</strong> Selbst fahren, wenn Sie müde sind. Parkplatzsuche. Ortskenntnis nötig.</li>
  <li><strong>Am besten für:</strong> Aufenthalte über eine Woche.</li>
</ul>

<h2>Vergleichstabelle</h2>
<table>
  <thead><tr><th>Option</th><th>Preis</th><th>Tür zu Tür</th><th>Buchung</th><th>Empfohlen</th></tr></thead>
  <tbody>
    <tr><td>Havaş-Bus</td><td>100–250 ₺</td><td>Nein</td><td>Nicht nötig</td><td>Sparsame Reisende</td></tr>
    <tr><td>Taxi</td><td>400–4.500 ₺</td><td>Ja</td><td>Nein</td><td>Kurze Strecken</td></tr>
    <tr><td><strong>VIP-Transfer</strong></td><td><strong>480–5.500 ₺</strong></td><td><strong>Ja</strong></td><td><strong>Erforderlich</strong></td><td><strong>Alle</strong></td></tr>
    <tr><td>Mietwagen</td><td>800 ₺/Tag +</td><td>—</td><td>Erforderlich</td><td>Lange Urlaube</td></tr>
  </tbody>
</table>

<h2>Schritte nach der Landung</h2>
<ol>
  <li>Passkontrolle (20–40 Min., bis zu einer Stunde zu Stoßzeiten)</li>
  <li>Gepäckausgabe</li>
  <li>Zoll</li>
  <li>Ankunftshalle — Ihr Fahrer wartet mit Namensschild</li>
</ol>
<p>Bei VIP-Transfer: <strong>Teilen Sie uns Ihren Flugcode per WhatsApp mit</strong> — wir verfolgen Ihren Flug, Verspätungen kosten nichts extra.</p>

<h2>Was sollten Sie wählen?</h2>
<p>Für Familien und Gruppen ist <strong>VIP-Transfer die beste Wahl</strong>. Festpreis vorab, Gepäckhilfe, Empfang mit Namen. <strong>Wenn Sie einen Kindersitz brauchen, fragen Sie vorab per WhatsApp</strong> — Verfügbarkeit und Preis werden bei der Buchung bestätigt.</p>',
    'faqs' => [
      ['q'=>'Was ist der günstigste Weg vom Flughafen Antalya zum Hotel?','a'=>'Der Havaş-Bus ist am günstigsten (100-250 ₺ pro Person). Er bringt Sie aber nicht bis zur Hoteltür, daher kann ein zweiter Transfer nötig sein.'],
      ['q'=>'Kann man den Taxipreis verhandeln?','a'=>'Bei längeren Strecken ist Verhandeln möglich, aber ohne Preisgarantie. Beim VIP-Transfer ist der Preis von Anfang an fest.'],
      ['q'=>'Wie lange im Voraus sollte ich VIP-Transfer buchen?','a'=>'Mindestens 2 Stunden. In der Hochsaison empfehlen wir 24 Stunden im Voraus.'],
      ['q'=>'Bieten Sie Kindersitze an?','a'=>'Kindersitz-Anfragen müssen vorab per WhatsApp gestellt werden. Verfügbarkeit und Preis werden bei der Buchung bestätigt.']
    ]
  ],
  'ru' => [
    'cat' => 'Гид по транспорту',
    'title' => "Как добраться из аэропорта Анталии до отеля (гид 2026)",
    'metaTitle' => "Из аэропорта Анталии до отеля: 4 варианта",
    'metaDesc' => "4 способа добраться из аэропорта Анталии до отеля: автобус Havaş, такси, VIP-трансфер, аренда авто. Цены, время и комфорт в сравнении.",
    'excerpt' => "После прилёта в Анталию у вас есть 4 способа добраться до отеля. У каждого свои плюсы и минусы. Сравнение на 2026 год.",
    'body' => '<p>Аэропорт Анталии (AYT) — один из самых загруженных туристических аэропортов Турции, более 30 миллионов пассажиров в год. После прилёта у вас есть <strong>4 варианта</strong> доехать до отеля. Ваш выбор влияет на остаток первого дня.</p>

<h2>1. Автобус Havaş</h2>
<p>Havaş организует автобусные маршруты из аэропорта в центр города и некоторые курортные районы. Остановка прямо у выхода из терминала.</p>
<ul>
  <li><strong>Цена:</strong> 100–250 ₺ на человека</li>
  <li><strong>Плюсы:</strong> Самый дешёвый вариант. С кондиционером, по расписанию.</li>
  <li><strong>Минусы:</strong> Останавливается на определённых станциях, не у отеля. Может потребоваться второй трансфер. Неудобен для групп.</li>
  <li><strong>Для кого:</strong> Одинокие путешественники с ограниченным бюджетом.</li>
</ul>

<h2>2. Такси</h2>
<p>На выходе из терминала всегда есть такси. В Анталии такси работают по счётчику, но на длинных дистанциях цена обсуждаема.</p>
<ul>
  <li><strong>Цена:</strong> 400–700 ₺ до Кунду/Лары, 1.200–1.800 ₺ до Сиде/Белека, 3.500–4.500 ₺ до Аланьи</li>
  <li><strong>Плюсы:</strong> Мгновенно доступно. От двери до двери.</li>
  <li><strong>Минусы:</strong> Иностранным туристам иногда называют завышенную цену. Ограниченный багажник. Нужны наличные. Нет гарантии цены заранее.</li>
  <li><strong>Для кого:</strong> Короткие дистанции (Кунду, Лара), одинокие пассажиры.</li>
</ul>

<h2>3. VIP-трансфер (личный водитель)</h2>
<p>Забронировано заранее, встреча с табличкой с вашим именем, доставка прямо до отеля.</p>
<ul>
  <li><strong>Цена:</strong> Sedan VIP от 480 ₺ (Кунду), около 4.000 ₺ до дальних мест</li>
  <li><strong>Плюсы:</strong> Фиксированная цена сразу. Водитель встречает по имени. Помощь с багажом. Отслеживание рейса. Комфортный автомобиль. От двери до двери.</li>
  <li><strong>Минусы:</strong> Требуется предварительное бронирование.</li>
  <li><strong>Для кого:</strong> Семьи, группы, деловые путешественники, впервые приезжающие.</li>
</ul>

<h2>4. Аренда авто</h2>
<p>В аэропорту работают несколько прокатных компаний. Идеально для длительных поездок.</p>
<ul>
  <li><strong>Цена:</strong> От 800 ₺ в день + топливо + страховка</li>
  <li><strong>Плюсы:</strong> Полная свобода.</li>
  <li><strong>Минусы:</strong> Нужно вести уставшим. Проблемы с парковкой. Нужно знать местный трафик.</li>
  <li><strong>Для кого:</strong> Поездки длиннее недели.</li>
</ul>

<h2>Таблица сравнения</h2>
<table>
  <thead><tr><th>Вариант</th><th>Цена</th><th>От двери до двери</th><th>Бронирование</th><th>Рекомендация</th></tr></thead>
  <tbody>
    <tr><td>Автобус Havaş</td><td>100–250 ₺</td><td>Нет</td><td>Не нужно</td><td>Экономным туристам</td></tr>
    <tr><td>Такси</td><td>400–4.500 ₺</td><td>Да</td><td>Нет</td><td>Короткие дистанции</td></tr>
    <tr><td><strong>VIP-трансфер</strong></td><td><strong>480–5.500 ₺</strong></td><td><strong>Да</strong></td><td><strong>Нужно</strong></td><td><strong>Всем</strong></td></tr>
    <tr><td>Аренда авто</td><td>800 ₺/день +</td><td>—</td><td>Нужно</td><td>Долгие отпуска</td></tr>
  </tbody>
</table>

<h2>Шаги после посадки</h2>
<ol>
  <li>Паспортный контроль (20–40 мин, до часа в пик)</li>
  <li>Получение багажа</li>
  <li>Таможня</li>
  <li>Зал прилёта — водитель ждёт с табличкой с вашим именем</li>
</ol>
<p>Если вы забронировали VIP-трансфер, <strong>обязательно поделитесь номером рейса в WhatsApp</strong>.</p>

<h2>Что выбрать?</h2>
<p>Для семей и групп <strong>VIP-трансфер — самый логичный выбор</strong>. <strong>Если нужно детское кресло — спросите заранее в WhatsApp</strong>, наличие и стоимость подтвердим при бронировании.</p>',
    'faqs' => [
      ['q'=>'Какой самый дешёвый способ добраться из аэропорта Анталии до отеля?','a'=>'Автобус Havaş — самый дешёвый (100-250 ₺ на человека). Но он не довозит до дверей отеля, может понадобиться дополнительный трансфер.'],
      ['q'=>'Можно ли торговаться с таксистами?','a'=>'На длинных дистанциях можно, но без гарантии цены. В VIP-трансфере цена фиксирована заранее.'],
      ['q'=>'За сколько нужно бронировать VIP-трансфер?','a'=>'Минимум за 2 часа. В высокий сезон рекомендуем за 24 часа.'],
      ['q'=>'Предоставляете ли вы детские кресла?','a'=>'Запрос на детское кресло нужно отправлять заранее в WhatsApp. Наличие и стоимость подтверждаются при бронировании.']
    ]
  ]
];

/* ==================== POST 2 ==================== */
$posts['antalya-taksi-vs-vip-transfer'] = [
  'date' => '2026-01-20',
  'tr' => [
    'cat' => 'Karşılaştırma',
    'title' => "Antalya'da Taksi mi VIP Transfer mi? Karşılaştırmalı Rehber",
    'metaTitle' => "Antalya Taksi mi VIP Transfer mi? 2026 Karşılaştırma",
    'metaDesc' => "Antalya'da taksi ile VIP transfer arasındaki farklar: fiyat, konfor, güvenilirlik, bagaj, dil. Hangi durumda hangisi tercih edilmeli?",
    'excerpt' => "Antalya'da taksi ve VIP transfer arasındaki farkları gerçek rakamlarla karşılaştırdık. Fiyat, konfor, güvenilirlik — hangisi size uygun?",
    'body' => '<p>Antalya\'ya gelen turistlerin en çok sorduğu sorulardan biri: "Taksi mi tutsam, VIP transfer mi ayarlasam?" İkisinin de artıları, eksileri var. Bu rehberde gerçek rakamlar ve durumlarla karşılaştırıyoruz.</p>

<h2>1. Fiyat Karşılaştırması</h2>
<p>Taksi fiyatı araç başıdır — kişi başı değil. VIP transfer de araç fiyatıdır.</p>
<table>
  <thead><tr><th>Güzergâh</th><th>Taksi (tahmini)</th><th>VIP Sedan</th><th>VIP Minivan</th></tr></thead>
  <tbody>
    <tr><td>Havalimanı → Lara</td><td>400–600 ₺</td><td>400 ₺</td><td>520 ₺</td></tr>
    <tr><td>Havalimanı → Kundu</td><td>450–650 ₺</td><td>480 ₺</td><td>620 ₺</td></tr>
    <tr><td>Havalimanı → Belek</td><td>1.200–1.600 ₺</td><td>1.330 ₺</td><td>1.730 ₺</td></tr>
    <tr><td>Havalimanı → Side</td><td>1.900–2.400 ₺</td><td>2.280 ₺</td><td>2.960 ₺</td></tr>
    <tr><td>Havalimanı → Alanya</td><td>3.500–4.500 ₺</td><td>4.050 ₺</td><td>5.270 ₺</td></tr>
  </tbody>
</table>
<p><strong>Sonuç:</strong> Kısa mesafelerde neredeyse aynı fiyat. Uzun mesafelerde taksi 100-200 ₺ daha ucuz olabilir ama sabit değildir.</p>

<h2>2. Konfor</h2>
<p>Taksi araçları genelde temizdir ancak araç yaşı değişkendir. VIP transfer araçları genelde 3 yıldan genç ve düzenli bakımlıdır.</p>

<h2>3. Güvenilirlik</h2>
<ul>
  <li><strong>Uçuş takibi:</strong> VIP şoförünüz bekler, taksi beklemez</li>
  <li><strong>İsimle karşılama:</strong> Havalimanı çıkışında tabelanızı görürsünüz</li>
  <li><strong>Fiyat önceden belli:</strong> Yolculuk sonrası sürpriz olmaz</li>
  <li><strong>Doğrudan otelinize:</strong> Adres tarif etmeniz gerekmez</li>
</ul>

<h2>4. Bagaj Kapasitesi</h2>
<table>
  <thead><tr><th>Araç Tipi</th><th>Yolcu</th><th>Bagaj</th></tr></thead>
  <tbody>
    <tr><td>Standart taksi</td><td>1–3</td><td>2–3 valiz</td></tr>
    <tr><td>VIP Sedan</td><td>1–3</td><td>2–3 valiz</td></tr>
    <tr><td>VIP Minivan</td><td>4–6</td><td>4–6 valiz</td></tr>
    <tr><td>VIP Minibüs</td><td>7–14</td><td>7+ valiz</td></tr>
  </tbody>
</table>

<h2>5. Dil ve İletişim</h2>
<p>Taksi şoförleri temel İngilizce bilir. VIP transfer şoförlerimiz İngilizce, Rusça ve Almanca hizmet verebilir.</p>

<h2>6. Çocuklu Aileler İçin Fark</h2>
<ul>
  <li>Taksilerde çocuk koltuğu genellikle yoktur</li>
  <li>VIP transferde çocuk koltuğu <strong>talep üzerine sağlanabilir</strong> — WhatsApp üzerinden önceden sormanız gerekir</li>
  <li>Bebek arabası için minivan kesinlikle daha rahat</li>
</ul>

<h2>Hangi Durumda Hangisi?</h2>
<table>
  <thead><tr><th>Durum</th><th>Öneri</th></tr></thead>
  <tbody>
    <tr><td>Tek kişi, kısa mesafe</td><td>Taksi veya VIP</td></tr>
    <tr><td>Çift, orta mesafe</td><td>VIP Sedan</td></tr>
    <tr><td>Aile (çocuklu)</td><td><strong>VIP</strong></td></tr>
    <tr><td>Grup (4+), uzun mesafe</td><td><strong>VIP Minivan/Minibüs</strong></td></tr>
    <tr><td>İş seyahati</td><td><strong>VIP Sedan</strong></td></tr>
    <tr><td>Gece geç saatte varış</td><td><strong>VIP</strong></td></tr>
  </tbody>
</table>

<h2>Sonuç</h2>
<p>Taksi kısa mesafelerde makul bir seçenek. Ancak <strong>aile, grup, iş seyahati ve uzun mesafelerde VIP transfer daha konforlu ve güvenilirdir.</strong></p>',
    'faqs' => [
      ['q'=>"Antalya'da taksiler taksimetre kullanmak zorunda mı?",'a'=>'Evet, tüm taksiler taksimetreyle çalışmak zorundadır. Ancak uzun mesafelerde sürücüyle pazarlık yaygındır.'],
      ['q'=>'VIP transfer daha pahalı mı?','a'=>'Kısa mesafelerde neredeyse aynı fiyat. Uzun mesafelerde VIP 100-300 ₺ daha pahalı olabilir ancak fiyat sabittir.'],
      ['q'=>'Havalimanında resmi olmayan taksi tekliflerine güvenebilir miyim?','a'=>'Hayır. Resmi taksi duraklarını kullanın. VIP rezervasyonunuz varsa şoförünüz isminizin tabelasını taşır.'],
      ['q'=>'Çocuk koltuğu sağlıyor musunuz?','a'=>'Çocuk koltuğu talebini WhatsApp üzerinden önceden iletmeniz gerekir. Uygunluk ve ücret rezervasyon sırasında teyit edilir.']
    ]
  ],
  'en' => [
    'cat' => 'Comparison',
    'title' => "Taxi or VIP Transfer in Antalya? A Practical Comparison",
    'metaTitle' => "Antalya Taxi vs VIP Transfer — 2026 Comparison",
    'metaDesc' => "Differences between taxi and VIP transfer in Antalya: price, comfort, reliability, luggage, language. Which should you choose?",
    'excerpt' => "We compared taxi and VIP transfer in Antalya with real numbers. Price, comfort, reliability — which one fits you?",
    'body' => '<p>One of the most common questions from Antalya visitors: "Should I take a taxi or book VIP transfer?" Both have pros and cons. This guide compares them with real numbers and situations.</p>

<h2>1. Price Comparison</h2>
<p>Taxi prices are per vehicle, not per person. Same with VIP transfer.</p>
<table>
  <thead><tr><th>Route</th><th>Taxi (est.)</th><th>VIP Sedan</th><th>VIP Minivan</th></tr></thead>
  <tbody>
    <tr><td>Airport → Lara</td><td>400–600 ₺</td><td>400 ₺</td><td>520 ₺</td></tr>
    <tr><td>Airport → Kundu</td><td>450–650 ₺</td><td>480 ₺</td><td>620 ₺</td></tr>
    <tr><td>Airport → Belek</td><td>1,200–1,600 ₺</td><td>1,330 ₺</td><td>1,730 ₺</td></tr>
    <tr><td>Airport → Side</td><td>1,900–2,400 ₺</td><td>2,280 ₺</td><td>2,960 ₺</td></tr>
    <tr><td>Airport → Alanya</td><td>3,500–4,500 ₺</td><td>4,050 ₺</td><td>5,270 ₺</td></tr>
  </tbody>
</table>
<p><strong>Verdict:</strong> Nearly identical on short routes. On long routes, taxi can be 100–200 ₺ cheaper — but not guaranteed.</p>

<h2>2. Comfort</h2>
<p>Taxis in Antalya are generally clean, but vehicle age varies widely. VIP transfer vehicles are usually under 3 years old and regularly maintained.</p>

<h2>3. Reliability</h2>
<ul>
  <li><strong>Flight tracking:</strong> VIP driver waits through delays, taxi doesn\'t</li>
  <li><strong>Meet-by-name:</strong> You see your name sign at arrivals</li>
  <li><strong>Price fixed upfront:</strong> No end-of-ride surprises</li>
  <li><strong>Direct to your hotel:</strong> No need to give directions</li>
</ul>

<h2>4. Luggage Capacity</h2>
<table>
  <thead><tr><th>Vehicle</th><th>Passengers</th><th>Luggage</th></tr></thead>
  <tbody>
    <tr><td>Standard taxi</td><td>1–3</td><td>2–3 suitcases</td></tr>
    <tr><td>VIP Sedan</td><td>1–3</td><td>2–3 suitcases</td></tr>
    <tr><td>VIP Minivan</td><td>4–6</td><td>4–6 suitcases</td></tr>
    <tr><td>VIP Minibus</td><td>7–14</td><td>7+ suitcases</td></tr>
  </tbody>
</table>

<h2>5. Language & Communication</h2>
<p>Taxi drivers usually know basic English. Our VIP drivers can serve in English, Russian and German.</p>

<h2>6. Difference for Families with Children</h2>
<ul>
  <li>Taxis usually don\'t have child seats</li>
  <li>VIP transfer can provide child seats <strong>on request</strong> — you must ask in advance on WhatsApp</li>
  <li>For strollers, minivan is far more comfortable</li>
</ul>

<h2>Which to Choose?</h2>
<table>
  <thead><tr><th>Situation</th><th>Recommendation</th></tr></thead>
  <tbody>
    <tr><td>Solo, short distance</td><td>Taxi or VIP</td></tr>
    <tr><td>Couple, medium distance</td><td>VIP Sedan</td></tr>
    <tr><td>Family with kids</td><td><strong>VIP</strong></td></tr>
    <tr><td>Group (4+), long distance</td><td><strong>VIP Minivan/Minibus</strong></td></tr>
    <tr><td>Business trip</td><td><strong>VIP Sedan</strong></td></tr>
    <tr><td>Late-night arrival</td><td><strong>VIP</strong></td></tr>
  </tbody>
</table>

<h2>Conclusion</h2>
<p>Taxis are reasonable on short routes. But for <strong>families, groups, business trips and long distances, VIP transfer is more comfortable and more reliable.</strong></p>',
    'faqs' => [
      ['q'=>'Do Antalya taxis have to use the meter?','a'=>'Yes, all taxis must use meters. However, negotiation is common for long distances.'],
      ['q'=>'Is VIP transfer more expensive?','a'=>'Nearly identical on short routes. On long routes, VIP may be 100–300 ₺ more — but the price is fixed.'],
      ['q'=>'Can I trust unofficial taxi offers at the airport?','a'=>'No. Use official taxi stands. If you have a VIP booking, your driver holds a sign with your name.'],
      ['q'=>'Do you provide child seats?','a'=>'Child seat requests must be made in advance via WhatsApp. Availability and fee are confirmed at booking.']
    ]
  ],
  'de' => [
    'cat' => 'Vergleich',
    'title' => "Taxi oder VIP-Transfer in Antalya? Ein ehrlicher Vergleich",
    'metaTitle' => "Antalya Taxi vs VIP-Transfer — Vergleich 2026",
    'metaDesc' => "Unterschiede zwischen Taxi und VIP-Transfer in Antalya: Preis, Komfort, Zuverlässigkeit, Gepäck, Sprache.",
    'excerpt' => "Wir haben Taxi und VIP-Transfer in Antalya mit echten Zahlen verglichen. Preis, Komfort, Zuverlässigkeit — was passt zu Ihnen?",
    'body' => '<p>Eine der häufigsten Fragen von Antalya-Besuchern: "Taxi nehmen oder VIP-Transfer buchen?" Beide haben Vor- und Nachteile. Dieser Vergleich zeigt echte Zahlen und Situationen.</p>

<h2>1. Preisvergleich</h2>
<p>Taxipreise gelten pro Fahrzeug, nicht pro Person. Dasselbe gilt für VIP-Transfer.</p>
<table>
  <thead><tr><th>Route</th><th>Taxi (ca.)</th><th>VIP Sedan</th><th>VIP Minivan</th></tr></thead>
  <tbody>
    <tr><td>Flughafen → Lara</td><td>400–600 ₺</td><td>400 ₺</td><td>520 ₺</td></tr>
    <tr><td>Flughafen → Kundu</td><td>450–650 ₺</td><td>480 ₺</td><td>620 ₺</td></tr>
    <tr><td>Flughafen → Belek</td><td>1.200–1.600 ₺</td><td>1.330 ₺</td><td>1.730 ₺</td></tr>
    <tr><td>Flughafen → Side</td><td>1.900–2.400 ₺</td><td>2.280 ₺</td><td>2.960 ₺</td></tr>
    <tr><td>Flughafen → Alanya</td><td>3.500–4.500 ₺</td><td>4.050 ₺</td><td>5.270 ₺</td></tr>
  </tbody>
</table>
<p><strong>Fazit:</strong> Auf kurzen Strecken fast identisch. Auf langen Strecken kann das Taxi 100–200 ₺ günstiger sein — aber ohne Garantie.</p>

<h2>2. Komfort</h2>
<p>Antalya-Taxis sind in der Regel sauber, aber das Fahrzeugalter schwankt stark. VIP-Fahrzeuge sind meist unter 3 Jahre alt.</p>

<h2>3. Zuverlässigkeit</h2>
<ul>
  <li><strong>Flugverfolgung:</strong> VIP-Fahrer wartet bei Verspätung, Taxi nicht</li>
  <li><strong>Empfang mit Namen:</strong> Sie sehen Ihr Namensschild in der Ankunftshalle</li>
  <li><strong>Festpreis von Anfang an:</strong> Keine Überraschungen am Ziel</li>
  <li><strong>Direkt zum Hotel:</strong> Keine Wegbeschreibung nötig</li>
</ul>

<h2>4. Gepäckkapazität</h2>
<table>
  <thead><tr><th>Fahrzeug</th><th>Passagiere</th><th>Gepäck</th></tr></thead>
  <tbody>
    <tr><td>Standard-Taxi</td><td>1–3</td><td>2–3 Koffer</td></tr>
    <tr><td>VIP Sedan</td><td>1–3</td><td>2–3 Koffer</td></tr>
    <tr><td>VIP Minivan</td><td>4–6</td><td>4–6 Koffer</td></tr>
    <tr><td>VIP Minibus</td><td>7–14</td><td>7+ Koffer</td></tr>
  </tbody>
</table>

<h2>5. Sprache & Kommunikation</h2>
<p>Taxifahrer sprechen meist Basis-Englisch. Unsere VIP-Fahrer sprechen Englisch, Russisch und Deutsch.</p>

<h2>6. Unterschied für Familien mit Kindern</h2>
<ul>
  <li>Taxis haben meist keine Kindersitze</li>
  <li>VIP-Transfer kann Kindersitze <strong>auf Anfrage</strong> bereitstellen — Anfrage vorab per WhatsApp</li>
  <li>Für Kinderwagen ist ein Minivan deutlich bequemer</li>
</ul>

<h2>Welche Wahl?</h2>
<table>
  <thead><tr><th>Situation</th><th>Empfehlung</th></tr></thead>
  <tbody>
    <tr><td>Allein, kurze Strecke</td><td>Taxi oder VIP</td></tr>
    <tr><td>Paar, mittlere Strecke</td><td>VIP Sedan</td></tr>
    <tr><td>Familie mit Kindern</td><td><strong>VIP</strong></td></tr>
    <tr><td>Gruppe (4+), lange Strecke</td><td><strong>VIP Minivan/Minibus</strong></td></tr>
    <tr><td>Geschäftsreise</td><td><strong>VIP Sedan</strong></td></tr>
    <tr><td>Späte Ankunft</td><td><strong>VIP</strong></td></tr>
  </tbody>
</table>

<h2>Fazit</h2>
<p>Taxis sind auf kurzen Strecken ok. Aber für <strong>Familien, Gruppen, Geschäftsreisen und lange Strecken ist VIP-Transfer komfortabler und zuverlässiger.</strong></p>',
    'faqs' => [
      ['q'=>'Müssen Antalya-Taxis das Taxameter verwenden?','a'=>'Ja, alle Taxis müssen das Taxameter nutzen. Bei längeren Strecken ist Verhandeln aber üblich.'],
      ['q'=>'Ist VIP-Transfer teurer?','a'=>'Auf kurzen Strecken fast identisch. Auf langen Strecken kann VIP 100–300 ₺ mehr kosten — aber der Preis ist fest.'],
      ['q'=>'Kann ich den inoffiziellen Taxi-Angeboten am Flughafen vertrauen?','a'=>'Nein. Nutzen Sie offizielle Taxistände. Bei VIP-Buchung hält der Fahrer ein Schild mit Ihrem Namen.'],
      ['q'=>'Bieten Sie Kindersitze an?','a'=>'Kindersitz-Anfragen müssen vorab per WhatsApp gestellt werden. Verfügbarkeit und Preis werden bei der Buchung bestätigt.']
    ]
  ],
  'ru' => [
    'cat' => 'Сравнение',
    'title' => "Такси или VIP-трансфер в Анталии? Практическое сравнение",
    'metaTitle' => "Анталия: такси или VIP-трансфер — сравнение 2026",
    'metaDesc' => "Различия между такси и VIP-трансфером в Анталии: цена, комфорт, надёжность, багаж, язык. Что выбрать?",
    'excerpt' => "Мы сравнили такси и VIP-трансфер в Анталии с реальными цифрами. Цена, комфорт, надёжность — что подойдёт вам?",
    'body' => '<p>Один из самых частых вопросов от туристов в Анталии: "Взять такси или забронировать VIP-трансфер?" У обоих есть плюсы и минусы.</p>

<h2>1. Сравнение цен</h2>
<p>Цена такси — за машину, не за человека. То же самое в VIP-трансфере.</p>
<table>
  <thead><tr><th>Маршрут</th><th>Такси (оц.)</th><th>VIP Sedan</th><th>VIP Minivan</th></tr></thead>
  <tbody>
    <tr><td>Аэропорт → Лара</td><td>400–600 ₺</td><td>400 ₺</td><td>520 ₺</td></tr>
    <tr><td>Аэропорт → Кунду</td><td>450–650 ₺</td><td>480 ₺</td><td>620 ₺</td></tr>
    <tr><td>Аэропорт → Белек</td><td>1.200–1.600 ₺</td><td>1.330 ₺</td><td>1.730 ₺</td></tr>
    <tr><td>Аэропорт → Сиде</td><td>1.900–2.400 ₺</td><td>2.280 ₺</td><td>2.960 ₺</td></tr>
    <tr><td>Аэропорт → Аланья</td><td>3.500–4.500 ₺</td><td>4.050 ₺</td><td>5.270 ₺</td></tr>
  </tbody>
</table>
<p><strong>Вывод:</strong> На коротких дистанциях почти одинаково. На длинных такси может быть дешевле на 100–200 ₺, но без гарантии.</p>

<h2>2. Комфорт</h2>
<p>Такси в Анталии обычно чистые, но возраст машин сильно разнится. Автомобили VIP-трансфера обычно не старше 3 лет.</p>

<h2>3. Надёжность</h2>
<ul>
  <li><strong>Отслеживание рейса:</strong> VIP-водитель ждёт при задержке, такси — нет</li>
  <li><strong>Встреча по имени:</strong> Вы видите табличку с вашим именем</li>
  <li><strong>Фиксированная цена сразу:</strong> Без сюрпризов в конце</li>
  <li><strong>Прямо до отеля:</strong> Не нужно объяснять дорогу</li>
</ul>

<h2>4. Вместимость багажа</h2>
<table>
  <thead><tr><th>Автомобиль</th><th>Пассажиры</th><th>Багаж</th></tr></thead>
  <tbody>
    <tr><td>Стандартное такси</td><td>1–3</td><td>2–3 чемодана</td></tr>
    <tr><td>VIP Sedan</td><td>1–3</td><td>2–3 чемодана</td></tr>
    <tr><td>VIP Minivan</td><td>4–6</td><td>4–6 чемоданов</td></tr>
    <tr><td>VIP Minibus</td><td>7–14</td><td>7+ чемоданов</td></tr>
  </tbody>
</table>

<h2>5. Язык и общение</h2>
<p>Водители такси обычно знают базовый английский. Наши VIP-водители говорят на английском, русском и немецком.</p>

<h2>6. Разница для семей с детьми</h2>
<ul>
  <li>В такси обычно нет детских кресел</li>
  <li>В VIP-трансфере детское кресло <strong>можно предоставить по запросу</strong> — спросить заранее в WhatsApp</li>
  <li>С коляской однозначно удобнее в минивэне</li>
</ul>

<h2>Что выбрать?</h2>
<table>
  <thead><tr><th>Ситуация</th><th>Рекомендация</th></tr></thead>
  <tbody>
    <tr><td>Один, короткая дистанция</td><td>Такси или VIP</td></tr>
    <tr><td>Пара, средняя дистанция</td><td>VIP Sedan</td></tr>
    <tr><td>Семья с детьми</td><td><strong>VIP</strong></td></tr>
    <tr><td>Группа (4+), длинная дистанция</td><td><strong>VIP Minivan/Minibus</strong></td></tr>
    <tr><td>Деловая поездка</td><td><strong>VIP Sedan</strong></td></tr>
    <tr><td>Поздняя ночь</td><td><strong>VIP</strong></td></tr>
  </tbody>
</table>

<h2>Итог</h2>
<p>Такси разумно на коротких маршрутах. Но для <strong>семей, групп, деловых поездок и дальних дистанций VIP-трансфер комфортнее и надёжнее.</strong></p>',
    'faqs' => [
      ['q'=>'Должны ли такси в Анталии использовать счётчик?','a'=>'Да, все такси обязаны использовать счётчик. Но на длинных дистанциях торговля распространена.'],
      ['q'=>'VIP-трансфер дороже?','a'=>'На коротких маршрутах почти одинаково. На длинных VIP может быть дороже на 100–300 ₺ — но цена фиксированная.'],
      ['q'=>'Можно ли доверять неофициальным предложениям такси в аэропорту?','a'=>'Нет. Используйте официальные стоянки. При брони VIP водитель держит табличку с вашим именем.'],
      ['q'=>'Предоставляете ли вы детские кресла?','a'=>'Запрос на детское кресло нужно отправить заранее в WhatsApp. Наличие и стоимость подтверждаются при бронировании.']
    ]
  ]
];

/* ==================== POST 3 ==================== */
$posts['antalya-havalimani-transfer-fiyatlari-2026'] = [
  'date' => '2026-01-25',
  'tr' => [
    'cat' => 'Fiyat Rehberi',
    'title' => "Antalya Havalimanı Transfer Fiyatları 2026 — Tam Liste",
    'metaTitle' => "Antalya Havalimanı Transfer Fiyatları 2026 | Tüm Bölgeler",
    'metaDesc' => "Antalya Havalimanı'ndan tüm bölgelere 2026 güncel transfer fiyatları. Lara, Kundu, Belek, Kemer, Side, Alanya ve 18 bölge daha.",
    'excerpt' => "Antalya Havalimanı'ndan tüm tatil bölgelerine 2026 yılı güncel transfer fiyatları. 24 bölge, 3 araç tipi, tam liste.",
    'body' => '<p>Antalya Havalimanı\'ndan otelinize transfer fiyatı, mesafeye göre değişir. 2026 yılı için tüm güzergâhların güncel fiyatları aşağıda listelenmiştir. Fiyatlarımız <strong>sabittir</strong> — trafik, gecikme veya kısa güzergâh değişiklikleri fiyatı etkilemez.</p>

<h2>Fiyatlandırma Sistemi</h2>
<table>
  <thead><tr><th>Mesafe</th><th>Kilometre Başı</th></tr></thead>
  <tbody>
    <tr><td>0–25 km</td><td>40 ₺/km</td></tr>
    <tr><td>25–50 km</td><td>38 ₺/km</td></tr>
    <tr><td>50–75 km</td><td>35 ₺/km</td></tr>
    <tr><td>75–100 km</td><td>33 ₺/km</td></tr>
    <tr><td>100 km ve üzeri</td><td>30 ₺/km</td></tr>
  </tbody>
</table>

<h2>Araç Tipleri</h2>
<table>
  <thead><tr><th>Araç</th><th>Yolcu</th><th>Bagaj</th></tr></thead>
  <tbody>
    <tr><td>Sedan VIP</td><td>1–3</td><td>2–3 valiz</td></tr>
    <tr><td>Minivan</td><td>4–6</td><td>4–6 valiz</td></tr>
    <tr><td>VIP Minibüs</td><td>7–14</td><td>7+ valiz</td></tr>
  </tbody>
</table>

<h2>Kısa Mesafe (0–25 km)</h2>
<table>
  <thead><tr><th>Bölge</th><th>Mesafe</th><th>Sedan</th><th>Minivan</th><th>Minibüs</th></tr></thead>
  <tbody>
    <tr><td>Lara</td><td>10 km</td><td>400 ₺</td><td>520 ₺</td><td>720 ₺</td></tr>
    <tr><td>Kundu</td><td>12 km</td><td>480 ₺</td><td>620 ₺</td><td>860 ₺</td></tr>
    <tr><td>Muratpaşa</td><td>13 km</td><td>520 ₺</td><td>680 ₺</td><td>940 ₺</td></tr>
    <tr><td>Kaleiçi</td><td>14 km</td><td>560 ₺</td><td>730 ₺</td><td>1.010 ₺</td></tr>
    <tr><td>Kepez</td><td>14 km</td><td>560 ₺</td><td>730 ₺</td><td>1.010 ₺</td></tr>
    <tr><td>Konyaaltı</td><td>18 km</td><td>720 ₺</td><td>940 ₺</td><td>1.300 ₺</td></tr>
    <tr><td>Aksu</td><td>20 km</td><td>800 ₺</td><td>1.040 ₺</td><td>1.440 ₺</td></tr>
  </tbody>
</table>

<h2>Orta Mesafe (25–75 km)</h2>
<table>
  <thead><tr><th>Bölge</th><th>Mesafe</th><th>Sedan</th><th>Minivan</th><th>Minibüs</th></tr></thead>
  <tbody>
    <tr><td>Döşemealtı</td><td>25 km</td><td>1.000 ₺</td><td>1.300 ₺</td><td>1.800 ₺</td></tr>
    <tr><td>Belconti</td><td>30 km</td><td>1.140 ₺</td><td>1.480 ₺</td><td>2.050 ₺</td></tr>
    <tr><td>Beldibi</td><td>30 km</td><td>1.140 ₺</td><td>1.480 ₺</td><td>2.050 ₺</td></tr>
    <tr><td>Belek</td><td>35 km</td><td>1.330 ₺</td><td>1.730 ₺</td><td>2.390 ₺</td></tr>
    <tr><td>Göynük</td><td>35 km</td><td>1.330 ₺</td><td>1.730 ₺</td><td>2.390 ₺</td></tr>
    <tr><td>Serik</td><td>40 km</td><td>1.520 ₺</td><td>1.980 ₺</td><td>2.740 ₺</td></tr>
    <tr><td>Kemer</td><td>45 km</td><td>1.710 ₺</td><td>2.220 ₺</td><td>3.080 ₺</td></tr>
    <tr><td>Side</td><td>65 km</td><td>2.280 ₺</td><td>2.960 ₺</td><td>4.100 ₺</td></tr>
  </tbody>
</table>

<h2>Uzun Mesafe (75 km+)</h2>
<table>
  <thead><tr><th>Bölge</th><th>Mesafe</th><th>Sedan</th><th>Minivan</th><th>Minibüs</th></tr></thead>
  <tbody>
    <tr><td>Manavgat</td><td>75 km</td><td>2.630 ₺</td><td>3.420 ₺</td><td>4.730 ₺</td></tr>
    <tr><td>Kızılağaç</td><td>75 km</td><td>2.630 ₺</td><td>3.420 ₺</td><td>4.730 ₺</td></tr>
    <tr><td>Titreyengöl</td><td>75 km</td><td>2.630 ₺</td><td>3.420 ₺</td><td>4.730 ₺</td></tr>
    <tr><td>Okurcalar</td><td>90 km</td><td>2.970 ₺</td><td>3.860 ₺</td><td>5.350 ₺</td></tr>
    <tr><td>Avsallar</td><td>100 km</td><td>3.300 ₺</td><td>4.290 ₺</td><td>5.940 ₺</td></tr>
    <tr><td>Konaklı</td><td>105 km</td><td>3.470 ₺</td><td>4.510 ₺</td><td>6.240 ₺</td></tr>
    <tr><td>Alanya</td><td>135 km</td><td>4.050 ₺</td><td>5.270 ₺</td><td>7.290 ₺</td></tr>
    <tr><td>Mahmutlar</td><td>135 km</td><td>4.050 ₺</td><td>5.270 ₺</td><td>7.290 ₺</td></tr>
    <tr><td>Gazipaşa</td><td>185 km</td><td>5.550 ₺</td><td>7.220 ₺</td><td>9.990 ₺</td></tr>
  </tbody>
</table>

<h2>Fiyata Neler Dahil?</h2>
<ul>
  <li>KDV dahil</li>
  <li>Bagaj ücreti yok</li>
  <li>Bekleme süresi ücretsiz</li>
  <li>Havalimanı otopark ücreti dahil</li>
  <li>Otel lobisine kadar bırakma dahil</li>
</ul>

<h2>Ek Hizmetler (Talep Üzerine)</h2>
<ul>
  <li><strong>Çocuk koltuğu:</strong> Uygunluk ve ücret WhatsApp üzerinden teyit edilir</li>
  <li>Ekstra durak / ara nokta</li>
  <li>Bebek arabası taşıma</li>
</ul>

<h2>Ödeme</h2>
<p>Araç içinde <strong>sadece nakit</strong> (₺, USD, EUR). Kredi kartı kabul edilmez.</p>',
    'faqs' => [
      ['q'=>'Antalya Havalimanı transfer fiyatları sabit mi?','a'=>'Evet. Rezervasyon sırasında onaylanan fiyat sabittir.'],
      ['q'=>'Fiyatlara KDV dahil mi?','a'=>'Evet, tüm fiyatlara KDV dahildir.'],
      ['q'=>'Bagaj için ek ücret var mı?','a'=>'Hayır. Makul sınırda bagaj için ek ücret alınmaz.'],
      ['q'=>'Kredi kartı kabul ediliyor mu?','a'=>'Hayır, ödeme sadece nakit olarak yapılır.'],
      ['q'=>'Çocuk koltuğu ek ücretli mi?','a'=>'Çocuk koltuğu ek hizmet olup standart fiyata dahil değildir. Uygunluk ve ücreti WhatsApp üzerinden önceden sormanız gerekir.']
    ]
  ],
  'en' => [
    'cat' => 'Price Guide',
    'title' => "Antalya Airport Transfer Prices 2026 — Full List",
    'metaTitle' => "Antalya Airport Transfer Prices 2026 | All Destinations",
    'metaDesc' => "2026 Antalya Airport transfer prices to all destinations. Lara, Kundu, Belek, Kemer, Side, Alanya and 18 more.",
    'excerpt' => "2026 transfer prices from Antalya Airport to all resort areas. 24 destinations, 3 vehicle types, full list.",
    'body' => '<p>Transfer prices from Antalya Airport depend on distance. All 2026 rates are listed below. Our prices are <strong>fixed</strong> — traffic, delays or minor route changes don\'t affect the price.</p>

<h2>Pricing System</h2>
<table>
  <thead><tr><th>Distance</th><th>Per km</th></tr></thead>
  <tbody>
    <tr><td>0–25 km</td><td>40 ₺/km</td></tr>
    <tr><td>25–50 km</td><td>38 ₺/km</td></tr>
    <tr><td>50–75 km</td><td>35 ₺/km</td></tr>
    <tr><td>75–100 km</td><td>33 ₺/km</td></tr>
    <tr><td>100 km and above</td><td>30 ₺/km</td></tr>
  </tbody>
</table>

<h2>Vehicle Types</h2>
<table>
  <thead><tr><th>Vehicle</th><th>Passengers</th><th>Luggage</th></tr></thead>
  <tbody>
    <tr><td>Sedan VIP</td><td>1–3</td><td>2–3 suitcases</td></tr>
    <tr><td>Minivan</td><td>4–6</td><td>4–6 suitcases</td></tr>
    <tr><td>VIP Minibus</td><td>7–14</td><td>7+ suitcases</td></tr>
  </tbody>
</table>

<h2>Short Distance (0–25 km)</h2>
<table>
  <thead><tr><th>Area</th><th>Distance</th><th>Sedan</th><th>Minivan</th><th>Minibus</th></tr></thead>
  <tbody>
    <tr><td>Lara</td><td>10 km</td><td>400 ₺</td><td>520 ₺</td><td>720 ₺</td></tr>
    <tr><td>Kundu</td><td>12 km</td><td>480 ₺</td><td>620 ₺</td><td>860 ₺</td></tr>
    <tr><td>Muratpaşa</td><td>13 km</td><td>520 ₺</td><td>680 ₺</td><td>940 ₺</td></tr>
    <tr><td>Kaleiçi</td><td>14 km</td><td>560 ₺</td><td>730 ₺</td><td>1,010 ₺</td></tr>
    <tr><td>Kepez</td><td>14 km</td><td>560 ₺</td><td>730 ₺</td><td>1,010 ₺</td></tr>
    <tr><td>Konyaaltı</td><td>18 km</td><td>720 ₺</td><td>940 ₺</td><td>1,300 ₺</td></tr>
    <tr><td>Aksu</td><td>20 km</td><td>800 ₺</td><td>1,040 ₺</td><td>1,440 ₺</td></tr>
  </tbody>
</table>

<h2>Medium Distance (25–75 km)</h2>
<table>
  <thead><tr><th>Area</th><th>Distance</th><th>Sedan</th><th>Minivan</th><th>Minibus</th></tr></thead>
  <tbody>
    <tr><td>Döşemealtı</td><td>25 km</td><td>1,000 ₺</td><td>1,300 ₺</td><td>1,800 ₺</td></tr>
    <tr><td>Belconti</td><td>30 km</td><td>1,140 ₺</td><td>1,480 ₺</td><td>2,050 ₺</td></tr>
    <tr><td>Beldibi</td><td>30 km</td><td>1,140 ₺</td><td>1,480 ₺</td><td>2,050 ₺</td></tr>
    <tr><td>Belek</td><td>35 km</td><td>1,330 ₺</td><td>1,730 ₺</td><td>2,390 ₺</td></tr>
    <tr><td>Göynük</td><td>35 km</td><td>1,330 ₺</td><td>1,730 ₺</td><td>2,390 ₺</td></tr>
    <tr><td>Serik</td><td>40 km</td><td>1,520 ₺</td><td>1,980 ₺</td><td>2,740 ₺</td></tr>
    <tr><td>Kemer</td><td>45 km</td><td>1,710 ₺</td><td>2,220 ₺</td><td>3,080 ₺</td></tr>
    <tr><td>Side</td><td>65 km</td><td>2,280 ₺</td><td>2,960 ₺</td><td>4,100 ₺</td></tr>
  </tbody>
</table>

<h2>Long Distance (75 km+)</h2>
<table>
  <thead><tr><th>Area</th><th>Distance</th><th>Sedan</th><th>Minivan</th><th>Minibus</th></tr></thead>
  <tbody>
    <tr><td>Manavgat</td><td>75 km</td><td>2,630 ₺</td><td>3,420 ₺</td><td>4,730 ₺</td></tr>
    <tr><td>Kızılağaç</td><td>75 km</td><td>2,630 ₺</td><td>3,420 ₺</td><td>4,730 ₺</td></tr>
    <tr><td>Titreyengöl</td><td>75 km</td><td>2,630 ₺</td><td>3,420 ₺</td><td>4,730 ₺</td></tr>
    <tr><td>Okurcalar</td><td>90 km</td><td>2,970 ₺</td><td>3,860 ₺</td><td>5,350 ₺</td></tr>
    <tr><td>Avsallar</td><td>100 km</td><td>3,300 ₺</td><td>4,290 ₺</td><td>5,940 ₺</td></tr>
    <tr><td>Konaklı</td><td>105 km</td><td>3,470 ₺</td><td>4,510 ₺</td><td>6,240 ₺</td></tr>
    <tr><td>Alanya</td><td>135 km</td><td>4,050 ₺</td><td>5,270 ₺</td><td>7,290 ₺</td></tr>
    <tr><td>Mahmutlar</td><td>135 km</td><td>4,050 ₺</td><td>5,270 ₺</td><td>7,290 ₺</td></tr>
    <tr><td>Gazipaşa</td><td>185 km</td><td>5,550 ₺</td><td>7,220 ₺</td><td>9,990 ₺</td></tr>
  </tbody>
</table>

<h2>What\'s Included</h2>
<ul>
  <li>VAT included</li>
  <li>No luggage fee</li>
  <li>Waiting time free (flight delays)</li>
  <li>Airport parking fee included</li>
  <li>Drop-off at your hotel lobby</li>
</ul>

<h2>Extra Services (On Request)</h2>
<ul>
  <li><strong>Child seat:</strong> Availability and fee confirmed via WhatsApp</li>
  <li>Extra stop / mid-point</li>
  <li>Stroller transport</li>
</ul>

<h2>Payment</h2>
<p><strong>Cash only</strong> inside the vehicle (₺, USD, EUR). Credit cards not accepted.</p>',
    'faqs' => [
      ['q'=>'Are Antalya Airport transfer prices fixed?','a'=>'Yes. The price confirmed at booking is fixed.'],
      ['q'=>'Is VAT included?','a'=>'Yes, all prices include VAT.'],
      ['q'=>'Is there a fee for luggage?','a'=>'No. Reasonable luggage is included at no charge.'],
      ['q'=>'Do you accept credit cards?','a'=>'No, payment is cash only.'],
      ['q'=>'Is the child seat extra?','a'=>'Child seat is a separate service not included in standard pricing. Availability and fee must be confirmed via WhatsApp in advance.']
    ]
  ],
  'de' => [
    'cat' => 'Preisratgeber',
    'title' => "Flughafen Antalya Transferpreise 2026 — Vollständige Liste",
    'metaTitle' => "Flughafen Antalya Transferpreise 2026 | Alle Ziele",
    'metaDesc' => "Aktuelle Transferpreise vom Flughafen Antalya 2026 zu allen Zielen. Lara, Kundu, Belek, Kemer, Side, Alanya und 18 weitere.",
    'excerpt' => "Aktuelle Transferpreise 2026 vom Flughafen Antalya zu allen Urlaubsgebieten. 24 Ziele, 3 Fahrzeugtypen.",
    'body' => '<p>Die Transferpreise vom Flughafen Antalya hängen von der Entfernung ab. Alle Preise für 2026 finden Sie hier. Unsere Preise sind <strong>fest</strong> — Verkehr, Verspätungen oder kleinere Routenänderungen ändern nichts.</p>

<h2>Preissystem</h2>
<table>
  <thead><tr><th>Entfernung</th><th>Pro km</th></tr></thead>
  <tbody>
    <tr><td>0–25 km</td><td>40 ₺/km</td></tr>
    <tr><td>25–50 km</td><td>38 ₺/km</td></tr>
    <tr><td>50–75 km</td><td>35 ₺/km</td></tr>
    <tr><td>75–100 km</td><td>33 ₺/km</td></tr>
    <tr><td>100 km und mehr</td><td>30 ₺/km</td></tr>
  </tbody>
</table>

<h2>Fahrzeugtypen</h2>
<table>
  <thead><tr><th>Fahrzeug</th><th>Passagiere</th><th>Gepäck</th></tr></thead>
  <tbody>
    <tr><td>Sedan VIP</td><td>1–3</td><td>2–3 Koffer</td></tr>
    <tr><td>Minivan</td><td>4–6</td><td>4–6 Koffer</td></tr>
    <tr><td>VIP Minibus</td><td>7–14</td><td>7+ Koffer</td></tr>
  </tbody>
</table>

<h2>Kurze Strecke (0–25 km)</h2>
<table>
  <thead><tr><th>Gebiet</th><th>Entfernung</th><th>Sedan</th><th>Minivan</th><th>Minibus</th></tr></thead>
  <tbody>
    <tr><td>Lara</td><td>10 km</td><td>400 ₺</td><td>520 ₺</td><td>720 ₺</td></tr>
    <tr><td>Kundu</td><td>12 km</td><td>480 ₺</td><td>620 ₺</td><td>860 ₺</td></tr>
    <tr><td>Muratpaşa</td><td>13 km</td><td>520 ₺</td><td>680 ₺</td><td>940 ₺</td></tr>
    <tr><td>Kaleiçi</td><td>14 km</td><td>560 ₺</td><td>730 ₺</td><td>1.010 ₺</td></tr>
    <tr><td>Kepez</td><td>14 km</td><td>560 ₺</td><td>730 ₺</td><td>1.010 ₺</td></tr>
    <tr><td>Konyaaltı</td><td>18 km</td><td>720 ₺</td><td>940 ₺</td><td>1.300 ₺</td></tr>
    <tr><td>Aksu</td><td>20 km</td><td>800 ₺</td><td>1.040 ₺</td><td>1.440 ₺</td></tr>
  </tbody>
</table>

<h2>Mittlere Strecke (25–75 km)</h2>
<table>
  <thead><tr><th>Gebiet</th><th>Entfernung</th><th>Sedan</th><th>Minivan</th><th>Minibus</th></tr></thead>
  <tbody>
    <tr><td>Döşemealtı</td><td>25 km</td><td>1.000 ₺</td><td>1.300 ₺</td><td>1.800 ₺</td></tr>
    <tr><td>Belconti</td><td>30 km</td><td>1.140 ₺</td><td>1.480 ₺</td><td>2.050 ₺</td></tr>
    <tr><td>Beldibi</td><td>30 km</td><td>1.140 ₺</td><td>1.480 ₺</td><td>2.050 ₺</td></tr>
    <tr><td>Belek</td><td>35 km</td><td>1.330 ₺</td><td>1.730 ₺</td><td>2.390 ₺</td></tr>
    <tr><td>Göynük</td><td>35 km</td><td>1.330 ₺</td><td>1.730 ₺</td><td>2.390 ₺</td></tr>
    <tr><td>Serik</td><td>40 km</td><td>1.520 ₺</td><td>1.980 ₺</td><td>2.740 ₺</td></tr>
    <tr><td>Kemer</td><td>45 km</td><td>1.710 ₺</td><td>2.220 ₺</td><td>3.080 ₺</td></tr>
    <tr><td>Side</td><td>65 km</td><td>2.280 ₺</td><td>2.960 ₺</td><td>4.100 ₺</td></tr>
  </tbody>
</table>

<h2>Lange Strecke (75 km+)</h2>
<table>
  <thead><tr><th>Gebiet</th><th>Entfernung</th><th>Sedan</th><th>Minivan</th><th>Minibus</th></tr></thead>
  <tbody>
    <tr><td>Manavgat</td><td>75 km</td><td>2.630 ₺</td><td>3.420 ₺</td><td>4.730 ₺</td></tr>
    <tr><td>Kızılağaç</td><td>75 km</td><td>2.630 ₺</td><td>3.420 ₺</td><td>4.730 ₺</td></tr>
    <tr><td>Titreyengöl</td><td>75 km</td><td>2.630 ₺</td><td>3.420 ₺</td><td>4.730 ₺</td></tr>
    <tr><td>Okurcalar</td><td>90 km</td><td>2.970 ₺</td><td>3.860 ₺</td><td>5.350 ₺</td></tr>
    <tr><td>Avsallar</td><td>100 km</td><td>3.300 ₺</td><td>4.290 ₺</td><td>5.940 ₺</td></tr>
    <tr><td>Konaklı</td><td>105 km</td><td>3.470 ₺</td><td>4.510 ₺</td><td>6.240 ₺</td></tr>
    <tr><td>Alanya</td><td>135 km</td><td>4.050 ₺</td><td>5.270 ₺</td><td>7.290 ₺</td></tr>
    <tr><td>Mahmutlar</td><td>135 km</td><td>4.050 ₺</td><td>5.270 ₺</td><td>7.290 ₺</td></tr>
    <tr><td>Gazipaşa</td><td>185 km</td><td>5.550 ₺</td><td>7.220 ₺</td><td>9.990 ₺</td></tr>
  </tbody>
</table>

<h2>Inklusive</h2>
<ul>
  <li>MwSt. inklusive</li>
  <li>Keine Gepäckgebühr</li>
  <li>Wartezeit kostenlos</li>
  <li>Flughafenparkgebühr inklusive</li>
  <li>Bis zur Hotellobby</li>
</ul>

<h2>Zusatzleistungen (auf Anfrage)</h2>
<ul>
  <li><strong>Kindersitz:</strong> Verfügbarkeit und Preis per WhatsApp bestätigt</li>
  <li>Zusätzlicher Stopp</li>
  <li>Kinderwagen-Transport</li>
</ul>

<h2>Zahlung</h2>
<p><strong>Nur Barzahlung</strong> im Fahrzeug (₺, USD, EUR).</p>',
    'faqs' => [
      ['q'=>'Sind die Flughafentransfer-Preise in Antalya fest?','a'=>'Ja. Der bei der Buchung bestätigte Preis ist fest.'],
      ['q'=>'Ist die MwSt. inbegriffen?','a'=>'Ja, alle Preise enthalten die MwSt.'],
      ['q'=>'Fällt eine Gepäckgebühr an?','a'=>'Nein. Angemessenes Gepäck ist kostenlos.'],
      ['q'=>'Akzeptieren Sie Kreditkarten?','a'=>'Nein, nur Barzahlung.'],
      ['q'=>'Kostet der Kindersitz extra?','a'=>'Der Kindersitz ist eine separate Leistung, nicht im Standardpreis enthalten. Verfügbarkeit und Preis müssen vorab per WhatsApp bestätigt werden.']
    ]
  ],
  'ru' => [
    'cat' => 'Гид по ценам',
    'title' => "Цены на трансфер из аэропорта Анталии 2026 — полный список",
    'metaTitle' => "Цены на трансфер из аэропорта Анталии 2026",
    'metaDesc' => "Актуальные цены на трансфер из аэропорта Анталии 2026 по всем направлениям. Лара, Кунду, Белек, Кемер, Сиде, Аланья и ещё 18.",
    'excerpt' => "Актуальные цены трансфера 2026 из аэропорта Анталии во все курортные районы. 24 направления, 3 типа авто.",
    'body' => '<p>Цены на трансфер из аэропорта Анталии зависят от расстояния. Все тарифы на 2026 год ниже. Наши цены <strong>фиксированы</strong> — пробки, задержки и небольшие изменения маршрута их не меняют.</p>

<h2>Система ценообразования</h2>
<table>
  <thead><tr><th>Расстояние</th><th>За км</th></tr></thead>
  <tbody>
    <tr><td>0–25 км</td><td>40 ₺/км</td></tr>
    <tr><td>25–50 км</td><td>38 ₺/км</td></tr>
    <tr><td>50–75 км</td><td>35 ₺/км</td></tr>
    <tr><td>75–100 км</td><td>33 ₺/км</td></tr>
    <tr><td>100 км и выше</td><td>30 ₺/км</td></tr>
  </tbody>
</table>

<h2>Типы автомобилей</h2>
<table>
  <thead><tr><th>Автомобиль</th><th>Пассажиры</th><th>Багаж</th></tr></thead>
  <tbody>
    <tr><td>Sedan VIP</td><td>1–3</td><td>2–3 чемодана</td></tr>
    <tr><td>Minivan</td><td>4–6</td><td>4–6 чемоданов</td></tr>
    <tr><td>VIP Minibus</td><td>7–14</td><td>7+ чемоданов</td></tr>
  </tbody>
</table>

<h2>Короткие дистанции (0–25 км)</h2>
<table>
  <thead><tr><th>Район</th><th>Расстояние</th><th>Sedan</th><th>Minivan</th><th>Minibus</th></tr></thead>
  <tbody>
    <tr><td>Лара</td><td>10 км</td><td>400 ₺</td><td>520 ₺</td><td>720 ₺</td></tr>
    <tr><td>Кунду</td><td>12 км</td><td>480 ₺</td><td>620 ₺</td><td>860 ₺</td></tr>
    <tr><td>Муратпаша</td><td>13 км</td><td>520 ₺</td><td>680 ₺</td><td>940 ₺</td></tr>
    <tr><td>Калеичи</td><td>14 км</td><td>560 ₺</td><td>730 ₺</td><td>1.010 ₺</td></tr>
    <tr><td>Кепез</td><td>14 км</td><td>560 ₺</td><td>730 ₺</td><td>1.010 ₺</td></tr>
    <tr><td>Коньяалты</td><td>18 км</td><td>720 ₺</td><td>940 ₺</td><td>1.300 ₺</td></tr>
    <tr><td>Аксу</td><td>20 км</td><td>800 ₺</td><td>1.040 ₺</td><td>1.440 ₺</td></tr>
  </tbody>
</table>

<h2>Средние дистанции (25–75 км)</h2>
<table>
  <thead><tr><th>Район</th><th>Расстояние</th><th>Sedan</th><th>Minivan</th><th>Minibus</th></tr></thead>
  <tbody>
    <tr><td>Дёшемеалты</td><td>25 км</td><td>1.000 ₺</td><td>1.300 ₺</td><td>1.800 ₺</td></tr>
    <tr><td>Бельконти</td><td>30 км</td><td>1.140 ₺</td><td>1.480 ₺</td><td>2.050 ₺</td></tr>
    <tr><td>Бельдиби</td><td>30 км</td><td>1.140 ₺</td><td>1.480 ₺</td><td>2.050 ₺</td></tr>
    <tr><td>Белек</td><td>35 км</td><td>1.330 ₺</td><td>1.730 ₺</td><td>2.390 ₺</td></tr>
    <tr><td>Гёйнюк</td><td>35 км</td><td>1.330 ₺</td><td>1.730 ₺</td><td>2.390 ₺</td></tr>
    <tr><td>Серик</td><td>40 км</td><td>1.520 ₺</td><td>1.980 ₺</td><td>2.740 ₺</td></tr>
    <tr><td>Кемер</td><td>45 км</td><td>1.710 ₺</td><td>2.220 ₺</td><td>3.080 ₺</td></tr>
    <tr><td>Сиде</td><td>65 км</td><td>2.280 ₺</td><td>2.960 ₺</td><td>4.100 ₺</td></tr>
  </tbody>
</table>

<h2>Длинные дистанции (75 км+)</h2>
<table>
  <thead><tr><th>Район</th><th>Расстояние</th><th>Sedan</th><th>Minivan</th><th>Minibus</th></tr></thead>
  <tbody>
    <tr><td>Манавгат</td><td>75 км</td><td>2.630 ₺</td><td>3.420 ₺</td><td>4.730 ₺</td></tr>
    <tr><td>Кызылагач</td><td>75 км</td><td>2.630 ₺</td><td>3.420 ₺</td><td>4.730 ₺</td></tr>
    <tr><td>Титреенгёль</td><td>75 км</td><td>2.630 ₺</td><td>3.420 ₺</td><td>4.730 ₺</td></tr>
    <tr><td>Окурджалар</td><td>90 км</td><td>2.970 ₺</td><td>3.860 ₺</td><td>5.350 ₺</td></tr>
    <tr><td>Авсаллар</td><td>100 км</td><td>3.300 ₺</td><td>4.290 ₺</td><td>5.940 ₺</td></tr>
    <tr><td>Конаклы</td><td>105 км</td><td>3.470 ₺</td><td>4.510 ₺</td><td>6.240 ₺</td></tr>
    <tr><td>Аланья</td><td>135 км</td><td>4.050 ₺</td><td>5.270 ₺</td><td>7.290 ₺</td></tr>
    <tr><td>Махмутлар</td><td>135 км</td><td>4.050 ₺</td><td>5.270 ₺</td><td>7.290 ₺</td></tr>
    <tr><td>Газипаша</td><td>185 км</td><td>5.550 ₺</td><td>7.220 ₺</td><td>9.990 ₺</td></tr>
  </tbody>
</table>

<h2>Что включено</h2>
<ul>
  <li>НДС включён</li>
  <li>За багаж платы нет</li>
  <li>Ожидание бесплатно</li>
  <li>Парковка в аэропорту включена</li>
  <li>Доставка до лобби отеля</li>
</ul>

<h2>Дополнительные услуги (по запросу)</h2>
<ul>
  <li><strong>Детское кресло:</strong> наличие и стоимость подтверждаются в WhatsApp</li>
  <li>Дополнительная остановка</li>
  <li>Перевозка коляски</li>
</ul>

<h2>Оплата</h2>
<p><strong>Только наличные</strong> в автомобиле (₺, USD, EUR).</p>',
    'faqs' => [
      ['q'=>'Цены на трансфер из аэропорта Анталии фиксированные?','a'=>'Да. Цена, подтверждённая при бронировании, фиксирована.'],
      ['q'=>'НДС включён?','a'=>'Да, все цены включают НДС.'],
      ['q'=>'Есть ли плата за багаж?','a'=>'Нет. Разумный багаж включён бесплатно.'],
      ['q'=>'Принимаете ли вы кредитные карты?','a'=>'Нет, только наличные.'],
      ['q'=>'Детское кресло платное?','a'=>'Детское кресло — отдельная услуга, не включённая в стандартную цену. Наличие и стоимость подтверждаются заранее в WhatsApp.']
    ]
  ]
];

/* ==================== POST 4 ==================== */
$posts['antalya-tatil-bolgeleri-mesafeler'] = [
  'date' => '2026-02-01',
  'tr' => [
    'cat' => 'Gezi Rehberi',
    'title' => "Antalya Tatil Bölgeleri Arası Mesafeler ve Süreler",
    'metaTitle' => "Antalya Tatil Bölgeleri Arası Mesafeler 2026",
    'metaDesc' => "Antalya'daki tüm tatil bölgeleri arası mesafeler ve ulaşım süreleri. Side, Belek, Kemer, Alanya, Lara ve daha fazlası.",
    'excerpt' => "Antalya'da hangi tatil bölgesi nerede, aralarındaki mesafe ne kadar? Tüm bölgelerin birbirine olan mesafeleri ve süreleri.",
    'body' => '<p>Antalya bölgesi, batıda Kemer\'den doğuda Gazipaşa\'ya kadar 200 km\'lik bir kıyı şeridine yayılır. Farklı bölgeleri ziyaret etmek istiyorsanız, aralarındaki mesafeleri bilmek planlamayı kolaylaştırır.</p>

<h2>Havalimanından Bölgelere Mesafeler</h2>
<table>
  <thead><tr><th>Bölge</th><th>Mesafe</th><th>Tahmini Süre</th><th>Yön</th></tr></thead>
  <tbody>
    <tr><td>Lara</td><td>10 km</td><td>15–20 dk</td><td>Doğu</td></tr>
    <tr><td>Kundu</td><td>12 km</td><td>15–20 dk</td><td>Doğu</td></tr>
    <tr><td>Kaleiçi</td><td>14 km</td><td>20–25 dk</td><td>Batı</td></tr>
    <tr><td>Konyaaltı</td><td>18 km</td><td>25–30 dk</td><td>Batı</td></tr>
    <tr><td>Belek</td><td>35 km</td><td>35–40 dk</td><td>Doğu</td></tr>
    <tr><td>Kemer</td><td>45 km</td><td>45–55 dk</td><td>Güneybatı</td></tr>
    <tr><td>Side</td><td>65 km</td><td>~60 dk</td><td>Doğu</td></tr>
    <tr><td>Manavgat</td><td>75 km</td><td>65–70 dk</td><td>Doğu</td></tr>
    <tr><td>Alanya</td><td>135 km</td><td>110–120 dk</td><td>Doğu</td></tr>
    <tr><td>Gazipaşa</td><td>185 km</td><td>150–165 dk</td><td>Doğu</td></tr>
  </tbody>
</table>

<h2>Bölgeler Arası Mesafeler</h2>
<table>
  <thead><tr><th></th><th>Lara</th><th>Kemer</th><th>Belek</th><th>Side</th><th>Alanya</th></tr></thead>
  <tbody>
    <tr><td><strong>Lara</strong></td><td>—</td><td>55 dk</td><td>40 dk</td><td>60 dk</td><td>120 dk</td></tr>
    <tr><td><strong>Kemer</strong></td><td>55 dk</td><td>—</td><td>70 dk</td><td>95 dk</td><td>150 dk</td></tr>
    <tr><td><strong>Belek</strong></td><td>40 dk</td><td>70 dk</td><td>—</td><td>35 dk</td><td>90 dk</td></tr>
    <tr><td><strong>Side</strong></td><td>60 dk</td><td>95 dk</td><td>35 dk</td><td>—</td><td>60 dk</td></tr>
    <tr><td><strong>Alanya</strong></td><td>120 dk</td><td>150 dk</td><td>90 dk</td><td>60 dk</td><td>—</td></tr>
  </tbody>
</table>

<h2>Bölge Seçiminde Ne Dikkate Alınmalı?</h2>

<h3>Deniz ve Plaj</h3>
<ul>
  <li><strong>Lara Plajı:</strong> Uzun kum plaj, mavi bayraklı, dalgalı olabilir</li>
  <li><strong>Konyaaltı Plajı:</strong> Şehir plajı, çakıl taşlı, sakin deniz</li>
  <li><strong>Kemer:</strong> Küçük koylar, berrak su, dağ manzarası</li>
  <li><strong>Side:</strong> Uzun kum plaj</li>
  <li><strong>Alanya/Kleopatra:</strong> Altın kum</li>
</ul>

<h3>Aile Dostu</h3>
<p>Küçük çocuklu aileler için: <strong>Belek, Kundu, Side, Kızılağaç, Titreyengöl</strong>.</p>

<h3>Gece Hayatı</h3>
<p>Gençler için: <strong>Alanya, Kemer, Lara</strong>.</p>

<h3>Doğa ve Sakinlik</h3>
<p>Huzur arayanlar: <strong>Göynük, Beldibi, Belconti, Kızılağaç, Okurcalar</strong>.</p>

<h3>Tarih ve Kültür</h3>
<p>Antik kalıntılar: <strong>Side, Kaleiçi, Kemer (Olympos, Phaselis)</strong>.</p>

<h3>Golf</h3>
<p>Golf: <strong>Belek</strong> (15+ saha).</p>

<h2>Günübirlik Gezi Önerileri</h2>
<ul>
  <li><strong>Lara/Kundu → Side:</strong> 60 dk, antik kalıntılar</li>
  <li><strong>Belek → Manavgat Şelalesi:</strong> 35 dk</li>
  <li><strong>Kemer → Olympos:</strong> 45 dk, Yanartaş</li>
  <li><strong>Alanya → Dim Çayı:</strong> 20 dk, nehir restoranları</li>
</ul>

<h2>Sonuç</h2>
<p>Hangi bölgede olursanız olun, <strong>diğer bölgeleri ziyaret etmek kolaydır</strong> — şoförlü araç hizmetimizle günübirlik geziler düzenleyebiliriz.</p>',
    'faqs' => [
      ['q'=>"Antalya'da hangi bölgede kalınır?",'a'=>'Aile için Belek, Kundu, Side; gece hayatı için Alanya, Kemer, Lara; tarih için Kaleiçi, Side; sakinlik için Göynük, Kızılağaç.'],
      ['q'=>'Side ile Alanya arası ne kadar?','a'=>'Yaklaşık 60 dakika (75 km).'],
      ['q'=>'Havalimanına en yakın tatil bölgesi?','a'=>'Lara ve Kundu (10–12 km, 15–20 dk).']
    ]
  ],
  'en' => [
    'cat' => 'Travel Guide',
    'title' => "Distances Between Antalya Resort Areas & Travel Times",
    'metaTitle' => "Antalya Resort Areas: Distances & Travel Times 2026",
    'metaDesc' => "Distances and travel times between all Antalya resort areas. Side, Belek, Kemer, Alanya, Lara and more.",
    'excerpt' => "Which Antalya resort is where, and how far apart are they? Distances and travel times, plus day-trip suggestions.",
    'body' => '<p>The Antalya region stretches along 200 km of coastline, from Kemer in the west to Gazipaşa in the east. If you want to explore more than one area, knowing the distances helps you plan realistically.</p>

<h2>Airport to Resort Areas</h2>
<table>
  <thead><tr><th>Area</th><th>Distance</th><th>Time</th><th>Direction</th></tr></thead>
  <tbody>
    <tr><td>Lara</td><td>10 km</td><td>15–20 min</td><td>East</td></tr>
    <tr><td>Kundu</td><td>12 km</td><td>15–20 min</td><td>East</td></tr>
    <tr><td>Kaleiçi</td><td>14 km</td><td>20–25 min</td><td>West</td></tr>
    <tr><td>Konyaaltı</td><td>18 km</td><td>25–30 min</td><td>West</td></tr>
    <tr><td>Belek</td><td>35 km</td><td>35–40 min</td><td>East</td></tr>
    <tr><td>Kemer</td><td>45 km</td><td>45–55 min</td><td>Southwest</td></tr>
    <tr><td>Side</td><td>65 km</td><td>~60 min</td><td>East</td></tr>
    <tr><td>Manavgat</td><td>75 km</td><td>65–70 min</td><td>East</td></tr>
    <tr><td>Alanya</td><td>135 km</td><td>110–120 min</td><td>East</td></tr>
    <tr><td>Gazipaşa</td><td>185 km</td><td>150–165 min</td><td>East</td></tr>
  </tbody>
</table>

<h2>Between Areas</h2>
<table>
  <thead><tr><th></th><th>Lara</th><th>Kemer</th><th>Belek</th><th>Side</th><th>Alanya</th></tr></thead>
  <tbody>
    <tr><td><strong>Lara</strong></td><td>—</td><td>55 min</td><td>40 min</td><td>60 min</td><td>120 min</td></tr>
    <tr><td><strong>Kemer</strong></td><td>55 min</td><td>—</td><td>70 min</td><td>95 min</td><td>150 min</td></tr>
    <tr><td><strong>Belek</strong></td><td>40 min</td><td>70 min</td><td>—</td><td>35 min</td><td>90 min</td></tr>
    <tr><td><strong>Side</strong></td><td>60 min</td><td>95 min</td><td>35 min</td><td>—</td><td>60 min</td></tr>
    <tr><td><strong>Alanya</strong></td><td>120 min</td><td>150 min</td><td>90 min</td><td>60 min</td><td>—</td></tr>
  </tbody>
</table>

<h2>What to Consider</h2>
<h3>Beaches</h3>
<ul>
  <li><strong>Lara:</strong> Long sandy beach, Blue Flag, can be wavy</li>
  <li><strong>Konyaaltı:</strong> City beach, pebbly, calm water</li>
  <li><strong>Kemer:</strong> Small coves, clear water, mountains behind</li>
  <li><strong>Side:</strong> Long sandy beach</li>
  <li><strong>Alanya/Cleopatra:</strong> Golden sand</li>
</ul>

<h3>Family-friendly</h3>
<p>For families with small children: <strong>Belek, Kundu, Side, Kızılağaç, Titreyengöl</strong>.</p>

<h3>Nightlife</h3>
<p>For younger travelers: <strong>Alanya, Kemer, Lara</strong>.</p>

<h3>Nature & Quiet</h3>
<p>Peace-seekers: <strong>Göynük, Beldibi, Belconti, Kızılağaç, Okurcalar</strong>.</p>

<h3>History & Culture</h3>
<p>Ancient ruins: <strong>Side, Kaleiçi, Kemer (Olympos, Phaselis)</strong>.</p>

<h3>Golf</h3>
<p>Golf: <strong>Belek</strong> (15+ courses).</p>

<h2>Day Trip Suggestions</h2>
<ul>
  <li><strong>Lara/Kundu → Side:</strong> 60 min, ancient ruins</li>
  <li><strong>Belek → Manavgat Waterfall:</strong> 35 min</li>
  <li><strong>Kemer → Olympos:</strong> 45 min, Yanartaş fire</li>
  <li><strong>Alanya → Dim River:</strong> 20 min, riverside restaurants</li>
</ul>

<h2>Conclusion</h2>
<p>Wherever you\'re staying, <strong>visiting other areas is easy</strong> — our chauffeured car service offers day trips on request.</p>',
    'faqs' => [
      ['q'=>'Which area should I stay in Antalya?','a'=>'For families: Belek, Kundu, Side. For nightlife: Alanya, Kemer, Lara. For history: Kaleiçi, Side. For peace: Göynük, Kızılağaç.'],
      ['q'=>'How far is Side from Alanya?','a'=>'About 60 minutes (75 km).'],
      ['q'=>'Which resort is closest to the airport?','a'=>'Lara and Kundu (10–12 km, 15–20 min).']
    ]
  ],
  'de' => [
    'cat' => 'Reiseführer',
    'title' => "Entfernungen zwischen den Urlaubsorten in Antalya",
    'metaTitle' => "Antalya Urlaubsorte: Entfernungen 2026",
    'metaDesc' => "Entfernungen und Fahrzeiten zwischen allen Urlaubsorten in Antalya. Side, Belek, Kemer, Alanya, Lara und mehr.",
    'excerpt' => "Welcher Urlaubsort in Antalya liegt wo, und wie weit sind sie voneinander entfernt?",
    'body' => '<p>Die Region Antalya erstreckt sich über 200 km Küstenlinie, von Kemer im Westen bis Gazipaşa im Osten.</p>

<h2>Flughafen zu Urlaubsgebieten</h2>
<table>
  <thead><tr><th>Gebiet</th><th>Entfernung</th><th>Zeit</th><th>Richtung</th></tr></thead>
  <tbody>
    <tr><td>Lara</td><td>10 km</td><td>15–20 Min.</td><td>Ost</td></tr>
    <tr><td>Kundu</td><td>12 km</td><td>15–20 Min.</td><td>Ost</td></tr>
    <tr><td>Kaleiçi</td><td>14 km</td><td>20–25 Min.</td><td>West</td></tr>
    <tr><td>Konyaaltı</td><td>18 km</td><td>25–30 Min.</td><td>West</td></tr>
    <tr><td>Belek</td><td>35 km</td><td>35–40 Min.</td><td>Ost</td></tr>
    <tr><td>Kemer</td><td>45 km</td><td>45–55 Min.</td><td>Südwest</td></tr>
    <tr><td>Side</td><td>65 km</td><td>~60 Min.</td><td>Ost</td></tr>
    <tr><td>Manavgat</td><td>75 km</td><td>65–70 Min.</td><td>Ost</td></tr>
    <tr><td>Alanya</td><td>135 km</td><td>110–120 Min.</td><td>Ost</td></tr>
    <tr><td>Gazipaşa</td><td>185 km</td><td>150–165 Min.</td><td>Ost</td></tr>
  </tbody>
</table>

<h2>Zwischen den Gebieten</h2>
<table>
  <thead><tr><th></th><th>Lara</th><th>Kemer</th><th>Belek</th><th>Side</th><th>Alanya</th></tr></thead>
  <tbody>
    <tr><td><strong>Lara</strong></td><td>—</td><td>55 Min.</td><td>40 Min.</td><td>60 Min.</td><td>120 Min.</td></tr>
    <tr><td><strong>Kemer</strong></td><td>55 Min.</td><td>—</td><td>70 Min.</td><td>95 Min.</td><td>150 Min.</td></tr>
    <tr><td><strong>Belek</strong></td><td>40 Min.</td><td>70 Min.</td><td>—</td><td>35 Min.</td><td>90 Min.</td></tr>
    <tr><td><strong>Side</strong></td><td>60 Min.</td><td>95 Min.</td><td>35 Min.</td><td>—</td><td>60 Min.</td></tr>
    <tr><td><strong>Alanya</strong></td><td>120 Min.</td><td>150 Min.</td><td>90 Min.</td><td>60 Min.</td><td>—</td></tr>
  </tbody>
</table>

<h2>Worauf es ankommt</h2>
<h3>Strände</h3>
<ul>
  <li><strong>Lara:</strong> Langer Sandstrand, Blaue Flagge</li>
  <li><strong>Konyaaltı:</strong> Stadtstrand, Kiesel, ruhig</li>
  <li><strong>Kemer:</strong> Kleine Buchten, klares Wasser</li>
  <li><strong>Side:</strong> Langer Sandstrand</li>
  <li><strong>Alanya/Kleopatra:</strong> Goldener Sand</li>
</ul>

<h3>Familienfreundlich</h3>
<p>Für Familien: <strong>Belek, Kundu, Side, Kızılağaç, Titreyengöl</strong>.</p>

<h3>Nachtleben</h3>
<p>Für jüngere Reisende: <strong>Alanya, Kemer, Lara</strong>.</p>

<h3>Natur & Ruhe</h3>
<p>Ruhesuchende: <strong>Göynük, Beldibi, Belconti, Kızılağaç, Okurcalar</strong>.</p>

<h3>Geschichte & Kultur</h3>
<p>Antike Ruinen: <strong>Side, Kaleiçi, Kemer</strong>.</p>

<h3>Golf</h3>
<p>Golf: <strong>Belek</strong>.</p>

<h2>Tagesausflugs-Tipps</h2>
<ul>
  <li><strong>Lara/Kundu → Side:</strong> 60 Min.</li>
  <li><strong>Belek → Manavgat-Wasserfall:</strong> 35 Min.</li>
  <li><strong>Kemer → Olympos:</strong> 45 Min.</li>
  <li><strong>Alanya → Dim-Fluss:</strong> 20 Min.</li>
</ul>

<h2>Fazit</h2>
<p>Wo auch immer Sie übernachten — <strong>andere Gebiete sind leicht erreichbar</strong>.</p>',
    'faqs' => [
      ['q'=>'In welchem Gebiet sollte ich in Antalya übernachten?','a'=>'Für Familien: Belek, Kundu, Side. Für Nachtleben: Alanya, Kemer, Lara. Für Geschichte: Kaleiçi, Side. Für Ruhe: Göynük, Kızılağaç.'],
      ['q'=>'Wie weit ist Side von Alanya entfernt?','a'=>'Etwa 60 Minuten (75 km).'],
      ['q'=>'Welcher Urlaubsort liegt am nächsten zum Flughafen?','a'=>'Lara und Kundu (10–12 km, 15–20 Min.).']
    ]
  ],
  'ru' => [
    'cat' => 'Путеводитель',
    'title' => "Расстояния между курортами Анталии и время в пути",
    'metaTitle' => "Курорты Анталии: расстояния 2026",
    'metaDesc' => "Расстояния и время в пути между всеми курортами Анталии. Сиде, Белек, Кемер, Аланья, Лара и другие.",
    'excerpt' => "Какой курорт в Анталии где и как далеко они друг от друга?",
    'body' => '<p>Регион Анталии растянулся вдоль 200 км побережья — от Кемера на западе до Газипаши на востоке.</p>

<h2>Из аэропорта до курортов</h2>
<table>
  <thead><tr><th>Район</th><th>Расстояние</th><th>Время</th><th>Направление</th></tr></thead>
  <tbody>
    <tr><td>Лара</td><td>10 км</td><td>15–20 мин</td><td>Восток</td></tr>
    <tr><td>Кунду</td><td>12 км</td><td>15–20 мин</td><td>Восток</td></tr>
    <tr><td>Калеичи</td><td>14 км</td><td>20–25 мин</td><td>Запад</td></tr>
    <tr><td>Коньяалты</td><td>18 км</td><td>25–30 мин</td><td>Запад</td></tr>
    <tr><td>Белек</td><td>35 км</td><td>35–40 мин</td><td>Восток</td></tr>
    <tr><td>Кемер</td><td>45 км</td><td>45–55 мин</td><td>Юго-запад</td></tr>
    <tr><td>Сиде</td><td>65 км</td><td>~60 мин</td><td>Восток</td></tr>
    <tr><td>Манавгат</td><td>75 км</td><td>65–70 мин</td><td>Восток</td></tr>
    <tr><td>Аланья</td><td>135 км</td><td>110–120 мин</td><td>Восток</td></tr>
    <tr><td>Газипаша</td><td>185 км</td><td>150–165 мин</td><td>Восток</td></tr>
  </tbody>
</table>

<h2>Между районами</h2>
<table>
  <thead><tr><th></th><th>Лара</th><th>Кемер</th><th>Белек</th><th>Сиде</th><th>Аланья</th></tr></thead>
  <tbody>
    <tr><td><strong>Лара</strong></td><td>—</td><td>55 мин</td><td>40 мин</td><td>60 мин</td><td>120 мин</td></tr>
    <tr><td><strong>Кемер</strong></td><td>55 мин</td><td>—</td><td>70 мин</td><td>95 мин</td><td>150 мин</td></tr>
    <tr><td><strong>Белек</strong></td><td>40 мин</td><td>70 мин</td><td>—</td><td>35 мин</td><td>90 мин</td></tr>
    <tr><td><strong>Сиде</strong></td><td>60 мин</td><td>95 мин</td><td>35 мин</td><td>—</td><td>60 мин</td></tr>
    <tr><td><strong>Аланья</strong></td><td>120 мин</td><td>150 мин</td><td>90 мин</td><td>60 мин</td><td>—</td></tr>
  </tbody>
</table>

<h2>Что учитывать</h2>
<h3>Пляжи</h3>
<ul>
  <li><strong>Лара:</strong> Длинный песчаный пляж</li>
  <li><strong>Коньяалты:</strong> Городской пляж, галька</li>
  <li><strong>Кемер:</strong> Небольшие бухты, чистая вода</li>
  <li><strong>Сиде:</strong> Длинный песчаный пляж</li>
  <li><strong>Аланья/Клеопатра:</strong> Золотой песок</li>
</ul>

<h3>Для семей</h3>
<p>С детьми: <strong>Белек, Кунду, Сиде, Кызылагач, Титреенгёль</strong>.</p>

<h3>Ночная жизнь</h3>
<p>Для молодёжи: <strong>Аланья, Кемер, Лара</strong>.</p>

<h3>Природа и тишина</h3>
<p>Для покоя: <strong>Гёйнюк, Бельдиби, Бельконти, Кызылагач, Окурджалар</strong>.</p>

<h3>История и культура</h3>
<p>Древние руины: <strong>Сиде, Калеичи, Кемер</strong>.</p>

<h3>Гольф</h3>
<p>Гольф: <strong>Белек</strong>.</p>

<h2>Идеи для однодневных поездок</h2>
<ul>
  <li><strong>Лара/Кунду → Сиде:</strong> 60 мин</li>
  <li><strong>Белек → водопад Манавгат:</strong> 35 мин</li>
  <li><strong>Кемер → Олимпос:</strong> 45 мин</li>
  <li><strong>Аланья → река Дим:</strong> 20 мин</li>
</ul>

<h2>Итог</h2>
<p>Где бы вы ни остановились, <strong>посетить другие районы легко</strong>.</p>',
    'faqs' => [
      ['q'=>'В каком районе Анталии остановиться?','a'=>'Семьям: Белек, Кунду, Сиде. Для ночной жизни: Аланья, Кемер, Лара. Для истории: Калеичи, Сиде. Для покоя: Гёйнюк, Кызылагач.'],
      ['q'=>'Сколько ехать из Сиде в Аланью?','a'=>'Около 60 минут (75 км).'],
      ['q'=>'Какой курорт ближе всего к аэропорту?','a'=>'Лара и Кунду (10–12 км, 15–20 мин).']
    ]
  ]
];

/* ==================== POST 5 ==================== */
$posts['antalya-havalimani-dis-hatlar-cikis-rehberi'] = [
  'date' => '2026-02-05',
  'tr' => [
    'cat' => 'Ulaşım Rehberi',
    'title' => "Antalya Havalimanı Dış Hatlar Çıkış Rehberi (2026)",
    'metaTitle' => "Antalya Havalimanı Dış Hatlar Çıkış Rehberi 2026",
    'metaDesc' => "Antalya Havalimanı'ndan indikten sonra ne yapmalısınız? Pasaport kontrolü, bagaj alımı, gümrük, karşılama salonu ve transfer.",
    'excerpt' => "Antalya Havalimanı'na indikten sonra hangi adımlardan geçeceksiniz, ne kadar sürecek, neye dikkat etmelisiniz?",
    'body' => '<p>Antalya Havalimanı Dış Hatlar Terminali (Terminal 1) Türkiye\'nin en modern havalimanlarından biridir. Uçağınız indikten sonra 4 ana adımdan geçeceksiniz.</p>

<h2>1. Uçaktan İndikten Sonra</h2>
<p>Uçak kapısı açıldığında sizi bir otobüs karşılar (uzak köprü) veya doğrudan jete bağlı kapıdan giriş yaparsınız. Bu genelde 5–10 dakika sürer.</p>
<p><strong>Dikkat:</strong> Terminal büyüktür — yaklaşık 500–700 metre yürüyüş. Yürüyen bantları kullanabilirsiniz.</p>

<h2>2. Pasaport Kontrolü</h2>
<ul>
  <li><strong>Yoğun olmayan saat:</strong> 10–20 dk</li>
  <li><strong>Yoğun saat:</strong> 40–60 dk</li>
  <li><strong>Yaz sezonu:</strong> 60+ dk</li>
</ul>
<p><strong>İpucu:</strong> E-gate sırası genelde daha kısadır.</p>

<h2>3. Bagaj Alımı</h2>
<ul>
  <li>Monitörden bagaj bandını kontrol edin</li>
  <li>Kayıp bagaj için bagaj etiketini saklayın</li>
  <li>Uzun kayışlı valizler bantta sıkışabilir — bandın sonunda bekleyin</li>
</ul>
<p>Ortalama bekleme süresi <strong>15–30 dakika</strong>.</p>

<h2>4. Gümrük Kontrolü</h2>
<ul>
  <li><strong>Yeşil Kanal:</strong> Beyan edilecek bir şey yoksa</li>
  <li><strong>Kırmızı Kanal:</strong> Yüksek değerli eşya, 10.000 € üzeri nakit</li>
</ul>

<h2>5. Karşılama Salonu</h2>
<p>Gümrükten çıktığınızda büyük karşılama salonuna gelirsiniz. Burada:</p>
<ul>
  <li>Otel ve transfer tabelaları</li>
  <li>Ücretsiz Wi-Fi (SMS doğrulama)</li>
  <li>Döviz büroları ve ATM\'ler</li>
  <li>Kafeler ve marketler</li>
  <li>SIM kart standları</li>
</ul>

<h2>VIP Transfer Şoförünüzle Buluşma</h2>
<ol>
  <li>Karşılama salonuna çıkın</li>
  <li>Yüksek tabelaları taşıyan şoförlere bakın</li>
  <li>İsminizin yazılı olduğu tabelayı bulun</li>
</ol>
<p><strong>Önemli:</strong> Uçuş kodunuzu WhatsApp üzerinden önceden paylaşın — gecikmelerde şoförünüz ücretsiz bekler.</p>

<h2>Dikkat Edilecek Şeyler</h2>

<h3>Resmi Olmayan "Taksi" Teklifleri</h3>
<p>Size yaklaşan "Taksi lazım mı?" diyen kişilere güvenmeyin. Resmi taksi duraklarını kullanın.</p>

<h3>SIM Kart Fiyatları</h3>
<p>Havalimanındaki SIM kart fiyatları şehirden yüksektir. Kısa kalacaksanız roaming daha ekonomik olabilir.</p>

<h3>Döviz Bozdurma</h3>
<p>Havalimanı kurları şehirden daha kötüdür. Acil ihtiyaç için küçük miktar bozdurun.</p>

<h2>Toplam Süre Tahmini</h2>
<table>
  <thead><tr><th>Aşama</th><th>Süre</th></tr></thead>
  <tbody>
    <tr><td>Uçaktan iniş</td><td>5–10 dk</td></tr>
    <tr><td>Pasaport kontrolü</td><td>20–40 dk</td></tr>
    <tr><td>Bagaj alımı</td><td>15–30 dk</td></tr>
    <tr><td>Gümrük</td><td>2–5 dk</td></tr>
    <tr><td>Karşılama + şoför</td><td>5–10 dk</td></tr>
    <tr><td><strong>Toplam</strong></td><td><strong>50–95 dk</strong></td></tr>
  </tbody>
</table>
<p>Uçağınız indikten sonra otelinize varmanız ortalama <strong>1,5–2,5 saat</strong> sürebilir.</p>',
    'faqs' => [
      ['q'=>"Antalya Havalimanı'nda pasaport kontrolü ne kadar sürer?",'a'=>'Yoğunluğa göre 20-60 dakika. Yaz sezonunda 60 dakikayı bulabilir.'],
      ['q'=>'Havalimanında ücretsiz Wi-Fi var mı?','a'=>'Evet, SMS doğrulaması ile.'],
      ['q'=>'Uçuşum gecikirse transfer şoförü beni bekler mi?','a'=>'Evet. Uçuş kodunuzu WhatsApp üzerinden paylaşırsanız uçuşunuzu takip ederiz, gecikmede ek ücret alınmaz.'],
      ['q'=>'Havalimanında SIM kart alabilir miyim?','a'=>'Evet, karşılama salonunda operatör standları var. Fiyatlar şehirden yüksektir.']
    ]
  ],
  'en' => [
    'cat' => 'Transport Guide',
    'title' => "Antalya Airport International Arrivals Guide (2026)",
    'metaTitle' => "Antalya Airport International Arrivals Guide 2026",
    'metaDesc' => "What to do after landing at Antalya Airport: passport control, baggage claim, customs, arrivals hall, and transfer.",
    'excerpt' => "Which steps will you go through after landing at Antalya Airport, how long will they take, what to watch out for?",
    'body' => '<p>Antalya Airport\'s International Terminal (Terminal 1) is one of Turkey\'s most modern airports. After landing, you\'ll go through 4 main steps.</p>

<h2>1. After Disembarking</h2>
<p>You\'ll either be taken by bus to the terminal (remote stand) or walk in via a jet bridge. Usually takes 5–10 minutes.</p>
<p><strong>Note:</strong> The terminal is large — about 500–700 metres of walking. Use the moving walkways if needed.</p>

<h2>2. Passport Control</h2>
<ul>
  <li><strong>Off-peak:</strong> 10–20 min</li>
  <li><strong>Peak:</strong> 40–60 min</li>
  <li><strong>Summer season:</strong> 60+ min</li>
</ul>
<p><strong>Tip:</strong> E-gate lines are usually shorter.</p>

<h2>3. Baggage Claim</h2>
<ul>
  <li>Check the monitor for your belt number</li>
  <li>Keep your baggage tag if luggage is lost</li>
  <li>Long-strapped suitcases can jam — stand at the end of the belt</li>
</ul>
<p>Average wait: <strong>15–30 minutes</strong>.</p>

<h2>4. Customs</h2>
<ul>
  <li><strong>Green Channel:</strong> Nothing to declare</li>
  <li><strong>Red Channel:</strong> High-value items, cash over €10,000</li>
</ul>

<h2>5. Arrivals Hall</h2>
<p>After customs you enter the arrivals hall. Here you\'ll find:</p>
<ul>
  <li>Hotel and transfer signs</li>
  <li>Free Wi-Fi (SMS verification)</li>
  <li>Currency exchange and ATMs</li>
  <li>Cafés and small shops</li>
  <li>SIM card stands</li>
</ul>

<h2>Meeting Your VIP Driver</h2>
<ol>
  <li>Walk into the arrivals hall</li>
  <li>Look for drivers holding tall signs</li>
  <li>Find the sign with your name</li>
</ol>
<p><strong>Important:</strong> Share your flight code on WhatsApp in advance — for delays, your driver waits free of charge.</p>

<h2>Things to Watch For</h2>

<h3>Unofficial "Taxi" Offers</h3>
<p>Ignore anyone approaching you with "Need a taxi?". Use official taxi stands.</p>

<h3>SIM Card Prices</h3>
<p>Airport SIM cards cost more than in the city. For a short stay, roaming may be cheaper.</p>

<h3>Currency Exchange</h3>
<p>Airport rates are worse than in the city. Exchange only what you need for immediate expenses.</p>

<h2>Total Time Estimate</h2>
<table>
  <thead><tr><th>Step</th><th>Duration</th></tr></thead>
  <tbody>
    <tr><td>Disembarking</td><td>5–10 min</td></tr>
    <tr><td>Passport control</td><td>20–40 min</td></tr>
    <tr><td>Baggage claim</td><td>15–30 min</td></tr>
    <tr><td>Customs</td><td>2–5 min</td></tr>
    <tr><td>Arrivals + driver</td><td>5–10 min</td></tr>
    <tr><td><strong>Total</strong></td><td><strong>50–95 min</strong></td></tr>
  </tbody>
</table>
<p>From landing to your hotel: expect about <strong>1.5–2.5 hours</strong>.</p>',
    'faqs' => [
      ['q'=>'How long does passport control take at Antalya Airport?','a'=>'20–60 minutes depending on traffic. In summer it can exceed 60 minutes.'],
      ['q'=>'Is there free Wi-Fi at the airport?','a'=>'Yes, with SMS verification.'],
      ['q'=>'If my flight is delayed, will my driver wait?','a'=>'Yes. Share your flight code on WhatsApp and we track your flight — no extra charge for delays.'],
      ['q'=>'Can I buy a SIM card at the airport?','a'=>'Yes, operator stands are in the arrivals hall. Prices are higher than in the city.']
    ]
  ],
  'de' => [
    'cat' => 'Transport-Ratgeber',
    'title' => "Flughafen Antalya Ankunft International — Guide (2026)",
    'metaTitle' => "Flughafen Antalya Ankunft International 2026",
    'metaDesc' => "Was tun nach der Landung am Flughafen Antalya? Passkontrolle, Gepäckausgabe, Zoll, Ankunftshalle und Transfer.",
    'excerpt' => "Welche Schritte erwarten Sie nach der Landung in Antalya, wie lange dauern sie, worauf sollten Sie achten?",
    'body' => '<p>Das internationale Terminal des Flughafens Antalya (Terminal 1) ist eines der modernsten der Türkei.</p>

<h2>1. Nach dem Aussteigen</h2>
<p>Entweder bringt Sie ein Bus zum Terminal (Außenposition) oder Sie gehen über die Fluggastbrücke. Meist 5–10 Minuten.</p>
<p><strong>Hinweis:</strong> Das Terminal ist groß — ca. 500–700 m Fußweg.</p>

<h2>2. Passkontrolle</h2>
<ul>
  <li><strong>Nebenzeit:</strong> 10–20 Min.</li>
  <li><strong>Stoßzeit:</strong> 40–60 Min.</li>
  <li><strong>Sommermonate:</strong> 60+ Min.</li>
</ul>
<p><strong>Tipp:</strong> E-Gate-Schlangen sind meist kürzer.</p>

<h2>3. Gepäckausgabe</h2>
<ul>
  <li>Prüfen Sie den Monitor für Ihr Band</li>
  <li>Gepäckanhänger aufbewahren bei Verlust</li>
  <li>Koffer mit langen Riemen können klemmen</li>
</ul>
<p>Durchschnittliche Wartezeit: <strong>15–30 Min.</strong></p>

<h2>4. Zoll</h2>
<ul>
  <li><strong>Grüner Kanal:</strong> Nichts zu verzollen</li>
  <li><strong>Roter Kanal:</strong> Hochwertige Waren, Bargeld über 10.000 €</li>
</ul>

<h2>5. Ankunftshalle</h2>
<ul>
  <li>Hotel- und Transfer-Schilder</li>
  <li>Kostenloses WLAN (SMS-Verifizierung)</li>
  <li>Wechselstuben und Geldautomaten</li>
  <li>Cafés und kleine Läden</li>
  <li>SIM-Karten-Stände</li>
</ul>

<h2>Ihren VIP-Fahrer treffen</h2>
<ol>
  <li>Gehen Sie in die Ankunftshalle</li>
  <li>Suchen Sie Fahrer mit hohen Schildern</li>
  <li>Finden Sie das Schild mit Ihrem Namen</li>
</ol>
<p><strong>Wichtig:</strong> Teilen Sie Ihre Flugnummer vorab per WhatsApp — bei Verspätung wartet Ihr Fahrer kostenlos.</p>

<h2>Worauf achten?</h2>
<h3>Inoffizielle "Taxi"-Angebote</h3>
<p>Ignorieren Sie Personen, die Sie mit "Taxi?" ansprechen.</p>
<h3>SIM-Karten-Preise</h3>
<p>Am Flughafen teurer als in der Stadt.</p>
<h3>Geldwechsel</h3>
<p>Flughafenkurse sind schlechter.</p>

<h2>Gesamtzeit</h2>
<table>
  <thead><tr><th>Schritt</th><th>Dauer</th></tr></thead>
  <tbody>
    <tr><td>Aussteigen</td><td>5–10 Min.</td></tr>
    <tr><td>Passkontrolle</td><td>20–40 Min.</td></tr>
    <tr><td>Gepäckausgabe</td><td>15–30 Min.</td></tr>
    <tr><td>Zoll</td><td>2–5 Min.</td></tr>
    <tr><td>Ankunft + Fahrer</td><td>5–10 Min.</td></tr>
    <tr><td><strong>Gesamt</strong></td><td><strong>50–95 Min.</strong></td></tr>
  </tbody>
</table>
<p>Von der Landung bis zum Hotel: etwa <strong>1,5–2,5 Stunden</strong>.</p>',
    'faqs' => [
      ['q'=>'Wie lange dauert die Passkontrolle in Antalya?','a'=>'20–60 Minuten, je nach Auslastung. In der Sommersaison über 60 Minuten möglich.'],
      ['q'=>'Gibt es kostenloses WLAN am Flughafen?','a'=>'Ja, mit SMS-Verifizierung.'],
      ['q'=>'Wartet mein Fahrer bei Flugverspätung?','a'=>'Ja. Teilen Sie Ihre Flugnummer per WhatsApp mit — wir verfolgen Ihren Flug, ohne Aufpreis.'],
      ['q'=>'Kann ich SIM-Karten am Flughafen kaufen?','a'=>'Ja, Stände der Betreiber in der Ankunftshalle. Preise höher als in der Stadt.']
    ]
  ],
  'ru' => [
    'cat' => 'Гид по транспорту',
    'title' => "Аэропорт Анталии — гид по прилёту (2026)",
    'metaTitle' => "Аэропорт Анталии: гид по прилёту 2026",
    'metaDesc' => "Что делать после прилёта в Анталию? Паспортный контроль, багаж, таможня, зал прилёта и трансфер.",
    'excerpt' => "Какие шаги ждут вас после прилёта в Анталию, сколько они занимают, на что обратить внимание?",
    'body' => '<p>Терминал международных рейсов аэропорта Анталии (Терминал 1) — один из самых современных в Турции.</p>

<h2>1. После выхода из самолёта</h2>
<p>Вас либо довезут автобусом до терминала, либо вы пройдёте через телетрап. Обычно 5–10 минут.</p>
<p><strong>Важно:</strong> Терминал большой — около 500–700 метров пешком.</p>

<h2>2. Паспортный контроль</h2>
<ul>
  <li><strong>Вне пик:</strong> 10–20 мин</li>
  <li><strong>Пик:</strong> 40–60 мин</li>
  <li><strong>Летний сезон:</strong> 60+ мин</li>
</ul>
<p><strong>Совет:</strong> Очередь к e-gate обычно короче.</p>

<h2>3. Получение багажа</h2>
<ul>
  <li>Проверьте номер ленты на мониторе</li>
  <li>Сохраняйте багажную бирку</li>
  <li>Чемоданы с длинными ручками могут застревать</li>
</ul>
<p>Среднее ожидание: <strong>15–30 минут</strong>.</p>

<h2>4. Таможня</h2>
<ul>
  <li><strong>Зелёный коридор:</strong> нечего декларировать</li>
  <li><strong>Красный коридор:</strong> ценные вещи, наличные свыше €10 000</li>
</ul>

<h2>5. Зал прилёта</h2>
<ul>
  <li>Таблички отелей и трансферов</li>
  <li>Бесплатный Wi-Fi (SMS-верификация)</li>
  <li>Обмен валюты и банкоматы</li>
  <li>Кафе и магазины</li>
  <li>Стенды с SIM-картами</li>
</ul>

<h2>Встреча с VIP-водителем</h2>
<ol>
  <li>Пройдите в зал прилёта</li>
  <li>Ищите водителей с высокими табличками</li>
  <li>Найдите табличку со своим именем</li>
</ol>
<p><strong>Важно:</strong> Отправьте номер рейса заранее в WhatsApp — при задержке водитель ждёт бесплатно.</p>

<h2>На что обратить внимание</h2>
<h3>Неофициальные "такси"</h3>
<p>Игнорируйте тех, кто предлагает "Такси?".</p>
<h3>Цены на SIM-карты</h3>
<p>В аэропорту дороже, чем в городе.</p>
<h3>Обмен валюты</h3>
<p>Курс в аэропорту хуже.</p>

<h2>Общее время</h2>
<table>
  <thead><tr><th>Этап</th><th>Длительность</th></tr></thead>
  <tbody>
    <tr><td>Выход из самолёта</td><td>5–10 мин</td></tr>
    <tr><td>Паспортный контроль</td><td>20–40 мин</td></tr>
    <tr><td>Багаж</td><td>15–30 мин</td></tr>
    <tr><td>Таможня</td><td>2–5 мин</td></tr>
    <tr><td>Зал + водитель</td><td>5–10 мин</td></tr>
    <tr><td><strong>Итого</strong></td><td><strong>50–95 мин</strong></td></tr>
  </tbody>
</table>
<p>От прилёта до отеля: около <strong>1,5–2,5 часов</strong>.</p>',
    'faqs' => [
      ['q'=>'Сколько длится паспортный контроль в Анталии?','a'=>'20–60 минут в зависимости от загруженности.'],
      ['q'=>'Есть ли в аэропорту бесплатный Wi-Fi?','a'=>'Да, с SMS-верификацией.'],
      ['q'=>'Ждёт ли водитель при задержке рейса?','a'=>'Да. Отправьте номер рейса в WhatsApp — доплата не требуется.'],
      ['q'=>'Можно ли купить SIM-карту в аэропорту?','a'=>'Да, стенды операторов в зале прилёта. Цены выше, чем в городе.']
    ]
  ]
];

/* ==================== POST 6 ==================== */
$posts['cocuklu-aileler-antalya-transfer'] = [
  'date' => '2026-02-10',
  'tr' => [
    'cat' => 'Aile Rehberi',
    'title' => "Çocuklu Aileler için Antalya Transfer İpuçları",
    'metaTitle' => "Çocuklu Aileler için Antalya Transfer Rehberi 2026",
    'metaDesc' => "Çocuklu aileler için Antalya Havalimanı transferi ipuçları: çocuk koltuğu nasıl talep edilir, bagaj planlaması, zamanlama, mola noktaları.",
    'excerpt' => "Küçük çocuklarla Antalya'ya seyahat ediyorsanız, transfer planlaması çok önemlidir. Bu rehberde aileler için pratik ipuçları bulacaksınız.",
    'body' => '<p>Küçük çocuklarla seyahat etmek, yetişkin yolculuğundan çok farklı bir planlama gerektirir. Uzun uçuş sonrası yorgun çocuklarla transfer yapmak, iyi hazırlanılmadığında zor olabilir.</p>

<h2>1. Çocuk Koltuğu İhtiyacınızı Önceden Sorun</h2>
<p>Türkiye\'de 4 yaşından küçük çocuklar araç içinde çocuk koltuğu kullanmak zorundadır. Ancak her transfer firmasında her tip koltuk bulunmaz.</p>
<p><strong>Bizim hizmetimizde:</strong></p>
<ul>
  <li>Çocuk koltuğu talebini <strong>WhatsApp üzerinden önceden iletmeniz gerekir</strong></li>
  <li>Uygunluk ve ücret <strong>rezervasyon sırasında teyit edilir</strong></li>
  <li>Koltuk tipleri: 0–13 kg ana kucağı, 9–18 kg çocuk koltuğu, 15–36 kg yükseltici</li>
  <li>Çocuğunuzun yaşını ve kilosunu belirtin</li>
</ul>
<p><strong>Önemli:</strong> Koltuğun araçta hazır olduğunu varsaymayın. WhatsApp\'tan yazıp teyit almadan seyahat etmeyin.</p>

<h2>2. Bagaj Planlaması</h2>
<p>Küçük çocuklu ailelerin bagajı normalden fazla olur: bebek arabası, mama, biberon, yedek kıyafetler, oyuncak, ilaç.</p>
<p>Bu nedenle <strong>sedan yeterli olmaz</strong>:</p>
<table>
  <thead><tr><th>Yolcu</th><th>Önerilen Araç</th></tr></thead>
  <tbody>
    <tr><td>2 yetişkin + 1 bebek</td><td>Sedan</td></tr>
    <tr><td>2 yetişkin + 2 çocuk</td><td>Minivan</td></tr>
    <tr><td>2 yetişkin + 3+ çocuk</td><td>Minivan/Minibüs</td></tr>
    <tr><td>4 yetişkin + 2 çocuk</td><td>Minibüs</td></tr>
  </tbody>
</table>

<h2>3. Doğru Uçuş Saatini Seçin</h2>
<ul>
  <li><strong>Sabah erken (06:00–09:00):</strong> Çocuk yorgun, transferde uyur</li>
  <li><strong>Akşam (18:00–21:00):</strong> En rahat seçenek</li>
  <li><strong>Gece (22:00+):</strong> Zor olabilir</li>
  <li><strong>Öğle (12:00–15:00):</strong> Çocuk aktif, sıkılabilir</li>
</ul>

<h2>4. Transfer Süresini Kısaltın</h2>
<ul>
  <li>Havalimanına yakın otel seçin (Lara, Kundu)</li>
  <li>Uzun mesafede mola verin (Manavgat, Serik)</li>
  <li>Gece transferleri daha hızlı geçer (çocuk uyur)</li>
</ul>

<h2>5. Çocuğu Oyalama</h2>
<ul>
  <li>Tablet + kulaklık (indirilmiş çizgi film)</li>
  <li>Küçük oyuncaklar</li>
  <li>Atıştırmalık (kuru meyve, kraker)</li>
  <li>Su veya meyve suyu (kapaklı şişe)</li>
  <li>Pelüş oyuncak / battaniye</li>
</ul>

<h2>6. Bulantı Önlemleri</h2>
<ul>
  <li>Yolculuktan 30 dk önce hafif yemek</li>
  <li>"Yavaş sürün, çocuk var" diyebilirsiniz</li>
  <li>Poşet ve ıslak mendil yanınızda olsun</li>
  <li>Çocuğun yan tarafa bakmasını sağlayın</li>
  <li>Doktor önerdiyse bulantı ilacı</li>
</ul>

<h2>7. Havalimanında Pratik Bilgiler</h2>
<ul>
  <li>Bebek bakım odaları mevcut</li>
  <li>Bebek arabası kabine alınabilir veya gate\'te teslim</li>
  <li>Süt ısıtma: kafelerden sıcak su</li>
  <li>Alt değiştirme masaları tüm tuvaletlerde</li>
</ul>

<h2>8. WhatsApp\'ta Ne Bildirmelisiniz?</h2>
<ul>
  <li>Çocuk sayısı ve yaşları</li>
  <li>Çocuk koltuğu talebi (kaç adet, hangi yaş)</li>
  <li>Bebek arabası taşınacak mı</li>
  <li>Özel ihtiyaçlar (alerji, ilaç)</li>
  <li>Klima tercihi</li>
</ul>

<h2>Kısa Özet</h2>
<ul>
  <li>✅ Çocuk koltuğunu <strong>WhatsApp üzerinden önceden sorun</strong></li>
  <li>✅ Minivan veya minibüs seçin</li>
  <li>✅ Akşam uçuşlarını tercih edin</li>
  <li>✅ Kısa mesafeli bölgeleri seçin</li>
  <li>✅ Tablet, atıştırmalık, su hazırlayın</li>
  <li>✅ Bulantı için önlem alın</li>
</ul>',
    'faqs' => [
      ['q'=>'Çocuk koltuğu sağlıyor musunuz?','a'=>'Evet, talep üzerine sağlayabiliyoruz. Ancak WhatsApp üzerinden önceden sormanız ve uygunluğu teyit etmeniz gerekir. Ücret rezervasyon sırasında bildirilir.'],
      ['q'=>'Çocuk koltuğunu ne zaman talep etmeliyim?','a'=>'En az 24 saat öncesinden. Yaz sezonunda en az 2-3 gün önceden.'],
      ['q'=>'Kaç çocuk koltuğu talep edebilirim?','a'=>'Araç kapasitesine göre: sedan için 1-2, minivan 2-3, minibüs 4+. Kesin sayıyı WhatsApp üzerinden teyit ederiz.'],
      ['q'=>'Bebek arabası araç içine sığar mı?','a'=>'Katlanır bebek arabası sedan bagajına sığabilir. Büyük bebek arabaları için minivan öneririz.'],
      ['q'=>'Çocuklu transferlerde ek ücret var mı?','a'=>'Standart ücret dışında otomatik bir ek ücret yoktur. Çocuk koltuğu talep ederseniz ek ücret uygulanır — tutarı WhatsApp üzerinden teyit ederiz.']
    ]
  ],
  'en' => [
    'cat' => 'Family Guide',
    'title' => "Antalya Transfer Tips for Families with Children",
    'metaTitle' => "Antalya Transfer Guide for Families with Kids 2026",
    'metaDesc' => "Antalya airport transfer tips for families: how to request a child seat, luggage planning, timing, and comfort.",
    'excerpt' => "Traveling to Antalya with small children? Transfer planning matters. Here are practical tips for families.",
    'body' => '<p>Traveling with small children requires very different planning than adult-only trips. After a long flight, doing a transfer with tired kids can be tricky without proper preparation.</p>

<h2>1. Ask About Child Seats in Advance</h2>
<p>In Turkey, children under 4 must use a child seat or booster in vehicles. But not every transfer company stocks every seat type.</p>
<p><strong>How it works with us:</strong></p>
<ul>
  <li>Child seat request must be submitted <strong>in advance via WhatsApp</strong></li>
  <li>Availability and fee are <strong>confirmed during booking</strong></li>
  <li>Seat types: 0–13 kg infant, 9–18 kg child, 15–36 kg booster</li>
  <li>Tell us your child\'s age and weight</li>
</ul>
<p><strong>Important:</strong> Don\'t assume the seat will be in the car. Don\'t travel without WhatsApp confirmation.</p>

<h2>2. Luggage Planning</h2>
<p>Families with small children carry more than average: stroller, formula, bottles, spare clothes, toys, medicine.</p>
<p>So <strong>sedan isn\'t enough</strong>:</p>
<table>
  <thead><tr><th>Passengers</th><th>Recommended Vehicle</th></tr></thead>
  <tbody>
    <tr><td>2 adults + 1 baby</td><td>Sedan</td></tr>
    <tr><td>2 adults + 2 kids</td><td>Minivan</td></tr>
    <tr><td>2 adults + 3+ kids</td><td>Minivan/Minibus</td></tr>
    <tr><td>4 adults + 2 kids</td><td>Minibus</td></tr>
  </tbody>
</table>

<h2>3. Choose the Right Flight Time</h2>
<ul>
  <li><strong>Early morning (06:00–09:00):</strong> Kids tired, sleep in the car</li>
  <li><strong>Evening (18:00–21:00):</strong> Easiest option</li>
  <li><strong>Night (22:00+):</strong> Can be tough</li>
  <li><strong>Midday (12:00–15:00):</strong> Kids active, may get bored</li>
</ul>

<h2>4. Keep Transfer Time Short</h2>
<ul>
  <li>Choose hotels near the airport (Lara, Kundu)</li>
  <li>For long distances, take a break (Manavgat, Serik)</li>
  <li>Night transfers go faster — kids sleep</li>
</ul>

<h2>5. Keeping Kids Entertained</h2>
<ul>
  <li>Tablet + headphones (downloaded cartoons)</li>
  <li>Small toys</li>
  <li>Snacks (dried fruit, crackers)</li>
  <li>Water or juice (sippy bottle)</li>
  <li>Stuffed toy / blanket</li>
</ul>

<h2>6. Motion Sickness</h2>
<ul>
  <li>Light meal 30 min before the trip</li>
  <li>You can ask the driver "please drive gently, kids in the car"</li>
  <li>Keep a bag and wet wipes handy</li>
  <li>Have kids look to the side, not forward</li>
  <li>Motion sickness medicine if doctor-approved</li>
</ul>

<h2>7. Practical Airport Tips</h2>
<ul>
  <li>Baby care rooms available</li>
  <li>Stroller to cabin or gate-checked</li>
  <li>Warm water from cafés for bottles</li>
  <li>Changing tables in all restrooms</li>
</ul>

<h2>8. What to Share on WhatsApp</h2>
<ul>
  <li>Number of children and their ages</li>
  <li>Child seat request (how many, which age)</li>
  <li>Stroller to be carried?</li>
  <li>Special needs (allergies, medication)</li>
  <li>Preferred AC temperature</li>
</ul>

<h2>Quick Summary</h2>
<ul>
  <li>✅ Ask about child seats in advance <strong>via WhatsApp</strong></li>
  <li>✅ Choose minivan or minibus</li>
  <li>✅ Prefer evening flights</li>
  <li>✅ Pick short-distance areas</li>
  <li>✅ Pack tablet, snacks, water</li>
  <li>✅ Prepare for motion sickness</li>
</ul>',
    'faqs' => [
      ['q'=>'Do you provide child seats?','a'=>'Yes, on request. But you must ask in advance via WhatsApp and confirm availability. The fee is stated at booking.'],
      ['q'=>'When should I request a child seat?','a'=>'At least 24 hours in advance. In summer, 2-3 days ahead.'],
      ['q'=>'How many child seats can I request?','a'=>'Depends on vehicle: 1-2 for sedan, 2-3 for minivan, 4+ for minibus. We confirm exact numbers on WhatsApp.'],
      ['q'=>'Will a stroller fit in the vehicle?','a'=>'Folding strollers may fit in sedan trunks. For larger strollers, we recommend a minivan.'],
      ['q'=>'Is there an extra charge for traveling with children?','a'=>'No automatic extra charge. If you request a child seat, an additional fee applies — confirmed on WhatsApp.']
    ]
  ],
  'de' => [
    'cat' => 'Familien-Ratgeber',
    'title' => "Antalya Transfer-Tipps für Familien mit Kindern",
    'metaTitle' => "Antalya Transfer mit Kindern — Guide 2026",
    'metaDesc' => "Flughafentransfer-Tipps in Antalya für Familien: Kindersitz anfragen, Gepäckplanung, Timing und Komfort.",
    'excerpt' => "Mit kleinen Kindern nach Antalya? Die Transferplanung ist entscheidend. Hier praktische Tipps für Familien.",
    'body' => '<p>Reisen mit kleinen Kindern erfordert völlig andere Planung als Reisen ohne Kinder.</p>

<h2>1. Kindersitz vorab anfragen</h2>
<p>In der Türkei müssen Kinder unter 4 Jahren einen Kindersitz oder eine Sitzerhöhung benutzen. Aber nicht jede Transferfirma hat jeden Sitztyp.</p>
<p><strong>So funktioniert es bei uns:</strong></p>
<ul>
  <li>Kindersitz-Anfrage <strong>vorab per WhatsApp</strong></li>
  <li>Verfügbarkeit und Preis werden <strong>bei der Buchung bestätigt</strong></li>
  <li>Sitztypen: 0–13 kg Babyschale, 9–18 kg Kindersitz, 15–36 kg Sitzerhöhung</li>
  <li>Bitte Alter und Gewicht Ihres Kindes mitteilen</li>
</ul>
<p><strong>Wichtig:</strong> Gehen Sie nicht davon aus, dass der Sitz im Auto ist. Nicht ohne WhatsApp-Bestätigung reisen.</p>

<h2>2. Gepäckplanung</h2>
<p>Familien mit kleinen Kindern führen mehr mit: Kinderwagen, Milchpulver, Fläschchen, Wechselkleidung, Spielzeug, Medikamente.</p>
<p>Deshalb reicht ein <strong>Sedan nicht</strong>:</p>
<table>
  <thead><tr><th>Passagiere</th><th>Empfohlenes Fahrzeug</th></tr></thead>
  <tbody>
    <tr><td>2 Erwachsene + 1 Baby</td><td>Sedan</td></tr>
    <tr><td>2 Erwachsene + 2 Kinder</td><td>Minivan</td></tr>
    <tr><td>2 Erwachsene + 3+ Kinder</td><td>Minivan/Minibus</td></tr>
    <tr><td>4 Erwachsene + 2 Kinder</td><td>Minibus</td></tr>
  </tbody>
</table>

<h2>3. Richtige Flugzeit wählen</h2>
<ul>
  <li><strong>Früh (06:00–09:00):</strong> Kinder müde, schlafen im Auto</li>
  <li><strong>Abend (18:00–21:00):</strong> Bequemste Option</li>
  <li><strong>Nacht (22:00+):</strong> Kann schwierig sein</li>
  <li><strong>Mittag (12:00–15:00):</strong> Kinder aktiv, könnten sich langweilen</li>
</ul>

<h2>4. Transferzeit kurz halten</h2>
<ul>
  <li>Hotels in Flughafennähe wählen (Lara, Kundu)</li>
  <li>Bei langen Strecken Pause einlegen</li>
  <li>Nachttransfers gehen schneller — Kinder schlafen</li>
</ul>

<h2>5. Kinder beschäftigen</h2>
<ul>
  <li>Tablet + Kopfhörer</li>
  <li>Kleine Spielzeuge</li>
  <li>Snacks (Trockenfrüchte, Cracker)</li>
  <li>Wasser oder Saft (Schnabeltasse)</li>
  <li>Kuscheltier / Decke</li>
</ul>

<h2>6. Reiseübelkeit</h2>
<ul>
  <li>30 Min. vor Fahrt leichte Mahlzeit</li>
  <li>"Bitte langsam fahren, Kinder im Auto"</li>
  <li>Tüte und Feuchttücher bereithalten</li>
  <li>Kinder zur Seite schauen lassen</li>
  <li>Reisetabletten nur wenn ärztlich empfohlen</li>
</ul>

<h2>7. Praktische Flughafentipps</h2>
<ul>
  <li>Babyräume vorhanden</li>
  <li>Kinderwagen in Kabine oder am Gate</li>
  <li>Warmes Wasser in Cafés für Fläschchen</li>
  <li>Wickeltische in allen Toiletten</li>
</ul>

<h2>8. Was per WhatsApp mitteilen?</h2>
<ul>
  <li>Anzahl und Alter der Kinder</li>
  <li>Kindersitz-Anfrage (wie viele, welches Alter)</li>
  <li>Kinderwagen mitnehmen?</li>
  <li>Besondere Bedürfnisse (Allergien, Medikamente)</li>
  <li>Klima-Wunschtemperatur</li>
</ul>

<h2>Kurzfassung</h2>
<ul>
  <li>✅ Kindersitz vorab <strong>per WhatsApp anfragen</strong></li>
  <li>✅ Minivan oder Minibus wählen</li>
  <li>✅ Abendflüge bevorzugen</li>
  <li>✅ Kurze Strecken wählen</li>
  <li>✅ Tablet, Snacks, Wasser einpacken</li>
  <li>✅ Reiseübelkeit vorbeugen</li>
</ul>',
    'faqs' => [
      ['q'=>'Bieten Sie Kindersitze an?','a'=>'Ja, auf Anfrage. Sie müssen aber vorab per WhatsApp anfragen und die Verfügbarkeit bestätigen lassen. Der Preis wird bei der Buchung genannt.'],
      ['q'=>'Wann sollte ich einen Kindersitz anfragen?','a'=>'Mindestens 24 Stunden vorher. In der Hochsaison 2-3 Tage vorher.'],
      ['q'=>'Wie viele Kindersitze kann ich anfragen?','a'=>'Je nach Fahrzeug: 1-2 beim Sedan, 2-3 beim Minivan, 4+ beim Minibus. Genaue Anzahl per WhatsApp.'],
      ['q'=>'Passt ein Kinderwagen ins Fahrzeug?','a'=>'Faltbare Kinderwagen passen oft in Sedan-Kofferräume. Für größere Kinderwagen empfehlen wir Minivan.'],
      ['q'=>'Gibt es Zusatzkosten bei Reisen mit Kindern?','a'=>'Keine automatische Zusatzgebühr. Bei Kindersitz-Anfrage fällt eine Gebühr an — per WhatsApp bestätigt.']
    ]
  ],
  'ru' => [
    'cat' => 'Семейный гид',
    'title' => "Анталия: советы по трансферу для семей с детьми",
    'metaTitle' => "Трансфер в Анталии с детьми — гид 2026",
    'metaDesc' => "Советы по трансферу из аэропорта Анталии для семей: как запросить детское кресло, планирование багажа, время и комфорт.",
    'excerpt' => "Едете в Анталию с маленькими детьми? Планирование трансфера важно. Практические советы для семей.",
    'body' => '<p>Путешествие с маленькими детьми требует совсем другого планирования.</p>

<h2>1. Заранее спросите о детских креслах</h2>
<p>В Турции дети до 4 лет обязаны ехать в детском кресле или бустере. Но не у всех трансферных компаний есть кресла всех типов.</p>
<p><strong>Как это работает у нас:</strong></p>
<ul>
  <li>Запрос на детское кресло отправляется <strong>заранее в WhatsApp</strong></li>
  <li>Наличие и стоимость <strong>подтверждаются при бронировании</strong></li>
  <li>Типы кресел: 0–13 кг люлька, 9–18 кг детское кресло, 15–36 кг бустер</li>
  <li>Сообщите возраст и вес ребёнка</li>
</ul>
<p><strong>Важно:</strong> Не предполагайте, что кресло будет в машине.</p>

<h2>2. Планирование багажа</h2>
<p>Семьи с детьми везут больше: коляска, смесь, бутылочки, запасная одежда, игрушки, лекарства.</p>
<p>Поэтому <strong>седан не подойдёт</strong>:</p>
<table>
  <thead><tr><th>Пассажиры</th><th>Рекомендуемое авто</th></tr></thead>
  <tbody>
    <tr><td>2 взрослых + 1 малыш</td><td>Sedan</td></tr>
    <tr><td>2 взрослых + 2 детей</td><td>Minivan</td></tr>
    <tr><td>2 взрослых + 3+ детей</td><td>Minivan/Minibus</td></tr>
    <tr><td>4 взрослых + 2 детей</td><td>Minibus</td></tr>
  </tbody>
</table>

<h2>3. Правильное время рейса</h2>
<ul>
  <li><strong>Раннее утро (06:00–09:00):</strong> Дети уставшие, спят в машине</li>
  <li><strong>Вечер (18:00–21:00):</strong> Лучший вариант</li>
  <li><strong>Ночь (22:00+):</strong> Может быть сложно</li>
  <li><strong>Полдень (12:00–15:00):</strong> Дети активны, могут скучать</li>
</ul>

<h2>4. Сократите время в пути</h2>
<ul>
  <li>Выбирайте отели ближе к аэропорту (Лара, Кунду)</li>
  <li>На длинных дистанциях делайте остановку</li>
  <li>Ночные трансферы быстрее — дети спят</li>
</ul>

<h2>5. Чем занять детей</h2>
<ul>
  <li>Планшет + наушники</li>
  <li>Маленькие игрушки</li>
  <li>Перекусы (сухофрукты, крекеры)</li>
  <li>Вода или сок (бутылочка с трубочкой)</li>
  <li>Мягкая игрушка / одеяло</li>
</ul>

<h2>6. Укачивание</h2>
<ul>
  <li>Легкий перекус за 30 минут до поездки</li>
  <li>"Пожалуйста, помедленнее, дети в машине"</li>
  <li>Пакет и влажные салфетки под рукой</li>
  <li>Смотрите в сторону, не вперёд</li>
  <li>Лекарства от укачивания только по рекомендации врача</li>
</ul>

<h2>7. Практические советы в аэропорту</h2>
<ul>
  <li>Комнаты матери и ребёнка есть</li>
  <li>Коляску можно взять в салон или сдать у трапа</li>
  <li>Тёплая вода для бутылочек в кафе</li>
  <li>Пеленальные столики во всех туалетах</li>
</ul>

<h2>8. Что сообщить в WhatsApp</h2>
<ul>
  <li>Количество и возраст детей</li>
  <li>Запрос детского кресла (сколько, для какого возраста)</li>
  <li>Нужно ли перевозить коляску</li>
  <li>Особые потребности (аллергии, лекарства)</li>
  <li>Желаемая температура кондиционера</li>
</ul>

<h2>Кратко</h2>
<ul>
  <li>✅ Заранее спросите о детских креслах <strong>в WhatsApp</strong></li>
  <li>✅ Выбирайте minivan или minibus</li>
  <li>✅ Отдавайте предпочтение вечерним рейсам</li>
  <li>✅ Выбирайте районы с коротким трансфером</li>
  <li>✅ Возьмите планшет, перекусы, воду</li>
  <li>✅ Подготовьтесь к укачиванию</li>
</ul>',
    'faqs' => [
      ['q'=>'Предоставляете ли вы детские кресла?','a'=>'Да, по запросу. Но нужно спросить заранее в WhatsApp и подтвердить наличие. Стоимость сообщается при бронировании.'],
      ['q'=>'Когда нужно запрашивать детское кресло?','a'=>'Минимум за 24 часа. В высокий сезон — за 2-3 дня.'],
      ['q'=>'Сколько детских кресел можно запросить?','a'=>'Зависит от авто: 1-2 для седана, 2-3 для минивэна, 4+ для минибус. Точное количество — в WhatsApp.'],
      ['q'=>'Поместится ли коляска в машину?','a'=>'Складные коляски могут поместиться в багажник седана. Для больших колясок рекомендуем минивэн.'],
      ['q'=>'Есть ли доплата за поездку с детьми?','a'=>'Автоматической доплаты нет. Если нужен детский кресло — взимается дополнительная плата, подтверждаемая в WhatsApp.']
    ]
  ]
];

/* ============================================================
   HELPERS
   ============================================================ */

function esc($s) {
  return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

function wa_link($wa, $text) {
  return "https://wa.me/" . $wa . "?text=" . rawurlencode($text);
}

function blog_url($lang, $slug = '') {
  if ($lang === 'tr') {
    return $slug ? '/blog/' . $slug . '.html' : '/blog/';
  }
  return $slug ? '/blog/' . $lang . '/' . $slug . '.html' : '/blog/' . $lang . '/';
}

/* ============================================================
   BUILD POST PAGE
   ============================================================ */

function build_post_page($slug, $post, $lang, $posts, $UI, $WA, $SITE, $YEAR, $LANGS) {
  $p = $post[$lang];
  $u = $UI[$lang];

  $title = esc($p['title']);
  $metaTitle = esc($p['metaTitle']);
  $metaDesc = esc($p['metaDesc']);
  $category = esc($p['cat']);
  $date = esc($post['date']);

  $blogIndexUrl = $SITE . blog_url($lang);
  $homeUrl = ($lang === 'tr') ? $SITE . '/' : $SITE . '/?lang=' . $lang;
  $postUrl = $SITE . blog_url($lang, $slug);

  // hreflang links
  $hreflang = '';
  foreach ($LANGS as $l) {
    $hreflang .= '<link rel="alternate" hreflang="' . $l . '" href="' . $SITE . blog_url($l, $slug) . '">' . "\n";
  }
  $hreflang .= '<link rel="alternate" hreflang="x-default" href="' . $SITE . blog_url('tr', $slug) . '">' . "\n";

  // FAQ HTML
  $faqHtml = '';
  foreach ($p['faqs'] as $f) {
    $faqHtml .= '<details><summary>' . esc($f['q']) . '</summary><p>' . esc($f['a']) . '</p></details>' . "\n    ";
  }

  // FAQ JSON-LD schema
  $faqItems = [];
  foreach ($p['faqs'] as $f) {
    $faqItems[] = '{"@type":"Question","name":"' . esc($f['q']) . '","acceptedAnswer":{"@type":"Answer","text":"' . esc($f['a']) . '"}}';
  }
  $faqSchema = implode(',', $faqItems);

  // Related posts (3 others)
  $relatedHtml = '';
  $count = 0;
  foreach ($posts as $rSlug => $rPost) {
    if ($rSlug === $slug) continue;
    if ($count >= 3) break;
    $relatedHtml .= '<a href="' . blog_url($lang, $rSlug) . '">' . esc($rPost[$lang]['title']) . '</a>' . "\n      ";
    $count++;
  }

  // Language switch options
  $langOptions = '';
  foreach ($LANGS as $l) {
    $sel = ($l === $lang) ? ' selected' : '';
    $langOptions .= '<option value="' . $l . '"' . $sel . '>' . strtoupper($l) . '</option>' . "\n          ";
  }

  // Language switch URLs (JSON)
  $langUrls = [];
  foreach ($LANGS as $l) {
    $langUrls[$l] = blog_url($l, $slug);
  }
  $langUrlsJson = json_encode($langUrls);

  $hrefWa = wa_link($WA, $u['waMsg']);

  // HTML output
  $html = '<!doctype html>' . "\n";
  $html .= '<html lang="' . $lang . '">' . "\n";
  $html .= '<head>' . "\n";
  $html .= '<meta charset="utf-8">' . "\n";
  $html .= '<script>' . "\n";
  $html .= 'window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}' . "\n";
  $html .= "gtag('consent','default',{analytics_storage:'denied',ad_storage:'denied',ad_user_data:'denied',ad_personalization:'denied',wait_for_update:500});\n";
  $html .= '</script>' . "\n";
  $html .= '<script async src="https://www.googletagmanager.com/gtag/js?id=G-L5YM12ZQ63"></script>' . "\n";
  $html .= "<script>gtag('js',new Date());gtag('config','G-L5YM12ZQ63');gtag('config','G-eqCMz7r5gdEPzEoexE');</script>\n";
  $html .= '<meta name="viewport" content="width=device-width,initial-scale=1">' . "\n";
  $html .= '<meta name="theme-color" content="#101114">' . "\n";
  $html .= '<meta name="description" content="' . $metaDesc . '">' . "\n";
  $html .= '<meta name="robots" content="index,follow">' . "\n";
  $html .= '<link rel="canonical" href="' . $postUrl . '">' . "\n";
  $html .= $hreflang;
  $html .= '<link rel="icon" type="image/png" href="/logo.png">' . "\n";
  $html .= '<link rel="shortcut icon" href="/logo.png">' . "\n";
  $html .= '<link rel="apple-touch-icon" href="/logo.png">' . "\n";
  $html .= '<meta property="og:type" content="article">' . "\n";
  $html .= '<meta property="og:title" content="' . $metaTitle . '">' . "\n";
  $html .= '<meta property="og:description" content="' . $metaDesc . '">' . "\n";
  $html .= '<meta property="og:url" content="' . $postUrl . '">' . "\n";
  $html .= '<meta property="og:image" content="' . $SITE . '/logo.png">' . "\n";
  $html .= '<title>' . $metaTitle . '</title>' . "\n";

  // JSON-LD schema
  $bcItem1 = '{"@type":"ListItem","position":1,"name":"' . esc($u['home']) . '","item":"' . $homeUrl . '"}';
  $bcItem2 = '{"@type":"ListItem","position":2,"name":"' . esc($u['blogHome']) . '","item":"' . $blogIndexUrl . '"}';
  $bcItem3 = '{"@type":"ListItem","position":3,"name":"' . $title . '"}';
  $articleSchema = '{"@type":"Article","headline":"' . $title . '","description":"' . $metaDesc . '","author":{"@type":"Organization","name":"Antalya Korsan VIP Transfer"},"publisher":{"@type":"Organization","name":"Antalya Korsan VIP Transfer","logo":{"@type":"ImageObject","url":"' . $SITE . '/logo.png"}},"datePublished":"' . $date . '","dateModified":"' . $date . '","mainEntityOfPage":"' . $postUrl . '"}';
  $bcSchema = '{"@type":"BreadcrumbList","itemListElement":[' . $bcItem1 . ',' . $bcItem2 . ',' . $bcItem3 . ']}';
  $faqSchemaFull = '{"@type":"FAQPage","mainEntity":[' . $faqSchema . ']}';
  $graphSchema = '{"@context":"https://schema.org","@graph":[' . $articleSchema . ',' . $bcSchema . ',' . $faqSchemaFull . ']}';

  $html .= '<script type="application/ld+json">' . "\n" . $graphSchema . "\n" . '</script>' . "\n";
  $html .= '<link rel="stylesheet" href="/route.css">' . "\n";

  // Inline styles for blog
  $html .= '<style>' . "\n";
  $html .= '.lang-bar{position:fixed;top:16px;right:16px;z-index:10}' . "\n";
  $html .= '.lang-bar select{appearance:none;-webkit-appearance:none;background:#1c1d21;color:#fff;border:1px solid #333;border-radius:10px;padding:9px 34px 9px 14px;font:inherit;font-size:13px;font-weight:800;cursor:pointer;outline:none}' . "\n";
  $html .= '.lang-bar select:hover{border-color:#ffcc00}' . "\n";
  $html .= '.blog-meta{color:#a9a9ac;font-size:13px;margin:12px 0 32px;display:flex;gap:14px;align-items:center;flex-wrap:wrap}' . "\n";
  $html .= '.blog-meta .cat{background:#ffcc0018;color:#ffcc00;padding:4px 12px;border-radius:100px;font-weight:700;font-size:12px}' . "\n";
  $html .= '.blog-body{max-width:780px;font-size:16px;line-height:1.85}' . "\n";
  $html .= '.blog-body h2{font-size:clamp(22px,2.8vw,30px);margin:44px 0 16px}' . "\n";
  $html .= '.blog-body h3{font-size:19px;margin:32px 0 12px;color:#ffcc00}' . "\n";
  $html .= '.blog-body p{color:#d0d0d3;margin:0 0 20px}' . "\n";
  $html .= '.blog-body ul,.blog-body ol{color:#d0d0d3;padding-left:24px;margin:0 0 22px}' . "\n";
  $html .= '.blog-body li{margin-bottom:8px;line-height:1.75}' . "\n";
  $html .= '.blog-body strong{color:#fff}' . "\n";
  $html .= '.blog-body table{margin:26px 0}' . "\n";
  $html .= '.related-posts{margin-top:56px;padding-top:40px;border-top:1px solid #2c2d32}' . "\n";
  $html .= '.related-posts h3{color:#fff;font-size:20px;margin:0 0 20px}' . "\n";
  $html .= '.related-posts a{display:block;padding:16px 20px;background:#1b1c20;border:1px solid #2c2d32;border-radius:10px;margin-bottom:10px;font-weight:700;color:#fff}' . "\n";
  $html .= '.related-posts a:hover{border-color:#ffcc00;color:#ffcc00}' . "\n";
  $html .= '.blog-header{padding:60px 0 20px}' . "\n";
  $html .= '.blog-header h1{font-size:clamp(30px,4.5vw,48px);line-height:1.15;margin:0}' . "\n";
  $html .= '</style>' . "\n";
  $html .= '</head>' . "\n";
  $html .= '<body>' . "\n";

  $html .= '<div class="lang-bar"><select id="langSwitch" aria-label="Language">' . "\n";
  $html .= $langOptions;
  $html .= '</select></div>' . "\n";

  $html .= '<header><div class="wrap"><nav class="top">' . "\n";
  $html .= '<a href="/" class="brand"><img src="/logo.png" alt="Antalya Korsan"><span>ANTALYA <span>KORSAN</span></span></a>' . "\n";
  $html .= '<div class="links">' . "\n";
  $html .= '<a href="/#hizmetler">' . esc($u['services']) . '</a>' . "\n";
  $html .= '<a href="/#guzergahlar">' . esc($u['routes']) . '</a>' . "\n";
  $html .= '<a href="' . $blogIndexUrl . '">' . esc($u['blogHome']) . '</a>' . "\n";
  $html .= '<a href="/#sss">' . esc($u['faq']) . '</a>' . "\n";
  $html .= '<a class="btn" href="' . $hrefWa . '" target="_blank" rel="noopener">' . esc($u['priceBtn']) . '</a>' . "\n";
  $html .= '</div></nav></div></header>' . "\n";

  $html .= '<div class="wrap"><nav class="breadcrumb">' . "\n";
  $html .= '<a href="' . $homeUrl . '">' . esc($u['home']) . '</a><span>›</span>' . "\n";
  $html .= '<a href="' . $blogIndexUrl . '">' . esc($u['blogHome']) . '</a><span>›</span>' . "\n";
  $html .= '<strong style="color:#fff">' . $title . '</strong>' . "\n";
  $html .= '</nav></div>' . "\n";

  $html .= '<div class="blog-header"><div class="wrap">' . "\n";
  $html .= '<div class="eyebrow">' . esc($u['eyebrow']) . '</div>' . "\n";
  $html .= '<h1>' . $title . '</h1>' . "\n";
  $html .= '<div class="blog-meta"><span class="cat">' . $category . '</span><span>' . $date . '</span><span>' . esc($u['readTime']) . '</span></div>' . "\n";
  $html .= '</div></div>' . "\n";

  $html .= '<section style="padding:20px 0 60px"><div class="wrap"><div class="blog-body">' . "\n";
  $html .= $p['body'] . "\n";
  $html .= '<div class="related-posts"><h3>' . esc($u['otherPosts']) . '</h3>' . "\n";
  $html .= $relatedHtml;
  $html .= '</div></div></div></section>' . "\n";

  $html .= '<div class="cta"><div class="wrap">' . "\n";
  $html .= '<div><h2>' . esc($u['ctaTitle']) . '</h2><p>' . esc($u['ctaSub']) . '</p></div>' . "\n";
  $html .= '<a class="btn" href="' . $hrefWa . '" target="_blank" rel="noopener">' . esc($u['ctaBtn']) . '</a>' . "\n";
  $html .= '</div></div>' . "\n";

  $html .= '<footer><div class="wrap">' . "\n";
  $html .= '<span>© <span id="year">' . $YEAR . '</span> Antalya Korsan VIP Transfer</span>' . "\n";
  $html .= '<a href="/">antalyakorsan.com</a>' . "\n";
  $html .= '</div></footer>' . "\n";

  $html .= '<div class="floating-contact">' . "\n";
  $html .= '<a class="contact-phone" href="tel:+' . $WA . '" aria-label="Phone">📞</a>' . "\n";
  $html .= '<a class="contact-wa" href="' . $hrefWa . '" target="_blank" rel="noopener" aria-label="WhatsApp">💬</a>' . "\n";
  $html .= '</div>' . "\n";

  $html .= '<div class="mobile-cta-bar">' . "\n";
  $html .= '<a class="m-wa" href="' . $hrefWa . '" target="_blank" rel="noopener">💬 WhatsApp</a>' . "\n";
  $html .= '<a class="m-call" href="tel:+' . $WA . '">📞 ' . esc($u['priceBtn']) . '</a>' . "\n";
  $html .= '</div>' . "\n";

  $html .= '<script>' . "\n";
  $html .= 'document.getElementById("year").textContent=new Date().getFullYear();' . "\n";
  $html .= 'var langUrls = ' . $langUrlsJson . ';' . "\n";
  $html .= 'document.getElementById("langSwitch").addEventListener("change", function(e){' . "\n";
  $html .= '  var l = e.target.value;' . "\n";
  $html .= '  if (langUrls[l]) location.href = langUrls[l];' . "\n";
  $html .= '});' . "\n";
  $html .= 'document.addEventListener("click",function(e){var a=e.target.closest(\'a[href*="wa.me"]\');if(a&&typeof gtag===\'function\')gtag("event","generate_lead",{method:"whatsapp",page:"blog_post",lang:"' . $lang . '"});});' . "\n";
  $html .= '</script>' . "\n";

  $html .= '</body></html>';

  return $html;
}

/* ============================================================
   BUILD BLOG INDEX
   ============================================================ */

function build_blog_index($posts, $lang, $UI, $WA, $SITE, $YEAR, $LANGS) {
  $u = $UI[$lang];
  $blogIndexUrl = $SITE . blog_url($lang);
  $homeUrl = ($lang === 'tr') ? $SITE . '/' : $SITE . '/?lang=' . $lang;

  // hreflang
  $hreflang = '';
  foreach ($LANGS as $l) {
    $hreflang .= '<link rel="alternate" hreflang="' . $l . '" href="' . $SITE . blog_url($l) . '">' . "\n";
  }
  $hreflang .= '<link rel="alternate" hreflang="x-default" href="' . $SITE . '/blog/">' . "\n";

  // Language options
  $langOptions = '';
  foreach ($LANGS as $l) {
    $sel = ($l === $lang) ? ' selected' : '';
    $langOptions .= '<option value="' . $l . '"' . $sel . '>' . strtoupper($l) . '</option>' . "\n          ";
  }

  // Language switch URLs (JSON)
  $blogLinks = [];
  foreach ($LANGS as $l) {
    $blogLinks[$l] = blog_url($l);
  }
  $blogLinksJson = json_encode($blogLinks);

  // Post cards
  $cards = '';
  foreach ($posts as $slug => $post) {
    $p = $post[$lang];
    $cardUrl = blog_url($lang, $slug);
    $cards .= '<article class="blog-card"><div class="blog-card-body">';
    $cards .= '<span class="blog-card-cat">' . esc($p['cat']) . '</span>';
    $cards .= '<h3><a href="' . $cardUrl . '">' . esc($p['title']) . '</a></h3>';
    $cards .= '<p>' . esc($p['excerpt']) . '</p>';
    $cards .= '<a class="blog-card-read" href="' . $cardUrl . '">' . esc($u['readMore']) . '</a>';
    $cards .= '</div></article>' . "\n    ";
  }

  $hrefWa = wa_link($WA, $u['waMsg']);

  // HTML
  $html = '<!doctype html>' . "\n";
  $html .= '<html lang="' . $lang . '">' . "\n";
  $html .= '<head>' . "\n";
  $html .= '<meta charset="utf-8">' . "\n";
  $html .= '<script>' . "\n";
  $html .= 'window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}' . "\n";
  $html .= "gtag('consent','default',{analytics_storage:'denied',ad_storage:'denied',ad_user_data:'denied',ad_personalization:'denied',wait_for_update:500});\n";
  $html .= '</script>' . "\n";
  $html .= '<script async src="https://www.googletagmanager.com/gtag/js?id=G-L5YM12ZQ63"></script>' . "\n";
  $html .= "<script>gtag('js',new Date());gtag('config','G-L5YM12ZQ63');gtag('config','G-eqCMz7r5gdEPzEoexE');</script>\n";
  $html .= '<meta name="viewport" content="width=device-width,initial-scale=1">' . "\n";
  $html .= '<meta name="theme-color" content="#101114">' . "\n";
  $html .= '<meta name="description" content="' . esc($u['blogSubtitle']) . '">' . "\n";
  $html .= '<meta name="robots" content="index,follow">' . "\n";
  $html .= '<link rel="canonical" href="' . $blogIndexUrl . '">' . "\n";
  $html .= $hreflang;
  $html .= '<link rel="icon" type="image/png" href="/logo.png">' . "\n";
  $html .= '<link rel="shortcut icon" href="/logo.png">' . "\n";
  $html .= '<meta property="og:type" content="website">' . "\n";
  $html .= '<meta property="og:title" content="' . esc($u['blogTitle']) . '">' . "\n";
  $html .= '<meta property="og:description" content="' . esc($u['blogSubtitle']) . '">' . "\n";
  $html .= '<meta property="og:url" content="' . $blogIndexUrl . '">' . "\n";
  $html .= '<title>' . esc($u['blogTitle']) . ' | Antalya Korsan</title>' . "\n";
  $html .= '<link rel="stylesheet" href="/route.css">' . "\n";

  $html .= '<style>' . "\n";
  $html .= '.lang-bar{position:fixed;top:16px;right:16px;z-index:10}' . "\n";
  $html .= '.lang-bar select{appearance:none;-webkit-appearance:none;background:#1c1d21;color:#fff;border:1px solid #333;border-radius:10px;padding:9px 34px 9px 14px;font:inherit;font-size:13px;font-weight:800;cursor:pointer;outline:none}' . "\n";
  $html .= '.lang-bar select:hover{border-color:#ffcc00}' . "\n";
  $html .= '.blog-hero{padding:70px 0 40px;text-align:center}' . "\n";
  $html .= '.blog-hero h1{font-size:clamp(32px,5vw,52px);line-height:1.15;margin:18px 0;max-width:800px;margin-left:auto;margin-right:auto}' . "\n";
  $html .= '.blog-hero p{color:#c6c6ca;font-size:17px;max-width:640px;margin:0 auto;line-height:1.75}' . "\n";
  $html .= '.blog-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px;margin-top:48px}' . "\n";
  $html .= '@media(max-width:980px){.blog-grid{grid-template-columns:repeat(2,1fr)}}' . "\n";
  $html .= '@media(max-width:640px){.blog-grid{grid-template-columns:1fr}}' . "\n";
  $html .= '.blog-card{background:#1b1c20;border:1px solid #2c2d32;border-radius:14px;transition:transform .25s,border-color .25s}' . "\n";
  $html .= '.blog-card:hover{transform:translateY(-4px);border-color:#ffcc0080}' . "\n";
  $html .= '.blog-card-body{padding:26px}' . "\n";
  $html .= '.blog-card-cat{display:inline-block;background:#ffcc0018;color:#ffcc00;padding:4px 12px;border-radius:100px;font-size:11px;font-weight:800;margin-bottom:14px;text-transform:uppercase}' . "\n";
  $html .= '.blog-card h3{margin:0 0 12px;font-size:19px;line-height:1.35}' . "\n";
  $html .= '.blog-card h3 a{color:#fff}' . "\n";
  $html .= '.blog-card h3 a:hover{color:#ffcc00}' . "\n";
  $html .= '.blog-card p{color:#b4b4b9;font-size:14px;line-height:1.7;margin:0 0 18px}' . "\n";
  $html .= '.blog-card-read{color:#ffcc00;font-weight:800;font-size:13px}' . "\n";
  $html .= '</style>' . "\n";
  $html .= '</head>' . "\n";
  $html .= '<body>' . "\n";

  $html .= '<div class="lang-bar"><select id="langSwitch" aria-label="Language">' . "\n";
  $html .= $langOptions;
  $html .= '</select></div>' . "\n";

  $html .= '<header><div class="wrap"><nav class="top">' . "\n";
  $html .= '<a href="/" class="brand"><img src="/logo.png" alt="Antalya Korsan"><span>ANTALYA <span>KORSAN</span></span></a>' . "\n";
  $html .= '<div class="links">' . "\n";
  $html .= '<a href="/#hizmetler">' . esc($u['services']) . '</a>' . "\n";
  $html .= '<a href="/#guzergahlar">' . esc($u['routes']) . '</a>' . "\n";
  $html .= '<a href="' . $SITE . blog_url($lang) . '">' . esc($u['blogHome']) . '</a>' . "\n";
  $html .= '<a href="/#sss">' . esc($u['faq']) . '</a>' . "\n";
  $html .= '<a class="btn" href="' . $hrefWa . '" target="_blank" rel="noopener">' . esc($u['priceBtn']) . '</a>' . "\n";
  $html .= '</div></nav></div></header>' . "\n";

  $html .= '<div class="wrap"><nav class="breadcrumb">' . "\n";
  $html .= '<a href="' . $homeUrl . '">' . esc($u['home']) . '</a><span>›</span>' . "\n";
  $html .= '<strong style="color:#fff">' . esc($u['blogHome']) . '</strong>' . "\n";
  $html .= '</nav></div>' . "\n";

  $html .= '<section class="blog-hero"><div class="wrap">' . "\n";
  $html .= '<div class="eyebrow">' . esc($u['eyebrow']) . '</div>' . "\n";
  $html .= '<h1>' . esc($u['blogTitle']) . '</h1>' . "\n";
  $html .= '<p>' . esc($u['blogSubtitle']) . '</p>' . "\n";
  $html .= '</div></section>' . "\n";

  $html .= '<section style="padding:20px 0 80px"><div class="wrap"><div class="blog-grid">' . "\n";
  $html .= $cards;
  $html .= '</div></div></section>' . "\n";

  $html .= '<div class="cta"><div class="wrap">' . "\n";
  $html .= '<div><h2>' . esc($u['ctaTitle']) . '</h2><p>' . esc($u['ctaSub']) . '</p></div>' . "\n";
  $html .= '<a class="btn" href="' . $hrefWa . '" target="_blank" rel="noopener">' . esc($u['ctaBtn']) . '</a>' . "\n";
  $html .= '</div></div>' . "\n";

  $html .= '<footer><div class="wrap">' . "\n";
  $html .= '<span>© <span id="year">' . $YEAR . '</span> Antalya Korsan VIP Transfer</span>' . "\n";
  $html .= '<a href="/">antalyakorsan.com</a>' . "\n";
  $html .= '</div></footer>' . "\n";

  $html .= '<div class="floating-contact">' . "\n";
  $html .= '<a class="contact-phone" href="tel:+' . $WA . '" aria-label="Phone">📞</a>' . "\n";
  $html .= '<a class="contact-wa" href="' . $hrefWa . '" target="_blank" rel="noopener" aria-label="WhatsApp">💬</a>' . "\n";
  $html .= '</div>' . "\n";

  $html .= '<div class="mobile-cta-bar">' . "\n";
  $html .= '<a class="m-wa" href="' . $hrefWa . '" target="_blank" rel="noopener">💬 WhatsApp</a>' . "\n";
  $html .= '<a class="m-call" href="tel:+' . $WA . '">📞 ' . esc($u['priceBtn']) . '</a>' . "\n";
  $html .= '</div>' . "\n";

  $html .= '<script>' . "\n";
  $html .= 'document.getElementById("year").textContent=new Date().getFullYear();' . "\n";
  $html .= 'var blogLinks = ' . $blogLinksJson . ';' . "\n";
  $html .= 'document.getElementById("langSwitch").addEventListener("change", function(e){' . "\n";
  $html .= '  var l = e.target.value;' . "\n";
  $html .= '  if (blogLinks[l]) location.href = blogLinks[l];' . "\n";
  $html .= '});' . "\n";
  $html .= '</script>' . "\n";

  $html .= '</body></html>';

  return $html;
}

/* ============================================================
   RUN
   ============================================================ */

$blogDir = __DIR__ . '/blog';
if (!is_dir($blogDir)) {
  mkdir($blogDir, 0755, true);
}

$written = 0;
$errors = [];

foreach ($LANGS as $lang) {
  $targetDir = ($lang === 'tr') ? $blogDir : $blogDir . '/' . $lang;
  if (!is_dir($targetDir)) {
    mkdir($targetDir, 0755, true);
  }

  // Blog index
  $indexHtml = build_blog_index($posts, $lang, $UI, $WA, $SITE, $YEAR, $LANGS);
  if (file_put_contents($targetDir . '/index.html', $indexHtml) === false) {
    $errors[] = "$lang/index";
  } else {
    $written++;
  }

  // Posts
  foreach ($posts as $slug => $post) {
    $pageHtml = build_post_page($slug, $post, $lang, $posts, $UI, $WA, $SITE, $YEAR, $LANGS);
    if (file_put_contents($targetDir . '/' . $slug . '.html', $pageHtml) === false) {
      $errors[] = "$lang/$slug";
    } else {
      $written++;
    }
  }
}

/* CLI output */
if (php_sapi_name() === 'cli') {
  echo "✓ Generated {$written} files in /blog/ across 4 languages\n";
  if ($errors) {
    echo "Errors: " . implode(', ', $errors) . "\n";
  }
  echo "\nFiles generated:\n";
  foreach ($LANGS as $lang) {
    $path = ($lang === 'tr') ? '/blog/' : "/blog/{$lang}/";
    echo "  {$path}index.html\n";
    foreach (array_keys($posts) as $slug) {
      echo "  {$path}{$slug}.html\n";
    }
  }
  echo "\nNow add to sitemap.xml:\n";
  foreach ($LANGS as $lang) {
    echo "  " . $SITE . blog_url($lang) . "\n";
    foreach (array_keys($posts) as $slug) {
      echo "  " . $SITE . blog_url($lang, $slug) . "\n";
    }
  }
  echo "\nThen DELETE build-blog.php.\n";
  exit;
}
?><!doctype html>
<html lang="tr"><head><meta charset="utf-8"><title>Blog Build</title>
<style>body{font-family:system-ui;background:#101114;color:#fff;padding:40px;max-width:900px;margin:auto}
h1{color:#ffcc00}a{color:#ffcc00}pre{background:#1b1c20;padding:16px;border-radius:8px;overflow:auto;font-size:12px}</style>
</head><body>
<h1>✓ Generated <?= $written ?> blog files</h1>
<p>Files written to <code>/blog/</code> in TR, EN, DE, RU. Now delete <code>build-blog.php</code>.</p>
<?php if ($errors): ?><p style="color:#ff6b6b">Errors: <?= implode(', ', $errors) ?></p><?php endif; ?>
<p><strong>Add these URLs to sitemap.xml:</strong></p>
<pre><?php
foreach ($LANGS as $lang) {
  echo $SITE . blog_url($lang) . "\n";
  foreach (array_keys($posts) as $slug) {
    echo $SITE . blog_url($lang, $slug) . "\n";
  }
}
?></pre>
<p><a href="/blog/">→ TR blog</a> | <a href="/blog/en/">EN</a> | <a href="/blog/de/">DE</a> | <a href="/blog/ru/">RU</a></p>
</body></html>