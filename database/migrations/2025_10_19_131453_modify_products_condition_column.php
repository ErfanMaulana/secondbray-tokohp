<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ubah kolom condition dari ENUM ke VARCHAR agar bisa menampung teks bahasa Indonesia
        DB::statement("ALTER TABLE products MODIFY COLUMN `condition` VARCHAR(20) NOT NULL DEFAULT 'Baik'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan ke ENUM dengan nilai English
        DB::statement("ALTER TABLE products MODIFY COLUMN `condition` ENUM('Excellent', 'Good', 'Fair') NOT NULL DEFAULT 'Good'");
    }
};
