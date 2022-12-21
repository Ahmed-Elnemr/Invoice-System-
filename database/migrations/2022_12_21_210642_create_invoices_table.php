<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_number', 50);
            $table->date('invoice_date')->nullable();
            $table->date('due_date')->nullable();
            $table->string('product', 50);
            $table->string('section', 50);
            $table->decimal('discount', 8, 2);
            $table->decimal('value_vAT', 8, 2);
            $table->string('rate_vAT');
            $table->decimal('total', 8, 2);
            $table->string('status', 50);
            $table->integer('value_status');
            $table->text('note')->nullable();
            $table->string('user');
            $table->softDeletes();
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
        Schema::dropIfExists('invoices');
    }
};