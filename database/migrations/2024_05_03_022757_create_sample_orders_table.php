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
        Schema::create('sample_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique();
            $table->string('payment_type');
            $table->string('order_hash');
            $table->foreignId('member_id')->constrained('sample_members');
            $table->foreignId('package_id')->constrained('sample_packages');
            $table->foreignId('therapist_id')->nullable()->constrained('sample_therapists');
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->unsignedDouble('price');
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->timestamp('actual_start_time')->nullable();
            $table->timestamp('actual_end_time')->nullable();
            $table->string('duration')->nullable();
            $table->string('actual_timezone')->nullable();
            $table->unsignedFloat('rating')->nullable();
            $table->string('member_comment')->nullable();
            $table->text('note')->nullable();
            $table->string('platform')->nullable();
            $table->foreignId('status_id')->constrained('sample_order_statuses');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sample_orders');
    }
};
