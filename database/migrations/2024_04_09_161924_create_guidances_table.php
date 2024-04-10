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
        Schema::create('guidances', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('student_id')->constrained('students')->onDelete('cascade');
            $table->string('thesis_title');
            $table->string('topic');
            $table->text('explanation')->nullable()->default(null);
            $table->string('thesis_file');
            $table->string('thesis_file_review')->nullable()->default(null);
            $table->text('lecturer_notes')->nullable()->default(null);
            $table->dateTime('schedule');
            $table->unsignedInteger('guidance_number')->default(1);
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guidances');
    }
};
