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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id(); // otomatik id
            $table->string('title'); // başlık
            $table->text('description'); // açıklama
            $table->string('author'); // yazar adı
            $table->string('image')->nullable(); // görsel (opsiyonel)
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
