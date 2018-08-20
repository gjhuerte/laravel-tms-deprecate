<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->longtext('details');
            $table->string('alt_contact')->nullable();
            $table->longtext('additional_info')->nullable();
            $table->integer('assigned_to')->nullable()->unsigned();
            $table->foreign('assigned_to')
                    ->references('id')
                    ->on('users')
                    ->onUpdate('cascade')
                    ->onDelete('set null');
            $table->integer('created_by')->unsigned()->nullable();
            $table->foreign('created_by')
                    ->references('id')
                    ->on('users')
                    ->onUpdate('cascade')
                    ->onDelete('set null');
            $table->integer('parent_id')->nullable()->unsigned();
            $table->foreign('parent_id')
                    ->references('id')
                    ->on('tickets')
                    ->onUpdate('cascade')
                    ->onDelete('set null');
            $table->datetime('date_assigned');
            $table->integer('level_id')->nullable()->unsigned();
            $table->foreign('level_id')
                    ->references('id')
                    ->on('levels')
                    ->onUpdate('cascade')
                    ->onDelete('set null');
            $table->string('status')->nullable();
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
        Schema::dropIfExists('tickets');
    }
}
