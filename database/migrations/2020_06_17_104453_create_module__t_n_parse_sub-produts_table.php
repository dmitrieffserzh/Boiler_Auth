<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuleTNParseSubProdutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module__t_n_parse_sub-produts', function (Blueprint $table) {
            $table->id();
            $table->integer('group')->unsigned();
            $table->integer('product')->unsigned();
            $table->integer('sub_product')->unsigned();
            $table->string('name');
            $table->date('start_date')->nullable()->default(null);
            $table->date('end_date')->nullable()->default(null);
            $table->integer('product_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('module__t_n_parse_sub-produts');
    }
}
