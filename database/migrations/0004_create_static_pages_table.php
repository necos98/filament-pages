<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('static_pages', function (Blueprint $table) {
            $table->id();
            $table->text("text_1")->nullable();
            $table->text("text_2")->nullable();
            $table->text("text_3")->nullable();
            $table->string("view")->nullable();
            $table->timestamp("published_at")->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('static_pages');
    }
};
