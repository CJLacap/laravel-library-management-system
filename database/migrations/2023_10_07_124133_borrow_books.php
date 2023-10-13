<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("borrow_books", function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreignId('book_id')->references('id')->on('books')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('librarian_id')->nullable()->references('id')->on('users')->onUpdate('cascade');
            $table->enum('status',['borrowed','returned'])->default('borrowed');
            $table->date('due_date');
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('borrow_books');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
};
