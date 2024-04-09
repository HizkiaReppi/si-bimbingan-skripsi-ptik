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
        Schema::create('head_of_departements', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('nip', 25)->unique();
            $table->string('nidn', 25)->unique();
            $table->string('front_degree', 50)->nullable()->default(null);
            $table->string('back_degree', 50)->nullable()->default(null);
            $table->string('position', 100)->nullable()->default(null);
            $table->string('rank', 100)->nullable()->default(null);
            $table->string('type', 50)->nullable()->default(null);
            $table->string('phone_number', 20)->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('head_of_departements');
    }
};
