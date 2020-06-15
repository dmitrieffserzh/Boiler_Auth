
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersProfilesTable extends Migration
{
    public function up()
    {
        Schema::create('users_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->references('id')->on('users');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->integer('gender')->unsigned()->default('0');
            $table->string('birthday')->nullable();
            $table->string('location')->nullable();
            $table->text('about')->nullable();
            $table->string('avatar')->nullable();
            $table->timestamp('offline_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users_profiles');
    }
}