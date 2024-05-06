<?php

namespace Tests\Feature;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SettingsTest extends TestCase
{
    use RefreshDatabase;

    public $setting;


    public function setUp() :void
    {
        parent::setUp();

        $this->setting = [
            'name' => 'Test Setting',
            'description' => fake()->sentence(),
            'attributes' => [
                'setting1' => 'setting1',
                'setting2' => 'setting2',
            ]
        ];
    }

    public function test_settings_screen_may_not_be_rendered_for_guest(): void
    {
        $response = $this->get(route('admin.settings.index'));

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
    public function test_settings_screen_may_not_be_rendered_for_user(): void
    {

        $response = $this->actingAs($this->user)->get(route('admin.settings.index'));

        $response->assertStatus(403);
    }

    public function test_settings_screen_may_be_rendered_for_admin(): void
    {

        $response = $this->actingAs($this->admin)->get(route('admin.settings.index'));

        $response->assertStatus(200);
    }

    public function test_admin_may_create_new_setting(): void
    {
        $this->withoutExceptionHandling();

        $response = $this->actingAs($this->admin)->post(route('admin.settings.store'), $this->setting);

        $response->assertStatus(302);
        $new_setting = Setting::where('name', $this->setting['name'])->first();

        $this->assertEquals($new_setting->fresh()->name, $this->setting["name"]);
        $this->assertEquals($new_setting->fresh()->description, $this->setting["description"]);
        $this->assertEquals($new_setting->fresh()->attributes->setting1, $this->setting["attributes"]['setting1']);
        $this->assertEquals($new_setting->fresh()->attributes->setting2, $this->setting["attributes"]['setting2']);
        $this->assertEquals(1, Setting::count());

    }

    public function test_user_may_not_create_new_setting(): void
    {

        $response = $this->post(route('admin.galleries.store'), $this->setting);
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));

        $response = $this->actingAs($this->user)->post(route('admin.galleries.store'), $this->setting);

        $response->assertStatus(403);
    }

    public function test_admin_may_update_setting(): void
    {
        // $this->withoutExceptionHandling();


        $response = $this->actingAs($this->user)->post(route('admin.settings.store'), $this->setting);
        $response->assertStatus(403);
        $response = $this->actingAs($this->admin)->post(route('admin.settings.store'), $this->setting);
        $response->assertStatus(302);

        $setting = Setting::where('name', $this->setting['name'])->first();
        //dd($this->setting);
        $this->assertEquals($setting->fresh()->name, $this->setting["name"]);
        $this->assertEquals($setting->fresh()->description, $this->setting["description"]);
        $this->assertEquals($setting->fresh()->attributes->setting1, $this->setting["attributes"]['setting1']);
        $this->assertEquals($setting->fresh()->attributes->setting2, $this->setting["attributes"]['setting2']);
        $this->assertCount(1, Setting::all()->toArray());

        $updatedsetting = [
            'name' => 'Test Updated Setting',
            'description' => fake()->sentence(),
            'attributes' => [
                'setting1' => 'newsetting1',
                'setting2' => 'newsetting2',
            ]
        ];

        $response = $this->actingAs($this->admin)->put(route('admin.settings.update', $setting), $updatedsetting);

        $response->assertStatus(302);

        // $this->assertDatabaseHas('settings', $updatedsetting);

        $this->assertEquals($setting->fresh()->name, $updatedsetting["name"]);
        $this->assertEquals($setting->fresh()->description, $updatedsetting["description"]);
        $this->assertEquals($setting->fresh()->attributes->setting1, $updatedsetting["attributes"]['setting1']);
        $this->assertEquals($setting->fresh()->attributes->setting2, $updatedsetting["attributes"]['setting2']);
    }
}
