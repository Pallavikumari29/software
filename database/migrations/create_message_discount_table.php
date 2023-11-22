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
        Schema::create('message_discount', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('message_id');
            $table->string('voucher_code');
            $table->string('voucher_discount_percentage');
            $table->dateTime('expiry');
            $table->string('is_private')->default('no');
           $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_discount');
    }
};
