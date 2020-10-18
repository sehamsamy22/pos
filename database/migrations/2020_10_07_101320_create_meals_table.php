<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meals', function (Blueprint $table) {
            $table->id();
            $table->string('ar_name')->nullable();
            $table->string('en_name')->nullable();
            $table->foreignId('sub_category_id')->constrained();
            $table->decimal('price', 8, 4);
            $table->boolean('status')->default(1);
            $table->enum('type', ['breakfast', 'lunch','dinner']);
            $table->longText('description');
            $table->string('image')->nullable();
            $table->string('calories')->nullable();
            $table->decimal('discount', 8, 2)->nullable();
            $table->decimal('tax', 8, 2)->nullable();


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
        Schema::dropIfExists('meals');
    }
}
