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
        Schema::create('disabled_days', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Property::class, 'property_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->json('disabled_dates');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disabled_days');
    }
};
