<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTicketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_ticket', function (Blueprint $table) {
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')
                    ->references('id')
                    ->on('categories')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->integer('ticket_id')->unsigned();
            $table->foreign('ticket_id')
                    ->references('id')
                    ->on('tickets')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->primary([ 'category_id', 'ticket_id']);
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
        Schema::dropIfExists('category_ticket');
    }
}
