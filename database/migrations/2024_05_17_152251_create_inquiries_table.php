<?php

use App\Models\Property;
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
        Schema::create('inquiries', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreignIdFor(Property::class, 'property_id')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->string('email');
            $table->string('phone');
            $table->integer('adults')->default(0);
            $table->integer('children')->default(0);
            $table->boolean('pets')->default(false);
            $table->string('subject');
            $table->text('message');
            $table->json('date');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
