<?php

namespace Tests\Feature;

use App\Models\Facility;
use App\Models\Gallery;
use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PropertiesTest extends TestCase
{
    use RefreshDatabase;

    public $property;


    public function setUp(): void
    {
        parent::setUp();

        $property = [
            'user_id' => $this->admin->id,
            'type' => "One-Bedroom Apartment",
            // 'slug' => str("Nassfeld and Lake Apartment")->slug(),
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
            'keywords' => [
                'sl' => "accommodations, Hermagor ",
                "en" => "",
                "de" => "",
                "hu" => "",
                "it" => "",
                "fr" => "",
                "cs" => "",
            ],
            'is_entire_apartment' => true,
            'coordinates' => [
                'lat' => '46.618689',
                'lng' => '13.3809776'
            ],
            'bed_types' => [
                ['title' => 'bedroom', 'name'=>'1 queen bed', 'icon' => 'QueenBedIcon'],
                ['title' => 'living_room', 'name'=>'1 sofa bed', 'icon' => 'SofaBedIcon'],
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

        $this->property = $property;
    }

    public function test_properties_screen_may_not_be_rendered_for_guest(): void
    {
        $response = $this->get(route('admin.properties.index'))
            ->assertStatus(302)
            ->assertRedirect('/login');
    }
    public function test_properties_screen_may_not_be_rendered_for_user(): void
    {

        $response = $this->actingAs($this->user)->get(route('admin.properties.index'))
            ->assertStatus(403);
    }

    public function test_properties_screen_may_be_rendered_for_admin(): void
    {

        $response = $this->actingAs($this->admin)->get(route('admin.properties.index'))
            ->assertStatus(200);
    }

    public function test_admin_may_create_new_property(): void
    {
        $this->withoutExceptionHandling();

        $response = $this->actingAs($this->admin)->post(route('admin.properties.store'), $this->property)
            ->assertStatus(302);
        //dd($response);
        $new_property = Property::where('name', $this->property['name'])->first();

        $this->assertEquals($new_property->fresh()->name, $this->property["name"]);
        $this->assertEquals($new_property->fresh()->description->en, $this->property["description"]['en']);
        $this->assertEquals(1, Property::count());
        $this->assertEquals($new_property->bed_types[0]['name'], '1 queen bed');

    }

    public function test_user_or_guest_may_not_create_new_property(): void
    {
        $response = $this->post(route('admin.properties.store'), $this->property)
            ->assertStatus(302)
            ->assertRedirect(route('login'));

        $response = $this->actingAs($this->user)->post(route('admin.properties.store'), $this->property)
            ->assertStatus(403);
    }

    public function test_user_or_guest_may_not_update_property(): void
    {
        $property = Property::factory()->create($this->property);

        //$property = Property::where('name', $this->property['name'])->first();
        // dd($property);
        $response = $this->put(route('admin.properties.update', $property), $this->property)
            ->assertStatus(302)
            ->assertRedirect(route('login'));

        $response = $this->actingAs($this->user)->put(route('admin.properties.update', $property), $this->property)
            ->assertStatus(403);
    }

    public function test_admin_may_update_property(): void
    {
        $property = Property::factory()->create($this->property);

        $property = Property::where('name', $property->name)->first();
        //$property = Property::find($property->id);
        //$property->save();
        $this->assertCount(9, $property->rules->en);
        $updated = $this->property;
        $updated['name'] = "new name";
        $updated['rules']['en'] = ['name' => 'Pets', 'title' => '', 'description' => 'Pets are allowed.', 'icon' => 'QuietHoursIcon'];



        //$property = Property::where('name', $this->property['name'])->first();
        // dd($property);
        $this->actingAs($this->admin)->put(route('admin.properties.update', $property), $updated)
            ->assertStatus(302)
            ->assertRedirect('/')
            ->assertSessionHas(["status" => "property-updated"]);

        //dd($property);

        $this->assertEquals('new name', $property->fresh()->name);
        $this->assertEquals('Pets are allowed.', $property->fresh()->rules->en->description);
        // $response->assertRedirect(route('login'));

    }

    public function test_facilities_can_be_attached_to_properties(): void
    {
        $facility1 = Facility::factory()->create();
        $facility2 = Facility::factory()->create();

        $property1 = Property::factory()->create();
        $property2 = Property::factory()->create();

        $this->actingAs($this->admin)->put(route('admin.properties.attach.facility', ['facility' => $facility1, 'property' => $property1]))
            ->assertSessionHas(["status" => "facility-attached"]);

        $this->assertDatabaseCount('properties_facilities', 1);

        $this->actingAs($this->admin)->put(route('admin.properties.attach.facility', ['facility' => $facility1, 'property' => $property2]))
            ->assertSessionHas(["status" => "facility-attached"]);

        $this->assertDatabaseCount('properties_facilities', 2);

        $this->actingAs($this->admin)->put(route('admin.properties.detach.facility', ['facility' => $facility1, 'property' => $property1]))
            ->assertSessionHas(["status" => "facility-detached"]);

        $this->assertDatabaseCount('properties_facilities', 1);

        $this->actingAs($this->admin)->put(route('admin.properties.attach.facility', ['facility' => $facility2, 'property' => $property1]))
            ->assertSessionHas(["status" => "facility-attached"]);
        $this->actingAs($this->admin)->put(route('admin.properties.attach.facility', ['facility' => $facility1, 'property' => $property1]))
            ->assertSessionHas(["status" => "facility-attached"]);

        $this->assertCount(2, $property1->fresh()->facilities);
    }

    public function test_galleries_can_be_attached_and_detached_to_properties(): void
    {
        $gallery1 = Gallery::factory()->create();
        $gallery2 = Gallery::factory()->create();

        $property1 = Property::factory()->create();

        $property1->galleries()->attach($gallery1);
        $this->assertCount(1, $property1->fresh()->galleries);

        $property1->galleries()->attach($gallery2);
        $this->assertCount(2, $property1->fresh()->galleries);

        $property1->galleries()->detach($gallery1);
        $this->assertCount(1, $property1->fresh()->galleries);

        $property1->galleries()->detach($gallery2);
        $this->assertCount(0, $property1->fresh()->galleries);
    }

    public function test_admin_may_attach_and_detach_galleries( )
    {
        $gallery1 = Gallery::factory()->create();

        $property1 = Property::factory()->create();

        $this->actingAs($this->admin)->put(route('admin.properties.attach.gallery', ['gallery' => $gallery1, 'property' => $property1]))
            ->assertSessionHas(["status" => "gallery-attached"]);

        $this->assertDatabaseCount('properties_galleries', 1);

        $this->actingAs($this->admin)->put(route('admin.properties.detach.gallery', ['gallery' => $gallery1, 'property' => $property1]))
            ->assertSessionHas(["status" => "gallery-detached"]);

        $this->assertDatabaseCount('properties_galleries', 0);
    }
}
