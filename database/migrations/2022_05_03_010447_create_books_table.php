<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Book;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            
            $table->string('title');
            $table->boolean('isbn');
            $table->string('isbn_number')->nullable();
            $table->string('author');/* agregar */
            $table->string('editorial');
            $table->integer('paginas');
            $table->integer('año');
            $table->string('idioma');
            $table->string('slug');
            $table->text('description');

            $table->unsignedBigInteger('subcategory_id');
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');

            $table->integer('quantity')->nullable();
            $table->enum('status', [Book::BORRADOR, Book::PUBLICADO])->default(Book::BORRADOR);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
};
