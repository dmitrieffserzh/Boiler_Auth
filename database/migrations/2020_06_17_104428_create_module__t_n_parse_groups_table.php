<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuleTNParseGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module__t_n_parse_groups', function (Blueprint $table) {
            $table->id();
            $table->integer('group')->unsigned();
            $table->string('name');
            $table->text('note');
            $table->integer('section_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('module__t_n_parse_groups');
    }
}
