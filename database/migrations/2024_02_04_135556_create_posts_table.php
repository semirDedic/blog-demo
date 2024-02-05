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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamp('published_at')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('post_translations', function (Blueprint $table) {

            $table->foreignId('post_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('locale')->index();

            $table->string('title')->nullable();
            $table->string('h1')->nullable();
            $table->text('text')->nullable();
            $table->text('excerpt')->nullable();
            $table->string('slug')->nullable();

            $table->unique(['post_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_translations');
        Schema::dropIfExists('posts');
    }
};
