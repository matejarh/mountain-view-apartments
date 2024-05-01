<?php

namespace Tests\Feature;

use App\Models\Gallery;
use App\Models\Image;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class GalleriesTest extends TestCase
{
    use RefreshDatabase;

    public function test_galleries_screen_can_not_be_rendered_for_guest(): void
    {


        $response = $this->get('/admin/galleries/index');

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
    public function test_galleries_screen_can_not_be_rendered_for_user(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/galleries/index');

        $response->assertStatus(403);
    }

    public function test_galleries_screen_can_be_rendered_for_admin(): void
    {
        $admin = User::factory(['is_admin' => true])->create();

        $response = $this->actingAs($admin)->get('/admin/galleries/index');

        $response->assertStatus(200);
    }

    public function test_admin_can_create_new_gallery(): void
    {
        // $this->withoutExceptionHandling();
        $admin = User::factory(['is_admin' => true])->create();

        $gallery = [
            'name' => 'Test Gallery',
            'description' => fake()->sentence(),
        ];

        $response = $this->actingAs($admin)->post(route('admin.galleries.store'), $gallery);

        $response->assertStatus(302);

        $this->assertDatabaseHas('galleries', $gallery);
        $this->assertEquals(1, Gallery::count());
        $this->assertDatabaseHas(Gallery::class, $gallery);

    }

    public function test_admin_can_not_post_spam(): void
    {
        $admin = User::factory(['is_admin' => true])->create();

        $gallery = [
            'name' => 'spam',
            'description' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
        ];

        $response = $this->actingAs($admin)->post('/admin/galleries/store', $gallery);

        $response->assertStatus(302);

        $response->assertSessionHasErrors(['name', 'description']);

        $this->assertDatabaseEmpty('galleries');
        $this->assertEquals(0, Gallery::count());

    }

    public function test_user_can_not_create_new_gallery(): void
    {
        $user = User::factory()->create();

        $gallery = [
            'name' => 'Test Gallery',
            'description' => fake()->sentence(),
        ];

        $response = $this->actingAs($user)->post('/admin/galleries/store', $gallery);

        $response->assertStatus(403);
    }

    public function test_admin_can_update_gallery(): void
    {
        $admin = User::factory(['is_admin' => true])->create();
        $user = User::factory(['is_admin' => false])->create();

        $gallery = [
            'name' => 'Test Gallery',
            'description' => fake()->sentence(),
        ];

        $response = $this->actingAs($admin)->post('/admin/galleries/store', $gallery);
        $response->assertStatus(302);

        $response = $this->actingAs($user)->post('/admin/galleries/store', $gallery);
        $response->assertStatus(403);

        $this->assertDatabaseHas('galleries', $gallery);
        $this->assertCount(1, Gallery::all()->toArray());

        $gallery = Gallery::where('name', $gallery['name'])->first();

        $updatedgallery = [
            'name' => 'Test Updated Gallery',
            'description' => fake()->sentence(),
        ];

        $response = $this->actingAs($admin)->put("/admin/galleries/$gallery->slug", $updatedgallery);

        $response->assertStatus(302);

        $this->assertDatabaseHas('galleries', $updatedgallery);

        $this->assertEquals($gallery->fresh()->name, $updatedgallery["name"]);
        $this->assertEquals($gallery->fresh()->description, $updatedgallery["description"]);
    }

    public function test_admin_can_add_images(): void
    {
        Storage::fake('public');
        // $this->withoutExceptionHandling();
        $admin = User::factory(['is_admin' => true])->create();

        $image = [
            'photo' => UploadedFile::fake()->image('image.jpg'),
            'name' => "Test Image",
            'description' => fake()->sentence(),
        ];

        // dd($image);


        $response = $this->actingAs($admin)->post(route('admin.images.store'), $image);

        $response->assertStatus(302);

        $response->assertSessionHasNoErrors();
        $this->assertEquals(1, Image::count());
        $this->assertDatabaseHas('images', ['name' => $image["name"], 'description' => $image["description"],]);
        // $this->assertDatabaseHas(Image::class, $image);
    }

    public function test_admin_can_update_images(): void
    {
        Storage::fake('public');
        // $this->withoutExceptionHandling();
        $admin = User::factory(['is_admin' => true])->create();

/*         $gallery = Gallery::factory([
            'name' => 'Test Gallery',
            'slug' => 'test-gallery',
            'description' => fake()->sentence(),
        ])->create(); */
        $image = Image::factory(['user_id' => $admin->id])->create();

        $updatedimage = [
            'photo' => UploadedFile::fake()->image('image.jpg'),
            'name' => "Test updated Image",
            'description' => fake()->sentence(),
        ];

        $response = $this->actingAs($admin)->put(route('admin.images.update', $image), $updatedimage);

        $response->assertStatus(302);

        $response->assertSessionHasNoErrors();
        $this->assertEquals(1, Image::count());
        $this->assertDatabaseHas('images', ['name' => $updatedimage["name"], 'description' => $updatedimage["description"],]);
        // $this->assertDatabaseHas(Image::class, $image);
    }

    public function test_admin_can_attach_images_to_gallery(): void
    {
        $admin = User::factory(['is_admin' => true])->create();

        $image = Image::factory(['user_id' => $admin->id])->create();
        $image1 = Image::factory(['user_id' => $admin->id])->create();

        $gallery = Gallery::factory([
            'name' => 'Test Gallery',
            'slug' => 'test-gallery',
            'description' => fake()->sentence(),
        ])->create();

        $gallery1 = Gallery::factory([
            'name' => 'Test Gallery',
            'slug' => 'test-gallery',
            'description' => fake()->sentence(),
        ])->create();

        $image->galleries()->attach($gallery);

        $this->assertCount(1, $gallery->fresh()->images);

        $gallery->images()->attach($image1);

        $this->assertCount(2, $gallery->fresh()->images);
        $this->assertCount(1, $image->fresh()->galleries);

        $image->galleries()->attach($gallery1);

        $this->assertCount(1, $gallery1->fresh()->images);
        $this->assertCount(2, $image->fresh()->galleries);
    }

}
