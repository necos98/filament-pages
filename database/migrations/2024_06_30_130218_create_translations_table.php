<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('model_translations', function (Blueprint $table) {
            $table->id();
            $table->morphs("modelable");
            $table->string("lang");
            $table->string("key");
            $table->string("value");
            $table->index(["modelable_type", "modelable_id", "lang", "key"]);
            $table->unique(["modelable_type", "modelable_id", "lang", "key"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('model_translations');
    }
};
