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
        Schema::create('borrows', function (Blueprint $table) {
            $table->id();
            /**
             * usuario fk
             * livro fk
             * quando foi emprestado
             * quando foi devolvido
             * devolver até
             */
            $table->timestamp('borrowed_at')->index();
            $table->timestamp('returned_at')->index()->nullable();
            $table->timestamp('return_by')->index()->nullable();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('book_id')->index();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrows');
    }
};
