<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('planets', function(Blueprint $table)
		{
            $table->engine = "MyISAM";
			$table->increments('id');
            $table->integer('x');
            $table->integer('y');
            $table->smallInteger('level')->index()->unsigned();
            $table->enum('sector', array(
                'alpha',
                'beta',
                'gamma',
                'delta',
                'x'))->index();
            $table->string('star')->index();
            $table->string('system')->index();
            $table->string('planet')->index();
            $table->enum('biome', array(
                'arid',
                'asteroid',
                'desert',
                'forest',
                'grasslands',
                'jungle',
                'magma',
                'moon',
                'savannah',
                'snow',
                'tentacle',
                'tundra',
                'volcano',
            ))->index();
            $table->enum('version', array(
                'enraged_koala',
            ))->index();
            $table->enum('os', array('windows', 'linux', 'mac'))->index();
            $table->text('comment');
            $table->integer('user_id')->index()->unsigned();
            $table->integer('views')->unsigned();

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
		Schema::drop('planets');
	}

}
