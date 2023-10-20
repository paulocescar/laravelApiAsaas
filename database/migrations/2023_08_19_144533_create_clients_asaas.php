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
        Schema::create('clients_asaas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('asaas_customer_id');
            $table->string('name');
            $table->string('cpfCnpj');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobilePhone')->nullable();
            $table->string('address')->nullable();
            $table->string('addressNumber')->nullable();
            $table->string('complement')->nullable();
            $table->string('province')->nullable();
            $table->string('postalCode')->nullable();
            $table->string('externalReference')->nullable();
            $table->boolean('notificationDisabled')->default(0);
            $table->string('additionalEmails')->nullable();
            $table->string('municipalInscription')->nullable();
            $table->string('stateInscription')->nullable();
            $table->string('observations')->nullable();
            $table->string('groupName')->nullable();
            $table->string('company')->nullable();
            $table->enum('lixeira',['Sim','Nao'])->default('Nao');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
