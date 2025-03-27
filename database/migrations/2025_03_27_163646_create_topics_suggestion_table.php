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
        Schema::create('topics_suggestion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('keyword_id')->constrained('keywords_pool')->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->enum('source', ['api', 'ai_generated', 'manual']);
            $table->enum('status', ['suggested', 'rejected', 'selected']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topics_suggestion');
    }
};
