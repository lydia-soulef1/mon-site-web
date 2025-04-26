<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildrenTable extends Migration
{
    public function up()
    {
        Schema::table('children', function (Blueprint $table) {
            // إزالة المفتاح القديم
            $table->dropForeign(['parent_id']);

            // ربطه بـ users بدلاً من parents
            $table->foreign('parent_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('children', function (Blueprint $table) {
            // الرجوع إلى المفتاح القديم إذا احتجت rollback
            $table->dropForeign(['parent_id']);
            $table->foreign('parent_id')->references('id')->on('parents')->onDelete('cascade');
        });
    }
}
