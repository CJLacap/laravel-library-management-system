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
            $table->string('cover')->nullable();
            $table->string('title');
            $table->foreign('author_id')->references('id')->on('authors');
            $table->string('isbn');
            $table->foreign('publisher_id')->references('id')->on('publishers');
            $table->string('publication_year')->nullable();
            $table->integer('copies')->nullable()->default(1);
            $table->enum('status',['available','unavailable','borrowed','out of order'])->default('available');
            $table->timestamps();
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
