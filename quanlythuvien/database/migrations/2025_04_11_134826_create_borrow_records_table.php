<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorrowRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrow', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('book_id');
            $table->integer('quantity');
            $table->dateTime('borrow_date');
            $table->dateTime('return_date');
            $table->string('status');
            $table->timestamps();
            
            // Tạo khóa ngoại
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('book_id')->references('book_id')->on('books');
        });
    }

    public function down()
    {
        Schema::dropIfExists('borrow');
    }
}
