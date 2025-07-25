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
        Schema::dropIfExists('out_funds');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('out_funds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->foreignId('divisi_id')->nullable()->constrained('divisi')->nullOnDelete();
            $table->decimal('jumlah', 11, 2);
            $table->date('tanggal_keluar');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }
};
