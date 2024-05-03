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
        Schema::create('sample_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('area_id')->nullable();
            $table->string('name');
            $table->string('gender');
            $table->date('birth_date');
            $table->string('phone', 20);
            $table->string('email')->unique();
            $table->boolean('is_vip');
            $table->string('password');
            $table->rememberToken();
            $table->text('note')->nullable();
            $table->string('image')->nullable();
            $table->string('firebase_token')->nullable();
            $table->timestamp('activated_at')->nullable();
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
        Schema::dropIfExists('sample_members');
    }
};
