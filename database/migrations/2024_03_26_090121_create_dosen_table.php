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
        Schema::create('dosen', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('nip', 25)->unique();
            $table->string('nidn', 25)->unique();
            $table->string('gelar_depan', 50)->nullable()->default(null);
            $table->string('gelar_belakang', 50)->nullable()->default(null);
            $table->string('jabatan', 100)->nullable()->default(null);
            $table->string('pangkat', 100)->nullable()->default(null);
            $table->string('golongan', 50)->nullable()->default(null);
            $table->string('no_hp', 20)->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosen');
    }
};
