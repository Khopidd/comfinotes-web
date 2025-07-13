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
        Schema::create('transaction', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('divisi_id')->nullable()->constrained('divisi');
            $table->decimal('total', 11, 2)->default(0);
            $table->decimal('total_disetujui', 11, 2)->nullable();
            $table->string('nama_acara');
            $table->date('tanggal_pengajuan');
            $table->text('catatan')->nullable();
            $table->string('supporting_image')->nullable();
            $table->integer('jumlah_hari')->nullable();
            $table->date('tanggal_akhir')->nullable();
            $table->enum('status', ['pending', 'rejected', 'approved'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction');
    }
};
