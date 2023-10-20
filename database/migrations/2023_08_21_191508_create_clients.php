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
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('client_asaas_id');
            $table->string('name');
            $table->string('cpfCnpj');
            $table->string('password');
            $table->enum('trial',['1','0'])->default('0');
            $table->enum('premium',['1','0'])->default('0');
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
