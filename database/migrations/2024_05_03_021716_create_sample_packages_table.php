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
        Schema::create('sample_packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id');
            $table->tinyInteger('hour');
            $table->tinyInteger('minute');
            $table->unsignedDouble('price');
            $table->unsignedBigInteger('sort');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sample_packages');
    }
};
