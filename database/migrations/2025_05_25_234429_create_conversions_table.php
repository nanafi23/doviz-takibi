<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // database/migrations/xxxx_create_conversions_table.php
    Schema::create('conversions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->decimal('amount', 15, 4);
        $table->foreignId('from_currency_id')->constrained('currencies');
        $table->foreignId('to_currency_id')->constrained('currencies');
        $table->decimal('converted_amount', 15, 4);
        $table->decimal('rate', 15, 8);
        $table->timestamps();
    });
    }

    public function down()
    {
        Schema::dropIfExists('conversions');
    }
};