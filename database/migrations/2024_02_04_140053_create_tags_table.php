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
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('tag_translations', function (Blueprint $table) {
            $table->foreignId('tag_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('locale')->index();

            $table->string('title')->nullable();

            $table->unique(['tag_id', 'locale']);
        });

        Schema::create('taggables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tag_id');
            $table->unsignedBigInteger('taggable_id');
            $table->string('taggable_type');
            $table->integer('order_column')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tag_translations');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('tags');
    }
};
