<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('architect_templates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->longText('body')->nullable();
            $table->timestamps();
        });
    }
};
