<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTabletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tablets', function (Blueprint $table) {
            //
	        $table->string('title',255);
	        $table->string('alias',255)->unique();
	        $table->string('img',255);

	        $table->text('description');



	        $table->integer( 'user_id' )->unsigned()->default( 1 );
	        $table->foreign('user_id')->references('id')->on('users');

	        $table->integer( 'category_id' )->unsigned()->default( 0 );
	        $table->foreign('category_id')->references('id')->on('categories');

	        $table->integer( 'manufacture_id' )->unsigned()->default( 0 );
	        $table->foreign('manufacture_id')->references('id')->on('manufactures');
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
        Schema::dropIfExists('tablets', function (Blueprint $table) {
            //
        });
    }
}
