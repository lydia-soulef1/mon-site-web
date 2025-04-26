<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('children', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->constrained('parents')->onDelete('cascade');
            $table->string('name', 100);
            $table->date('dob');
            $table->char('gender', 1)->check('gender in ("M", "F")');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('children');
    }
    
};
