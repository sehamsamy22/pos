<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('entry_id')->index()->nullable();
            $table->unsignedBigInteger('account_id')->index()->nullable();
            $table->decimal('account_amount_before', 8, 4)->default(0);
            $table->decimal('amount', 8, 4)->default(0);
            $table->unsignedBigInteger('another_account_id')->index()->nullable();
            $table->enum('affect',['creditor','debtor'])->nullable();
            $table->decimal('account_amount_after', 8, 4)->default(0);
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
        Schema::dropIfExists('accounts_logs');
    }
}
