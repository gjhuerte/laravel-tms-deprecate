<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_tag', function (Blueprint $table) {
            $table->integer('tag_id')->unsigned();
            $table->foreign('tag_id')
                    ->references('id')
                    ->on('tags')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->integer('ticket_id')->unsigned();
            $table->foreign('ticket_id')
                    ->references('id')
                    ->on('tickets')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->primary([ 'tag_id', 'ticket_id']);
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
        Schema::dropIfExists('ticket_tag');
    }
}
