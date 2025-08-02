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
        Schema::create('slides', function (Blueprint $table) {
            $table->id();
            $table->foreignId('presentation_id')->constrained();
            $table->string('title');
            $table->string('file')->nullable();
            $table->string('file_type')->default("imagen");
            $table->string('question')->nullable();
            $table->string('question_type')->default("opcion unica");
            $table->string('status')->default("inicial");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slides');
    }
};
