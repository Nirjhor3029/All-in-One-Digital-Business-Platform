<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'site_name', 'value' => 'Apnar Business', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'All-in-One Digital Business Platform', 'group' => 'general'],
            ['key' => 'contact_email', 'value' => 'hello@apnarbusiness.com', 'group' => 'general'],
            ['key' => 'contact_phone', 'value' => '+8801700000000', 'group' => 'general'],
            ['key' => 'address', 'value' => 'Dhaka, Bangladesh', 'group' => 'general'],
            ['key' => 'meta_title', 'value' => 'Apnar Business — Learn, Build, Grow', 'group' => 'seo'],
            ['key' => 'meta_description', 'value' => 'Bangladesh\'s first all-in-one digital business platform with premium courses, ready-made software, and expert support.', 'group' => 'seo'],
            ['key' => 'facebook_url', 'value' => 'https://facebook.com/apnarbusiness', 'group' => 'social'],
            ['key' => 'twitter_url', 'value' => 'https://twitter.com/apnarbusiness', 'group' => 'social'],
            ['key' => 'linkedin_url', 'value' => 'https://linkedin.com/company/apnarbusiness', 'group' => 'social'],
            ['key' => 'youtube_url', 'value' => 'https://youtube.com/@apnarbusiness', 'group' => 'social'],
            ['key' => 'currency', 'value' => 'BDT', 'group' => 'payment'],
            ['key' => 'currency_symbol', 'value' => '৳', 'group' => 'payment'],
            ['key' => 'commission_rate', 'value' => '5', 'group' => 'payment'],
            ['key' => 'tax_rate', 'value' => '5', 'group' => 'payment'],
        ];

        foreach ($settings as $data) {
            Setting::create($data);
        }
    }
}
