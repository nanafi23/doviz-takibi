<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
    Schema::create('currencies', function (Blueprint $table) {
        $table->id();
        $table->string('code', 3)->unique();
        $table->string('name');
        $table->string('symbol', 3);
        $table->decimal('rate', 10, 6);
        $table->string('country')->nullable();
        $table->string('flag_emoji', 10)->nullable();
        $table->decimal('change', 15, 6)->default(0);
        $table->timestamps();
    });
    }

    public function down()
    {
        Schema::dropIfExists('currencies');
    }
};