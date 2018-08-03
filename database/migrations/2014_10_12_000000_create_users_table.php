<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname', 50);
            $table->string('middlename', 50)->nullable();
            $table->string('lastname', 50);
            $table->integer('access_list_id')->unsigned()->nullable();
            $table->foreign('access_list_id')
                    ->references('id')
                    ->on('access_lists')
                    ->onUpdate('cascade')
                    ->onDelete('set null');
            $table->integer('organization_id')->unsigned()->nullable();
            $table->foreign('organization_id')
                    ->references('id')
                    ->on('organizations')
                    ->onUpdate('cascade')
                    ->onDelete('set null');
            $table->string('mobile', 20)->nullable();
            $table->string('username', 15)->unique();
            $table->string('email')->unique();
            $table->datetime('is_activated')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
