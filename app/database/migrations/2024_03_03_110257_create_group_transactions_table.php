<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("owner_id")->nullable();
            $table->unsignedBigInteger("group_id");
            $table->unsignedBigInteger("transaction_id");
            $table->foreign('owner_id','group_transactions_owner_id_fk')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('group_id','group_transactions_group_id_fk')->references('id')->on('groups')->cascadeOnDelete();
            $table->foreign('transaction_id','group_transactions_transaction_id_fk')->references('id')->on('transactions')->cascadeOnDelete();

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
        Schema::dropIfExists('group_transactions');
    }
}
