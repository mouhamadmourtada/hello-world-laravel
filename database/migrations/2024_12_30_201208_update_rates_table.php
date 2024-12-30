<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rates', function (Blueprint $table) {
            // Supprimer la colonne is_active si elle existe
            if (Schema::hasColumn('rates', 'is_active')) {
                $table->dropColumn('is_active');
            }

            // Ajouter la colonne duration_type si elle n'existe pas
            if (!Schema::hasColumn('rates', 'duration_type')) {
                $table->enum('duration_type', ['night', '3_days', 'week', 'month', 'year'])->after('accommodation_id');
            }

            // Ajouter une contrainte unique sur accommodation_id et duration_type
            $table->unique(['accommodation_id', 'duration_type'], 'rates_accommodation_duration_unique');
        });
    }

    public function down(): void
    {
        Schema::table('rates', function (Blueprint $table) {
            $table->dropUnique('rates_accommodation_duration_unique');
            
            if (!Schema::hasColumn('rates', 'is_active')) {
                $table->boolean('is_active')->default(true);
            }
        });
    }
};
