<?php

use App\Models\Facility;
use App\Models\Property;
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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user_id')->constrained()->onDelete('cascade');
            $table->string('type');
            $table->string('slug');
            $table->string('name');
            $table->text('address')->nullable();
            $table->text('description')->nullable();
            $table->text('keywords')->nullable();
            $table->string('size')->nullable();
            $table->boolean('is_entire_apartment')->default(false);
            $table->json('bed_types')->nullable();
            $table->json('recomended')->nullable();
            $table->json('prices')->nullable();
            $table->json('rules')->nullable();
            $table->timestamps();
        });

        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('icon');
            $table->text('text')->nullable();
            $table->timestamps();
        });

        Schema::create('properties_facilities', function (Blueprint $table) {
            $table->foreignIdFor(Property::class, 'property_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignIdFor(Facility::class, 'facility_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();

            $table->unique(['property_id', 'facility_id']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties_facilities');
        Schema::dropIfExists('facilities');
        Schema::dropIfExists('properties');
    }
};
