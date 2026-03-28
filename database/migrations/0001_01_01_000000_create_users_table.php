<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('dni', 8)->unique();
            $table->string('first_name');
            $table->string('paternal_surname');
            $table->string('maternal_surname');
            $table->string('phone', 9);
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['admin','lawyer','secretary']);
            $table->enum('status', ['active','inactive'])->default('active');
            $table->string('profile_photo')->nullable();
            $table->string('cal_number', 10)->nullable();
            $table->foreignId('lawyer_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('users');
    }
};