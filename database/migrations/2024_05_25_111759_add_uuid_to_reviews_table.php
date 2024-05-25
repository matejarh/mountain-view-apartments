<?php

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
        Schema::table('reviews', function (Blueprint $table) {
            $table->uuid('uuid')->nullable()->after('id');
        });

        // Populate existing records with UUIDs
        DB::table('reviews')->whereNull('uuid')->get()->each(function ($record) {
            DB::table('reviews')
                ->where('id', $record->id)
                ->update(['uuid' => (string) Str::uuid()]);
        });

        // Make the UUID column non-nullable
        Schema::table('reviews', function (Blueprint $table) {
            $table->uuid('uuid')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });
    }
};
