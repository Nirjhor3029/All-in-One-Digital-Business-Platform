<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title' => 'EduTrack Platform',
                'description' => 'Complete learning management system for schools and coaching centers with exam management, grade cards, and parent communication.',
                'color' => '#6366F1',
                'tech_stack' => ['Laravel', 'Filament', 'Vue.js'],
                'icon_path' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
                'sort_order' => 1,
            ],
            [
                'title' => 'PayFlow Gateway',
                'description' => 'Payment processing gateway with SSLCommerz integration, subscription billing, invoice generation, and multi-currency support.',
                'color' => '#10B981',
                'tech_stack' => ['Laravel', 'Livewire', 'Tailwind'],
                'icon_path' => 'M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z',
                'sort_order' => 2,
            ],
            [
                'title' => 'StockMaster ERP',
                'description' => 'Enterprise inventory management with barcode scanning, warehousing, purchase orders, and real-time stock tracking dashboard.',
                'color' => '#F59E0B',
                'tech_stack' => ['Laravel', 'MySQL', 'REST API'],
                'icon_path' => 'M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7',
                'sort_order' => 3,
            ],
            [
                'title' => 'SMSBlast API',
                'description' => 'High-throughput SMS gateway API with templating engine, scheduling, delivery reports, and webhook integration for developers.',
                'color' => '#EF4444',
                'tech_stack' => ['Laravel', 'Redis', 'React'],
                'icon_path' => 'M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z',
                'sort_order' => 4,
            ],
        ];

        foreach ($projects as $data) {
            Project::create($data);
        }
    }
}
