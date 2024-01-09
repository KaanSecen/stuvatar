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
        Schema::create('item_chests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chest_id')
                ->constrained('chests')
                ->cascadeOnDelete();
            $table->foreignId('item_id')
                ->constrained('items')
                ->cascadeOnDelete();
            $table->string('rarity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_chests');
    }
};
