<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follows', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('following_id');
            $table->unsignedInteger('followed_id');
            $table->timestamps();

            $table->unique(['following_id', 'followed_id']);

            $table->foreign('following_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('followed_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('follows', function (Blueprint $table){
            $table->dropForeign(['following_id', 'followed_id']);
        });
        
        Schema::dropIfExists('follows');
    }
}
