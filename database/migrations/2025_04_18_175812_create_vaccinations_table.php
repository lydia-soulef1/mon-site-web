<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('vaccinations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('child_id')->constrained('children')->onDelete('cascade');
        $table->foreignId('vaccine_id')->constrained('vaccines')->onDelete('cascade');
        $table->date('date_administered');
        $table->foreignId('pediatrician_id')->constrained('pediatricians')->onDelete('cascade');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('vaccinations');
}

};
