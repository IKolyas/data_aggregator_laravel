<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddActualUserTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('actual_user')) {
            Schema::create('actual_user', function (Blueprint $table) {
                $table->id();
                $table->string('firstname')->nullable();
                $table->string('lastname')->nullable();
                $table->char('phone', 10)->unique();
                $table->string('email')->nullable();
                $table->char('referral_id', 10)->unique();
                $table->integer('inviting_id')->unsigned()->nullable();
                $table->timestamps();
                $table->index('phone');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('actual_user')) {
            Schema::drop('actual_user');
        }
    }
}
