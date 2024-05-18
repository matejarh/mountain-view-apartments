<?php

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
        Schema::create('reviews', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(User::class, 'user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('reviewed_id');
            $table->string('reviewed_type', 50);
            $table->integer('score')->default(5);
            $table->text('text')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'reviewed_id', 'reviewed_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review');
    }
};
