<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExecutiveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('executive', function (Blueprint $table) {
            $table->id();
            $table->integer('executive_id');
            $table->string('position',10);
            $table->string('status',10)->default('offline');
            $table->text('rating')->default('none');
            $table->text('query_assigned')->default('none');
            $table->text('query_solved')->default('none');
            $table->text('query_pending')->default('none');
            $table->text('query_transferred')->default('none');
            $table->boolean('active')->default(0);
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
        Schema::dropIfExists('executive');
    }
}
