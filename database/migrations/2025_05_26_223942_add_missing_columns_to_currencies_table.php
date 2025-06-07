<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('currencies', function (Blueprint $table) {
            if (!Schema::hasColumn('currencies', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('symbol');
            }
            
            if (!Schema::hasColumn('currencies', 'rate')) {
                $table->decimal('rate', 10, 6)->default(1)->after('is_active');
            }
            
            if (!Schema::hasColumn('currencies', 'sort_order')) {
                $table->integer('sort_order')->default(0)->after('rate');
            }
        });
    }

    public function down()
    {
        Schema::table('currencies', function (Blueprint $table) {
            $table->dropColumn(['is_active', 'rate', 'sort_order']);
        });
    }
};
