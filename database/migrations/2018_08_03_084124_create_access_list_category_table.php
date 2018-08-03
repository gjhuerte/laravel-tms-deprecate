<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessListCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_list_category', function (Blueprint $table) {
            $table->integer('access_list_id')->unsigned();
            $table->foreign('access_list_id')
                    ->references('id')
                    ->on('access_lists')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')
                    ->references('id')
                    ->on('categories')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->primary([ 'category_id', 'access_list_id']);
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
        Schema::dropIfExists('access_list_category');
    }
}
