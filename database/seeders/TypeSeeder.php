<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['name' => 'Course', 'slug' => 'course', 'sort_order' => 1],
            ['name' => 'Service', 'slug' => 'service', 'sort_order' => 2],
            ['name' => 'Blog', 'slug' => 'blog', 'sort_order' => 3],
            ['name' => 'Product', 'slug' => 'product', 'sort_order' => 4],
            ['name' => 'General', 'slug' => 'general', 'sort_order' => 5],
        ];

        foreach ($types as $data) {
            Type::firstOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
