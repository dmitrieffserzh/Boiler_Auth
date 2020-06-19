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
            $table->integer('section')->unsigned();
            $table->integer('group')->unsigned();
            $table->string('name');
            $table->text('note');
            $table->date('start_date')->nullable()->default(null);
            $table->date('end_date')->nullable()->default(null);
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
