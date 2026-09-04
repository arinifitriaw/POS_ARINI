<?php 
 
use Illuminate\Database\Migrations\Migration; 
use Illuminate\Database\Schema\Blueprint; 
use Illuminate\Support\Facades\Schema; 
 
return new class extends Migration 
{ 
    public function up(): void 
    { 
        Schema::create('penjualan', function (Blueprint $table) { 
            $table->id(); 
            $table->foreignId('user_id')
            ->nullable()
            ->constrained('users', 'id')
            ->nullOnDelete(); 
            
            $table->integer('total_pembayaran'); 
            $table->string('metode_pembayaran')->nullable(); 
            $table->enum('status', ['OPEN', 'COMPLETED']); 
            $table->timestamps(); 
        }); 
    } 
 
    public function down(): void 
    { 
        Schema::dropIfExists('penjualan'); 
    } 
};