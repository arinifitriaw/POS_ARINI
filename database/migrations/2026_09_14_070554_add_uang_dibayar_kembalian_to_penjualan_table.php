<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penjualan', function (Blueprint $table) {
            $table->decimal('uang_dibayar', 15, 2)
                ->nullable()
                ->after('total_pembayaran');

            $table->decimal('kembalian', 15, 2)
                ->nullable()
                ->after('uang_dibayar');
        });
    }

    public function down(): void
    {
        Schema::table('penjualan', function (Blueprint $table) {
            if (Schema::hasColumn('penjualan', 'uang_dibayar')) {
                $table->dropColumn('uang_dibayar');
            }

            if (Schema::hasColumn('penjualan', 'kembalian')) {
                $table->dropColumn('kembalian');
            }
        });
    }
};