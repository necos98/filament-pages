<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('slug')->unique();
            $table->string("controllable")->nullable();
            $table->nullableMorphs("modelable");
            $table->enum('status', ["draft", "published", "scheduled"])->default('draft')->index();
            $table->timestamp("scheduled_at")->nullable()->index();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('url')->unique()->index();
            $table->timestamps();
            $table->softDeletes();

            // $table->foreign('page_type_id')->references('id')->on('page_types')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('pages')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pages');
    }
};
