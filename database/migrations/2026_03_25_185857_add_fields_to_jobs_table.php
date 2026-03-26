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
        Schema::table('jobs', function (Blueprint $table) {
            $table->string('canton', 2)->nullable()->after('location_id');
            $table->string('zip', 10)->nullable()->after('canton');
            $table->boolean('home_office')->default(false)->after('zip');
            $table->string('language')->nullable()->after('home_office');
            $table->string('workplace')->nullable()->after('language');
        });
    }

    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn(['canton', 'zip', 'home_office', 'language', 'workplace']);
        });
    }
};
