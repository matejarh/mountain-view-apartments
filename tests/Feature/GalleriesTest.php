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

    public $gallery;
    public $image;


    public function setUp() :void
    {
        parent::setUp();

        $this->gallery = [
            'name' => 'Test Gallery',
            'description' => fake()->sentence(),
        ];

        $this->image = [
            'photo' => UploadedFile::fake()->image('image.jpg',1280,720),
            'name' => "Test Image",
            'description' => fake()->sentence(),
        ];
    }

    public function test_galleries_screen_may_not_be_rendered_for_guest(): void
    {
        $response = $this->get('/admin/galleries/index');

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
    public function test_galleries_screen_may_not_be_rendered_for_user(): void
    {

        $response = $this->actingAs($this->user)->get(route('admin.galleries.index'));

        $response->assertStatus(403);
    }

    public function test_galleries_screen_may_be_rendered_for_admin(): void
    {

        $response = $this->actingAs($this->admin)->get(route('admin.galleries.index'));

        $response->assertStatus(200);
    }

    public function test_admin_may_create_new_gallery(): void
    {
        // $this->withoutExceptionHandling();

        $gallery = [
            'name' => 'Test Gallery',
            'description' => fake()->sentence(),
        ];

        $response = $this->actingAs($this->admin)->post(route('admin.galleries.store'), $gallery);

        $response->assertStatus(302);

        $this->assertDatabaseHas('galleries', $gallery);
        $this->assertEquals(1, Gallery::count());
        $this->assertDatabaseHas(Gallery::class, $gallery);

    }

    public function test_admin_may_not_post_spam(): void
    {

        $gallery = [
            'name' => 'spam',
            'description' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
        ];

        $response = $this->actingAs($this->admin)->post(route('admin.galleries.store'), $gallery);

        $response->assertStatus(302);

        $response->assertSessionHasErrors(['name', 'description']);

        $this->assertDatabaseEmpty('galleries');
        $this->assertEquals(0, Gallery::count());

    }

    public function test_user_may_not_create_new_gallery(): void
    {

        $gallery = [
            'name' => 'Test Gallery',
            'description' => fake()->sentence(),
        ];

        $response = $this->actingAs($this->user)->post(route('admin.galleries.store'), $gallery);

        $response->assertStatus(403);
    }

    public function test_admin_may_update_gallery(): void
    {

        $gallery = [
            'name' => 'Test Gallery',
            'description' => fake()->sentence(),
        ];

        $response = $this->actingAs($this->admin)->post(route('admin.galleries.store'), $gallery);
        $response->assertStatus(302);

        $response = $this->actingAs($this->user)->post(route('admin.galleries.store'), $gallery);
        $response->assertStatus(403);

        $this->assertDatabaseHas('galleries', $gallery);
        $this->assertCount(1, Gallery::all()->toArray());

        $gallery = Gallery::where('name', $gallery['name'])->first();

        $updatedgallery = [
            'name' => 'Test Updated Gallery',
            'description' => fake()->sentence(),
        ];

        $response = $this->actingAs($this->admin)->put("/admin/galleries/$gallery->slug", $updatedgallery);

        $response->assertStatus(302);

        $this->assertDatabaseHas('galleries', $updatedgallery);

        $this->assertEquals($gallery->fresh()->name, $updatedgallery["name"]);
        $this->assertEquals($gallery->fresh()->description, $updatedgallery["description"]);
    }

    public function test_admin_may_add_images(): void
    {
        Storage::fake('public');
        // $this->withoutExceptionHandling();

        $image = [
            'photo' => UploadedFile::fake()->image('image.jpg',1280,720),
            'name' => "Test Image",
            'description' => fake()->sentence(),
        ];

        // dd($image);


        $response = $this->actingAs($this->admin)->post(route('admin.images.store'), $image);

        $response->assertStatus(302);

        $response->assertSessionHasNoErrors();
        $this->assertEquals(1, Image::count());
        $this->assertDatabaseHas('images', ['name' => $image["name"], 'description' => $image["description"],]);
        // $this->assertDatabaseHas(Image::class, $image);
    }

    public function test_admin_may_update_images(): void
    {
        Storage::fake('public');
        // $this->withoutExceptionHandling();

/*         $gallery = Gallery::factory([
            'name' => 'Test Gallery',
            'slug' => 'test-gallery',
            'description' => fake()->sentence(),
        ])->create(); */
        $image = Image::factory(['user_id' => $this->admin->id])->create();

        $updatedimage = [
            'photo' => UploadedFile::fake()->image('image.jpg',1280,720),
            'name' => "Test updated Image",
            'description' => fake()->sentence(),
        ];

        $response = $this->actingAs($this->admin)->post(route('admin.images.update', $image), $updatedimage);

        $response->assertStatus(302);

        $response->assertSessionHasNoErrors();
        $this->assertEquals(1, Image::count());
        $this->assertDatabaseHas('images', ['name' => $updatedimage["name"], 'description' => $updatedimage["description"],]);
        // $this->assertDatabaseHas(Image::class, $image);
    }

    public function test_admin_may_attach_images_to_gallery(): void
    {
        $this->withoutExceptionHandling();


        $image = Image::factory(['user_id' => $this->admin->id])->create();
        $image1 = Image::factory(['user_id' => $this->admin->id])->create();

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

        $response = $this->actingAs($this->admin)->put(route('admin.images.attach', ['image' => $image, 'gallery' => $gallery]));

        //$image->galleries()->attach($gallery);

        $this->assertCount(1, $gallery->fresh()->images);
        $response = $this->actingAs($this->admin)->put(route('admin.images.attach', ['image' => $image1, 'gallery' => $gallery]));
        $this->assertCount(2, $gallery->fresh()->images);

        $response = $this->actingAs($this->admin)->put(route('admin.images.detach', ['image' => $image, 'gallery' => $gallery]));

        $this->assertCount(1, $gallery->fresh()->images);

        $response = $this->actingAs($this->admin)->put(route('admin.galleries.attach', ['image' => $image, 'gallery' => $gallery]));
        $this->assertCount(2, $gallery->fresh()->images);
        $response = $this->actingAs($this->admin)->put(route('admin.galleries.detach', ['image' => $image, 'gallery' => $gallery]));
        $this->assertCount(1, $gallery->fresh()->images);
        $response = $this->actingAs($this->admin)->put(route('admin.galleries.detach', ['image' => $image1, 'gallery' => $gallery]));
        $this->assertCount(0, $gallery->fresh()->images);
    }

    public function test_admin_may_delete_images(): void
    {

        $image = Image::factory(['user_id' => $this->admin->id])->create();

        $gallery = Gallery::factory([
            'name' => 'Test Gallery',
            'slug' => 'test-gallery',
            'description' => fake()->sentence(),
        ])->create();

        $image->galleries()->attach($gallery);

        $response = $this->actingAs($this->admin)->delete(route('admin.images.destroy', $image));

        $response->assertStatus(302);

        $response->assertSessionHasNoErrors();

        $this->assertDatabaseEmpty('galleries_images');
        $this->assertDatabaseEmpty('images');
    }

    public function test_admin_may_delete_galleries(): void
    {

        $image = Image::factory(['user_id' => $this->admin->id])->create();

        $gallery = Gallery::factory([
            'name' => 'Test Gallery',
            'slug' => 'test-gallery',
            'description' => fake()->sentence(),
        ])->create();

        $image->galleries()->attach($gallery);

        $response = $this->actingAs($this->admin)->delete(route('admin.galleries.destroy', $gallery));

        $response->assertStatus(302);

        $response->assertSessionHasNoErrors();

        $this->assertDatabaseEmpty('galleries_images');
        $this->assertDatabaseEmpty('galleries');
    }

    public function test_admin_may_upload_image(): void {
        Storage::fake('public');


        $photo = new UploadedFile(resource_path('images/test/150730321.jpg'), '150730321.jpg', null, null, true);

        $image = [
            'name' => "test image",
            'description' => "test description",
            'photo' => $photo,
        ];

        $response = $this->actingAs($this->admin)->post(route('admin.images.store'), $image);

        $response->assertStatus(302);

        $image=Image::where('name', 'test image')->first();

        $updatedimage = [
            'name' => "test image",
            'description' => "test description",
            'photo' => $photo,
        ];

        $response = $this->actingAs($this->admin)->post(route('admin.images.update', $image), $updatedimage);

        $response->assertStatus(302);
    }

}
