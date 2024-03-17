<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subject_id')->constrained(indexName: 'act_sub_id');
            $table->string('name')->index();
            $table->integer('max_score');
            $table->timestamps();
            $table->unique(['subject_id', 'name'], 'unique_s_id_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            Schema::dropIfExists('activities');
        });
    }
};
