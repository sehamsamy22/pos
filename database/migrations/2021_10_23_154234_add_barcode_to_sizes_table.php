<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBarcodeToSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sizes', function (Blueprint $table) {
            $table->string('barcode')->nullable();
            $table->double('purchase_price')->nullable();
            $table->string('quantity')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sizes', function (Blueprint $table) {
            $table->dropColumn('barcode');
            $table->dropColumn('purchase_price');
            $table->dropColumn('quantity');
        });
    }
}
