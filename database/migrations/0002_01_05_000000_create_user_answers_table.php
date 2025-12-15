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
        Schema::create('user_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('presentation_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('slide_id')->constrained();
            $table->integer('play_id');
            $table->string('question');
            $table->string('question_type');
            $table->string('answer');
            $table->string('correct');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_answers');
    }
};
