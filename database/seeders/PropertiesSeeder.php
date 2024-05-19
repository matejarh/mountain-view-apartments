<?php

namespace Database\Seeders;

use App\Models\Facility;
use App\Models\Property;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $properties = Property::all();
        foreach ($properties as $key => $property) {
            foreach (Facility::get() as $key => $facility) {
                $facility->properties()->attach($property);
            }
        }
    }

    private function nassfeld(): array
    {

        return [
            "user_id" => 1,
            "type" => "One-Bedroom Apartment",
            "slug" => "nassfeld-and-lake-apartment",
            "name" => "Nassfeld and Lake Apartment",
            "address" => "61 Neudorf 1, 9620 Hermagor, Austria",
            "title" => [
                "cs" => "Nassfeld and Lake Apartment",
                "de" => "Nassfeld and Lake Apartment",
                "en" => "Nassfeld and Lake Apartment",
                "fr" => "Nassfeld and Lake Apartment",
                "hu" => "Nassfeld and Lake Apartment",
                "it" => "Nassfeld and Lake Apartment",
                "sl" => "Nassfeld and Lake Apartment",
            ],
            "description" => [
                "cs" => "Nabízející zahradu, apartmán Nassfeld and Lake poskytuje ubytování v Hermagoru. Tento objekt nabízí přístup na balkon a bezplatné soukromé parkoviště. Ubytování zajišťuje soukromé ubytování a odhlášení a parkování pro kola pro hosty.",
                "de" => "Mit einem Garten erwartet Sie das Nassfeld and Lake Apartment in Hermagor. Diese Unterkunft bietet Zugang zu einem Balkon und kostenfreie private Parkplätze. Die Unterkunft bietet einen privaten Check-in und Check-out sowie Fahrradparkplätze für die Gäste.",
                "en" => "Featuring a garden, Nassfeld and Lake Apartment offers accommodations in Hermagor. This property offers access to a balcony and free private parking. The accommodation provides private check-in and check-out and bicycle parking for guests.",
                "fr" => "Doté d'un jardin, le Nassfeld and Lake Apartment propose des hébergements à Hermagor. Cet établissement offre l'accès à un balcon et un parking privé gratuit. L'hébergement propose un enregistrement et un départ privés ainsi qu'un parking à vélos pour les clients.",
                "hu" => "A Nassfeld and Lake Apartment kerttel várja vendégeit Hermagorban. A szálláshely teraszhoz és ingyenes privát parkolási lehetőséghez biztosít hozzáférést. A szálláshely magáncsekkolást és kijelentkezést kínál, valamint biciklitárolót a vendégek számára.",
                "it" => "Dotato di giardino, il Nassfeld and Lake Apartment offre sistemazioni a Hermagor. Questa struttura offre l'accesso a un balcone e un parcheggio privato gratuito. L'alloggio fornisce check-in e check-out privati e parcheggio per biciclette per gli ospiti.",
                "sl" => "S svojim vrtom ponuja apartma Nassfeld and Lake namestitev v kraju Hermagor. Ta nastanitev nudi dostop do balkona in brezplačnega zasebnega parkirišča. Nastanitev nudi tudi možnost zasebnega prijave in odjave ter parkirišče za kolesa za goste.",
            ],
            "quote" => [
                "cs" => "Rakouská Korutanská je nádherná země.",
                "de" => "Österreichisch Kärnten ist ein wundervolles Land.",
                "en" => "Austrian Carinthia is a wonderful land.",
                "fr" => "La Carinthie autrichienne est une terre merveilleuse.",
                "hu" => "Az osztrák Károlyi a csodálatos föld.",
                "it" => "La Carinzia austriaca è una terra meravigliosa.",
                "sl" => "Avstrijska Koroška je čudovita dežela.",
            ],
            "long_description" => [
                "cs" => "Nabízející zahradu, apartmán Nassfeld and Lake poskytuje ubytování v Hermagoru. Tento objekt nabízí přístup na balkon a bezplatné soukromé parkoviště. Ubytování zajišťuje soukromé ubytování a odhlášení a parkování pro kola pro hosty.",
                "de" => "Mit einem Garten erwartet Sie das Nassfeld and Lake Apartment in Hermagor. Diese Unterkunft bietet Zugang zu einem Balkon und kostenfreie private Parkplätze. Die Unterkunft bietet einen privaten Check-in und Check-out sowie Fahrradparkplätze für die Gäste.",
                "en" => "<p>Featuring a garden, <strong>Nassfeld and Lake Apartment </strong>offers accommodations in <strong>Hermagor</strong>. This property offers access to a balcony and free private parking.</p><p>The accommodation provides private check-in and check-out and bicycle parking for guests. Offering a terrace and mountain views, the apartment includes 1 bedroom, a living room, cable flat-screen TV, an equipped kitchen, and 1 bathroom with a bath. </p><p>This apartment also has a patio that doubles up as an outdoor dining area. The apartment offers bed linen, towels, and ironing service. For guests with children, the apartment features outdoor play equipment. Ski storage space is available on-site and skiing can be enjoyed close to <strong>Nassfeld and Lake Apartment</strong>. </p><p><strong>Porcia Castle</strong> is 30 miles from the accommodation, while <strong>Lake Pressegger</strong> is 5 miles from the property. The nearest airport is Klagenfurt Airport, 54 miles from Nassfeld and Lake Apartment. </p><p><em>Distance in property description is calculated using © OpenStreetMap</em></p>",
                "fr" => "Doté d'un jardin, le Nassfeld and Lake Apartment propose des hébergements à Hermagor. Cet établissement offre l'accès à un balcon et un parking privé gratuit. L'hébergement propose un enregistrement et un départ privés ainsi qu'un parking à vélos pour les clients.",
                "hu" => "A Nassfeld and Lake Apartment kerttel várja vendégeit Hermagorban. A szálláshely teraszhoz és ingyenes privát parkolási lehetőséghez biztosít hozzáférést. A szálláshely magáncsekkolást és kijelentkezést kínál, valamint biciklitárolót a vendégek számára.",
                "it" => "Dotato di giardino, il Nassfeld and Lake Apartment offre sistemazioni a Hermagor. Questa struttura offre l'accesso a un balcone e un parcheggio privato gratuito. L'alloggio fornisce check-in e check-out privati e parcheggio per biciclette per gli ospiti.",
                "sl" => "<p>Nastanitev Nassfeld and Lake Apartment se nahaja približno 47 km od znamenitosti skakalnica Villacher Alpenarena in ponuja razgled na vrt, balkon ter aparat za kavo. </p><p>Nastanitev je 28 km od znamenitosti <strong>Terra Mystica Mine </strong>in nudi vrt ter brezplačno zasebno parkirišče. </p><p>Apartma s teraso in pogledom na gore ima spalnico (1), dnevno sobo, TV z ravnim zaslonom, opremljeno kuhinjo s hladilnikom in s pečico ter kopalnico (1) s kadjo. V apartmaju lahko koristite brisače in posteljnino. V sklopu nastanitve je na voljo otroško igrišče, v bližini pa se lahko podate na smučanje. </p><p>Znamenitost <strong>Porcia Castle</strong> je od nastanitve <strong>Nassfeld and Lake Apartment</strong> oddaljena 49 km. Najbližje letališče (<strong>Letališče Celovec</strong>) je 87 km od nastanitve <strong>Nassfeld and Lake Apartment</strong>. </p><p><em>Razdalja v opisu nastanitve je izračunana z © OpenStreetMap.</em></p>",
            ],
            "keywords" => [
                "en" => "Nassfeld and Lake Apartment, Hermagor, garden, balcony, private parking, private check-in, private check-out, bicycle parking, terrace, mountain views, 1 bedroom, living room, cable flat-screen TV, equipped kitchen, 1 bathroom, bath, patio, outdoor dining area, bed linen, towels, ironing service, outdoor play equipment, ski storage space, skiing, Porcia Castle, Lake Pressegger, Klagenfurt Airport",
                "cs" => "Apartmán Nassfeld a jezero, Hermagor, zahrada, balkon, soukromé parkoviště, soukromé ubytování, soukromé odhlášení, parkoviště pro kola, terasa, výhled na hory, 1 ložnice, obývací pokoj, kabelová TV s plochou obrazovkou, vybavená kuchyň, 1 koupelna, vana, terasa, venkovní jídelní prostor, povlečení, ručníky, žehlení, venkovní herní vybavení, úložný prostor na lyže, lyžování, hrad Porcia, jezero Pressegger, letiště Klagenfurt",
                "de" => "Nassfeld und Seewohnung, Hermagor, Garten, Balkon, privater Parkplatz, privater Check-in, privater Check-out, Fahrradparkplatz, Terrasse, Bergblick, 1 Schlafzimmer, Wohnzimmer, Kabel-Flachbild-TV, ausgestattete Küche, 1 Badezimmer, Badewanne, Terrasse, Essbereich im Freien, Bettwäsche, Handtücher, Bügelservice, Spielgeräte im Freien, Skiaufbewahrung, Skifahren, Schloss Porcia, Pressegger See, Flughafen Klagenfurt",
                "fr" => "Appartement Nassfeld et lac, Hermagor, jardin, balcon, parking privé, check-in privé, check-out privé, parking pour vélos, terrasse, vue sur la montagne, 1 chambre, salon, télévision à écran plat par câble, cuisine équipée, 1 salle de bains, baignoire, terrasse, coin repas extérieur, linge de lit, serviettes, service de repassage, équipement de jeu extérieur, local à skis, ski, château de Porcia, lac Pressegger, aéroport de Klagenfurt",
                "hu" => "Nassfeld és Tó Apartman, Hermagor, kert, erkély, saját parkoló, saját bejelentkezés, saját kijelentkezés, kerékpártároló, terasz, hegyre néző kilátás, 1 hálószoba, nappali, síkképernyős kábel TV, felszerelt konyha, 1 fürdőszoba, fürdőkád, terasz, kültéri étkezőhely, ágynemű, törölközők, vasalási szolgáltatás, kültéri játékeszközök, síeléssel kapcsolatos tárolóhely, síelés, Porcia kastély, Pressegger-tó, Klagenfurti repülőtér",
                "it" => "Appartamento Nassfeld e lago, Hermagor, giardino, balcone, parcheggio privato, check-in privato, check-out privato, parcheggio per biciclette, terrazza, vista sulle montagne, 1 camera da letto, soggiorno, TV via cavo a schermo piatto, cucina attrezzata, 1 bagno, vasca, patio, area pranzo all'aperto, biancheria da letto, asciugamani, servizio di stiratura, attrezzature da gioco all'aperto, spazio di archiviazione per sci, sci, Castello di Porcia, Lago di Pressegger, Aeroporto di Klagenfurt",
                "sl" => "Apartma Nassfeld in jezerski apartma, Hermagor, vrt, balkon, zasebno parkirišče, zasebno prijava, zasebna odjava, parkirišče za kolesa, terasa, razgled na gore, 1 spalnica, dnevna soba, kabelska televizija z ravnim zaslonom, opremljena kuhinja, 1 kopalnica, kopalna kad, terasa, jedilnica na prostem, posteljnina, brisače, storitev likanja, oprema za igro na prostem, shramba za smučarsko opremo, smučanje, Grad Porcia, jezero Pressegger, Letališče Klagenfurt",
            ],
            "size" => "50",
            "is_entire_apartment" => true,
            "coordinates" => [
                "lat" => "46.618689",
                "lng" => "13.3809776",
            ],
            "bed_types" => [
                [
                    "icon" => "QueenBedIcon",
                    "name" => "1 queen bed",
                    "title" => "bedroom",
                ],
                [
                    "icon" => "SofaBedIcon",
                    "name" => "1 sofa bed",
                    "title" => "living_room",
                ],
            ],
            "recomended" => [
                "for 4 adults",
            ],
            "prices" => [
                [
                    "price" => "945",
                    "guests" => 4,
                ],
                [
                    "price" => "883",
                    "guests" => 3,
                ],
                [
                    "price" => "846",
                    "guests" => 2,
                ],
                [
                    "price" => "810",
                    "guests" => 1,
                ],
            ],
            "rules" => $this->rules(),
        ];

    }
    private function twoAngels(): array
    {
        return [
            "user_id" => 1,
            "type" => "Two-Bedroom Apartment",
            "slug" => "apartment-two-angels",
            "name" => "Apartment Two Angels",
            "address" => "Zgornje gorje 26/A, 4247 Bled, Slovenija",
            "title" => [
                "cs" => "Apartment Two Angels",
                "de" => "Apartment Two Angels",
                "en" => "Apartment Two Angels",
                "fr" => "Apartment Two Angels",
                "hu" => "Apartment Two Angels",
                "it" => "Apartment Two Angels",
                "sl" => "Apartment Two Angels",
            ],
            "keywords" => [
                "en" => "Two Angels, Bled, Gorenjska region, Bled Island, free Wi-Fi, children's playground, garden, free private parking, balcony, city views, kitchen, fridge, hob, private bathroom, shower, air-conditioned, seating area, dining area, sun terrace, cycling, Bled Castle, Bled Sports Hall, Jože Pučnik - Ljubljana Airport",
                "cs" => "Two Angels, Bled, region Gorenjska, Bledský ostrov, zdarma Wi-Fi, dětské hřiště, zahrada, bezplatné soukromé parkoviště, balkon, výhled na město, kuchyň, lednička, vařič, soukromá koupelna, sprcha, klimatizace, posezení, jídelní kout, sluneční terasa, cyklistika, Bledský hrad, Sportovní hala Bled, Letiště Jožeta Pučnika - Lublaň",
                "de" => "Two Angels, Bled, Region Gorenjska, Bled Island, kostenloses WLAN, Kinderspielplatz, Garten, kostenfreies privates Parken, Balkon, Stadtblick, Küche, Kühlschrank, Herd, eigenes Badezimmer, Dusche, klimatisiert, Sitzbereich, Essbereich, Sonnenterrasse, Radfahren, Burg Bled, Sportzentrum Bled, Flughafen Jože Pučnik - Ljubljana",
                "fr" => "Two Angels, Bled, région de Gorenjska, île de Bled, Wi-Fi gratuit, aire de jeux pour enfants, jardin, parking privé gratuit, balcon, vue sur la ville, cuisine, réfrigérateur, plaques de cuisson, salle de bains privative, douche, climatisé, coin salon, coin repas, terrasse ensoleillée, cyclisme, château de Bled, salle de sport de Bled, aéroport Jože Pučnik - Ljubljana",
                "hu" => "Two Angels, Bled, Gorenjska régió, Bled-sziget, ingyenes Wi-Fi, gyermekjátszótér, kert, ingyenes saját parkoló, erkély, városi kilátás, konyha, hűtőszekrény, főzőlap, saját fürdőszoba, zuhanyzó, légkondicionált, ülősarok, étkező sarok, napozóterasz, kerékpározás, Bledi vár, Bledi Sportcsarnok, Jože Pučnik - Ljubljana repülőtér",
                "it" => "Two Angels, Bled, regione di Gorenjska, Isola di Bled, Wi-Fi gratuito, parco giochi per bambini, giardino, parcheggio privato gratuito, balcone, vista sulla città, cucina, frigorifero, piano cottura, bagno privato, doccia, aria condizionata, area salotto, zona pranzo, terrazza solarium, ciclismo, Castello di Bled, Palazzetto dello Sport di Bled, Aeroporto Jože Pučnik - Lubiana",
                "sl" => "Two Angels, Bled, regija Gorenjska, Bledski otok, brezplačen Wi-Fi, otroško igrišče, vrt, brezplačno zasebno parkirišče, balkon, pogled na mesto, kuhinja, hladilnik, kuhalna plošča, lastna kopalnica, tuš, klimatizirano, sedežni kot, jedilni kot, sončna terasa, kolesarjenje, Blejski grad, Športna dvorana Bled, Letališče Jožeta Pučnika - Ljubljana",
            ],
            "description" => [
                "en" => "Two Angels accommodation is located in Bled in the Gorenjska region, 3.6 km from the landmark Bled Island, and offers free WiFi, a children's playground, garden, and free private parking.",
                "cs" => "Ubytování Two Angels se nachází v Bledu v regionu Gorenjska, 3,6 km od památky Blejský ostrov, a nabízí zdarma WiFi, dětské hřiště, zahradu a zdarma soukromé parkoviště.",
                "de" => "Die Unterkunft Two Angels befindet sich in Bled in der Region Gorenjska, 3,6 km von der Sehenswürdigkeit Blejski otok entfernt, und bietet kostenloses WLAN, einen Kinderspielplatz, einen Garten und kostenfreie Privatparkplätze.",
                "fr" => "L'hébergement Two Angels est situé à Bled dans la région de Gorenjska, à 3,6 km du célèbre Blejski otok, et propose une connexion Wi-Fi gratuite, un aire de jeux pour enfants, un jardin et un parking privé gratuit.",
                "hu" => "A Two Angels szállás Bledben, a Gorenjska régióban található, 3,6 km-re a Blejski otok jellegzetességétől, ingyenes wifivel, játszótérrel, kerttel és ingyenes privát parkolóval.",
                "it" => "L'alloggio Two Angels si trova a Bled nella regione di Gorenjska, a 3,6 km dal simbolo dell'Isola di Bled, e offre connessione Wi-Fi gratuita, parco giochi per bambini, giardino e parcheggio privato gratuito.",
                "sl" => "Nastanitev Two Angels se nahaja na Bledu v regiji Gorenjska, 3,6 km od znamenitosti Blejski otok, in ponuja brezplačen WiFi, otroško igrišče, vrt ter brezplačno zasebno parkirišče.",
            ],
            "long_description" => [
                "cs" => "Two Angels se nachází v Bledu v regionu Gorenjska, 3,6 km od atrakce Bledský ostrov. Nabízí bezplatné Wi-Fi, dětské hřiště, zahradu a bezplatné soukromé parkoviště. Všechny jednotky mají balkon s výhledem na město, kuchyň s lednicí a vařičem a vlastní koupelnu se sprchovým koutem. Všechny jednotky jsou klimatizované a mají posezení a/nebo jídelní kout. Hosté mohou relaxovat na sluneční terase nebo se v okolí věnovat cyklistice. Hrad Bled je od ubytování Two Angels vzdálen 3,9 km a Sportovní hala Bled je 4,8 km. Nejbližším letištěm je Letiště Jožeta Pučnika - Lublaň, které je od ubytování Two Angels vzdáleno 38 km. Vzdálenosti v popisu ubytování jsou vypočítány dle © OpenStreetMap.",
                "en" => "Two Angels is located in Bled in the Gorenjska region, 3.6 km from the Bled Island attraction. It offers free Wi-Fi, a children's playground, a garden, and free private parking. All units feature a balcony with city views, a kitchen with a fridge and hob, and a private bathroom with a shower. All units are air-conditioned and include a seating and/or dining area. Guests can relax on the sun terrace or enjoy cycling in the surrounding area. Bled Castle is 3.9 km from Two Angels, while Bled Sports Hall is 4.8 km away. The nearest airport is Jože Pučnik - Ljubljana Airport, 38 km from Two Angels. Distances in the accommodation description are calculated by © OpenStreetMap.",
                "de" => "Die Unterkunft Two Angels befindet sich in Bled in der Region Gorenjska, 3,6 km von der Sehenswürdigkeit Bleder Insel entfernt. Es bietet kostenloses WLAN, einen Kinderspielplatz, einen Garten und kostenfreie Privatparkplätze. Alle Unterkünfte verfügen über einen Balkon mit Stadtblick, eine Küche mit Kühlschrank und Kochfeld sowie ein eigenes Bad mit Dusche. Alle Unterkünfte sind klimatisiert und bieten einen Sitz- und/oder Essbereich. Entspannen Sie auf der Sonnenterrasse der Unterkunft oder erkunden Sie die Umgebung beim Radfahren. Die Burg Bled liegt 3,9 km von der Unterkunft Two Angels entfernt und die Bleder Sporthalle erreichen Sie nach 4,8 km. Der nächste Flughafen (Flughafen Ljubljana-Jože-Pučnik) liegt 38 km von der Unterkunft Two Angels entfernt. Die Entfernungen in der Beschreibung zur Unterkunft werden von © OpenStreetMap berechnet.",
                "fr" => "L'établissement Two Angels est situé à Bled, dans la région de la Gorenjska, à 3,6 km de l'île de Bled. Il propose une connexion Wi-Fi gratuite, une aire de jeux pour enfants, un jardin et un parking privé gratuit. Toutes les unités comprennent un balcon avec vue sur la ville, une cuisine équipée d'un réfrigérateur et de plaques de cuisson ainsi qu'une salle de bains privative pourvue d'une douche. Toutes les unités sont climatisées et disposent d'un coin salon et/ou repas. Vous pourrez vous détendre sur la terrasse bien exposée de l'établissement ou partir en randonnée à vélo dans les environs. Le château de Bled se trouve à 3,9 km du Two Angels, tandis que la salle omnisports de Bled est à 4,8 km. L'aéroport le plus proche, celui de Ljubljana-Jože-Pučnik, est implanté à 38 km. Les distances sont calculées à vol d'oiseau. © OpenStreetMap",
                "hu" => "A Two Angels szállás Bledben, a Gorenjska régióban található, 3,6 km-re a Bledi-sziget nevezetességétől. A szálláshely ingyenes WiFit, játszóteret, kertet és ingyenes privát parkolást kínál. Az összes egység erkéllyel, városra néző kilátással, hűtőszekrénnyel és főzőlappal felszerelt konyhával, valamint saját fürdőszobával zuhanyzóval rendelkezik. Az összes egység légkondicionált, és ülősarokkal/játszóhelyiséggel ellátott. A szálláshely teraszon pihenhet, a környéken pedig biciklizhet. A Bledi vár 3,9 km-re, a Bledi Sportcsarnok pedig 4,8 km-re található a Two Angels szállástól. A legközelebbi repülőtér (Ljubljana - Jože Pučnik repülőtér) 38 km-re helyezkedik el a Two Angels szállástól. A szállás leírásában szereplő távolságokat az OpenStreetMap alapján számoltuk ki.",
                "it" => "La struttura Two Angels si trova a Bled, nella regione della Gorenjska, a 3,6 km dall'Isola di Bled. Offre gratuitamente la connessione WiFi, un parco giochi per bambini, un giardino e un parcheggio privato gratuito. Tutte le unità abitative presentano un balcone con vista sulla città, una cucina con frigorifero e piano cottura e un bagno privato con doccia. Tutte le unità sono climatizzate e dispongono di area salotto e/o zona pranzo. Potrete rilassarvi sulla terrazza solarium della struttura o praticare il ciclismo nei dintorni. Il Castello di Bled si trova a 3,9 km dal Two Angels, mentre il Palazzetto dello Sport di Bled dista 4,8 km. L'aeroporto più vicino è quello di Lubiana-Jože Pučnik, a 38 km dalla struttura. Le distanze sono calcolate in linea retta. © OpenStreetMap",
                "sl" => "Nastanitev Two Angels se nahaja na Bledu v regiji Gorenjska, 3,6 km od znamenitosti Blejski otok, in ponuja brezplačen WiFi, otroško igrišče, vrt ter brezplačno zasebno parkirišče. Vse enote nudijo balkon s pogledom na mesto, kuhinjo s hladilnikom in s kuhalno ploščo ter zasebno kopalnico s prho. Vse enote so klimatizirane in vključujejo prostor za sedenje in/ali jedilni predel. V sklopu nastanitve se lahko sprostite na terasi za sončenje, v bližini pa uživate v kolesarjenju. Znamenitost Blejski grad je 3,9 km od nastanitve Two Angels, znamenitost Športna dvorana Bled pa je 4,8 km stran. Najbližje letališče (Letališče Jožeta Pučnika - Ljubljana) je 38 km od nastanitve Two Angels.Razdalja v opisu nastanitve je izračunana z © OpenStreetMap.",
            ],
            "quote" => [
                "cs" => "Dechberoucí výhled na Bledské jezero z tohoto útulného apartmánu udělá váš pobyt opravdu nezapomenutelným. Díky své výhodné poloze poblíž centra města a atrakcí jako je Bledský hrad a ostrov, budete mít všechno, co potřebujete pro dokonalý útěk. Relaxujte na balkoně s sklenicí místního vína nebo objevujte okouzlující uličky Bledu. Rezervujte si svůj pobyt hned teď a zažijte krásu Bledu na vlastní kůži!",
                "de" => "Die atemberaubende Aussicht auf den Bleder See von diesem gemütlichen Apartment aus wird Ihren Aufenthalt unvergesslich machen. Dank seiner günstigen Lage in der Nähe des Stadtzentrums und Attraktionen wie dem Bleder Schloss und der Insel haben Sie alles, was Sie für einen perfekten Kurzurlaub brauchen. Entspannen Sie auf dem Balkon mit einem Glas lokalem Wein oder erkunden Sie die charmanten Straßen von Bled. Buchen Sie jetzt Ihren Aufenthalt und erleben Sie die Schönheit von Bled aus erster Hand!",
                "sl" => "Osupljiv pogled na Blejsko jezero iz tega udobnega apartmaja bo vaše bivanje resnično nepozabno. Zaradi svoje ugodne lokacije blizu mestnega središča in znamenitosti, kot sta Blejski grad in otok, boste imeli vse, kar potrebujete za popolno pobeg. Sprostite se na balkonu s kozarcem lokalnega vina ali raziskujte očarljive ulice Bleda. Rezervirajte svoje bivanje zdaj in doživite lepoto Bleda iz prve roke!",
                "fr" => "La vue à couper le souffle sur le lac de Bled depuis cet appartement confortable rendra votre séjour vraiment mémorable. Avec son emplacement pratique près du centre-ville et des attractions comme le château de Bled et l'île, vous aurez tout ce dont vous avez besoin pour une escapade parfaite. Détendez-vous sur le balcon avec un verre de vin local ou explorez les rues charmantes de Bled. Réservez dès maintenant votre séjour et découvrez la beauté de Bled de vos propres yeux !",
                "hu" => "A Bledi-tó lélegzetelállító kilátása ebből az otthonos apartmanból valóban emlékezetessé teszi tartózkodását. Kényelmes elhelyezkedésének köszönhetően a városközpont közelében és olyan látnivalók mellett, mint a Bledi vár és a sziget, minden rendelkezésre áll, amire tökéletes kikapcsolódáshoz szüksége lehet. Pihenjen a balkonon egy pohár helyi borral, vagy fedezze fel Bled bájos utcáit. Foglalja le tartózkodását most, és élvezze Bled szépségét első kézből!",
                "it" => "La vista mozzafiato sul lago di Bled da questo accogliente appartamento renderà il tuo soggiorno veramente memorabile. Grazie alla sua posizione comoda vicino al centro città e attrazioni come il castello di Bled e l'isola, avrai tutto ciò di cui hai bisogno per una vacanza perfetta. Rilassati sul balcone con un bicchiere di vino locale o esplora le affascinanti strade di Bled. Prenota ora il tuo soggiorno e vivi in prima persona la bellezza di Bled!",
                "en" => "The breathtaking views of Lake Bled from this cozy apartment will make your stay truly memorable. With its convenient location near the town center and attractions like Bled Castle and the island, you'll have everything you need for a perfect getaway. Relax on the balcony with a glass of local wine or explore the charming streets of Bled. Book your stay now and experience the beauty of Bled firsthand!",
            ],
            "size" => "20",
            "is_entire_apartment" => false,
            "coordinates" => [
                "lat" => "46.383290",
                "lng" => "14.080390",
            ],
            "bed_types" => [
                [
                    "icon" => "QueenBedIcon",
                    "name" => "1 queen bed",
                    "title" => "bedroom_1",
                ],
            ],
            "recomended" => [
                "for 2 adults",
            ],
            "prices" => [
                [
                    "price" => "920",
                    "guests" => 2,
                ],

            ],
            "rules" => $this->rules(),
        ];
    }

    private function tree(): array
    {
        return [
            "user_id" => 1,
            "type" => "Two-Bedroom Apartment",
            "slug" => "apartment-tree",
            "name" => "Apartment Tree",
            "address" => "Zgornje gorje 26/A, 4247 Bled, Slovenija",
            "title" => [
                "cs" => "Apartment Tree",
                "de" => "Apartment Tree",
                "en" => "Apartment Tree",
                "fr" => "Apartment Tree",
                "hu" => "Apartment Tree",
                "it" => "Apartment Tree",
                "sl" => "Apartment Tree",
            ],
            "description" => [
                "en" => "Boasting air-conditioned accommodation with a patio, Tree is situated in Bled. This property offers access to a terrace, free private parking and free WiFi. The property is allergy-free and is set 3.6 km from The Bled Island.",
                "cs" => "Pyšní se klimatizovaným ubytováním s terasou, Tree se nachází v Bledu. Tato nemovitost nabízí přístup na terasu, zdarma soukromé parkování a zdarma WiFi. Nemovitost je bez alergenů a nachází se 3,6 km od Bledského ostrova.",
                "de" => "Mit klimatisierten Unterkünften und einer Terrasse erwartet Sie Tree in Bled. Diese Unterkunft bietet Zugang zu einer Terrasse, kostenfreie Privatparkplätze und kostenfreies WLAN. Die Unterkunft ist allergikerfreundlich und liegt 3,6 km von der Bled-Insel entfernt.",
                "fr" => "Offrant un hébergement climatisé avec patio, Tree est situé à Bled. Cet établissement offre l'accès à une terrasse, un parking privé gratuit et une connexion Wi-Fi gratuite. La propriété est hypoallergénique et se trouve à 3,6 km de l'île de Bled.",
                "hu" => "Lobogó klímával és terasszal rendelkező szálláshely várja Önt Bledben a Tree. A szálláshely terasszal, ingyenes magán parkolással és ingyenes wifi-vel rendelkezik. Az ingatlan allergénmentes és 3,6 km-re található a Bled-szigettől.",
                "it" => "Vantando sistemazioni climatizzate con patio, Tree si trova a Bled. Questa struttura offre l'accesso a una terrazza, un parcheggio privato gratuito e la connessione WiFi gratuita. La struttura è priva di allergeni e dista 3,6 km dall'Isola di Bled.",
                "sl" => "Nastanitev Tree se nahaja na Bledu, 3,6 km od znamenitosti Blejski otok in 3,9 km od znamenitosti Blejski grad, ter ponuja brezplačen WiFi, klimatsko napravo, vrt in teraso. Apartma nudi brezplačno zasebno parkirišče, v okolici pa lahko uživate v aktivnostih, kot sta pohodništvo in kolesarjenje.",
            ],
            "quote" => [
                "cs" => "Dechberoucí výhled na Bledské jezero z tohoto útulného apartmánu udělá váš pobyt opravdu nezapomenutelným. Díky své výhodné poloze poblíž centra města a atrakcí jako je Bledský hrad a ostrov, budete mít všechno, co potřebujete pro dokonalý útěk. Relaxujte na balkoně s sklenicí místního vína nebo objevujte okouzlující uličky Bledu. Rezervujte si svůj pobyt hned teď a zažijte krásu Bledu na vlastní kůži!",
                "de" => "Die atemberaubende Aussicht auf den Bleder See von diesem gemütlichen Apartment aus wird Ihren Aufenthalt unvergesslich machen. Dank seiner günstigen Lage in der Nähe des Stadtzentrums und Attraktionen wie dem Bleder Schloss und der Insel haben Sie alles, was Sie für einen perfekten Kurzurlaub brauchen. Entspannen Sie auf dem Balkon mit einem Glas lokalem Wein oder erkunden Sie die charmanten Straßen von Bled. Buchen Sie jetzt Ihren Aufenthalt und erleben Sie die Schönheit von Bled aus erster Hand!",
                "sl" => "Osupljiv pogled na Blejsko jezero iz tega udobnega apartmaja bo vaše bivanje resnično nepozabno. Zaradi svoje ugodne lokacije blizu mestnega središča in znamenitosti, kot sta Blejski grad in otok, boste imeli vse, kar potrebujete za popolno pobeg. Sprostite se na balkonu s kozarcem lokalnega vina ali raziskujte očarljive ulice Bleda. Rezervirajte svoje bivanje zdaj in doživite lepoto Bleda iz prve roke!",
                "fr" => "La vue à couper le souffle sur le lac de Bled depuis cet appartement confortable rendra votre séjour vraiment mémorable. Avec son emplacement pratique près du centre-ville et des attractions comme le château de Bled et l'île, vous aurez tout ce dont vous avez besoin pour une escapade parfaite. Détendez-vous sur le balcon avec un verre de vin local ou explorez les rues charmantes de Bled. Réservez dès maintenant votre séjour et découvrez la beauté de Bled de vos propres yeux !",
                "hu" => "A Bledi-tó lélegzetelállító kilátása ebből az otthonos apartmanból valóban emlékezetessé teszi tartózkodását. Kényelmes elhelyezkedésének köszönhetően a városközpont közelében és olyan látnivalók mellett, mint a Bledi vár és a sziget, minden rendelkezésre áll, amire tökéletes kikapcsolódáshoz szüksége lehet. Pihenjen a balkonon egy pohár helyi borral, vagy fedezze fel Bled bájos utcáit. Foglalja le tartózkodását most, és élvezze Bled szépségét első kézből!",
                "it" => "La vista mozzafiato sul lago di Bled da questo accogliente appartamento renderà il tuo soggiorno veramente memorabile. Grazie alla sua posizione comoda vicino al centro città e attrazioni come il castello di Bled e l'isola, avrai tutto ciò di cui hai bisogno per una vacanza perfetta. Rilassati sul balcone con un bicchiere di vino locale o esplora le affascinanti strade di Bled. Prenota ora il tuo soggiorno e vivi in prima persona la bellezza di Bled!",
                "en" => "The breathtaking views of Lake Bled from this cozy apartment will make your stay truly memorable. With its convenient location near the town center and attractions like Bled Castle and the island, you'll have everything you need for a perfect getaway. Relax on the balcony with a glass of local wine or explore the charming streets of Bled. Book your stay now and experience the beauty of Bled firsthand!",
            ],
            "long_description" => [
                "cs" => "Ubytování Tree se nachází v Bledu, 3,6 km od památky Blejský ostrov a 3,9 km od památky Blejský hrad, a nabízí zdarma WiFi, klimatizaci, zahradu a terasu. Apartmán poskytuje zdarma soukromé parkoviště, v okolí lze využít aktivit, jako je turistika a cyklistika. Apartmán má dvě ložnice, kuchyň s lednicí a troubou a dvě koupelny s sprchou, zdarma poskytovanými toaletními potřebami a pračkou. V apartmánu jsou k dispozici ručníky a povlečení. V areálu ubytování je k dispozici dětské hřiště. Památka Sportovní hala Bled je od ubytování Tree vzdálena 4,8 km, památka Adventure Mini Golf Panorama je vzdálena 14 km. Nejbližší letiště (Letiště Jožeta Pučnika - Lublaň) je od ubytování Tree vzdáleno 38 km. Vzdálenosti uvedené v popisu ubytování jsou spočítány podle © OpenStreetMap.",
                "de" => "Die Unterkunft Tree befindet sich in Bled, 3,6 km von der Sehenswürdigkeit Blejski otok und 3,9 km von der Sehenswürdigkeit Blejski grad entfernt, und bietet kostenloses WLAN, Klimaanlage, einen Garten und eine Terrasse. Das Apartment bietet kostenlosen Privatparkplatz, und in der Umgebung können Sie Aktivitäten wie Wandern und Radfahren genießen. Die Wohnung verfügt über zwei Schlafzimmer, eine Küche mit Kühlschrank und Backofen sowie zwei Badezimmer mit Dusche, kostenlosen Pflegeprodukten und einer Waschmaschine. Handtücher und Bettwäsche werden gestellt. Auf dem Gelände der Unterkunft gibt es einen Kinderspielplatz. Die Sehenswürdigkeit Sportna Dvorana Bled ist 4,8 km von der Unterkunft Tree entfernt, die Sehenswürdigkeit Adventure Mini Golf Panorama ist 14 km entfernt. Der nächstgelegene Flughafen (Flughafen Jože Pučnik - Ljubljana) ist 38 km von der Unterkunft Tree entfernt. Die in der Unterkunftsbeschreibung angegebenen Entfernungen wurden nach © OpenStreetMap berechnet.",
                "en" => "Accommodation Tree is located in Bled, 3.6 km from the landmark Bled Island and 3.9 km from the landmark Bled Castle, and offers free WiFi, air conditioning, a garden, and a terrace. The apartment provides free private parking, and activities such as hiking and cycling can be enjoyed nearby. The apartment features two bedrooms, a kitchen with a fridge and an oven, and two bathrooms with a shower, complimentary toiletries, and a washing machine. Towels and bed linen are provided in the apartment. A children's playground is available on-site at the accommodation. The Sports Hall Bled landmark is 4.8 km from the Tree accommodation, while the Adventure Mini Golf Panorama landmark is 14 km away. The nearest airport (Jože Pučnik - Ljubljana Airport) is 38 km from the Tree accommodation. Distances mentioned in the accommodation description are calculated by © OpenStreetMap.",
                "fr" => "L'hébergement Tree est situé à Bled, à 3,6 km du célèbre Blejski otok et à 3,9 km du château de Bled, et propose une connexion Wi-Fi gratuite, la climatisation, un jardin et une terrasse. L'appartement offre un parking privé gratuit, et des activités telles que la randonnée et le vélo sont disponibles à proximité. L'appartement comprend deux chambres, une cuisine avec réfrigérateur et four, et deux salles de bains avec douche, articles de toilette gratuits et machine à laver. Les serviettes et le linge de lit sont fournis dans l'appartement. Un aire de jeux pour enfants est disponible sur place. La salle de sport Bled est à 4,8 km de l'hébergement Tree, tandis que le panorama du mini golf Adventure est à 14 km. L'aéroport le plus proche (aéroport Jože Pučnik - Ljubljana) est à 38 km de l'hébergement Tree. Les distances mentionnées dans la description de l'hébergement sont calculées par © OpenStreetMap.",
                "hu" => "A Tree szállás Bledben, 3,6 km-re található a Blejski otok jellegzetességétől és 3,9 km-re a Bledi vár jellegzetességétől, ingyenes wifit, légkondicionálást, kertet és teraszt kínál. Az apartman ingyenes privát parkolót biztosít, és túrázás és kerékpározás közben élvezheti a környéken kínált tevékenységeket. Az apartmanban két hálószoba, konyha hűtővel és sütővel, valamint két fürdőszoba található zuhanyzóval, ingyenes fürdőszobai kiegészítőkkel és mosógéppel. Törölközők és ágynemű biztosított. A szálláshelyen játszótér áll rendelkezésre. A Bledi Sportcsarnok 4,8 km-re található a Tree szállástól, míg az Adventure Mini Golf Panoráma 14 km-re van. A legközelebbi repülőtér (Jože Pučnik - Ljubljana repülőtér) 38 km-re található a Tree szállástól. Az ingatlan leírásában szereplő távolságokat az © OpenStreetMap számította ki.",
                "it" => "L'alloggio Tree si trova a Bled, a 3,6 km dal simbolo dell'Isola di Bled e a 3,9 km dal simbolo del Castello di Bled, e offre connessione Wi-Fi gratuita, aria condizionata, giardino e terrazza. L'appartamento offre un parcheggio privato gratuito, e attività come escursioni e ciclismo possono essere praticate nelle vicinanze. L'appartamento dispone di due camere da letto, una cucina con frigorifero e forno, e due bagni con doccia, set di cortesia gratuiti e lavatrice. Asciugamani e lenzuola sono forniti nell'appartamento. In loco è disponibile un parco giochi per bambini. Il simbolo della Sala Sportiva di Bled si trova a 4,8 km dall'alloggio Tree, mentre il simbolo del Panorama Adventure Mini Golf dista 14 km. L'aeroporto più vicino (Aeroporto Jože Pučnik - Lubiana) dista 38 km dall'alloggio Tree. Le distanze menzionate nella descrizione dell'alloggio sono calcolate da © OpenStreetMap.",
                "sl" => "Nastanitev Tree se nahaja na Bledu, 3,6 km od znamenitosti Blejski otok in 3,9 km od znamenitosti Blejski grad, ter ponuja brezplačen WiFi, klimatsko napravo, vrt in teraso. Apartma nudi brezplačno zasebno parkirišče, v okolici pa lahko uživate v aktivnostih, kot sta pohodništvo in kolesarjenje. Apartma ima več spalnic (2), kuhinjo s hladilnikom in s pečico ter več kopalnic (2) s prho, z brezplačnim toaletnim priborom in s pralnim strojem. V apartmaju imate na voljo brisače in posteljnino. V sklopu nastanitve lahko koristite otroško igrišče. Znamenitost Športna dvorana Bled je od nastanitve Tree oddaljena 4,8 km, znamenitost Adventure Mini Golf Panorama pa je 14 km stran. Najbližje letališče (Letališče Jožeta Pučnika - Ljubljana) je 38 km od nastanitve Tree. Razdalja v opisu nastanitve je izračunana z © OpenStreetMap.",
            ],
            "keywords" => [
                "cs" => "Bled, Blejský ostrov, Blejský hrad, WiFi, klimatizace, zahrada, terasa, bezplatné parkoviště, turistika, cyklistika, ložnice, kuchyně, koupelny, bezplatné toaletní potřeby, pračka, ručníky, povlečení, dětské hřiště, Sportovní hala Bled, Adventure Mini Golf Panorama, Letiště Jože Pučnik - Lublaň",
                "de" => "Bled, Blejski otok, Blejski grad, WiFi, Klimaanlage, Garten, Terrasse, kostenfreies Parken, Wandern, Radfahren, Schlafzimmer, Küche, Badezimmer, kostenlose Toilettenartikel, Waschmaschine, Handtücher, Bettwäsche, Kinderspielplatz, Sportna Dvorana Bled, Adventure Mini Golf Panorama, Flughafen Jože Pučnik - Ljubljana",
                "en" => "Bled, Bled Island, Bled Castle, WiFi, air conditioning, garden, terrace, free parking, hiking, cycling, bedrooms, kitchen, bathrooms, complimentary toiletries, washing machine, towels, bed linen, children's playground, Sports Hall Bled, Adventure Mini Golf Panorama, Jože Pučnik - Ljubljana Airport",
                "fr" => "Bled, île de Bled, château de Bled, WiFi, climatisation, jardin, terrasse, parking gratuit, randonnée, cyclisme, chambres, cuisine, salles de bains, articles de toilette gratuits, machine à laver, serviettes, linge de lit, aire de jeux pour enfants, salle de sport de Bled, Adventure Mini Golf Panorama, aéroport Jože Pučnik - Ljubljana",
                "hu" => "Bled, Blejski otok, Blejski grad, WiFi, légkondicionálás, kert, terasz, ingyenes parkolás, túrázás, kerékpározás, hálószobák, konyha, fürdőszobák, ingyenes fürdőszobai termékek, mosógép, törölközők, ágynemű, játszótér, Sportna Dvorana Bled, Adventure Mini Golf Panorama, Jože Pučnik - Ljubljana repülőtér",
                "it" => "Bled, Isola di Bled, Castello di Bled, WiFi, aria condizionata, giardino, terrazza, parcheggio gratuito, escursioni, ciclismo, camere da letto, cucina, bagni, set di cortesia gratuiti, lavatrice, asciugamani, lenzuola, parco giochi per bambini, Sala Sportiva di Bled, Adventure Mini Golf Panorama, Aeroporto Jože Pučnik - Lubiana",
                "sl" => "Bled, Blejski otok, Blejski grad, WiFi, klimatsko napravo, vrt, teraso, brezplačno parkirišče, pohodništvo, kolesarjenje, spalnic, kuhinjo, kopalnic, toaletnim priborom, pralnim strojem, brisače, posteljnino, otroško igrišče, Športna dvorana Bled, Adventure Mini Golf Panorama, Letališče Jožeta Pučnika - Ljubljana",
            ],
            "size" => "50",
            "is_entire_apartment" => true,
            "coordinates" => [
                "lat" => "46.383290",
                "lng" => "14.080390",
            ],
            "bed_types" => [
                [
                    "icon" => "QueenBedIcon",
                    "name" => "1 very large queen bed",
                    "title" => "bedroom_1",
                ],
                [
                    "icon" => "SingleBedIcon",
                    "name" => "2 single beds",
                    "title" => "bedroom_2",
                ],
                [
                    "icon" => "AttachedBathroomIcon",
                    "name" => "2 bathrooms",
                    "title" => "bathroom",
                ],
            ],
            "recomended" => [
                "for 4 adults",
            ],
            "prices" => [
                [
                    "price" => "1892",
                    "guests" => 4,
                ],

            ],
            "rules" => $this->rules(),
        ];
    }

    public function rules( ) :array
    {

            return [
                "cs" => [
                    [
                        "icon" => "CheckInIcon",
                        "name" => "Přihlášení",
                        "title" => "Od 16:00 do 00:00",
                        "description" => "Musíte ubytování předem informovat o svém předpokládaném čase příjezdu.",
                    ],
                    [
                        "icon" => "CheckOutIcon",
                        "name" => "Odhlášení",
                        "title" => "Od 00:00 do 10:00",
                        "description" => null,
                    ],
                    [
                        "icon" => "CancellationPrepaymentIcon",
                        "name" => "Zrušení/předplatné",
                        "title" => null,
                        "description" => "Podmínky zrušení a předplatného se mohou lišit v závislosti na typu apartmánu. Před rezervací si prosím zkontrolujte podmínky svého vybraného apartmánu.",
                    ],
                    [
                        "icon" => "ChildrenBedsIcon",
                        "name" => "Děti a postele",
                        "title" => "Dětské politiky",
                        "description" => "Děti všech věkových kategorií jsou vítány. Pro zobrazení správných cen a informací o obsazenosti zadejte počet a věk dětí ve své skupině do vyhledávání.",
                    ],
                    [
                        "icon" => "AgeRestrictionIcon",
                        "name" => "Věkové omezení",
                        "title" => null,
                        "description" => "Minimální věk pro ubytování je 18 let.",
                    ],
                    [
                        "icon" => "NonSmokingRoomsIcon",
                        "name" => "Kouření",
                        "title" => null,
                        "description" => "Kouření není povoleno.",
                    ],
                    [
                        "icon" => "PartiesIcon",
                        "name" => "Večírky",
                        "title" => null,
                        "description" => "Večírky/akce nejsou povoleny.",
                    ],
                    [
                        "icon" => "QuietHoursIcon",
                        "name" => "Klidové hodiny",
                        "title" => null,
                        "description" => "Hosté musí být tiší od 22:00 do 07:00 hodin.",
                    ],
                    [
                        "icon" => "PetsIcon",
                        "name" => "Domácí zvířata",
                        "title" => null,
                        "description" => "Domácí zvířata nejsou povolena.",
                    ],
                ],
                "de" => [
                    [
                        "icon" => "CheckInIcon",
                        "name" => "Check-in",
                        "title" => "Von 16:00 bis 00:00 Uhr",
                        "description" => "Sie müssen der Unterkunft im Voraus mitteilen, wann Sie anreisen.",
                    ],
                    [
                        "icon" => "CheckOutIcon",
                        "name" => "Check-out",
                        "title" => "Von 00:00 bis 10:00 Uhr",
                        "description" => null,
                    ],
                    [
                        "icon" => "CancellationPrepaymentIcon",
                        "name" => "Stornierung/Vorauszahlung",
                        "title" => null,
                        "description" => "Stornierungs- und Vorauszahlungsbedingungen können je nach Apartmenttyp variieren. Bitte überprüfen Sie die Bedingungen Ihrer gewählten Unterkunft.",
                    ],
                    [
                        "icon" => "ChildrenBedsIcon",
                        "name" => "Kinder und Betten",
                        "title" => "Kinderregelung",
                        "description" => "Kinder jeden Alters sind willkommen. Um korrekte Preise und Belegungsinformationen zu sehen, fügen Sie Ihrer Suche bitte die Anzahl der Kinder in Ihrer Gruppe und deren Alter hinzu. Babybetten oder Zustellbetten sind nicht verfügbar.",
                    ],
                    [
                        "icon" => "AgeRestrictionIcon",
                        "name" => "Altersbeschränkung",
                        "title" => null,
                        "description" => "Das Mindestalter für den Check-in beträgt 18 Jahre.",
                    ],
                    [
                        "icon" => "NonSmokingRoomsIcon",
                        "name" => "Rauchen",
                        "title" => null,
                        "description" => "Rauchen ist nicht gestattet.",
                    ],
                    [
                        "icon" => "PartiesIcon",
                        "name" => "Partys",
                        "title" => null,
                        "description" => "Partys/Veranstaltungen sind nicht erlaubt.",
                    ],
                    [
                        "icon" => "QuietHoursIcon",
                        "name" => "Ruhezeiten",
                        "title" => null,
                        "description" => "Gäste müssen sich zwischen 22:00 und 07:00 Uhr leise verhalten.",
                    ],
                    [
                        "icon" => "PetsIcon",
                        "name" => "Haustiere",
                        "title" => null,
                        "description" => "Haustiere sind nicht gestattet.",
                    ],
                ],
                "en" => [
                    [
                        "icon" => "CheckInIcon",
                        "name" => "Check In",
                        "title" => "From 4:00 PM to 12:00 AM",
                        "description" => "You need to let the property know what time you'll be arriving in advance.",
                    ],
                    [
                        "icon" => "CheckOutIcon",
                        "name" => "Check Out",
                        "title" => "From 12:00 AM to 10:00 AM",
                        "description" => null,
                    ],
                    [
                        "icon" => "CancellationPrepaymentIcon",
                        "name" => "Cancellation/prepayment",
                        "title" => null,
                        "description" => "<p>Cancellation and prepayment policies vary according to apartment type. </p><p>Please check the Apartment Conditions when selecting your apartment above.</p>",
                    ],
                    [
                        "icon" => "ChildrenBedsIcon",
                        "name" => "Children & Beds",
                        "title" => null,
                        "description" => "<p>Children of all ages are welcome.</p><p>To see correct prices and occupancy info, add the number and ages of children in your group to your search. </p><p>No cribs or extra beds are available.</p>",
                    ],
                    [
                        "icon" => "AgeRestrictionIcon",
                        "name" => "Age restriction",
                        "title" => null,
                        "description" => "The minimum age for check-in is 18",
                    ],
                    [
                        "icon" => "NonSmokingRoomsIcon",
                        "name" => "Smoking",
                        "title" => null,
                        "description" => "Smoking is not allowed.",
                    ],
                    [
                        "icon" => "PartiesIcon",
                        "name" => "Parties",
                        "title" => null,
                        "description" => "Parties/events are not allowed",
                    ],
                    [
                        "icon" => "QuietHoursIcon",
                        "name" => "Quiet hours",
                        "title" => null,
                        "description" => "Guests need be quiet between 10:00 PM and 7:00 AM.",
                    ],
                    [
                        "icon" => "PetsIcon",
                        "name" => "Pets",
                        "title" => null,
                        "description" => "Pets are not allowed.",
                    ],
                    [
                        "icon" => "WheelchairIcon",
                        "name" => "Disabled persons",
                        "title" => null,
                        "description" => "Property is not suitable for disabled persons",
                    ],
                    [
                        "icon" => "CashIcon",
                        "name" => "Tourist tax",
                        "title" => "Not included in the price",
                        "description" => "<p>3,13€ per day for <strong>adults </strong></p><p>1,57€ for <strong>children </strong>per day</p>",
                    ],
                ],
                "fr" => [
                    [
                        "icon" => "CheckInIcon",
                        "name" => "Arrivée",
                        "title" => "De 16h à minuit",
                        "description" => "Vous devez informer l'établissement à l'avance de l'heure à laquelle vous prévoyez d'arriver.",
                    ],
                    [
                        "icon" => "CheckOutIcon",
                        "name" => "Départ",
                        "title" => "De minuit à 10h00",
                        "description" => null,
                    ],
                    [
                        "icon" => "CancellationPrepaymentIcon",
                        "name" => "Annulation/prépaiement",
                        "title" => null,
                        "description" => "Les conditions d'annulation et de prépaiement varient en fonction du type d'appartement. Veuillez vérifier les conditions de l'appartement lors de la sélection de votre appartement ci-dessus.",
                    ],
                    [
                        "icon" => "ChildrenBedsIcon",
                        "name" => "Enfants et lits",
                        "title" => "Politique enfant",
                        "description" => "Tous les enfants sont les bienvenus. Pour voir les tarifs et les informations sur l'occupation corrects, veuillez ajouter le nombre et l'âge des enfants de votre groupe à votre recherche. Aucun lit d'appoint ni lit bébé n'est disponible.",
                    ],
                    [
                        "icon" => "AgeRestrictionIcon",
                        "name" => "Restriction d'âge",
                        "title" => null,
                        "description" => "L'âge minimum pour effectuer l'enregistrement est de 18 ans.",
                    ],
                    [
                        "icon" => "NonSmokingRoomsIcon",
                        "name" => "Fumer",
                        "title" => null,
                        "description" => "Il est interdit de fumer.",
                    ],
                    [
                        "icon" => "PartiesIcon",
                        "name" => "Fêtes",
                        "title" => null,
                        "description" => "Les fêtes/événements ne sont pas autorisés",
                    ],
                    [
                        "icon" => "QuietHoursIcon",
                        "name" => "Heures calmes",
                        "title" => null,
                        "description" => "Les clients doivent éviter de faire du bruit entre 22h00 et 7h00.",
                    ],
                    [
                        "icon" => "PetsIcon",
                        "name" => "Animaux domestiques",
                        "title" => null,
                        "description" => "Les animaux de compagnie ne sont pas admis.",
                    ],
                ],
                "hu" => [
                    [
                        "icon" => "CheckInIcon",
                        "name" => "Érkezés",
                        "title" => "16:00-tól éjfélig",
                        "description" => "Előzetesen értesítenie kell a szálláshelyet, hogy mikor érkezik.",
                    ],
                    [
                        "icon" => "CheckOutIcon",
                        "name" => "Távozás",
                        "title" => "éjfél után 10:00-ig",
                        "description" => null,
                    ],
                    [
                        "icon" => "CancellationPrepaymentIcon",
                        "name" => "Lemondás/előleg fizetése",
                        "title" => null,
                        "description" => "A lemondási és előlegfizetési feltételek a lakástípustól függően változnak. Kérjük, válassza ki a lakástípust a fenti apartmanfeltételek ellenőrzésekor.",
                    ],
                    [
                        "icon" => "ChildrenBedsIcon",
                        "name" => "Gyermekek és ágyak",
                        "title" => "Gyerekpolitika",
                        "description" => "Minden korosztályú gyermek fogadására van lehetőség. Helyes árak és foglaltsági információk megtekintéséhez adja meg a gyerekek számát és életkorát a csoportjában a kereséshez. Kispályás focilabda vagy pótágy nem áll rendelkezésre.",
                    ],
                    [
                        "icon" => "AgeRestrictionIcon",
                        "name" => "Korhatár",
                        "title" => null,
                        "description" => "A bejelentkezés minimális életkora 18 év.",
                    ],
                    [
                        "icon" => "NonSmokingRoomsIcon",
                        "name" => "Dohányzás",
                        "title" => null,
                        "description" => "Dohányzás tilos.",
                    ],
                    [
                        "icon" => "PartiesIcon",
                        "name" => "Bulik",
                        "title" => null,
                        "description" => "Bulik/rendezvények nem engedélyezettek",
                    ],
                    [
                        "icon" => "QuietHoursIcon",
                        "name" => "Csendes órák",
                        "title" => null,
                        "description" => "A vendégeknek csendesnek kell lenniük este 10:00 és reggel 7:00 között.",
                    ],
                    [
                        "icon" => "PetsIcon",
                        "name" => "Háziállatok",
                        "title" => null,
                        "description" => "Háziállat nem engedélyezett.",
                    ],
                ],
                "it" => [
                    [
                        "icon" => "CheckInIcon",
                        "name" => "Check-in",
                        "title" => "Dalle 16:00 alle 00:00",
                        "description" => "È necessario comunicare in anticipo alla struttura l'orario previsto per il check-in.",
                    ],
                    [
                        "icon" => "CheckOutIcon",
                        "name" => "Check-out",
                        "title" => "Dalle 00:00 alle 10:00",
                        "description" => null,
                    ],
                    [
                        "icon" => "CancellationPrepaymentIcon",
                        "name" => "Annullamento/pagamento anticipato",
                        "title" => null,
                        "description" => "Le condizioni relative alla cancellazione e al pagamento anticipato variano a seconda della tipologia di appartamento. Si prega di verificare le condizioni della tua prenotazione.",
                    ],
                    [
                        "icon" => "ChildrenBedsIcon",
                        "name" => "Bambini e letti",
                        "title" => "Politiche per i bambini",
                        "description" => "I bambini di tutte le età sono i benvenuti. Per vedere corrette informazioni sui prezzi e sulla disponibilità, inserisci il numero e l'età dei bambini nel tuo gruppo.",
                    ],
                    [
                        "icon" => "AgeRestrictionIcon",
                        "name" => "Limitazione d'età",
                        "title" => null,
                        "description" => "L'età minima per fare il check-in è 18 anni.",
                    ],
                    [
                        "icon" => "NonSmokingRoomsIcon",
                        "name" => "Fumo",
                        "title" => null,
                        "description" => "È vietato fumare.",
                    ],
                    [
                        "icon" => "PartiesIcon",
                        "name" => "Feste",
                        "title" => null,
                        "description" => "Feste/eventi non ammessi.",
                    ],
                    [
                        "icon" => "QuietHoursIcon",
                        "name" => "Orari silenziosi",
                        "title" => null,
                        "description" => "Gli ospiti devono rispettare il silenzio tra le 22:00 e le 07:00.",
                    ],
                    [
                        "icon" => "PetsIcon",
                        "name" => "Animali",
                        "title" => null,
                        "description" => "Animali non ammessi.",
                    ],
                ],
                "sl" => [
                    [
                        "icon" => "CheckInIcon",
                        "name" => "Prijava",
                        "title" => "Od 16:00 do 00:00",
                        "description" => "O svojem prihodu morate prej obvestiti nastanitev.",
                    ],
                    [
                        "icon" => "CheckOutIcon",
                        "name" => "Odjava",
                        "title" => "Od 00:00 do 10:00",
                        "description" => null,
                    ],
                    [
                        "icon" => "CancellationPrepaymentIcon",
                        "name" => "Preklic/predplačilo",
                        "title" => null,
                        "description" => "Politika preklica in predplačila se lahko razlikuje glede na vrsto apartmaja. Prosimo, preverite pogoje apartmaja pri izbiri apartmaja zgoraj.",
                    ],
                    [
                        "icon" => "ChildrenBedsIcon",
                        "name" => "Otroci in postelje",
                        "title" => "Politike otrok",
                        "description" => "Otroci vseh starosti so dobrodošli. Da bi videli pravilne cene in informacije o zasedenosti, dodajte število in starost otrok v svojo iskalno poizvedbo. Otroške postelje ali dodatne postelje niso na voljo.",
                    ],
                    [
                        "icon" => "AgeRestrictionIcon",
                        "name" => "Omejitev glede starosti",
                        "title" => null,
                        "description" => "Najmanjša starost za prijavo je 18 let.",
                    ],
                    [
                        "icon" => "NonSmokingRoomsIcon",
                        "name" => "Kajenje",
                        "title" => null,
                        "description" => "Kajenje ni dovoljeno.",
                    ],
                    [
                        "icon" => "PartiesIcon",
                        "name" => "Praznovanja",
                        "title" => null,
                        "description" => "Praznovanja in dogodki niso dovoljeni.",
                    ],
                    [
                        "icon" => "QuietHoursIcon",
                        "name" => "Ure tišine",
                        "title" => null,
                        "description" => "Gostje morajo biti tiho med 22:00 in 07:00.",
                    ],
                    [
                        "icon" => "PetsIcon",
                        "name" => "Hišni ljubljenčki",
                        "title" => null,
                        "description" => "Hišni ljubljenčki niso dovoljeni.",
                    ],
                ],
            ];

    }

}
