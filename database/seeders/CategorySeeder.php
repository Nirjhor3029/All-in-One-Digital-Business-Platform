<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Type;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Web Development', 'type' => 'course', 'sort_order' => 1],
            ['name' => 'Mobile Apps', 'type' => 'course', 'sort_order' => 2],
            ['name' => 'Digital Marketing', 'type' => 'course', 'sort_order' => 3],
            ['name' => 'Graphic Design', 'type' => 'course', 'sort_order' => 4],
            ['name' => 'Business & Finance', 'type' => 'course', 'sort_order' => 5],
            ['name' => 'Personal Development', 'type' => 'course', 'sort_order' => 6],
            ['name' => 'Coaching Management', 'type' => 'service', 'sort_order' => 1],
            ['name' => 'School Management', 'type' => 'service', 'sort_order' => 2],
            ['name' => 'Business Automation', 'type' => 'service', 'sort_order' => 3],
            ['name' => 'Technology', 'type' => 'blog', 'sort_order' => 1],
            ['name' => 'Tutorials', 'type' => 'blog', 'sort_order' => 2],
            ['name' => 'News', 'type' => 'blog', 'sort_order' => 3],
            ['name' => 'Software', 'type' => 'product', 'sort_order' => 1],
            ['name' => 'Digital Products', 'type' => 'product', 'sort_order' => 2],
        ];

        foreach ($categories as $data) {
            $data['type_id'] = Type::where('slug', $data['type'])->first()?->id;
            Category::create($data);
        }
    }
}
