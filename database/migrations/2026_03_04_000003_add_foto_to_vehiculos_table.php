<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('vehiculos')) {
            return;
        }

        Schema::table('vehiculos', function (Blueprint $table) {
            if (!Schema::hasColumn('vehiculos', 'foto')) {
                $table->string('foto')->nullable()->after('telefono_cliente');
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('vehiculos')) {
            return;
        }

        Schema::table('vehiculos', function (Blueprint $table) {
            if (Schema::hasColumn('vehiculos', 'foto')) {
                $table->dropColumn('foto');
            }
        });
    }
};
