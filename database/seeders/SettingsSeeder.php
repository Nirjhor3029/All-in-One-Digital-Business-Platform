<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General
            ['key' => 'site_name', 'value' => 'Apnar Business', 'group' => 'general'],
            ['key' => 'footer_description', 'value' => "Bangladesh's first all-in-one digital platform — premium courses, ready-made software, and expert support.", 'group' => 'general'],

            // Hero
            ['key' => 'hero_badge', 'value' => "Bangladesh's All-in-One Platform", 'group' => 'hero'],
            ['key' => 'hero_headline_line1', 'value' => 'শিখুন।', 'group' => 'hero'],
            ['key' => 'hero_headline_line2', 'value' => 'বানান।', 'group' => 'hero'],
            ['key' => 'hero_headline_line3', 'value' => 'বাড়ান।', 'group' => 'hero'],
            ['key' => 'hero_subtitle', 'value' => "Bangladesh's first platform where you get premium courses, ready-made SaaS products, and expert support — all in one place.", 'group' => 'hero'],
            ['key' => 'hero_cta_text', 'value' => 'কোর্স দেখুন', 'group' => 'hero'],
            ['key' => 'hero_cta_url', 'value' => '/courses', 'group' => 'hero'],
            ['key' => 'hero_demo_text', 'value' => 'Demo দেখুন', 'group' => 'hero'],
            ['key' => 'hero_social_proof', 'value' => '2,450+ জন শিখছেন', 'group' => 'hero'],
            ['key' => 'hero_rating_text', 'value' => '4.9/5', 'group' => 'hero'],

            // Stats
            ['key' => 'stats', 'value' => json_encode([
                ['icon' => '📚', 'value' => '50+', 'label' => 'Courses', 'sub' => 'Expert-led'],
                ['icon' => '👥', 'value' => '2,450+', 'label' => 'Students', 'sub' => 'Active learners'],
                ['icon' => '🛠', 'value' => '20+', 'label' => 'Products', 'sub' => 'SaaS solutions'],
                ['icon' => '⭐', 'value' => '4.9/5', 'label' => 'Rating', 'sub' => 'Student reviews'],
            ], JSON_UNESCAPED_UNICODE), 'group' => 'stats'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
