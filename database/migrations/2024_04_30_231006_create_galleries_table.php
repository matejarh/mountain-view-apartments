<?php

use App\Models\Gallery;
use App\Models\Image;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user_id')->constrained()->onDelete('cascade');
            $table->string('slug');
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user_id')->constrained()->onDelete('cascade');
            $table->string('slug');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('image_path', 2048)->nullable();
            $table->string('thumb_path', 2048)->nullable();
            $table->string('tile_path', 2048)->nullable();
            $table->unsignedBigInteger('likes_count')->default(0);
            $table->unsignedBigInteger('comments_count')->default(0);
            $table->timestamps();
        });

        Schema::create('galleries_images', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Gallery::class, 'gallery_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignIdFor(Image::class, 'image_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->integer('order');
            $table->timestamps();

            $table->unique(['gallery_id', 'image_id']);
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries_images');
        Schema::dropIfExists('galleries');
        Schema::dropIfExists('images');
    }
};
