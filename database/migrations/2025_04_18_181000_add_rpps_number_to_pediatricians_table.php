<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pediatricians', function (Blueprint $table) {
            $table->string('rpps_number')->unique()->after('hospital');
        });
    }
    
    public function down()
    {
        Schema::table('pediatricians', function (Blueprint $table) {
            $table->dropColumn('rpps_number');
        });
    }
    
};
