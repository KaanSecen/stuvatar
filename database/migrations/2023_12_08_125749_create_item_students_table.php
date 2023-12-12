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
        Schema::create('item_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')
                ->constrained('items')
                ->cascadeOnDelete();
            $table->foreignId('student_id')
                ->constrained('students')
                ->cascadeOnDelete();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_students');
    }
};
