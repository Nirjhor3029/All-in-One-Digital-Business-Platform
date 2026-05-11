<?php

use App\Models\Type;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $types = ['course', 'service', 'blog', 'product', 'general'];
        $typeIds = [];
        foreach ($types as $name) {
            $type = Type::create(['name' => ucfirst($name), 'slug' => $name, 'sort_order' => array_search($name, $types) + 1]);
            $typeIds[$name] = $type->id;
        }

        Schema::table('categories', function (Blueprint $table) {
            $table->foreignId('type_id')->nullable()->constrained('types')->nullOnDelete();
        });

        DB::table('categories')->get()->each(function ($cat) use ($typeIds) {
            $typeName = $cat->type ?? 'general';
            $tid = $typeIds[$typeName] ?? $typeIds['general'];
            DB::table('categories')->where('id', $cat->id)->update(['type_id' => $tid]);
        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign(['type_id']);
            $table->dropColumn('type_id');
        });
    }
};
