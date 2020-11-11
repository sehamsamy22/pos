<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPayesToClientSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_subscriptions', function (Blueprint $table) {
            $table->decimal('payed', 8, 4)->default(0);
            $table->decimal('reminder', 8, 4)->default(0);
            $table->enum('payment_type',['cache','Agel'])->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_subscriptions', function (Blueprint $table) {
            //
        });
    }
}
