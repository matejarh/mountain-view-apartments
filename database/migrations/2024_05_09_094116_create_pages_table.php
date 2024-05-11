<?php

use App\Models\Gallery;
use App\Models\Page;
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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->json('title');
            $table->json('description')->nullable();
            $table->json('keywords')->nullable();
            $table->timestamps();
        });

        Schema::create('pages_galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Gallery::class, 'gallery_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignIdFor(Page::class, 'page_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();

            $table->unique(['gallery_id', 'page_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages_galleries');
        Schema::dropIfExists('pages');
    }
};
