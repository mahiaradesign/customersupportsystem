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
            $table->string('position',10)->default('Junior');
            $table->string('status',10)->default('offline');
            $table->double('rating',3, 2)->default(0);
            $table->string('query_assigned')->default('');
            $table->string('query_solved')->default('');
            $table->string('query_pending')->default('');
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
