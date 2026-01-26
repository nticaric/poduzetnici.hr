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
        Schema::table('ads', function (Blueprint $table) {
            $table->decimal('annual_revenue', 15, 2)->nullable()->after('price');
            $table->decimal('net_profit', 15, 2)->nullable()->after('annual_revenue');
            $table->integer('established_year')->nullable()->after('net_profit');
            $table->integer('employee_count')->nullable()->after('established_year');
            $table->boolean('includes_real_estate')->default(false)->after('employee_count');
            $table->string('website')->nullable()->after('includes_real_estate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ads', function (Blueprint $table) {
            $table->dropColumn([
                'annual_revenue',
                'net_profit',
                'established_year',
                'employee_count',
                'includes_real_estate',
                'website',
            ]);
        });
    }
};
