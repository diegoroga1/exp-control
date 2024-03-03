<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->double("amount");
            $table->string("type");
            $table->unsignedBigInteger('currency_id')->unsigned()->nullable();
            $table->unsignedBigInteger('category_id')->unsigned()->nullable();
            $table->unsignedBigInteger('subcategory_id')->unsigned()->nullable();
            $table->foreign('currency_id','transaction_currency_id_fk')->references('id')->on('currencies')->nullOnDelete()->cascadeOnUpdate();
            $table->foreign('category_id','transaction_category_id_fk')->references('id')->on('categories')->nullOnDelete()->cascadeOnUpdate();
            $table->foreign('subcategory_id','transaction_subcategory_id_fk')->references('id')->on('categories')->nullOnDelete()->cascadeOnUpdate();
            $table->date("date");
            $table->time("hour")->nullable();
            $table->text("description")->nullable();
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
        Schema::dropIfExists('transaction');
    }
}
