<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('custom_inputs', function (Blueprint $table) {
            $table->id();
            $table->text('input');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('custom_inputs');
    }
};
