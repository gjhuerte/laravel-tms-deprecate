<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessListSystemFunctionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_list_system_function', function (Blueprint $table) {
            $table->integer('access_list_id')->unsigned();
            $table->foreign('access_list_id')
                    ->references('id')
                    ->on('access_lists')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->integer('function_id')->unsigned();
            $table->foreign('function_id')
                    ->references('id')
                    ->on('system_functions')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->primary([ 'access_list_id', 'function_id']);
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
        Schema::dropIfExists('access_list_system_function');
    }
}
