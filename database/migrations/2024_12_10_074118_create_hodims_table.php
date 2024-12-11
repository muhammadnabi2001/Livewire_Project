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
        Schema::create('hodims', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('bulim_id')->constrained('bulims')->onDelete('cascade');
            $table->string('img');
            $table->string('oylik_type');
            $table->float('oylik_miqdor');
            $table->double('bonus')->nullable();
            $table->time('start_time');
            $table->time('end_time');
            $table->float('kunlik_time');
            $table->float('oylik_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hodims');
    }
};
