<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $settings = Setting::getAll();

        $parseJson = function (string $key, array $default = []) use ($settings): array {
            $raw = json_decode($settings[$key] ?? '[]', true);
            return is_array($raw) && count($raw) > 0 ? $raw : $default;
        };

        $defaultJourneySteps = [
            ['icon' => 'lightbulb', 'label' => 'Idea'],
            ['icon' => 'edit_note', 'label' => 'Planning'],
            ['icon' => 'brush', 'label' => 'Brand'],
            ['icon' => 'language', 'label' => 'Website'],
            ['icon' => 'terminal', 'label' => 'Software'],
            ['icon' => 'automation', 'label' => 'Automation'],
            ['icon' => 'trending_up', 'label' => 'Growth'],
        ];

        $defaultCoreServices = [
            ['icon' => 'partner_exchange', 'title' => 'Business Consultation', 'description' => 'Strategic planning and operational optimization for your venture.'],
            ['icon' => 'developer_mode', 'title' => 'Custom Software', 'description' => 'Bespoke software systems built to solve unique challenges.'],
            ['icon' => 'smartphone', 'title' => 'Mobile App Dev', 'description' => 'High-performance iOS and Android applications focused on user experience.'],
            ['icon' => 'web', 'title' => 'Website Development', 'description' => 'Clean, editorial-grade web experiences that communicate authority.'],
            ['icon' => 'precision_manufacturing', 'title' => 'Business Automation', 'description' => 'Removing manual labor through intelligent API integrations and AI tools.'],
            ['icon' => 'school', 'title' => 'Business Starter Courses', 'description' => 'Guided learning paths for founders looking to master business building.'],
            ['icon' => 'inventory_2', 'title' => 'SaaS Products', 'description' => 'Enterprise-grade supply chain and management systems for local markets.'],
            ['icon' => 'transform', 'title' => 'Digital Transformation', 'description' => 'Modernizing traditional business workflows for the digital age.'],
        ];

        $defaultSaasProducts = [
            ['title' => 'Inventory Pro XL', 'description' => 'An enterprise-grade supply chain and warehouse management system designed for the local market.'],
            ['title' => 'RetailFlow CRM', 'description' => 'Customer relationship management tailored for fast-growing retail brands and service providers.'],
            ['title' => 'EduScale Portal', 'description' => 'Complete LMS and administrative backbone for coaching centers and private universities.'],
        ];

        $defaultBusinessCourses = [
            ['title' => 'Startup Foundation 101', 'description' => 'Mastering legal, structural, and financial basics for Bangladeshi entrepreneurs.', 'image' => 'course-foundation.jpg', 'modules' => '8', 'price' => '৫,০০০'],
            ['title' => 'Automation Masterclass', 'description' => 'Learn to use Zapier, AI, and APIs to put your business on autopilot.', 'image' => 'course-automation.jpg', 'modules' => '12', 'price' => '১২,০০০'],
            ['title' => 'The Scale Framework', 'description' => 'Advanced strategies for hiring, delegation, and geographic expansion.', 'image' => 'course-scale.jpg', 'modules' => '15', 'price' => '১৫,০০০'],
        ];

        $defaultWhyPoints = [
            ['number' => '01', 'title' => "Partnership over Projects", 'description' => "We don't just deliver code; we embed ourselves in your growth journey as your dedicated technical partner."],
            ['number' => '02', 'title' => 'Simplicity by Design', 'description' => 'Technology should solve problems, not create them. We build tools that are intuitive and powerful.'],
            ['number' => '03', 'title' => 'Local Context, Global Tech', 'description' => 'We understand the unique challenges of the Bangladeshi market and solve them with world-class engineering.'],
        ];

        $defaultSuccessStories = [
            ['icon' => 'storefront', 'quote' => '"আপনার Business replaced our manual bookkeeping with a custom CRM. Our efficiency tripled in 4 months."', 'name' => 'RAHAT CHOWDHURY', 'role' => 'CEO, Modina Logistics'],
            ['icon' => 'rocket_launch', 'quote' => '"From a simple idea to a fully automated SaaS platform. They are the best technical team I\'ve ever worked with."', 'name' => 'SARAH ISLAM', 'role' => 'Founder, EduNext BD'],
        ];

        $defaultRoadmapStages = [
            ['title' => 'Business Idea', 'subtitle' => 'Visionary Thinking'],
            ['title' => 'Planning', 'subtitle' => 'Strategic Blueprint'],
            ['title' => 'Brand Identity', 'subtitle' => 'Visual Essence'],
            ['title' => 'Website', 'subtitle' => 'Digital Home'],
            ['title' => 'Software', 'subtitle' => 'Custom Tools'],
            ['title' => 'Automation', 'subtitle' => 'Operational Efficiency'],
            ['title' => 'Growth', 'subtitle' => 'Market Capture'],
            ['title' => 'Scale', 'subtitle' => 'Global Domination'],
        ];

        $defaultJourneyCards = [
            ['image' => 'icon-idea.png', 'title' => 'I have an idea', 'description' => 'I want to start a new business and need guidance from idea to launch.', 'cta_text' => 'Get Started', 'cta_url' => '/register'],
            ['image' => 'icon-business.png', 'title' => 'I already have a business', 'description' => 'I want to improve, digitize, or streamline my existing business.', 'cta_text' => 'Modernize', 'cta_url' => '/services'],
            ['image' => 'icon-software.png', 'title' => 'I need software', 'description' => 'I need a website, mobile app, custom software, or SaaS solution.', 'cta_text' => 'Build Now', 'cta_url' => '/contact'],
            ['image' => 'icon-growth.png', 'title' => 'I want to grow', 'description' => 'I want to automate operations, increase sales, and scale my business.', 'cta_text' => 'Scale Up', 'cta_url' => '/courses'],
        ];

        $data = [
            'settings' => $settings,
            'journey_steps' => $parseJson('journey_steps', $defaultJourneySteps),
            'core_services' => $parseJson('core_services', $defaultCoreServices),
            'saas_products' => $parseJson('saas_products', $defaultSaasProducts),
            'business_courses' => $parseJson('business_courses', $defaultBusinessCourses),
            'why_points' => $parseJson('why_points', $defaultWhyPoints),
            'success_stories' => $parseJson('success_stories', $defaultSuccessStories),
            'roadmap_stages' => $parseJson('roadmap_stages', $defaultRoadmapStages),
            'journey_cards' => $parseJson('journey_cards', $defaultJourneyCards),
        ];

        return view('welcome', $data);
    }
}