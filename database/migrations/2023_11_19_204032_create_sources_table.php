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
        Schema::create('sources', function (Blueprint $table) {
            $table->id();
            $table->string('external_id',100)->nullable(false);
            $table->string('url',100)->nullable(false);
            $table->string('name',100)->nullable(false);
            $table->string('category',20)->nullable(false);
            $table->string('description',500);
            $table->string('country',2);
            $table->string('language',5);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sources');
    }
};
