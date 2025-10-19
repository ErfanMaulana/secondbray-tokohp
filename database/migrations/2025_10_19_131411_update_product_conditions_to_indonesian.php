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
        // Update kondisi dari English ke Bahasa Indonesia
        DB::table('products')->where('condition', 'Excellent')->update(['condition' => 'Sangat Baik']);
        DB::table('products')->where('condition', 'Good')->update(['condition' => 'Baik']);
        DB::table('products')->where('condition', 'Fair')->update(['condition' => 'Cukup']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan ke English
        DB::table('products')->where('condition', 'Sangat Baik')->update(['condition' => 'Excellent']);
        DB::table('products')->where('condition', 'Baik')->update(['condition' => 'Good']);
        DB::table('products')->where('condition', 'Cukup')->update(['condition' => 'Fair']);
    }
};
