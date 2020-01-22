<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('set null');

            $table->string('billing_fname');
            $table->string('billing_lname');
            $table->string('billing_email');
            $table->string('billing_address');
            $table->string('billing_city');
            $table->string('billing_province');
            $table->integer('billing_zip');
            $table->string('billing_phone');
            $table->string('billing_subtotal');
            $table->string('billing_total');
            $table->string('payment_gateway')->default('COD');
            $table->string('status')->default('pending');
            $table->string('error')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
