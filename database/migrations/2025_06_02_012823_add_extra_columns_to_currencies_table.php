<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('currencies', function (Blueprint $table) {
            if (!Schema::hasColumn('currencies', 'country')) {
                $table->string('country')->nullable()->after('symbol');
            }
            if (!Schema::hasColumn('currencies', 'flag_emoji')) {
                $table->string('flag_emoji', 10)->nullable()->after('country');
            }
            if (!Schema::hasColumn('currencies', 'change')) {
                $table->decimal('change', 10, 6)->default(0)->after('rate');
            }
        });
    }

    public function down()
    {
        Schema::table('currencies', function (Blueprint $table) {
            $table->dropColumn(['country', 'flag_emoji', 'change']);
        });
    }
};

