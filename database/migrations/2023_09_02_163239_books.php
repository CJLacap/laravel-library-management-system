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
            $table->string('cover')->nullable();
            $table->string('title');
            $table->foreignId('author_id')->references('id')->on('authors');
            $table->string('isbn');
            $table->foreignId('publisher_id')->references('id')->on('publishers');
            $table->string('publication_year')->nullable();
            $table->string('copies')->default(1);
            $table->enum('status',['available','unavailable','out of order'])->default('available');
            $table->timestamps();
        });

        Schema::table('books', function(Blueprint $table) {
            
           
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
