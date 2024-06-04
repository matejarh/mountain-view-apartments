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
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Property::class, 'property_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->datetime('from')->nullable();
            $table->datetime('to')->nullable();
            $table->integer('min_days')->default(1);
            $table->integer('max_days')->default(10);
            $table->json('prices');
            //$table->integer('guests')->default(1);
            //$table->string('price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prices');
    }
};
