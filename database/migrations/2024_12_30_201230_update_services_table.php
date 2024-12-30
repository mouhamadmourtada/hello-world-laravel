<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            // Mettre à jour les colonnes existantes si nécessaire
            if (!Schema::hasColumn('services', 'description')) {
                $table->text('description')->nullable()->after('name');
            }
            
            if (!Schema::hasColumn('services', 'price')) {
                $table->decimal('price', 10, 2)->after('description');
            }
            
            if (!Schema::hasColumn('services', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('price');
            }
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            if (Schema::hasColumn('services', 'description')) {
                $table->dropColumn('description');
            }
            
            if (Schema::hasColumn('services', 'price')) {
                $table->dropColumn('price');
            }
            
            if (Schema::hasColumn('services', 'is_active')) {
                $table->dropColumn('is_active');
            }
        });
    }
};
