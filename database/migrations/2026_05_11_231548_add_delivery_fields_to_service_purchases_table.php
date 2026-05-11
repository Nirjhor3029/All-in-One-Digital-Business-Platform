<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_purchases', function (Blueprint $table) {
            $table->string('download_url')->nullable()->after('status');
            $table->text('credentials')->nullable()->after('download_url');
            $table->text('admin_notes')->nullable()->after('credentials');
            $table->timestamp('delivered_at')->nullable()->after('admin_notes');
            $table->foreignId('delivered_by')->nullable()->constrained('users')->after('delivered_at');
        });
    }

    public function down(): void
    {
        Schema::table('service_purchases', function (Blueprint $table) {
            $table->dropConstrainedForeignId('delivered_by');
            $table->dropColumn(['download_url', 'credentials', 'admin_notes', 'delivered_at']);
        });
    }
};
