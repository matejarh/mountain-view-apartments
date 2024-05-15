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
                'sl' => 'Apartmaji Koman ponuja 3 elegantno in udobno opremljene apartmaje, vse z lastno kopalnico, balkonom ali teraso, klimo, ogrevanjem in popolnoma opremljeno kuhinjo. V vseh apartmajih ponujamo kabelsko TV, brezplačno parkiranje in brezplačen WiFi.',
                'en' => 'My husband and I have long dreamed of arranging an idyllic space that will offer visitors to Bled a pleasant and comfortable holiday accommodation. Our wish came true in 2010, when we transformed a beautiful villa from the 1950s into holiday apartments, offering modern comfort with a touch of old times. As great lovers of art and antiques, we wanted the renovated spaces of the villa to reflect its noble past, so we included various antique decorative items of local origin when furnishing the rooms.\nWe are honored to host visitors from all over the world. As a local, an enthusiastic taster of local delicacies and curious visitors to interesting local events, guests with We are happy to advise where to go on a trip or where to go to a good home Feast. \nApartments Koman represent the realization of many years of dreams and It\'s a pleasure to share my enthusiasm with you. \nWelcome into an open heart home.',
                'de' => '',
                'hu' => '',
                'it' => '',
                'fr' => '',
                'cs' => '',
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
        ];

        $sql="INSERT INTO `pages` (`id`, `name`, `slug`, `title`, `description`, `keywords`, `extras`, `created_at`, `updated_at`) VALUES
        (1, 'Home', 'home', '{\"cs\": \"Vítejte v apartmánech Mountain View\", \"de\": \"Willkommen in den Mountain View Apartments\", \"en\": \"Welcome to Mountain View Apartments\", \"fr\": \"Bienvenue aux Appartements Mountain View\", \"hu\": \"Üdvözöljük a Mountain View Apartmanokban\", \"it\": \"Benvenuti negli Appartamenti Mountain View\", \"sl\": \"Dobrodošli v apartmajih Mountain View\"}', '{\"cs\": \"Apartmány Koman nabízejí 3 elegantně a pohodlně zařízené apartmány, všechny s vlastní koupelnou, balkonem nebo terasou, klimatizací, topením a plně vybavenou kuchyní. Ve všech apartmánech nabízíme kabelovou televizi, zdarma parkování a Wi-Fi připojení zdarma.\", \"de\": \"Die Apartments Koman bietet 3 elegant und komfortabel eingerichtete Apartments, alle mit eigenem Bad, Balkon oder Terrasse, Klimaanlage, Heizung und voll ausgestatteter Küche. In allen Apartments bieten wir Kabel-TV, kostenlose Parkplätze und kostenloses WLAN.\", \"en\": \"Apartments Koman offers 3 elegantly and comfortably furnished apartments, all with private bathroom, balcony or terrace, air conditioning, heating, and fully equipped kitchen. In all apartments, we offer cable TV, free parking, and free WiFi.\", \"fr\": \"Les Appartements Koman proposent 3 appartements élégamment aménagés et confortables, tous avec leur propre salle de bain, balcon ou terrasse, climatisation, chauffage et cuisine entièrement équipée. Dans tous les appartements, nous proposons la télévision par câble, un parking gratuit et une connexion Wi-Fi gratuite.\", \"hu\": \"A Koman Apartmanok 3 elegáns és kényelmesen berendezett apartmant kínál, mindegyik saját fürdőszobával, erkéllyel vagy terasszal, légkondicionálással, fűtéssel és teljesen felszerelt konyhával. Minden apartmanban kábel TV-t, ingyenes parkolást és ingyenes Wi-Fi-t biztosítunk\", \"it\": \"Gli Appartamenti Koman offrono 3 appartamenti elegantemente arredati e confortevoli, tutti con bagno privato, balcone o terrazza, aria condizionata, riscaldamento e cucina completamente attrezzata. In tutti gli appartamenti offriamo TV via cavo, parcheggio gratuito e WiFi gratuito.\", \"sl\": \"Apartmaji Koman ponuja 3 elegantno in udobno opremljene apartmaje, vse z lastno kopalnico, balkonom ali teraso, klimo, ogrevanjem in popolnoma opremljeno kuhinjo. V vseh apartmajih ponujamo kabelsko TV, brezplačno parkiranje in brezplačen WiFi.\"}', '{\"cs\": \"Apartmány Koman, nabízí, elegantně, pohodlně, zařízené, vlastní koupelna, balkon, terasa, klimatizace, topení, plně vybavená kuchyň, kabelová televize, zdarma parkování, zdarma WiFi\", \"de\": \"Apartments Koman, bietet, elegant, komfortabel, eingerichtete, private Badezimmer, Balkon, Terrasse, Klimaanlage, Heizung, voll ausgestattete Küche, Kabel-TV, kostenlose Parkplätze, kostenloses WLAN\", \"en\": \"Apartments Koman, offers, elegantly, comfortably, furnished, private bathroom, balcony, terrace, air conditioning, heating, fully equipped kitchen, cable TV, free parking, free WiFi\", \"fr\": \"Appartements Koman, propose, élégamment, confortablement, meublés, salle de bain privée, balcon, terrasse, climatisation, chauffage, cuisine entièrement équipée, télévision par câble, parking gratuit, WiFi gratuit\", \"hu\": \"Koman apartmanok, kínál, elegánsan, kényelmesen, berendezett, saját fürdőszoba, erkély, terasz, légkondicionálás, fűtés, teljesen felszerelt konyha, kábel TV, ingyenes parkolás, ingyenes WiFi\", \"it\": \"Appartamenti Koman, offre, elegantemente, comodamente, arredati, bagno privato, balcone, terrazza, aria condizionata, riscaldamento, cucina completamente attrezzata, TV via cavo, parcheggio gratuito, WiFi gratuito\", \"sl\": \"Apartmaji Koman, ponuja, elegantno, udobno, opremljeni, kopalnica, balkon, terasa, klima, ogrevanje, popolnoma opremljena kuhinja, kabelska TV, brezplačno parkiranje, brezplačen WiFi\"}', '{\"bled_text\": {\"text\": {\"cs\": \"<p>Rodinně vedené apartmány Koman se nacházejí v idylické lokalitě v centru Bledu. Nabízejí návštěvníkům pohodlné ubytování a autentický zážitek z rodinné pohostinnosti.</p>\", \"de\": \"<p>Die familiengeführten <strong>Apartments Koman</strong> befinden sich in einer idyllischen Lage im Zentrum von <strong>Bled</strong>. Sie bieten Besuchern komfortable Unterkünfte und eine authentische Erfahrung familiärer Gastfreundschaft.</p>\", \"en\": \"<p>Family-run<strong> Apartments Koman</strong> are located in an idyllic location in the center of <strong>Bled</strong>. They offer visitors comfortable accommodation and an authentic experience of family hospitality.</p>\", \"fr\": \"<p>Les <strong>appartements Koman</strong>, gérés par une famille, sont situés dans un endroit idyllique au centre de <strong>Bled</strong>. Ils offrent aux visiteurs un hébergement confortable et une expérience authentique de l\'hospitalité familiale.</p>\", \"hu\": \"<p>A családi vezetésű <strong>Koman Apartmanok</strong> egy idilli helyen találhatók <strong>Bled </strong>központjában. Kényelmes szállást és autentikus családi vendégszeretetet kínálnak a látogatóknak.</p>\", \"it\": \"<p>Gli <strong>Appartamenti Koman</strong> a conduzione familiare si trovano in una posizione idilliaca nel centro di <strong>Bled</strong>. Offrono ai visitatori un alloggio confortevole e un\'esperienza autentica dell\'ospitalità familiare.</p>\", \"sl\": \"<p>Družinsko vodeni <strong>Apartmaji Koman</strong> se nahajajo na idilični lokaciji v centru <strong>Bleda</strong>. Obiskovalcem nudijo udobno nastanitev in izkušnjo pristnega družinskega gostoljubja.</p>\"}, \"title\": {\"cs\": \"Apartmány v Bledu\", \"de\": \"Ferienwohnungen in Bled\", \"en\": \"Apartments in Bled\", \"fr\": \"Appartements à Bled\", \"hu\": \"Apartmanok Bleden\", \"it\": \"Appartamenti a Bled\", \"sl\": \"Apartmaji na Bledu\"}}, \"nasfield_text\": {\"text\": {\"cs\": \"\", \"de\": \"\", \"en\": \"\", \"fr\": \"\", \"hu\": \"\", \"it\": \"\", \"sl\": \"<p>sdsdf</p>\"}, \"title\": {\"cs\": \"\", \"de\": \"\", \"en\": \"Apartment in Nassfeld\", \"fr\": \"\", \"hu\": \"\", \"it\": \"\", \"sl\": \"Apartma v Nassfeldu\"}}}', '2024-05-15 08:10:48', '2024-05-15 20:42:28'),
        (2, 'About Us', 'about-us', '{\"cs\": \"Vítejte v apartmánech Mountain View\", \"de\": \"Willkommen in den Mountain View Apartments\", \"en\": \"Welcome to Mountain View Apartments\", \"fr\": \"Bienvenue aux Appartements Mountain View\", \"hu\": \"Üdvözöljük a Mountain View Apartmanokban\", \"it\": \"Benvenuti negli Appartamenti Mountain View\", \"sl\": \"Dobrodošli v apartmajih Mountain View\"}', '{\"cs\": \"\", \"de\": \"\", \"en\": \"My husband and I have long dreamed of arranging an idyllic space that will offer visitors to Bled a pleasant and comfortable holiday accommodation. Our wish came true in 2010, when we transformed a beautiful villa from the 1950s into holiday apartments, offering modern comfort with a touch of old times. As great lovers of art and antiques, we wanted the renovated spaces of the villa to reflect its noble past, so we included various antique decorative items of local origin when furnishing the rooms.\\nWe are honored to host visitors from all over the world. As a local, an enthusiastic taster of local delicacies and curious visitors to interesting local events, guests with We are happy to advise where to go on a trip or where to go to a good home Feast. \\nApartments Koman represent the realization of many years of dreams and It\'s a pleasure to share my enthusiasm with you. \\nWelcome into an open heart home.\", \"fr\": \"\", \"hu\": \"\", \"it\": \"\", \"sl\": \"Apartmaji Koman ponuja 3 elegantno in udobno opremljene apartmaje, vse z lastno kopalnico, balkonom ali teraso, klimo, ogrevanjem in popolnoma opremljeno kuhinjo. V vseh apartmajih ponujamo kabelsko TV, brezplačno parkiranje in brezplačen WiFi.\"}', '{\"cs\": \"Apartmány Koman, nabízí, elegantně, pohodlně, zařízené, vlastní koupelna, balkon, terasa, klimatizace, topení, plně vybavená kuchyň, kabelová televize, zdarma parkování, zdarma WiFi\", \"de\": \"Apartments Koman, bietet, elegant, komfortabel, eingerichtete, private Badezimmer, Balkon, Terrasse, Klimaanlage, Heizung, voll ausgestattete Küche, Kabel-TV, kostenlose Parkplätze, kostenloses WLAN\", \"en\": \"Apartments Koman, offers, elegantly, comfortably, furnished, private bathroom, balcony, terrace, air conditioning, heating, fully equipped kitchen, cable TV, free parking, free WiFi\", \"fr\": \"Appartements Koman, propose, élégamment, confortablement, meublés, salle de bain privée, balcon, terrasse, climatisation, chauffage, cuisine entièrement équipée, télévision par câble, parking gratuit, WiFi gratuit\", \"hu\": \"Koman apartmanok, kínál, elegánsan, kényelmesen, berendezett, saját fürdőszoba, erkély, terasz, légkondicionálás, fűtés, teljesen felszerelt konyha, kábel TV, ingyenes parkolás, ingyenes WiFi\", \"it\": \"Appartamenti Koman, offre, elegantemente, comodamente, arredati, bagno privato, balcone, terrazza, aria condizionata, riscaldamento, cucina completamente attrezzata, TV via cavo, parcheggio gratuito, WiFi gratuito\", \"sl\": \"Apartmaji Koman, ponuja, elegantno, udobno, opremljeni, kopalnica, balkon, terasa, klima, ogrevanje, popolnoma opremljena kuhinja, kabelska TV, brezplačno parkiranje, brezplačen WiFi\"}', '{\"definition_name\": {\"text\": {\"cs\": \"\", \"de\": \"\", \"en\": \"\", \"fr\": \"\", \"hu\": \"\", \"it\": \"\", \"sl\": \"\"}, \"title\": {\"cs\": \"\", \"de\": \"\", \"en\": \"\", \"fr\": \"\", \"hu\": \"\", \"it\": \"\", \"sl\": \"\"}}}', '2024-05-15 08:10:48', '2024-05-15 08:10:48');";

        \DB::unprepared($sql);
        // Page::factory()->create($homepage);
        // Page::factory()->create($about_us);
    }
}
