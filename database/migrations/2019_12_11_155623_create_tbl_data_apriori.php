<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblDataApriori extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_data_apriori', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_1');
            $table->integer('product_2');
            $table->integer('product_3');
            $table->integer('product_4');
            $table->integer('recommend_1');
            $table->integer('recommend_2');
            $table->integer('recommend_3');
            $table->integer('recommend_4');
            $table->integer('support');
            $table->integer('Confidence');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_data_apriori');
    }
}
