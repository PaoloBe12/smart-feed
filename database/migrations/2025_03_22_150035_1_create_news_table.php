<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trend_id')->constrained('trends')->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->text('full_text');
            $table->json('metadata')->nullable();
            $table->string('seo_score')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('news');
    }
};