<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->enum('document_type', ['DNI', 'RUC', 'CE']);
            $table->string('number_document', 11)->unique();
            $table->string('first_name');
            $table->string('paternal_surname');
            $table->string('maternal_surname');
            $table->string('phone', 9)->nullable();
            $table->string('email', 250)->unique()->nullable();
            $table->string('address');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
