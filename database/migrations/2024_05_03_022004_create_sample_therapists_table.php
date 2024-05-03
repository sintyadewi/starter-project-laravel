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
        Schema::create('sample_therapists', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id');
            $table->unsignedBigInteger('unit_id');
            $table->unsignedBigInteger('district_id');
            $table->string('name');
            $table->string('alias_name')->nullable();
            $table->date('birth_date');
            $table->char('gender');
            $table->string('address');
            $table->string('rtrw')->nullable();
            $table->string('block_number')->nullable();
            $table->string('building_name')->nullable();
            $table->string('full_address');
            $table->string('trainer')->nullable();
            $table->string('phone', 20);
            $table->unsignedFloat('rating')->nullable();
            $table->string('image')->nullable();
            $table->date('join_date');
            $table->timestamp('banned_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sample_therapists');
    }
};
