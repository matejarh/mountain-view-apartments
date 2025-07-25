<?php

namespace Tests\Feature;

use App\Models\Gallery;
use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use SebastianBergmann\Type\VoidType;
use Tests\TestCase;

class PagesTest extends TestCase
{
    use RefreshDatabase;

    public $page;

    public function setUp(): void
    {
        parent::setUp();

        $this->page = [
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


    }

    public function test_pages_screen_may_not_be_rendered_for_guest(): void
    {
        $response = $this->get(route('admin.pages.index'));

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
    public function test_pages_screen_may_not_be_rendered_for_user(): void
    {

        $response = $this->actingAs($this->user)->get(route('admin.pages.index'));

        $response->assertStatus(403);
    }

    public function test_pages_screen_may_be_rendered_for_admin(): void
    {

        $response = $this->actingAs($this->admin)->get(route('admin.pages.index'));

        $response->assertStatus(200);
    }

    public function test_admin_may_create_new_page(): void
    {
        $this->withoutExceptionHandling();

        $page = [
            'name' => 'apage name',
            'title' => [
                'en' => 'en title',
                'sl' => 'sl title',
            ],
            'description' => [
                'sl' => 'sl description',
                'en' => 'en description',
            ],
            'keywords' => [
                'sl' => 'sl keywords',
                'en' => 'en keywords',
            ],
            'extras' => [
                'testextra' => [
                    'title' => [
                        'sl' => 'sl extra',
                        'en' => 'en extra',
                    ]
                ]
            ],
        ];

        $response = $this->actingAs($this->admin)->post(route('admin.pages.store'), $page)
            ->assertStatus(302)
            ->assertSessionHas(["status" => "page-created"]);

        $new_page = Page::where('name', $page['name'])->first();
        // dd($new_page);
        $this->assertEquals($new_page->fresh()->name, $page["name"]);
        $this->assertCount(collect(config('app.supported_locales'))->count(), collect($new_page->fresh()->keywords));
        $this->assertCount(collect(config('app.supported_locales'))->count(), collect($new_page->fresh()->description));
        $this->assertCount(collect(config('app.supported_locales'))->count(), collect($new_page->fresh()->title));
        $this->assertCount(collect(config('app.supported_locales'))->count(), collect($new_page->fresh()->extras->testextra->title));
        $this->assertEquals(1, Page::count());
    }

    public function test_admin_may_update_page(): void
    {
        $this->withoutExceptionHandling();
        $page = Page::factory()->create(['name' => 'Test Page Name', 'title' => $this->page['title']]);

        /* $page->name='Changed name'; */
        /* $page->description=$this->page['description']; */
        $updated = [
            'name' => 'Changed name',
            'title' => $this->page['title'],
            'description' => $this->page['description'],
            'keywords' => $this->page['keywords'],
            'extras' => [
                'testextra' => [
                    'title' => [
                        'sl' => 'sl nova extra',
                        'en' => 'en nova extra',
                    ]
                ]
            ],
        ];

        $response = $this->actingAs($this->admin)->put(route('admin.pages.update', $page), $updated);
        // dd($response->ddSession());
        $response->assertStatus(302)
            ->assertSessionHas(["status" => "page-updated"]);

        $this->assertEquals($page->fresh()->name, 'Changed name');
        $this->assertEquals((array) $page->fresh()->description, $this->page['description']);
        $this->assertEquals($page->fresh()->extras->testextra->title->sl, 'sl nova extra');
        $this->assertEquals($page->fresh()->extras->testextra->title->en, 'en nova extra');

    }

    public function test_admin_may_not_post_spam_on_page_update(): void
    {
        //$this->withoutExceptionHandling();
        $page = Page::factory()->create(['name' => 'Test Page Name', 'title' => $this->page['title']]);

        $updated = [
            'name' => 'spam',
            'description' => $this->page['description'],
            'extras' => [
                'nassfeld' => [
                    'sl' => 'sl nova extra',
                    'en' => 'en npova extra',
                ]
            ],
        ];

        $response = $this->actingAs($this->admin)->put(route('admin.pages.update', $page), $updated)
            ->assertStatus(302);
        //dd($response->getSession());
        // dd($response->ddSession());
        $response->assertSessionHasErrorsIn('updatingPage', ['name']);

        $updated['description']['en'] = 'spam';
        $response = $this->actingAs($this->admin)->put(route('admin.pages.update', $page), $updated)
            ->assertStatus(302)
            ->assertSessionHasErrorsIn('description.en')
            ->assertSessionMissing(["status" => "page-updated"]);

        $updated['extras']['nassfeld']['en'] = 'spam';

        $response = $this->actingAs($this->admin)->put(route('admin.pages.update', $page), $updated)
            ->assertSessionHasErrorsIn('extras.nassfeld.en')
            ->assertStatus(302)->assertSessionMissing(["status" => "page-updated"]);

        // dd($response->ddSession());
        $response->assertSessionHasErrorsIn('updatingPage', ['description.en']);
        $this->assertNotEquals($page->fresh()->description->en, 'spam');

    }

    public function test_user_or_guest_may_not_create_new_page(): void
    {
        $response = $this->post(route('admin.pages.store'), $this->page)
            ->assertStatus(302)
            ->assertRedirect(route('login'));

        $response = $this->actingAs($this->user)->post(route('admin.pages.store'), $this->page);

        $response->assertStatus(403);
    }

    public function test_user_or_guest_may_not_update_page(): void
    {
        $page = Page::factory()->create($this->page);

        //$page = Property::where('name', $this->page['name'])->first();
        // dd($page);
        $response = $this->put(route('admin.pages.update', $page), $this->page)
            ->assertStatus(302)
            ->assertRedirect(route('login'));

        $response = $this->actingAs($this->user)->put(route('admin.pages.update', $page), $this->page);

        $response->assertStatus(403);
    }

    public function test_admin_may_delete_given_page(): void
    {
        $page = Page::factory()->create();

        $this->assertDatabaseCount(Page::class, 1);

        $response = $this->actingAs($this->admin)->delete(route('admin.pages.destroy', $page))
            ->assertStatus(302)
            ->assertSessionHas(["status" => "page-destroyed"]);

        $this->assertDatabaseCount(Page::class, 0);
    }

    public function test_user_or_guest_may_not_delete_given_page(): void
    {
        $page = Page::factory()->create();

        $this->assertDatabaseCount(Page::class, 1);

        $response = $this->delete(route('admin.pages.destroy', $page))
            ->assertStatus(302)
            ->assertRedirect(route('login'));

        $response = $this->actingAs($this->user)->delete(route('admin.pages.destroy', $page))
            ->assertStatus(403);

        $this->assertDatabaseCount(Page::class, 1);
    }

    public function test_galleries_can_be_attached_and_detached_to_pages(): void
    {
        $gallery1 = Gallery::factory()->create();
        $gallery2 = Gallery::factory()->create();

        $page = Page::factory()->create();

        $page->galleries()->attach($gallery1);
        $this->assertCount(1, $page->fresh()->galleries);

        $page->galleries()->attach($gallery2);
        $this->assertCount(2, $page->fresh()->galleries);

        $page->galleries()->detach($gallery1);
        $this->assertCount(1, $page->fresh()->galleries);

        $page->galleries()->detach($gallery2);
        $this->assertCount(0, $page->fresh()->galleries);
    }

    public function test_admin_may_attach_and_detach_galleries()
    {
        $gallery1 = Gallery::factory()->create();

        $page = Page::factory()->create();

        $request = $this->actingAs($this->admin)->put(route('admin.pages.attach.gallery', ['gallery' => $gallery1, 'page' => $page]))
            ->assertSessionHas(["status" => "gallery-attached"]);
        //dd($request);
        $this->assertDatabaseCount('pages_galleries', 1);

        $this->actingAs($this->admin)->put(route('admin.pages.detach.gallery', ['gallery' => $gallery1, 'page' => $page]))
            ->assertSessionHas(["status" => "gallery-detached"]);

        $this->assertDatabaseCount('pages_galleries', 0);
    }

}
