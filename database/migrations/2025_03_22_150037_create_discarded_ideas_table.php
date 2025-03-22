<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('discarded_ideas', function (Blueprint $table) {
            $table->id();
            $table->text('idea');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('discarded_ideas');
    }
};
