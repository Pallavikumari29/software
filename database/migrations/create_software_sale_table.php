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
        Schema::create('software_sale', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('software_id');
            $table->date('date')->format('d/m/Y');
            $table->string('amount');
            $table->string('customer_name');
            $table->string('customer_number');
            $table->string('customer_email');
            $table->integer('trans_id');
            $table->integer('order_id');
            $table->string('status')->default("pending");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('software_sale');
    }
};
