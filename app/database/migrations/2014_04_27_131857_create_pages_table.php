<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pages', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
            
            $table->string('title');
            $table->string('route');
            $table->string('alias');
            $table->enum('method', array('GET', 'POST', 'PUT', 'DELETE', 'PATCH', 'OPTIONS'));
            $table->integer('node_id');
            
            $table->unique('route');
            $table->unique('alias');
            $table->index('node_id');
            
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pages');
	}

}
