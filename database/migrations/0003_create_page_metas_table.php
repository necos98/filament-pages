<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pages_meta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('page_id');
            $table->string('key');
            $table->text('value');
            $table->timestamps();

            $table->foreign('page_id')->references('id')->on('pages')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unique(['page_id', 'key']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('pages_meta');
    }
};
