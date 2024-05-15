<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $homepage = [
            'name' => 'Home',
            'slug' => 'home',
            'title' => [
                'sl' => 'Dobrodošli v apartmajih Mountain View',
                'en' => 'Welcome to Mountain View Apartments',
                'de' => 'Willkommen in den Mountain View Apartments',
                'hu' => 'Üdvözöljük a Mountain View Apartmanokban',
                'it' => 'Benvenuti negli Appartamenti Mountain View',
                'fr' => 'Bienvenue aux Appartements Mountain View',
                'cs' => 'Vítejte v apartmánech Mountain View',
            ],
            'description' => [
                'sl' => 'Apartmaji Koman ponuja 3 elegantno in udobno opremljene apartmaje, vse z lastno kopalnico, balkonom ali teraso, klimo, ogrevanjem in popolnoma opremljeno kuhinjo. V vseh apartmajih ponujamo kabelsko TV, brezplačno parkiranje in brezplačen WiFi.',
                'en' => 'Apartments Koman offers 3 elegantly and comfortably furnished apartments, all with private bathroom, balcony or terrace, air conditioning, heating, and fully equipped kitchen. In all apartments, we offer cable TV, free parking, and free WiFi.',
                'de' => 'Die Apartments Koman bietet 3 elegant und komfortabel eingerichtete Apartments, alle mit eigenem Bad, Balkon oder Terrasse, Klimaanlage, Heizung und voll ausgestatteter Küche. In allen Apartments bieten wir Kabel-TV, kostenlose Parkplätze und kostenloses WLAN.',
                'hu' => 'A Koman Apartmanok 3 elegáns és kényelmesen berendezett apartmant kínál, mindegyik saját fürdőszobával, erkéllyel vagy terasszal, légkondicionálással, fűtéssel és teljesen felszerelt konyhával. Minden apartmanban kábel TV-t, ingyenes parkolást és ingyenes Wi-Fi-t biztosítunk',
                'it' => 'Gli Appartamenti Koman offrono 3 appartamenti elegantemente arredati e confortevoli, tutti con bagno privato, balcone o terrazza, aria condizionata, riscaldamento e cucina completamente attrezzata. In tutti gli appartamenti offriamo TV via cavo, parcheggio gratuito e WiFi gratuito.',
                'fr' => 'Les Appartements Koman proposent 3 appartements élégamment aménagés et confortables, tous avec leur propre salle de bain, balcon ou terrasse, climatisation, chauffage et cuisine entièrement équipée. Dans tous les appartements, nous proposons la télévision par câble, un parking gratuit et une connexion Wi-Fi gratuite.',
                'cs' => 'Apartmány Koman nabízejí 3 elegantně a pohodlně zařízené apartmány, všechny s vlastní koupelnou, balkonem nebo terasou, klimatizací, topením a plně vybavenou kuchyní. Ve všech apartmánech nabízíme kabelovou televizi, zdarma parkování a Wi-Fi připojení zdarma.',
            ],
            'keywords' => [
                'sl' => 'Apartmaji Koman, ponuja, elegantno, udobno, opremljeni, kopalnica, balkon, terasa, klima, ogrevanje, popolnoma opremljena kuhinja, kabelska TV, brezplačno parkiranje, brezplačen WiFi',
                'en' => 'Apartments Koman, offers, elegantly, comfortably, furnished, private bathroom, balcony, terrace, air conditioning, heating, fully equipped kitchen, cable TV, free parking, free WiFi',
                'de' => 'Apartments Koman, bietet, elegant, komfortabel, eingerichtete, private Badezimmer, Balkon, Terrasse, Klimaanlage, Heizung, voll ausgestattete Küche, Kabel-TV, kostenlose Parkplätze, kostenloses WLAN',
                'hu' => 'Koman apartmanok, kínál, elegánsan, kényelmesen, berendezett, saját fürdőszoba, erkély, terasz, légkondicionálás, fűtés, teljesen felszerelt konyha, kábel TV, ingyenes parkolás, ingyenes WiFi',
                'it' => 'Appartamenti Koman, offre, elegantemente, comodamente, arredati, bagno privato, balcone, terrazza, aria condizionata, riscaldamento, cucina completamente attrezzata, TV via cavo, parcheggio gratuito, WiFi gratuito',
                'fr' => 'Appartements Koman, propose, élégamment, confortablement, meublés, salle de bain privée, balcon, terrasse, climatisation, chauffage, cuisine entièrement équipée, télévision par câble, parking gratuit, WiFi gratuit',
                'cs' => 'Apartmány Koman, nabízí, elegantně, pohodlně, zařízené, vlastní koupelna, balkon, terasa, klimatizace, topení, plně vybavená kuchyň, kabelová televize, zdarma parkování, zdarma WiFi',
            ],
            'extras' => [
                'nasfield_text' => [
                    'title' => [
                        'sl' => '',
                        'en' => '',
                        'de' => '',
                        'hu' => '',
                        'it' => '',
                        'fr' => '',
                        'cs' => '',
                    ],
                    'text' => [
                        'sl' => '',
                        'en' => '',
                        'de' => '',
                        'hu' => '',
                        'it' => '',
                        'fr' => '',
                        'cs' => '',
                    ],
                ],
                'bled_text' => [
                    'title' => [
                        'sl' => '',
                        'en' => '',
                        'de' => '',
                        'hu' => '',
                        'it' => '',
                        'fr' => '',
                        'cs' => '',
                    ],
                    'text' => [
                        'sl' => '',
                        'en' => '',
                        'de' => '',
                        'hu' => '',
                        'it' => '',
                        'fr' => '',
                        'cs' => '',
                    ],
                ]
            ]
        ];

        $about_us = [
            'name' => 'About Us',
            'slug' => 'about-us',
            'title' => [
                'sl' => 'Dobrodošli v apartmajih Mountain View',
                'en' => 'Welcome to Mountain View Apartments',
                'de' => 'Willkommen in den Mountain View Apartments',
                'hu' => 'Üdvözöljük a Mountain View Apartmanokban',
                'it' => 'Benvenuti negli Appartamenti Mountain View',
                'fr' => 'Bienvenue aux Appartements Mountain View',
                'cs' => 'Vítejte v apartmánech Mountain View',
            ],
            'description' => [
                'sl' => 'Moj mož in jaz že dolgo sanjariva o urejanju idiličnega prostora, ki bo obiskovalcem Bleda ponudil prijetno in udobno počitniško nastanitev. Naša želja se je uresničila leta 2010, ko smo preoblikovali prelepo vilo iz petdesetih let v počitniške apartmaje, ki ponujajo sodobno udobje s pridihom preteklosti. Kot velika ljubitelja umetnosti in starin sva želela, da prenovljeni prostori vile odražajo njeno plemenito preteklost, zato sva pri opremljanju sob vključila različne starinske dekorativne predmete lokalnega izvora.\nPonosna sva, da lahko gostiva obiskovalce iz vsega sveta. Kot domačina, navdušena nad poskusom lokalnih dobrot in radovedna obiskovalca zanimivih lokalnih dogodkov, sva vesela, da lahko svetujeva, kam na izlet ali kje dobro jesti domače jedi.\nApartmaji Koman predstavljajo uresničitev mnogoletnih sanj in veselje mi je, da lahko svoje navdušenje delim z vami.\nDobrodošli v dom odprtega srca.',
                'en' => 'My husband and I have long dreamed of arranging an idyllic space that will offer visitors to Bled a pleasant and comfortable holiday accommodation. Our wish came true in 2010, when we transformed a beautiful villa from the 1950s into holiday apartments, offering modern comfort with a touch of old times. As great lovers of art and antiques, we wanted the renovated spaces of the villa to reflect its noble past, so we included various antique decorative items of local origin when furnishing the rooms.\nWe are honored to host visitors from all over the world. As a local, an enthusiastic taster of local delicacies and curious visitors to interesting local events, guests with We are happy to advise where to go on a trip or where to go to a good home Feast. \nApartments Koman represent the realization of many years of dreams and It\'s a pleasure to share my enthusiasm with you. \nWelcome into an open heart home.',
                'de' => 'Mein Mann und ich träumen schon lange davon, einen idyllischen Raum zu gestalten, der den Besuchern von Bled eine angenehme und komfortable Urlaubsunterkunft bietet. Unser Wunsch wurde 2010 wahr, als wir eine wunderschöne Villa aus den 1950er Jahren in Ferienwohnungen umwandelten, die modernen Komfort mit einem Hauch von alten Zeiten bieten. Als große Liebhaber von Kunst und Antiquitäten wollten wir, dass die renovierten Räume der Villa ihre noble Vergangenheit widerspiegeln, daher haben wir bei der Einrichtung der Zimmer verschiedene antike Dekorationsgegenstände lokalen Ursprungs einbezogen.\nWir sind geehrt, Besucher aus der ganzen Welt zu beherbergen. Als Einheimische, begeisterte Verkoster lokaler Köstlichkeiten und neugierige Besucher interessanter lokaler Veranstaltungen beraten wir gerne, wohin Sie auf einen Ausflug gehen oder wo Sie ein gutes Essen genießen können. \nDie Apartments Koman sind die Verwirklichung vieler Jahre Träume und es ist mir ein Vergnügen, meine Begeisterung mit Ihnen zu teilen. \nWillkommen in einem Haus mit offenem Herzen.',
                'hu' => 'Hosszú ideje álmodunk a férjemmel arról, hogy egy idilli teret rendezzünk be, amely kellemes és kényelmes nyaralási szállást kínál Bled látogatóinak. Álmunk valóra vált 2010-ben, amikor átalakítottunk egy gyönyörű villát a 50-es évekből nyaraló apartmanokká, amelyek modern kényelmet nyújtanak a régmúlt hangulatával. Mint a művészet és antik tárgyak nagy szerelmesei, azt akartuk, hogy a villa felújított terei tükrözzék nemes múltját, ezért különböző, helyi eredetű antik dekorációs tárgyakat tartalmaztunk a szobák berendezésekor.\nTisztelettel fogadunk látogatókat az egész világból. Mint helyiek, lelkes helyi finomságok kóstolói és kíváncsi látogatók érdekes helyi eseményekre, szívesen tanácsot adunk, hová menjünk kirándulni, vagy hol érdemes otthonosan étkezni. \nA Koman apartmanok a sok éves álmok megvalósulása, és örömöm, hogy megoszthatom lelkesedésemet veled. \nÜdvözöljük egy nyitott szív otthonában.',
                'it' => 'Mio marito ed io abbiamo da tempo sognato di organizzare uno spazio idilliaco che offra ai visitatori di Bled un alloggio vacanziero piacevole e confortevole. Il nostro desiderio si è avverato nel 2010, quando abbiamo trasformato una bellissima villa degli anni \'50 in appartamenti vacanza, offrendo comfort moderno con un tocco di antico. Grandi amanti dell\'arte e delle antichità, abbiamo voluto che gli spazi rinnovati della villa riflettessero il suo nobile passato, quindi abbiamo incluso vari oggetti decorativi antichi di origine locale nell\'arredamento delle stanze.\nSiamo onorati di ospitare visitatori da tutto il mondo. Da locali, appassionati assaggiatori di prelibatezze locali e curiosi visitatori di interessanti eventi locali, siamo felici di consigliare dove andare in gita o dove andare per una buona cena casalinga. \nGli appartamenti Koman rappresentano la realizzazione di molti anni di sogni ed è un piacere condividere il mio entusiasmo con voi. \nBenvenuti in una casa dal cuore aperto.',
                'fr' => 'Mon mari et moi rêvons depuis longtemps d\'aménager un espace idyllique qui offrira aux visiteurs de Bled un hébergement de vacances agréable et confortable. Notre souhait s\'est réalisé en 2010, lorsque nous avons transformé une belle villa des années 1950 en appartements de vacances, offrant un confort moderne avec une touche d\'antan. Grands amateurs d\'art et d\'antiquités, nous voulions que les espaces rénovés de la villa reflètent son passé noble, nous avons donc inclus divers objets décoratifs anciens d\'origine locale lors de l\'aménagement des chambres.\nNous sommes honorés d\'accueillir des visiteurs du monde entier. En tant que locaux, amateurs enthousiastes de délices locaux et curieux visiteurs d\'événements locaux intéressants, nous sommes heureux de conseiller où partir en excursion ou où aller pour un bon repas fait maison. \nLes appartements Koman représentent la réalisation de nombreux rêves depuis des années et c\'est un plaisir de partager mon enthousiasme avec vous. \nBienvenue dans une maison au cœur ouvert.',
                'cs' => 'Můj manžel a já jsme již dlouho snili o uspořádání idylického prostoru, který návštěvníkům Bledu nabídne příjemné a pohodlné ubytování. Náš sen se stal skutečností v roce 2010, kdy jsme přeměnili krásnou vilu z padesátých let na prázdninové apartmány, nabízející moderní komfort s nádechem starých časů. Jako velcí milovníci umění a starožitností jsme chtěli, aby renovované prostory vily odrážely její šlechetnou minulost, proto jsme při zařizování pokojů zahrnuli různé starožitné dekorativní předměty místního původu.\nJsme poctěni, že můžeme hostit návštěvníky z celého světa. Jako místní obyvatelé, nadšení ochutnávači místních lahůdek a zvědaví návštěvníci zajímavých místních událostí, jsme rádi, že vám poradíme, kam na výlet nebo kam jít na dobré domácí jídlo. \nApartmány Koman představují realizaci mnohaletých snů a je pro mě potěšením sdílet svůj nadšení s vámi. \nVítejte v domě s otevřeným srdcem.',
            ],
            'keywords' => [
                'sl' => 'Apartmaji Koman, ponuja, elegantno, udobno, opremljeni, kopalnica, balkon, terasa, klima, ogrevanje, popolnoma opremljena kuhinja, kabelska TV, brezplačno parkiranje, brezplačen WiFi',
                'en' => 'Apartments Koman, offers, elegantly, comfortably, furnished, private bathroom, balcony, terrace, air conditioning, heating, fully equipped kitchen, cable TV, free parking, free WiFi',
                'de' => 'Apartments Koman, bietet, elegant, komfortabel, eingerichtete, private Badezimmer, Balkon, Terrasse, Klimaanlage, Heizung, voll ausgestattete Küche, Kabel-TV, kostenlose Parkplätze, kostenloses WLAN',
                'hu' => 'Koman apartmanok, kínál, elegánsan, kényelmesen, berendezett, saját fürdőszoba, erkély, terasz, légkondicionálás, fűtés, teljesen felszerelt konyha, kábel TV, ingyenes parkolás, ingyenes WiFi',
                'it' => 'Appartamenti Koman, offre, elegantemente, comodamente, arredati, bagno privato, balcone, terrazza, aria condizionata, riscaldamento, cucina completamente attrezzata, TV via cavo, parcheggio gratuito, WiFi gratuito',
                'fr' => 'Appartements Koman, propose, élégamment, confortablement, meublés, salle de bain privée, balcon, terrasse, climatisation, chauffage, cuisine entièrement équipée, télévision par câble, parking gratuit, WiFi gratuit',
                'cs' => 'Apartmány Koman, nabízí, elegantně, pohodlně, zařízené, vlastní koupelna, balkon, terasa, klimatizace, topení, plně vybavená kuchyň, kabelová televize, zdarma parkování, zdarma WiFi',
            ],
            'extras' => [],
        ];

        $sql="INSERT INTO `pages` (`id`, `name`, `slug`, `title`, `description`, `keywords`, `extras`, `created_at`, `updated_at`) VALUES
        (1, 'Home', 'home', '{\"cs\": \"Vítejte v apartmánech Mountain View\", \"de\": \"Willkommen in den Mountain View Apartments\", \"en\": \"Welcome to Mountain View Apartments\", \"fr\": \"Bienvenue aux Appartements Mountain View\", \"hu\": \"Üdvözöljük a Mountain View Apartmanokban\", \"it\": \"Benvenuti negli Appartamenti Mountain View\", \"sl\": \"Dobrodošli v apartmajih Mountain View\"}', '{\"cs\": \"Apartmány Koman nabízejí 3 elegantně a pohodlně zařízené apartmány, všechny s vlastní koupelnou, balkonem nebo terasou, klimatizací, topením a plně vybavenou kuchyní. Ve všech apartmánech nabízíme kabelovou televizi, zdarma parkování a Wi-Fi připojení zdarma.\", \"de\": \"Die Apartments Koman bietet 3 elegant und komfortabel eingerichtete Apartments, alle mit eigenem Bad, Balkon oder Terrasse, Klimaanlage, Heizung und voll ausgestatteter Küche. In allen Apartments bieten wir Kabel-TV, kostenlose Parkplätze und kostenloses WLAN.\", \"en\": \"Apartments Koman offers 3 elegantly and comfortably furnished apartments, all with private bathroom, balcony or terrace, air conditioning, heating, and fully equipped kitchen. In all apartments, we offer cable TV, free parking, and free WiFi.\", \"fr\": \"Les Appartements Koman proposent 3 appartements élégamment aménagés et confortables, tous avec leur propre salle de bain, balcon ou terrasse, climatisation, chauffage et cuisine entièrement équipée. Dans tous les appartements, nous proposons la télévision par câble, un parking gratuit et une connexion Wi-Fi gratuite.\", \"hu\": \"A Koman Apartmanok 3 elegáns és kényelmesen berendezett apartmant kínál, mindegyik saját fürdőszobával, erkéllyel vagy terasszal, légkondicionálással, fűtéssel és teljesen felszerelt konyhával. Minden apartmanban kábel TV-t, ingyenes parkolást és ingyenes Wi-Fi-t biztosítunk\", \"it\": \"Gli Appartamenti Koman offrono 3 appartamenti elegantemente arredati e confortevoli, tutti con bagno privato, balcone o terrazza, aria condizionata, riscaldamento e cucina completamente attrezzata. In tutti gli appartamenti offriamo TV via cavo, parcheggio gratuito e WiFi gratuito.\", \"sl\": \"Apartmaji Koman ponuja 3 elegantno in udobno opremljene apartmaje, vse z lastno kopalnico, balkonom ali teraso, klimo, ogrevanjem in popolnoma opremljeno kuhinjo. V vseh apartmajih ponujamo kabelsko TV, brezplačno parkiranje in brezplačen WiFi.\"}', '{\"cs\": \"Apartmány Koman, nabízí, elegantně, pohodlně, zařízené, vlastní koupelna, balkon, terasa, klimatizace, topení, plně vybavená kuchyň, kabelová televize, zdarma parkování, zdarma WiFi\", \"de\": \"Apartments Koman, bietet, elegant, komfortabel, eingerichtete, private Badezimmer, Balkon, Terrasse, Klimaanlage, Heizung, voll ausgestattete Küche, Kabel-TV, kostenlose Parkplätze, kostenloses WLAN\", \"en\": \"Apartments Koman, offers, elegantly, comfortably, furnished, private bathroom, balcony, terrace, air conditioning, heating, fully equipped kitchen, cable TV, free parking, free WiFi\", \"fr\": \"Appartements Koman, propose, élégamment, confortablement, meublés, salle de bain privée, balcon, terrasse, climatisation, chauffage, cuisine entièrement équipée, télévision par câble, parking gratuit, WiFi gratuit\", \"hu\": \"Koman apartmanok, kínál, elegánsan, kényelmesen, berendezett, saját fürdőszoba, erkély, terasz, légkondicionálás, fűtés, teljesen felszerelt konyha, kábel TV, ingyenes parkolás, ingyenes WiFi\", \"it\": \"Appartamenti Koman, offre, elegantemente, comodamente, arredati, bagno privato, balcone, terrazza, aria condizionata, riscaldamento, cucina completamente attrezzata, TV via cavo, parcheggio gratuito, WiFi gratuito\", \"sl\": \"Apartmaji Koman, ponuja, elegantno, udobno, opremljeni, kopalnica, balkon, terasa, klima, ogrevanje, popolnoma opremljena kuhinja, kabelska TV, brezplačno parkiranje, brezplačen WiFi\"}', '{\"bled_text\": {\"text\": {\"cs\": \"<p>Rodinně vedené apartmány Koman se nacházejí v idylické lokalitě v centru Bledu. </p><p>Nabízejí návštěvníkům pohodlné ubytování a autentický zážitek z rodinné pohostinnosti.</p>\", \"de\": \"<p>Die familiengeführten <strong>Apartments Koman</strong> befinden sich in einer idyllischen Lage im Zentrum von <strong>Bled</strong>. </p><p>Sie bieten Besuchern komfortable Unterkünfte und eine authentische Erfahrung familiärer Gastfreundschaft.</p>\", \"en\": \"<p>Family-run<strong> Apartments Koman</strong> are located in an idyllic location in the center of <strong>Bled</strong>. </p><p>They offer visitors comfortable accommodation and an authentic experience of family hospitality.</p>\", \"fr\": \"<p>Les <strong>appartements Koman</strong>, gérés par une famille, sont situés dans un endroit idyllique au centre de <strong>Bled</strong>. </p><p>Ils offrent aux visiteurs un hébergement confortable et une expérience authentique de l\'hospitalité familiale.</p>\", \"hu\": \"<p>A családi vezetésű <strong>Koman Apartmanok</strong> egy idilli helyen találhatók <strong>Bled </strong>központjában. </p><p>Kényelmes szállást és autentikus családi vendégszeretetet kínálnak a látogatóknak.</p>\", \"it\": \"<p>Gli <strong>Appartamenti Koman</strong> a conduzione familiare si trovano in una posizione idilliaca nel centro di <strong>Bled</strong>. </p><p>Offrono ai visitatori un alloggio confortevole e un\'esperienza autentica dell\'ospitalità familiare.</p>\", \"sl\": \"<p>Družinsko vodeni <strong>Apartmaji Koman</strong> se nahajajo na idilični lokaciji v centru <strong>Bleda</strong>. </p><p>Obiskovalcem nudijo udobno nastanitev in izkušnjo pristnega družinskega gostoljubja.</p>\"}, \"title\": {\"cs\": \"Apartmány v Bledu\", \"de\": \"Ferienwohnungen in Bled\", \"en\": \"Apartments in Bled\", \"fr\": \"Appartements à Bled\", \"hu\": \"Apartmanok Bleden\", \"it\": \"Appartamenti a Bled\", \"sl\": \"Apartmaji na Bledu\"}}, \"nasfield_text\": {\"text\": {\"cs\": \"\", \"de\": \"\", \"en\": \"<p>Offering a garden and garden view, <strong>Nassfeld and Lake Apartment</strong> is situated in <strong>Hermagor</strong>, 8.1 km from <strong>Lake Pressegger</strong> and 11 km from <strong>Nassfeld</strong>. </p><p>This property offers access to a balcony and free private parking. The property is non-smoking and is set 49 km from <strong>Porcia Castle</strong>.</p>\", \"fr\": \"\", \"hu\": \"\", \"it\": \"\", \"sl\": \"<p>Nastanitev <strong>Nassfeld and Lake Apartment </strong>se nahaja približno 47 km od znamenitosti skakalnica Villacher Alpenarena in ponuja razgled na vrt, balkon ter aparat za kavo.</p><p>Nastanitev je 28 km od znamenitosti Terra Mystica Mine in nudi vrt ter brezplačno zasebno parkirišče.</p>\"}, \"title\": {\"cs\": \"\", \"de\": \"\", \"en\": \"Apartment in Nassfeld\", \"fr\": \"\", \"hu\": \"\", \"it\": \"\", \"sl\": \"Apartma v Nassfeldu\"}}}', '2024-05-15 08:10:48', '2024-05-15 23:31:46');";

        \DB::unprepared($sql);
        // Page::factory()->create($homepage);
        Page::factory()->create($about_us);
    }
}
