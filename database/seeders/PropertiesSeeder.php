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
        $sql = "INSERT INTO `properties` (`id`, `user_id`, `type`, `slug`, `name`, `address`, `title`, `description`, `quote`, `long_description`, `keywords`, `size`, `is_entire_apartment`, `coordinates`, `bed_types`, `recomended`, `prices`, `rules`, `created_at`, `updated_at`) VALUES
        (1, 2, 'One-Bedroom Apartment', 'nassfeld-and-lake-apartment', 'Nassfeld and Lake Apartment', '61 Neudorf 1, 9620 Hermagor, Austria', '{\"cs\": \"Nassfeld and Lake Apartment\", \"de\": \"Nassfeld and Lake Apartment\", \"en\": \"Nassfeld and Lake Apartment\", \"fr\": \"Nassfeld and Lake Apartment\", \"hu\": \"Nassfeld and Lake Apartment\", \"it\": \"Nassfeld and Lake Apartment\", \"sl\": \"Nassfeld and Lake Apartment\"}', '{\"cs\": \"Nabízející zahradu, apartmán Nassfeld and Lake poskytuje ubytování v Hermagoru. Tento objekt nabízí přístup na balkon a bezplatné soukromé parkoviště. Ubytování zajišťuje soukromé ubytování a odhlášení a parkování pro kola pro hosty.\", \"de\": \"Mit einem Garten erwartet Sie das Nassfeld and Lake Apartment in Hermagor. Diese Unterkunft bietet Zugang zu einem Balkon und kostenfreie private Parkplätze. Die Unterkunft bietet einen privaten Check-in und Check-out sowie Fahrradparkplätze für die Gäste.\", \"en\": \"Featuring a garden, Nassfeld and Lake Apartment offers accommodations in Hermagor. This property offers access to a balcony and free private parking. The accommodation provides private check-in and check-out and bicycle parking for guests.\", \"fr\": \"Doté d\'un jardin, le Nassfeld and Lake Apartment propose des hébergements à Hermagor. Cet établissement offre l\'accès à un balcon et un parking privé gratuit. L\'hébergement propose un enregistrement et un départ privés ainsi qu\'un parking à vélos pour les clients.\", \"hu\": \"A Nassfeld and Lake Apartment kerttel várja vendégeit Hermagorban. A szálláshely teraszhoz és ingyenes privát parkolási lehetőséghez biztosít hozzáférést. A szálláshely magáncsekkolást és kijelentkezést kínál, valamint biciklitárolót a vendégek számára.\", \"it\": \"Dotato di giardino, il Nassfeld and Lake Apartment offre sistemazioni a Hermagor. Questa struttura offre l\'accesso a un balcone e un parcheggio privato gratuito. L\'alloggio fornisce check-in e check-out privati e parcheggio per biciclette per gli ospiti.\", \"sl\": \"S svojim vrtom ponuja apartma Nassfeld and Lake namestitev v kraju Hermagor. Ta nastanitev nudi dostop do balkona in brezplačnega zasebnega parkirišča. Nastanitev nudi tudi možnost zasebnega prijave in odjave ter parkirišče za kolesa za goste.\"}', '{\"cs\": \"Rakouská Korutanská je nádherná země.\", \"de\": \"Österreichisch Kärnten ist ein wundervolles Land.\", \"en\": \"Austrian Carinthia is a wonderful land.\", \"fr\": \"La Carinthie autrichienne est une terre merveilleuse.\", \"hu\": \"Az osztrák Károlyi a csodálatos föld.\", \"it\": \"La Carinzia austriaca è una terra meravigliosa.\", \"sl\": \"Avstrijska Koroška je čudovita dežela.\"}', '{\"cs\": \"Nabízející zahradu, apartmán Nassfeld and Lake poskytuje ubytování v Hermagoru. Tento objekt nabízí přístup na balkon a bezplatné soukromé parkoviště. Ubytování zajišťuje soukromé ubytování a odhlášení a parkování pro kola pro hosty.\", \"de\": \"Mit einem Garten erwartet Sie das Nassfeld and Lake Apartment in Hermagor. Diese Unterkunft bietet Zugang zu einem Balkon und kostenfreie private Parkplätze. Die Unterkunft bietet einen privaten Check-in und Check-out sowie Fahrradparkplätze für die Gäste.\", \"en\": \"<p>Featuring a garden, <strong>Nassfeld and Lake Apartment </strong>offers accommodations in <strong>Hermagor</strong>. This property offers access to a balcony and free private parking.</p><p>The accommodation provides private check-in and check-out and bicycle parking for guests. Offering a terrace and mountain views, the apartment includes 1 bedroom, a living room, cable flat-screen TV, an equipped kitchen, and 1 bathroom with a bath. </p><p>This apartment also has a patio that doubles up as an outdoor dining area. The apartment offers bed linen, towels, and ironing service. For guests with children, the apartment features outdoor play equipment. Ski storage space is available on-site and skiing can be enjoyed close to <strong>Nassfeld and Lake Apartment</strong>. </p><p><strong>Porcia Castle</strong> is 30 miles from the accommodation, while <strong>Lake Pressegger</strong> is 5 miles from the property. The nearest airport is Klagenfurt Airport, 54 miles from Nassfeld and Lake Apartment. </p><p><em>Distance in property description is calculated using © OpenStreetMap</em></p>\", \"fr\": \"Doté d\'un jardin, le Nassfeld and Lake Apartment propose des hébergements à Hermagor. Cet établissement offre l\'accès à un balcon et un parking privé gratuit. L\'hébergement propose un enregistrement et un départ privés ainsi qu\'un parking à vélos pour les clients.\", \"hu\": \"A Nassfeld and Lake Apartment kerttel várja vendégeit Hermagorban. A szálláshely teraszhoz és ingyenes privát parkolási lehetőséghez biztosít hozzáférést. A szálláshely magáncsekkolást és kijelentkezést kínál, valamint biciklitárolót a vendégek számára.\", \"it\": \"Dotato di giardino, il Nassfeld and Lake Apartment offre sistemazioni a Hermagor. Questa struttura offre l\'accesso a un balcone e un parcheggio privato gratuito. L\'alloggio fornisce check-in e check-out privati e parcheggio per biciclette per gli ospiti.\", \"sl\": \"<p>Nastanitev Nassfeld and Lake Apartment se nahaja približno 47 km od znamenitosti skakalnica Villacher Alpenarena in ponuja razgled na vrt, balkon ter aparat za kavo. </p><p>Nastanitev je 28 km od znamenitosti <strong>Terra Mystica Mine </strong>in nudi vrt ter brezplačno zasebno parkirišče. </p><p>Apartma s teraso in pogledom na gore ima spalnico (1), dnevno sobo, TV z ravnim zaslonom, opremljeno kuhinjo s hladilnikom in s pečico ter kopalnico (1) s kadjo. V apartmaju lahko koristite brisače in posteljnino. V sklopu nastanitve je na voljo otroško igrišče, v bližini pa se lahko podate na smučanje. </p><p>Znamenitost <strong>Porcia Castle</strong> je od nastanitve <strong>Nassfeld and Lake Apartment</strong> oddaljena 49 km. Najbližje letališče (<strong>Letališče Celovec</strong>) je 87 km od nastanitve <strong>Nassfeld and Lake Apartment</strong>. </p><p><em>Razdalja v opisu nastanitve je izračunana z © OpenStreetMap.</em></p>\"}', '{\"cs\": null, \"de\": null, \"en\": null, \"fr\": null, \"hu\": null, \"it\": null, \"sl\": \"accommodations, Hermagor\"}', '50', 1, '{\"lat\": \"46.618689\", \"lng\": \"13.3809776\"}', '[{\"icon\": \"QueenBedIcon\", \"name\": \"1 queen bed\", \"title\": \"bedroom\"}, {\"icon\": \"SofaBedIcon\", \"name\": \"1 sofa bed\", \"title\": \"living_room\"}]', '[\"for 4 adults\"]', '[{\"price\": \"945\", \"guests\": 4}, {\"price\": \"883\", \"guests\": 3}, {\"price\": \"846\", \"guests\": 2}, {\"price\": \"810\", \"guests\": 1}]', '{\"cs\": [{\"icon\": \"CheckInIcon\", \"name\": \"Přihlášení\", \"title\": \"Od 16:00 do 00:00\", \"description\": \"Musíte ubytování předem informovat o svém předpokládaném čase příjezdu.\"}, {\"icon\": \"CheckOutIcon\", \"name\": \"Odhlášení\", \"title\": \"Od 00:00 do 10:00\", \"description\": null}, {\"icon\": \"CancellationPrepaymentIcon\", \"name\": \"Zrušení/předplatné\", \"title\": null, \"description\": \"Podmínky zrušení a předplatného se mohou lišit v závislosti na typu apartmánu. Před rezervací si prosím zkontrolujte podmínky svého vybraného apartmánu.\"}, {\"icon\": \"ChildrenBedsIcon\", \"name\": \"Děti a postele\", \"title\": \"Dětské politiky\", \"description\": \"Děti všech věkových kategorií jsou vítány. Pro zobrazení správných cen a informací o obsazenosti zadejte počet a věk dětí ve své skupině do vyhledávání.\"}, {\"icon\": \"AgeRestrictionIcon\", \"name\": \"Věkové omezení\", \"title\": null, \"description\": \"Minimální věk pro ubytování je 18 let.\"}, {\"icon\": \"NonSmokingRoomsIcon\", \"name\": \"Kouření\", \"title\": null, \"description\": \"Kouření není povoleno.\"}, {\"icon\": \"PartiesIcon\", \"name\": \"Večírky\", \"title\": null, \"description\": \"Večírky/akce nejsou povoleny.\"}, {\"icon\": \"QuietHoursIcon\", \"name\": \"Klidové hodiny\", \"title\": null, \"description\": \"Hosté musí být tiší od 22:00 do 07:00 hodin.\"}, {\"icon\": \"PetsIcon\", \"name\": \"Domácí zvířata\", \"title\": null, \"description\": \"Domácí zvířata nejsou povolena.\"}], \"de\": [{\"icon\": \"CheckInIcon\", \"name\": \"Check-in\", \"title\": \"Von 16:00 bis 00:00 Uhr\", \"description\": \"Sie müssen der Unterkunft im Voraus mitteilen, wann Sie anreisen.\"}, {\"icon\": \"CheckOutIcon\", \"name\": \"Check-out\", \"title\": \"Von 00:00 bis 10:00 Uhr\", \"description\": null}, {\"icon\": \"CancellationPrepaymentIcon\", \"name\": \"Stornierung/Vorauszahlung\", \"title\": null, \"description\": \"Stornierungs- und Vorauszahlungsbedingungen können je nach Apartmenttyp variieren. Bitte überprüfen Sie die Bedingungen Ihrer gewählten Unterkunft.\"}, {\"icon\": \"ChildrenBedsIcon\", \"name\": \"Kinder und Betten\", \"title\": \"Kinderregelung\", \"description\": \"Kinder jeden Alters sind willkommen. Um korrekte Preise und Belegungsinformationen zu sehen, fügen Sie Ihrer Suche bitte die Anzahl der Kinder in Ihrer Gruppe und deren Alter hinzu. Babybetten oder Zustellbetten sind nicht verfügbar.\"}, {\"icon\": \"AgeRestrictionIcon\", \"name\": \"Altersbeschränkung\", \"title\": null, \"description\": \"Das Mindestalter für den Check-in beträgt 18 Jahre.\"}, {\"icon\": \"NonSmokingRoomsIcon\", \"name\": \"Rauchen\", \"title\": null, \"description\": \"Rauchen ist nicht gestattet.\"}, {\"icon\": \"PartiesIcon\", \"name\": \"Partys\", \"title\": null, \"description\": \"Partys/Veranstaltungen sind nicht erlaubt.\"}, {\"icon\": \"QuietHoursIcon\", \"name\": \"Ruhezeiten\", \"title\": null, \"description\": \"Gäste müssen sich zwischen 22:00 und 07:00 Uhr leise verhalten.\"}, {\"icon\": \"PetsIcon\", \"name\": \"Haustiere\", \"title\": null, \"description\": \"Haustiere sind nicht gestattet.\"}], \"en\": [{\"icon\": \"CheckInIcon\", \"name\": \"Check In\", \"title\": \"From 4:00 PM to 12:00 AM\", \"description\": \"You need to let the property know what time you\'ll be arriving in advance.\"}, {\"icon\": \"CheckOutIcon\", \"name\": \"Check Out\", \"title\": \"From 12:00 AM to 10:00 AM\", \"description\": null}, {\"icon\": \"CancellationPrepaymentIcon\", \"name\": \"Cancellation/prepayment\", \"title\": null, \"description\": \"Cancellation and prepayment policies vary according to apartment type. Please check the Apartment Conditions when selecting your apartment above.\"}, {\"icon\": \"ChildrenBedsIcon\", \"name\": \"Children & Beds\", \"title\": \"Child policies\", \"description\": \"Children of all ages are welcome. To see correct prices and occupancy info, add the number and ages of children in your group to your search. No cribs or extra beds are available.\"}, {\"icon\": \"AgeRestrictionIcon\", \"name\": \"Age restriction\", \"title\": null, \"description\": \"The minimum age for check-in is 18\"}, {\"icon\": \"NonSmokingRoomsIcon\", \"name\": \"Smoking\", \"title\": null, \"description\": \"Smoking is not allowed.\"}, {\"icon\": \"PartiesIcon\", \"name\": \"Parties\", \"title\": null, \"description\": \"Parties/events are not allowed\"}, {\"icon\": \"QuietHoursIcon\", \"name\": \"Quiet hours\", \"title\": null, \"description\": \"Guests need be quiet between 10:00 PM and 7:00 AM.\"}, {\"icon\": \"PetsIcon\", \"name\": \"Pets\", \"title\": null, \"description\": \"Pets are not allowed.\"}], \"fr\": [{\"icon\": \"CheckInIcon\", \"name\": \"Arrivée\", \"title\": \"De 16h à minuit\", \"description\": \"Vous devez informer l\'établissement à l\'avance de l\'heure à laquelle vous prévoyez d\'arriver.\"}, {\"icon\": \"CheckOutIcon\", \"name\": \"Départ\", \"title\": \"De minuit à 10h00\", \"description\": null}, {\"icon\": \"CancellationPrepaymentIcon\", \"name\": \"Annulation/prépaiement\", \"title\": null, \"description\": \"Les conditions d\'annulation et de prépaiement varient en fonction du type d\'appartement. Veuillez vérifier les conditions de l\'appartement lors de la sélection de votre appartement ci-dessus.\"}, {\"icon\": \"ChildrenBedsIcon\", \"name\": \"Enfants et lits\", \"title\": \"Politique enfant\", \"description\": \"Tous les enfants sont les bienvenus. Pour voir les tarifs et les informations sur l\'occupation corrects, veuillez ajouter le nombre et l\'âge des enfants de votre groupe à votre recherche. Aucun lit d\'appoint ni lit bébé n\'est disponible.\"}, {\"icon\": \"AgeRestrictionIcon\", \"name\": \"Restriction d\'âge\", \"title\": null, \"description\": \"L\'âge minimum pour effectuer l\'enregistrement est de 18 ans.\"}, {\"icon\": \"NonSmokingRoomsIcon\", \"name\": \"Fumer\", \"title\": null, \"description\": \"Il est interdit de fumer.\"}, {\"icon\": \"PartiesIcon\", \"name\": \"Fêtes\", \"title\": null, \"description\": \"Les fêtes/événements ne sont pas autorisés\"}, {\"icon\": \"QuietHoursIcon\", \"name\": \"Heures calmes\", \"title\": null, \"description\": \"Les clients doivent éviter de faire du bruit entre 22h00 et 7h00.\"}, {\"icon\": \"PetsIcon\", \"name\": \"Animaux domestiques\", \"title\": null, \"description\": \"Les animaux de compagnie ne sont pas admis.\"}], \"hu\": [{\"icon\": \"CheckInIcon\", \"name\": \"Érkezés\", \"title\": \"16:00-tól éjfélig\", \"description\": \"Előzetesen értesítenie kell a szálláshelyet, hogy mikor érkezik.\"}, {\"icon\": \"CheckOutIcon\", \"name\": \"Távozás\", \"title\": \"éjfél után 10:00-ig\", \"description\": null}, {\"icon\": \"CancellationPrepaymentIcon\", \"name\": \"Lemondás/előleg fizetése\", \"title\": null, \"description\": \"A lemondási és előlegfizetési feltételek a lakástípustól függően változnak. Kérjük, válassza ki a lakástípust a fenti apartmanfeltételek ellenőrzésekor.\"}, {\"icon\": \"ChildrenBedsIcon\", \"name\": \"Gyermekek és ágyak\", \"title\": \"Gyerekpolitika\", \"description\": \"Minden korosztályú gyermek fogadására van lehetőség. Helyes árak és foglaltsági információk megtekintéséhez adja meg a gyerekek számát és életkorát a csoportjában a kereséshez. Kispályás focilabda vagy pótágy nem áll rendelkezésre.\"}, {\"icon\": \"AgeRestrictionIcon\", \"name\": \"Korhatár\", \"title\": null, \"description\": \"A bejelentkezés minimális életkora 18 év.\"}, {\"icon\": \"NonSmokingRoomsIcon\", \"name\": \"Dohányzás\", \"title\": null, \"description\": \"Dohányzás tilos.\"}, {\"icon\": \"PartiesIcon\", \"name\": \"Bulik\", \"title\": null, \"description\": \"Bulik/rendezvények nem engedélyezettek\"}, {\"icon\": \"QuietHoursIcon\", \"name\": \"Csendes órák\", \"title\": null, \"description\": \"A vendégeknek csendesnek kell lenniük este 10:00 és reggel 7:00 között.\"}, {\"icon\": \"PetsIcon\", \"name\": \"Háziállatok\", \"title\": null, \"description\": \"Háziállat nem engedélyezett.\"}], \"it\": [{\"icon\": \"CheckInIcon\", \"name\": \"Check-in\", \"title\": \"Dalle 16:00 alle 00:00\", \"description\": \"È necessario comunicare in anticipo alla struttura l\'orario previsto per il check-in.\"}, {\"icon\": \"CheckOutIcon\", \"name\": \"Check-out\", \"title\": \"Dalle 00:00 alle 10:00\", \"description\": null}, {\"icon\": \"CancellationPrepaymentIcon\", \"name\": \"Annullamento/pagamento anticipato\", \"title\": null, \"description\": \"Le condizioni relative alla cancellazione e al pagamento anticipato variano a seconda della tipologia di appartamento. Si prega di verificare le condizioni della tua prenotazione.\"}, {\"icon\": \"ChildrenBedsIcon\", \"name\": \"Bambini e letti\", \"title\": \"Politiche per i bambini\", \"description\": \"I bambini di tutte le età sono i benvenuti. Per vedere corrette informazioni sui prezzi e sulla disponibilità, inserisci il numero e l\'età dei bambini nel tuo gruppo.\"}, {\"icon\": \"AgeRestrictionIcon\", \"name\": \"Limitazione d\'età\", \"title\": null, \"description\": \"L\'età minima per fare il check-in è 18 anni.\"}, {\"icon\": \"NonSmokingRoomsIcon\", \"name\": \"Fumo\", \"title\": null, \"description\": \"È vietato fumare.\"}, {\"icon\": \"PartiesIcon\", \"name\": \"Feste\", \"title\": null, \"description\": \"Feste/eventi non ammessi.\"}, {\"icon\": \"QuietHoursIcon\", \"name\": \"Orari silenziosi\", \"title\": null, \"description\": \"Gli ospiti devono rispettare il silenzio tra le 22:00 e le 07:00.\"}, {\"icon\": \"PetsIcon\", \"name\": \"Animali\", \"title\": null, \"description\": \"Animali non ammessi.\"}], \"sl\": [{\"icon\": \"CheckInIcon\", \"name\": \"Prijava\", \"title\": \"Od 16:00 do 00:00\", \"description\": \"O svojem prihodu morate prej obvestiti nastanitev.\"}, {\"icon\": \"CheckOutIcon\", \"name\": \"Odjava\", \"title\": \"Od 00:00 do 10:00\", \"description\": null}, {\"icon\": \"CancellationPrepaymentIcon\", \"name\": \"Preklic/predplačilo\", \"title\": null, \"description\": \"Politika preklica in predplačila se lahko razlikuje glede na vrsto apartmaja. Prosimo, preverite pogoje apartmaja pri izbiri apartmaja zgoraj.\"}, {\"icon\": \"ChildrenBedsIcon\", \"name\": \"Otroci in postelje\", \"title\": \"Politike otrok\", \"description\": \"Otroci vseh starosti so dobrodošli. Da bi videli pravilne cene in informacije o zasedenosti, dodajte število in starost otrok v svojo iskalno poizvedbo. Otroške postelje ali dodatne postelje niso na voljo.\"}, {\"icon\": \"AgeRestrictionIcon\", \"name\": \"Omejitev glede starosti\", \"title\": null, \"description\": \"Najmanjša starost za prijavo je 18 let.\"}, {\"icon\": \"NonSmokingRoomsIcon\", \"name\": \"Kajenje\", \"title\": null, \"description\": \"Kajenje ni dovoljeno.\"}, {\"icon\": \"PartiesIcon\", \"name\": \"Praznovanja\", \"title\": null, \"description\": \"Praznovanja in dogodki niso dovoljeni.\"}, {\"icon\": \"QuietHoursIcon\", \"name\": \"Ure tišine\", \"title\": null, \"description\": \"Gostje morajo biti tiho med 22:00 in 07:00.\"}, {\"icon\": \"PetsIcon\", \"name\": \"Hišni ljubljenčki\", \"title\": null, \"description\": \"Hišni ljubljenčki niso dovoljeni.\"}]}', '2024-05-14 19:41:34', '2024-05-15 09:37:44');";

        \DB::unprepared($sql);


        $property = Property::find(1);

        foreach (Facility::get() as $key => $facility) {
            $facility->properties()->attach($property);
        }
    }

    private function nassfeld(): array
    {
        return [
            'user_id' => 2,
            'type' => "One-Bedroom Apartment",
            'slug' => str("Nassfeld and Lake Apartment")->slug(),
            'name' => "Nassfeld and Lake Apartment",
            'address' => '61 Neudorf 1, 9620 Hermagor, Austria',
            'title' => [
                'sl' => 'Nassfeld and Lake Apartment',
                'en' => 'Nassfeld and Lake Apartment',
                'de' => 'Nassfeld and Lake Apartment',
                'hu' => 'Nassfeld and Lake Apartment',
                'it' => 'Nassfeld and Lake Apartment',
                'fr' => 'Nassfeld and Lake Apartment',
                'cs' => 'Nassfeld and Lake Apartment',
            ],
            'description' => [
                "sl" => "S svojim vrtom ponuja apartma Nassfeld and Lake namestitev v kraju Hermagor. Ta nastanitev nudi dostop do balkona in brezplačnega zasebnega parkirišča. Nastanitev nudi tudi možnost zasebnega prijave in odjave ter parkirišče za kolesa za goste.",
                "en" => "Featuring a garden, Nassfeld and Lake Apartment offers accommodations in Hermagor. This property offers access to a balcony and free private parking. The accommodation provides private check-in and check-out and bicycle parking for guests.",
                "de" => "Mit einem Garten erwartet Sie das Nassfeld and Lake Apartment in Hermagor. Diese Unterkunft bietet Zugang zu einem Balkon und kostenfreie private Parkplätze. Die Unterkunft bietet einen privaten Check-in und Check-out sowie Fahrradparkplätze für die Gäste.",
                "hu" => "A Nassfeld and Lake Apartment kerttel várja vendégeit Hermagorban. A szálláshely teraszhoz és ingyenes privát parkolási lehetőséghez biztosít hozzáférést. A szálláshely magáncsekkolást és kijelentkezést kínál, valamint biciklitárolót a vendégek számára.",
                "it" => "Dotato di giardino, il Nassfeld and Lake Apartment offre sistemazioni a Hermagor. Questa struttura offre l'accesso a un balcone e un parcheggio privato gratuito. L'alloggio fornisce check-in e check-out privati e parcheggio per biciclette per gli ospiti.",
                "fr" => "Doté d'un jardin, le Nassfeld and Lake Apartment propose des hébergements à Hermagor. Cet établissement offre l'accès à un balcon et un parking privé gratuit. L'hébergement propose un enregistrement et un départ privés ainsi qu'un parking à vélos pour les clients.",
                "cs" => "Nabízející zahradu, apartmán Nassfeld and Lake poskytuje ubytování v Hermagoru. Tento objekt nabízí přístup na balkon a bezplatné soukromé parkoviště. Ubytování zajišťuje soukromé ubytování a odhlášení a parkování pro kola pro hosty.",
            ],
            'quote' => [
                "sl" => "Avstrijska Koroška je čudovita dežela.",
                "en" => "Austrian Carinthia is a wonderful land.",
                "de" => "Österreichisch Kärnten ist ein wundervolles Land.",
                "hu" => "Az osztrák Károlyi a csodálatos föld.",
                "it" => "La Carinzia austriaca è una terra meravigliosa.",
                "fr" => "La Carinthie autrichienne est une terre merveilleuse.",
                "cs" => "Rakouská Korutanská je nádherná země.",
            ],
            'long_description' => [
                "sl" => "Nastanitev Nassfeld and Lake Apartment se nahaja približno 47 km od znamenitosti skakalnica Villacher Alpenarena in ponuja razgled na vrt, balkon ter aparat za kavo. Nastanitev je 28 km od znamenitosti Terra Mystica Mine in nudi vrt ter brezplačno zasebno parkirišče.

                Apartma s teraso in pogledom na gore ima spalnico (1), dnevno sobo, TV z ravnim zaslonom, opremljeno kuhinjo s hladilnikom in s pečico ter kopalnico (1) s kadjo. V apartmaju lahko koristite brisače in posteljnino.

                V sklopu nastanitve je na voljo otroško igrišče, v bližini pa se lahko podate na smučanje.

                Znamenitost Porcia Castle je od nastanitve Nassfeld and Lake Apartment oddaljena 49 km. Najbližje letališče (Letališče Celovec) je 87 km od nastanitve Nassfeld and Lake Apartment.

                Razdalja v opisu nastanitve je izračunana z © OpenStreetMap.",
                "en" => "Featuring a garden, Nassfeld and Lake Apartment offers accommodations in Hermagor. This property offers access to a balcony and free private parking. The accommodation provides private check-in and check-out and bicycle parking for guests.

                Offering a terrace and mountain views, the apartment includes 1 bedroom, a living room, cable flat-screen TV, an equipped kitchen, and 1 bathroom with a bath. This apartment also has a patio that doubles up as an outdoor dining area. The apartment offers bed linen, towels, and ironing service.

                For guests with children, the apartment features outdoor play equipment. Ski storage space is available on-site and skiing can be enjoyed close to Nassfeld and Lake Apartment.

                Porcia Castle is 30 miles from the accommodation, while Lake Pressegger is 5 miles from the property. The nearest airport is Klagenfurt Airport, 54 miles from Nassfeld and Lake Apartment.

                Distance in property description is calculated using © OpenStreetMap",
                "de" => "Mit einem Garten erwartet Sie das Nassfeld and Lake Apartment in Hermagor. Diese Unterkunft bietet Zugang zu einem Balkon und kostenfreie private Parkplätze. Die Unterkunft bietet einen privaten Check-in und Check-out sowie Fahrradparkplätze für die Gäste.",
                "hu" => "A Nassfeld and Lake Apartment kerttel várja vendégeit Hermagorban. A szálláshely teraszhoz és ingyenes privát parkolási lehetőséghez biztosít hozzáférést. A szálláshely magáncsekkolást és kijelentkezést kínál, valamint biciklitárolót a vendégek számára.",
                "it" => "Dotato di giardino, il Nassfeld and Lake Apartment offre sistemazioni a Hermagor. Questa struttura offre l'accesso a un balcone e un parcheggio privato gratuito. L'alloggio fornisce check-in e check-out privati e parcheggio per biciclette per gli ospiti.",
                "fr" => "Doté d'un jardin, le Nassfeld and Lake Apartment propose des hébergements à Hermagor. Cet établissement offre l'accès à un balcon et un parking privé gratuit. L'hébergement propose un enregistrement et un départ privés ainsi qu'un parking à vélos pour les clients.",
                "cs" => "Nabízející zahradu, apartmán Nassfeld and Lake poskytuje ubytování v Hermagoru. Tento objekt nabízí přístup na balkon a bezplatné soukromé parkoviště. Ubytování zajišťuje soukromé ubytování a odhlášení a parkování pro kola pro hosty.",
            ],
            'keywords' => [
                'sl' => "accommodations, Hermagor ",
                "en" => "",
                "de" => "",
                "hu" => "",
                "it" => "",
                "fr" => "",
                "cs" => "",
            ],
            'size' => "50",
            'is_entire_apartment' => true,
            'coordinates' => [
                'lat' => '46.618689',
                'lng' => '13.3809776'
            ],

            'bed_types' => [
                ['title' => 'bedroom', 'name' => '1 queen bed', 'icon' => 'QueenBedIcon'],
                ['title' => 'living_room', 'name' => '1 sofa bed', 'icon' => 'SofaBedIcon'],
            ],
            'recomended' => [
                'for 4 adults',
            ],
            'prices' => [
                ['guests' => 4, 'price' => "945"],
                ['guests' => 3, 'price' => "883"],
                ['guests' => 2, 'price' => "846"],
                ['guests' => 1, 'price' => "810"],
            ],
            'rules' => [
                'en' => [
                    ['name' => 'Check In', 'title' => 'From 4:00 PM to 12:00 AM', 'description' => 'You need to let the property know what time you\'ll be arriving in advance.', 'icon' => 'CheckInIcon'],
                    ['name' => 'Check Out', 'title' => 'From 12:00 AM to 10:00 AM', 'description' => '', 'icon' => 'CheckOutIcon'],
                    ['name' => 'Cancellation/prepayment', 'title' => '', 'description' => 'Cancellation and prepayment policies vary according to apartment type. Please check the Apartment Conditions when selecting your apartment above.', 'icon' => 'CancellationPrepaymentIcon'],
                    ['name' => 'Children & Beds', 'title' => 'Child policies', 'description' => 'Children of all ages are welcome. To see correct prices and occupancy info, add the number and ages of children in your group to your search. No cribs or extra beds are available.', 'icon' => 'ChildrenBedsIcon'],
                    ['name' => 'Age restriction', 'title' => '', 'description' => 'The minimum age for check-in is 18', 'icon' => 'AgeRestrictionIcon'],
                    ['name' => 'Smoking', 'title' => '', 'description' => 'Smoking is not allowed.', 'icon' => 'NonSmokingRoomsIcon'],
                    ['name' => 'Parties', 'title' => '', 'description' => 'Parties/events are not allowed', 'icon' => 'PartiesIcon'],
                    ['name' => 'Quiet hours', 'title' => '', 'description' => 'Guests need be quiet between 10:00 PM and 7:00 AM.', 'icon' => 'QuietHoursIcon'],
                    ['name' => 'Pets', 'title' => '', 'description' => 'Pets are not allowed.', 'icon' => 'PetsIcon'],
                ],
                'sl' => [
                    ['name' => 'Prijava', 'title' => 'Od 16:00 do 00:00', 'description' => 'O svojem prihodu morate prej obvestiti nastanitev.', 'icon' => 'CheckInIcon'],
                    ['name' => 'Odjava', 'title' => 'Od 00:00 do 10:00', 'description' => '', 'icon' => 'CheckOutIcon'],
                    ['name' => 'Preklic/predplačilo', 'title' => '', 'description' => 'Politika preklica in predplačila se lahko razlikuje glede na vrsto apartmaja. Prosimo, preverite pogoje apartmaja pri izbiri apartmaja zgoraj.', 'icon' => 'CancellationPrepaymentIcon'],
                    ['name' => 'Otroci in postelje', 'title' => 'Politike otrok', 'description' => 'Otroci vseh starosti so dobrodošli. Da bi videli pravilne cene in informacije o zasedenosti, dodajte število in starost otrok v svojo iskalno poizvedbo. Otroške postelje ali dodatne postelje niso na voljo.', 'icon' => 'ChildrenBedsIcon'],
                    ['name' => 'Omejitev glede starosti', 'title' => '', 'description' => 'Najmanjša starost za prijavo je 18 let.', 'icon' => 'AgeRestrictionIcon'],
                    ['name' => 'Kajenje', 'title' => '', 'description' => 'Kajenje ni dovoljeno.', 'icon' => 'NonSmokingRoomsIcon'],
                    ['name' => 'Praznovanja', 'title' => '', 'description' => 'Praznovanja in dogodki niso dovoljeni.', 'icon' => 'PartiesIcon'],
                    ['name' => 'Ure tišine', 'title' => '', 'description' => 'Gostje morajo biti tiho med 22:00 in 07:00.', 'icon' => 'QuietHoursIcon'],
                    ['name' => 'Hišni ljubljenčki', 'title' => '', 'description' => 'Hišni ljubljenčki niso dovoljeni.', 'icon' => 'PetsIcon']
                ],
                'de' => [
                    ['name' => 'Check-in', 'title' => 'Von 16:00 bis 00:00 Uhr', 'description' => 'Sie müssen der Unterkunft im Voraus mitteilen, wann Sie anreisen.', 'icon' => 'CheckInIcon'],
                    ['name' => 'Check-out', 'title' => 'Von 00:00 bis 10:00 Uhr', 'description' => '', 'icon' => 'CheckOutIcon'],
                    ['name' => 'Stornierung/Vorauszahlung', 'title' => '', 'description' => 'Stornierungs- und Vorauszahlungsbedingungen können je nach Apartmenttyp variieren. Bitte überprüfen Sie die Bedingungen Ihrer gewählten Unterkunft.', 'icon' => 'CancellationPrepaymentIcon'],
                    ['name' => 'Kinder und Betten', 'title' => 'Kinderregelung', 'description' => 'Kinder jeden Alters sind willkommen. Um korrekte Preise und Belegungsinformationen zu sehen, fügen Sie Ihrer Suche bitte die Anzahl der Kinder in Ihrer Gruppe und deren Alter hinzu. Babybetten oder Zustellbetten sind nicht verfügbar.', 'icon' => 'ChildrenBedsIcon'],
                    ['name' => 'Altersbeschränkung', 'title' => '', 'description' => 'Das Mindestalter für den Check-in beträgt 18 Jahre.', 'icon' => 'AgeRestrictionIcon'],
                    ['name' => 'Rauchen', 'title' => '', 'description' => 'Rauchen ist nicht gestattet.', 'icon' => 'NonSmokingRoomsIcon'],
                    ['name' => 'Partys', 'title' => '', 'description' => 'Partys/Veranstaltungen sind nicht erlaubt.', 'icon' => 'PartiesIcon'],
                    ['name' => 'Ruhezeiten', 'title' => '', 'description' => 'Gäste müssen sich zwischen 22:00 und 07:00 Uhr leise verhalten.', 'icon' => 'QuietHoursIcon'],
                    ['name' => 'Haustiere', 'title' => '', 'description' => 'Haustiere sind nicht gestattet.', 'icon' => 'PetsIcon']
                ],
                'it' => [
                    ['name' => 'Check-in', 'title' => 'Dalle 16:00 alle 00:00', 'description' => 'È necessario comunicare in anticipo alla struttura l\'orario previsto per il check-in.', 'icon' => 'CheckInIcon'],
                    ['name' => 'Check-out', 'title' => 'Dalle 00:00 alle 10:00', 'description' => '', 'icon' => 'CheckOutIcon'],
                    ['name' => 'Annullamento/pagamento anticipato', 'title' => '', 'description' => 'Le condizioni relative alla cancellazione e al pagamento anticipato variano a seconda della tipologia di appartamento. Si prega di verificare le condizioni della tua prenotazione.', 'icon' => 'CancellationPrepaymentIcon'],
                    ['name' => 'Bambini e letti', 'title' => 'Politiche per i bambini', 'description' => 'I bambini di tutte le età sono i benvenuti. Per vedere corrette informazioni sui prezzi e sulla disponibilità, inserisci il numero e l\'età dei bambini nel tuo gruppo.', 'icon' => 'ChildrenBedsIcon'],
                    ['name' => 'Limitazione d\'età', 'title' => '', 'description' => 'L\'età minima per fare il check-in è 18 anni.', 'icon' => 'AgeRestrictionIcon'],
                    ['name' => 'Fumo', 'title' => '', 'description' => 'È vietato fumare.', 'icon' => 'NonSmokingRoomsIcon'],
                    ['name' => 'Feste', 'title' => '', 'description' => 'Feste/eventi non ammessi.', 'icon' => 'PartiesIcon'],
                    ['name' => 'Orari silenziosi', 'title' => '', 'description' => 'Gli ospiti devono rispettare il silenzio tra le 22:00 e le 07:00.', 'icon' => 'QuietHoursIcon'],
                    ['name' => 'Animali', 'title' => '', 'description' => 'Animali non ammessi.', 'icon' => 'PetsIcon']
                ],
                'cs' => [
                    ['name' => 'Přihlášení', 'title' => 'Od 16:00 do 00:00', 'description' => 'Musíte ubytování předem informovat o svém předpokládaném čase příjezdu.', 'icon' => 'CheckInIcon'],
                    ['name' => 'Odhlášení', 'title' => 'Od 00:00 do 10:00', 'description' => '', 'icon' => 'CheckOutIcon'],
                    ['name' => 'Zrušení/předplatné', 'title' => '', 'description' => 'Podmínky zrušení a předplatného se mohou lišit v závislosti na typu apartmánu. Před rezervací si prosím zkontrolujte podmínky svého vybraného apartmánu.', 'icon' => 'CancellationPrepaymentIcon'],
                    ['name' => 'Děti a postele', 'title' => 'Dětské politiky', 'description' => 'Děti všech věkových kategorií jsou vítány. Pro zobrazení správných cen a informací o obsazenosti zadejte počet a věk dětí ve své skupině do vyhledávání.', 'icon' => 'ChildrenBedsIcon'],
                    ['name' => 'Věkové omezení', 'title' => '', 'description' => 'Minimální věk pro ubytování je 18 let.', 'icon' => 'AgeRestrictionIcon'],
                    ['name' => 'Kouření', 'title' => '', 'description' => 'Kouření není povoleno.', 'icon' => 'NonSmokingRoomsIcon'],
                    ['name' => 'Večírky', 'title' => '', 'description' => 'Večírky/akce nejsou povoleny.', 'icon' => 'PartiesIcon'],
                    ['name' => 'Klidové hodiny', 'title' => '', 'description' => 'Hosté musí být tiší od 22:00 do 07:00 hodin.', 'icon' => 'QuietHoursIcon'],
                    ['name' => 'Domácí zvířata', 'title' => '', 'description' => 'Domácí zvířata nejsou povolena.', 'icon' => 'PetsIcon']
                ],
                'fr' => [
                    ['name' => 'Arrivée', 'title' => 'De 16h à minuit', 'description' => 'Vous devez informer l\'établissement à l\'avance de l\'heure à laquelle vous prévoyez d\'arriver.', 'icon' => 'CheckInIcon'],
                    ['name' => 'Départ', 'title' => 'De minuit à 10h00', 'description' => '', 'icon' => 'CheckOutIcon'],
                    ['name' => 'Annulation/prépaiement', 'title' => '', 'description' => 'Les conditions d\'annulation et de prépaiement varient en fonction du type d\'appartement. Veuillez vérifier les conditions de l\'appartement lors de la sélection de votre appartement ci-dessus.', 'icon' => 'CancellationPrepaymentIcon'],
                    ['name' => 'Enfants et lits', 'title' => 'Politique enfant', 'description' => 'Tous les enfants sont les bienvenus. Pour voir les tarifs et les informations sur l\'occupation corrects, veuillez ajouter le nombre et l\'âge des enfants de votre groupe à votre recherche. Aucun lit d\'appoint ni lit bébé n\'est disponible.', 'icon' => 'ChildrenBedsIcon'],
                    ['name' => 'Restriction d\'âge', 'title' => '', 'description' => 'L\'âge minimum pour effectuer l\'enregistrement est de 18 ans.', 'icon' => 'AgeRestrictionIcon'],
                    ['name' => 'Fumer', 'title' => '', 'description' => 'Il est interdit de fumer.', 'icon' => 'NonSmokingRoomsIcon'],
                    ['name' => 'Fêtes', 'title' => '', 'description' => 'Les fêtes/événements ne sont pas autorisés', 'icon' => 'PartiesIcon'],
                    ['name' => 'Heures calmes', 'title' => '', 'description' => 'Les clients doivent éviter de faire du bruit entre 22h00 et 7h00.', 'icon' => 'QuietHoursIcon'],
                    ['name' => 'Animaux domestiques', 'title' => '', 'description' => 'Les animaux de compagnie ne sont pas admis.', 'icon' => 'PetsIcon'],
                ],
                'hu' => [
                    ['name' => 'Érkezés', 'title' => '16:00-tól éjfélig', 'description' => 'Előzetesen értesítenie kell a szálláshelyet, hogy mikor érkezik.', 'icon' => 'CheckInIcon'],
                    ['name' => 'Távozás', 'title' => 'éjfél után 10:00-ig', 'description' => '', 'icon' => 'CheckOutIcon'],
                    ['name' => 'Lemondás/előleg fizetése', 'title' => '', 'description' => 'A lemondási és előlegfizetési feltételek a lakástípustól függően változnak. Kérjük, válassza ki a lakástípust a fenti apartmanfeltételek ellenőrzésekor.', 'icon' => 'CancellationPrepaymentIcon'],
                    ['name' => 'Gyermekek és ágyak', 'title' => 'Gyerekpolitika', 'description' => 'Minden korosztályú gyermek fogadására van lehetőség. Helyes árak és foglaltsági információk megtekintéséhez adja meg a gyerekek számát és életkorát a csoportjában a kereséshez. Kispályás focilabda vagy pótágy nem áll rendelkezésre.', 'icon' => 'ChildrenBedsIcon'],
                    ['name' => 'Korhatár', 'title' => '', 'description' => 'A bejelentkezés minimális életkora 18 év.', 'icon' => 'AgeRestrictionIcon'],
                    ['name' => 'Dohányzás', 'title' => '', 'description' => 'Dohányzás tilos.', 'icon' => 'NonSmokingRoomsIcon'],
                    ['name' => 'Bulik', 'title' => '', 'description' => 'Bulik/rendezvények nem engedélyezettek', 'icon' => 'PartiesIcon'],
                    ['name' => 'Csendes órák', 'title' => '', 'description' => 'A vendégeknek csendesnek kell lenniük este 10:00 és reggel 7:00 között.', 'icon' => 'QuietHoursIcon'],
                    ['name' => 'Háziállatok', 'title' => '', 'description' => 'Háziállat nem engedélyezett.', 'icon' => 'PetsIcon'],
                ],
            ],
        ];
    }

}
