<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('customer');
            $table->enum('billingType', ['BOLETO','CREDIT_CARD','PIX'])->default('BOLETO');;
            $table->float('value',10,3)->nullable();
            $table->string('dueDate')->timestamp();
            $table->string('description')->nullable();
            $table->string('externalReference')->nullable();
            $table->integer('installmentCount')->nullable();
            $table->float('totalValue')->nullable();
            $table->float('installmentValue')->nullable();
            $table->string('discount_id')->nullable();
            $table->string('interest_id')->nullable();
            $table->string('fine_id')->nullable();
            $table->string('postalService')->nullable();
            $table->string('split')->nullable();
            $table->enum('lixeira',['Sim','Nao'])->default('Nao');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
