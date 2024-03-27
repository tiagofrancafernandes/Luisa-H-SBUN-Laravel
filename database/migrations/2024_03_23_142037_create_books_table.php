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
        Schema::create('books', function (Blueprint $table) {
            $table->id();

            $table->string('title')->index();
            $table->integer('quantity')->index()->nullable();
            $table->string('reference')->index();
            $table->longText('sinopsis')->nullable();
            $table->unsignedBigInteger('author_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->timestamps();

            $table->foreign('author_id')->references('id')
                ->on('authors')->onDelete('set null'); // cascade|set null

            $table->foreign('category_id')->references('id')
                ->on('categories')->onDelete('set null'); // cascade|set null

            $table->index('created_at');
            $table->index('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
