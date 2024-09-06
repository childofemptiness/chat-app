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
        Schema::create('messages_statuses', function (Blueprint $table) {
            
            $table->id();
            
            $table->unsignedBigInteger('message_id');

            $table->unsignedBigInteger('user_id');

            $table->enum('status', ['sent', 'delivered', 'read', 'falied', 'pending']);


            // Внешние ключи

            $table->foreign('message_id')->references('id')->on('messages');

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages_statuses');
    }
};
