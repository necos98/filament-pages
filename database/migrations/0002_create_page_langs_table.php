<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Pages\Models\Page;

return new class extends Migration
{
    public function up()
    {
        Schema::create('page_langs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Page::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('lang')->index();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('slug');
            $table->string('url')->unique()->index();
            $table->timestamps();
            $table->unique(['page_id', 'lang']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('page_langs');
    }
};
