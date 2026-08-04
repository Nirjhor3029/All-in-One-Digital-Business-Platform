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
            ['key' => 'hero_headline', 'value' => 'আপনার ব্যবসা শুরু থেকে Scale পর্যন্ত।', 'group' => 'hero'],
            ['key' => 'hero_subtitle', 'value' => 'We help businesses launch, automate and grow with technology. Experience precision engineering for the modern entrepreneur.', 'group' => 'hero'],
            ['key' => 'hero_cta_text', 'value' => 'Start Your Business', 'group' => 'hero'],
            ['key' => 'hero_cta_url', 'value' => '/courses', 'group' => 'hero'],
            ['key' => 'hero_demo_text', 'value' => 'Book Consultation', 'group' => 'hero'],
            ['key' => 'hero_demo_url', 'value' => '/contact', 'group' => 'hero'],
            ['key' => 'hero_image', 'value' => 'settings/hero-graphic.png', 'group' => 'hero'],
            ['key' => 'hero_bg_image', 'value' => 'settings/hero-graphic.png', 'group' => 'hero'],

            // Business Journey Steps (7 steps)
            ['key' => 'journey_steps', 'value' => json_encode([
                ['icon' => 'lightbulb', 'label' => 'Idea'],
                ['icon' => 'edit_note', 'label' => 'Planning'],
                ['icon' => 'brush', 'label' => 'Brand'],
                ['icon' => 'language', 'label' => 'Website'],
                ['icon' => 'terminal', 'label' => 'Software'],
                ['icon' => 'automation', 'label' => 'Automation'],
                ['icon' => 'trending_up', 'label' => 'Growth'],
            ], JSON_UNESCAPED_UNICODE), 'group' => 'journey'],

            // Core Services Grid (8 services)
            ['key' => 'core_services', 'value' => json_encode([
                ['icon' => 'partner_exchange', 'title' => 'Business Consultation', 'description' => 'Strategic planning and operational optimization for your venture.'],
                ['icon' => 'developer_mode', 'title' => 'Custom Software', 'description' => 'Bespoke software systems built to solve unique challenges.'],
                ['icon' => 'smartphone', 'title' => 'Mobile App Dev', 'description' => 'High-performance iOS and Android applications focused on user experience.'],
                ['icon' => 'web', 'title' => 'Website Development', 'description' => 'Clean, editorial-grade web experiences that communicate authority.'],
                ['icon' => 'precision_manufacturing', 'title' => 'Business Automation', 'description' => 'Removing manual labor through intelligent API integrations and AI tools.'],
                ['icon' => 'school', 'title' => 'Business Starter Courses', 'description' => 'Guided learning paths for founders looking to master business building.'],
                ['icon' => 'inventory_2', 'title' => 'SaaS Products', 'description' => 'Enterprise-grade supply chain and management systems for local markets.'],
                ['icon' => 'transform', 'title' => 'Digital Transformation', 'description' => 'Modernizing traditional business workflows for the digital age.'],
            ], JSON_UNESCAPED_UNICODE), 'group' => 'services'],

            // SaaS Products (3 products)
            ['key' => 'saas_products', 'value' => json_encode([
                ['title' => 'Inventory Pro XL', 'description' => 'An enterprise-grade supply chain and warehouse management system designed for the local market.'],
                ['title' => 'RetailFlow CRM', 'description' => 'Customer relationship management tailored for fast-growing retail brands and service providers.'],
                ['title' => 'EduScale Portal', 'description' => 'Complete LMS and administrative backbone for coaching centers and private universities.'],
            ], JSON_UNESCAPED_UNICODE), 'group' => 'saas'],

            // Business Courses (3 courses)
            ['key' => 'business_courses', 'value' => json_encode([
                ['title' => 'Startup Foundation 101', 'description' => 'Mastering legal, structural, and financial basics for Bangladeshi entrepreneurs.', 'image' => 'courses/course-foundation.jpg', 'modules' => '8', 'price' => '৫,০০০'],
                ['title' => 'Automation Masterclass', 'description' => 'Learn to use Zapier, AI, and APIs to put your business on autopilot.', 'image' => 'courses/course-automation.jpg', 'modules' => '12', 'price' => '১২,০০০'],
                ['title' => 'The Scale Framework', 'description' => 'Advanced strategies for hiring, delegation, and geographic expansion.', 'image' => 'courses/course-scale.jpg', 'modules' => '15', 'price' => '১৫,০০০'],
            ], JSON_UNESCAPED_UNICODE), 'group' => 'courses'],

            // Why Apnar Business (3 points)
            ['key' => 'why_points', 'value' => json_encode([
                ['number' => '01', 'title' => "Partnership over Projects", 'description' => "We don't just deliver code; we embed ourselves in your growth journey as your dedicated technical partner."],
                ['number' => '02', 'title' => 'Simplicity by Design', 'description' => 'Technology should solve problems, not create them. We build tools that are intuitive and powerful.'],
                ['number' => '03', 'title' => 'Local Context, Global Tech', 'description' => 'We understand the unique challenges of the Bangladeshi market and solve them with world-class engineering.'],
            ], JSON_UNESCAPED_UNICODE), 'group' => 'why'],

            // Success Stories (2 stories)
            ['key' => 'success_stories', 'value' => json_encode([
                ['icon' => 'storefront', 'quote' => '"আপনার Business replaced our manual bookkeeping with a custom CRM. Our efficiency tripled in 4 months."', 'name' => 'RAHAT CHOWDHURY', 'role' => 'CEO, Modina Logistics'],
                ['icon' => 'rocket_launch', 'quote' => '"From a simple idea to a fully automated SaaS platform. They are the best technical team I\'ve ever worked with."', 'name' => 'SARAH ISLAM', 'role' => 'Founder, EduNext BD'],
            ], JSON_UNESCAPED_UNICODE), 'group' => 'stories'],

            // Client Roadmap Stages (8 stages)
            ['key' => 'roadmap_stages', 'value' => json_encode([
                ['title' => 'Business Idea', 'subtitle' => 'Visionary Thinking'],
                ['title' => 'Planning', 'subtitle' => 'Strategic Blueprint'],
                ['title' => 'Brand Identity', 'subtitle' => 'Visual Essence'],
                ['title' => 'Website', 'subtitle' => 'Digital Home'],
                ['title' => 'Software', 'subtitle' => 'Custom Tools'],
                ['title' => 'Automation', 'subtitle' => 'Operational Efficiency'],
                ['title' => 'Growth', 'subtitle' => 'Market Capture'],
                ['title' => 'Scale', 'subtitle' => 'Global Domination'],
            ], JSON_UNESCAPED_UNICODE), 'group' => 'roadmap'],

            // Choose Your Journey Bento Cards (4 cards)
            ['key' => 'journey_cards', 'value' => json_encode([
                ['image' => 'settings/icon-idea.png', 'title' => 'I have an idea', 'description' => 'I want to start a new business and need guidance from idea to launch.', 'cta_text' => 'Get Started', 'cta_url' => '/register'],
                ['image' => 'settings/icon-business.png', 'title' => 'I already have a business', 'description' => 'I want to improve, digitize, or streamline my existing business.', 'cta_text' => 'Modernize', 'cta_url' => '/services'],
                ['image' => 'settings/icon-software.png', 'title' => 'I need software', 'description' => 'I need a website, mobile app, custom software, or SaaS solution.', 'cta_text' => 'Build Now', 'cta_url' => '/contact'],
                ['image' => 'settings/icon-growth.png', 'title' => 'I want to grow', 'description' => 'I want to automate operations, increase sales, and scale my business.', 'cta_text' => 'Scale Up', 'cta_url' => '/courses'],
            ], JSON_UNESCAPED_UNICODE), 'group' => 'journey_cards'],

            // Consultation CTA
            ['key' => 'consultation_headline', 'value' => 'পরবর্তী ধাপে যেতে প্রস্তুত?', 'group' => 'cta'],
            ['key' => 'consultation_description', 'value' => 'আপনার বিজনেস আইডিয়া বা চলমান সমস্যা নিয়ে আমাদের সাথে আলোচনা করুন। আমরা আছি আপনার পাশে।', 'group' => 'cta'],
            ['key' => 'consultation_cta_text', 'value' => 'Book Your Free Call', 'group' => 'cta'],
            ['key' => 'consultation_cta_url', 'value' => '/register', 'group' => 'cta'],

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