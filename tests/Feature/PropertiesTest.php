<?php

namespace Tests\Feature;

use App\Models\Facility;
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
            'description' => "Featuring a garden, Nassfeld and Lake Apartment offers accommodations in Hermagor. This property offers access to a balcony and free private parking. The accommodation provides private check-in and check-out and bicycle parking for guests.",
            'keywords' => "accommodations, Hermagor ",
            'is_entire_apartment' => true,
            'bed_types' => [
                'bedroom' => ['name' => '1 queen bed', 'icon' => 'QueenBedIcon'],
                'living_room' => ['name' => '1 sofa bed', 'icon' => 'SofaBedIcon'],
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
                ['name' => 'Check In', 'title' => 'From 4:00 PM to 12:00 AM', 'description' => 'You need to let the property know what time you\'ll be arriving in advance.', 'icon' => 'CheckInIcon'],
                ['name' => 'Check Out', 'title' => 'From 12:00 AM to 10:00 AM', 'description' => '', 'icon' => 'CheckOutIcon'],
                ['name' => 'Cancellation/prepayment', 'title' => '', 'description' => 'Cancellation and prepayment policies vary according to apartment type. Please check the Apartment Conditions when selecting your apartment above.', 'icon' => 'CancellationPrepaymentIcon'],
                ['name' => 'Children & Beds', 'title' => 'Child policies', 'description' => 'Children of all ages are welcome. To see correct prices and occupancy info, add the number and ages of children in your group to your search. No cribs or extra beds are available.', 'icon' => 'ChildrenBedsIcon'],
                ['name' => 'Age restriction', 'title' => '', 'description' => 'The minimum age for check-in is 18', 'icon' => 'ChildrenBedsIcon'],
                ['name' => 'Smoking', 'title' => '', 'description' => 'Smoking is not allowed.', 'icon' => 'NonSmokingRoomsIcon'],
                ['name' => 'Parties', 'title' => '', 'description' => 'Parties/events are not allowed', 'icon' => 'PartiesIcon'],
                ['name' => 'Quiet hours', 'title' => '', 'description' => 'Guests need be quiet between 10:00 PM and 7:00 AM.', 'icon' => 'QuietHoursIcon'],
                ['name' => 'Pets', 'title' => '', 'description' => 'Pets are not allowed.', 'icon' => 'QuietHoursIcon'],
            ],
        ];

        $this->property = $property;
    }

    public function test_properties_screen_may_not_be_rendered_for_guest(): void
    {
        $response = $this->get(route('admin.properties.index'));

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
    public function test_properties_screen_may_not_be_rendered_for_user(): void
    {

        $response = $this->actingAs($this->user)->get(route('admin.properties.index'));

        $response->assertStatus(403);
    }

    public function test_properties_screen_may_be_rendered_for_admin(): void
    {

        $response = $this->actingAs($this->admin)->get(route('admin.properties.index'));

        $response->assertStatus(200);
    }

    public function test_admin_may_create_new_property(): void
    {
        $this->withoutExceptionHandling();

        $response = $this->actingAs($this->admin)->post(route('admin.properties.store'), $this->property);

        $response->assertStatus(302);
        $new_property = Property::where('name', $this->property['name'])->first();

        $this->assertEquals($new_property->fresh()->name, $this->property["name"]);
        $this->assertEquals($new_property->fresh()->description, $this->property["description"]);
        $this->assertEquals(1, Property::count());
        $this->assertEquals($new_property->bed_types->bedroom->name, '1 queen bed');

    }

    public function test_user_or_guest_may_not_create_new_property(): void
    {
        $response = $this->post(route('admin.properties.store'), $this->property);
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));

        $response = $this->actingAs($this->user)->post(route('admin.properties.store'), $this->property);

        $response->assertStatus(403);
    }

    public function test_user_or_guest_may_not_update_property(): void
    {
        $property = Property::factory()->create($this->property);

        //$property = Property::where('name', $this->property['name'])->first();
        // dd($property);
        $response = $this->put(route('admin.properties.update', $property), $this->property);
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));

        $response = $this->actingAs($this->user)->put(route('admin.properties.update', $property), $this->property);

        $response->assertStatus(403);
    }

    public function test_admin_may_update_property(): void
    {
        $property = Property::factory()->create($this->property);

        $property = Property::where('name', $property->name)->first();
        //$property = Property::find($property->id);
        //$property->save();
        $this->assertCount(9, $property->rules);
        $updated = $this->property;
        $updated['name'] = "new name";

        array_push($updated['rules'], ['name' => 'Pets', 'title' => '', 'description' => 'Pets are not allowed.', 'icon' => 'QuietHoursIcon']);


        //$property = Property::where('name', $this->property['name'])->first();
        // dd($property);
        $this->actingAs($this->admin)->put(route('admin.properties.update', $property), $updated)
            ->assertStatus(302)
            ->assertRedirect('/')
            ->assertSessionHas(["status" => "property-updated"]);

        //dd($property);

        $this->assertEquals('new name', $property->fresh()->name);
        $this->assertCount(10, $property->fresh()->rules);
        // $response->assertRedirect(route('login'));

    }

    public function test_facilities_can_be_attached_to_properties(): void
    {
        $facility1 = Facility::factory()->create();
        $facility2 = Facility::factory()->create();

        $property1 = Property::factory()->create();
        $property2 = Property::factory()->create();

        $this->actingAs($this->admin)->put(route('admin.properties.attach', ['facility' => $facility1, 'property' => $property1]))
            ->assertSessionHas(["status" => "facility-attached"]);

        $this->assertDatabaseCount('properties_facilities', 1);

        $this->actingAs($this->admin)->put(route('admin.properties.attach', ['facility' => $facility1, 'property' => $property2]))
            ->assertSessionHas(["status" => "facility-attached"]);

        $this->assertDatabaseCount('properties_facilities', 2);

        $this->actingAs($this->admin)->put(route('admin.properties.detach', ['facility' => $facility1, 'property' => $property1]))
            ->assertSessionHas(["status" => "facility-detached"]);

        $this->assertDatabaseCount('properties_facilities', 1);

        $this->actingAs($this->admin)->put(route('admin.properties.attach', ['facility' => $facility2, 'property' => $property1]))
            ->assertSessionHas(["status" => "facility-attached"]);
        $this->actingAs($this->admin)->put(route('admin.properties.attach', ['facility' => $facility1, 'property' => $property1]))
            ->assertSessionHas(["status" => "facility-attached"]);

        $this->assertCount(2, Property::where('name', $property1->name)->first()->facilities);
    }

}
