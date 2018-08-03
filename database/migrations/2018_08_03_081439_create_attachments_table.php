<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->longtext('path');
            $table->longtext('filename');
            $table->integer('size_in_kb')->nullable();
            $table->string('extension')->nullable();
            $table->integer('uploaded_by')->unsigned()->nullable();
            $table->foreign('uploaded_by')
                    ->references('id')
                    ->on('users')
                    ->onUpdate('cascade')
                    ->onDelete('set null');
            $table->integer('ticket_id')->unsigned()->nullable();
            $table->foreign('ticket_id')
                    ->references('id')
                    ->on('tickets')
                    ->onUpdate('cascade')
                    ->onDelete('set null');
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
        Schema::dropIfExists('attachments');
    }
}
