<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('vaccination_reminders', function (Blueprint $table) {
        $table->id();
        $table->foreignId('child_id')->constrained('children')->onDelete('cascade');
        $table->foreignId('vaccine_id')->constrained('vaccines')->onDelete('cascade');
        $table->date('reminder_date');
        $table->enum('status', ['Pending', 'Sent', 'Missed'])->default('Pending');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('vaccination_reminders');
}

};
