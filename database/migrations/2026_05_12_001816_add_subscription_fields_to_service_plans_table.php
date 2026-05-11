<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_plans', function (Blueprint $table) {
            $table->boolean('is_subscription')->default(false)->after('is_popular');
            $table->string('billing_interval')->nullable()->after('is_subscription');
            $table->unsignedSmallInteger('trial_days')->nullable()->after('billing_interval');
        });
    }

    public function down(): void
    {
        Schema::table('service_plans', function (Blueprint $table) {
            $table->dropColumn(['is_subscription', 'billing_interval', 'trial_days']);
        });
    }
};
