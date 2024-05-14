<?php

namespace Tests\Feature;

use App\Models\Facility;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FacilitiesTest extends TestCase
{
    use RefreshDatabase;
    public function test_admin_may_create_new_facility(): void
    {
        $facility = [
            'name' => 'Test Facility',
        ];

        $this->actingAs($this->admin)->post(route('admin.facilities.store'), $facility)
            ->assertStatus(302)->assertSessionHas('status', 'facility-created');

        $this->assertDatabaseHas(Facility::class, $facility);
    }
    public function test_admin_may_update_facility(): void
    {
        $facility = Facility::factory()->create([
            'name' => 'Test Facility',
            'slug' => 'test-facility',
            'text' => 'Test text',
            'icon' => 'TestFacilityIcon',
        ]);

        $updated = $facility;
        $updated->name = 'Updates Test Facility';
        $updated->text = 'Updates Test Text Facility';

        $response = $this->actingAs($this->admin)->put(route('admin.facilities.update', $facility), $updated->toArray())
        ->assertStatus(302)->assertSessionHas('status', 'facility-updated');

        $this->assertEquals('Updates Test Facility', $facility->fresh()->name);
        $this->assertEquals('updates-test-facility', $facility->fresh()->slug);
        $this->assertEquals('Updates Test Text Facility', $facility->fresh()->text);
        $this->assertEquals('UpdatesTestFacilityIcon', $facility->fresh()->icon);
        // $this->assertDatabaseHas(Facility::class, $updated->toArray());
    }
    public function test_admin_may_delete_facility(): void
    {
        $facility = Facility::factory()->create([
            'name' => 'Test Facility',
            'slug' => 'test-facility',
            'text' => 'Test text',
            'icon' => 'TestFacilityIcon',
        ]);
        $response = $this->actingAs($this->admin)->delete(route('admin.facilities.destroy', $facility));

        $response->assertStatus(302);

        $response->assertSessionHasNoErrors();

        $this->assertDatabaseEmpty('facilities');
    }
    public function test_user_or_guest_may_not_create_new_facility(): void
    {
        $facility = [
            'name' => 'Test Facility',
        ];

        $this->post(route('admin.facilities.store'), $facility)
            ->assertStatus(302)->assertSessionMissing(['status' => 'facility-created'])->assertRedirect(route('login'));

        $this->actingAs($this->user)->post(route('admin.facilities.store'), $facility)
            ->assertStatus(403)->assertSessionMissing(['status' => 'facility-created']);

    }
}
