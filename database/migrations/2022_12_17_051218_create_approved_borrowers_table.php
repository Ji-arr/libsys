<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApprovedBorrowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approved_borrowers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('Name');
            $table->string('book_id');
            $table->string('Occupation');
            $table->string('IDNum_studentNum');
            $table->string('Contact');
            $table->string('Email');
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
        Schema::dropIfExists('approved_borrowers');
    }
}
