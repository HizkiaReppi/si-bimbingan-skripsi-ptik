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
        Schema::create('students', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
            $table->foreignUuid('lecturer_id')->constrained('lecturers')->onDelete('cascade');
            $table->string('nim', 20)->unique();
            $table->unsignedSmallInteger('batch');
            $table->enum('concentration', ['RPL', 'Multimedia', 'TKJ']);
            $table->string('phone_number', 20)->nullable()->default(null);
            $table->string('address')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
