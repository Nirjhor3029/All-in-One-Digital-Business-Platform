<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'is_published' => true,
                'content' => '<h2>Information We Collect</h2>
<p>We collect information you provide when registering, making purchases, or contacting us.</p>
<h2>How We Use Your Information</h2>
<p>We use your information to provide services, process payments, send updates, and improve our platform.</p>
<h2>Data Protection</h2>
<p>We implement security measures to protect your personal information.</p>
<h2>Contact</h2>
<p>Questions about this policy? Contact us at hello@apnarbusiness.com.</p>',
                'meta_title' => 'Privacy Policy — Apnar Business',
                'meta_description' => 'Apnar Business privacy policy — how we collect, use, and protect your information.',
            ],
            [
                'title' => 'Terms of Service',
                'slug' => 'terms',
                'is_published' => true,
                'content' => '<h2>Acceptance of Terms</h2>
<p>By accessing or using Apnar Business, you agree to be bound by these terms.</p>
<h2>Services</h2>
<p>We provide online courses, software solutions, and digital services as described on our platform.</p>
<h2>Payments</h2>
<p>All payments are processed securely through SSLCommerz. Refunds are subject to our refund policy.</p>
<h2>Account Responsibility</h2>
<p>You are responsible for maintaining the confidentiality of your account credentials.</p>
<h2>Contact</h2>
<p>For questions about these terms, contact us at hello@apnarbusiness.com.</p>',
                'meta_title' => 'Terms of Service — Apnar Business',
                'meta_description' => 'Apnar Business terms of service — rules and guidelines for using our platform.',
            ],
            [
                'title' => 'About Us',
                'slug' => 'about',
                'is_published' => true,
                'content' => '<p>Apnar Business is Bangladesh\'s first all-in-one digital business platform. We provide premium courses, ready-made software solutions, and expert support to help you learn, build, and grow your business.</p>
<p>Our mission is to empower entrepreneurs, freelancers, and professionals in Bangladesh with the tools and knowledge they need to succeed in the digital economy.</p>
<p>Founded with a vision to make quality education and business tools accessible to everyone, we continue to expand our offerings and support our growing community.</p>',
                'meta_title' => 'About Us — Apnar Business',
                'meta_description' => 'Learn about Apnar Business — Bangladesh\'s all-in-one digital platform for courses, software, and services.',
            ],
            [
                'title' => 'Contact Us',
                'slug' => 'contact',
                'is_published' => true,
                'content' => '<p>Have questions or feedback? We\'d love to hear from you.</p>
<p><strong>Email:</strong> hello@apnarbusiness.com</p>
<p><strong>Location:</strong> Dhaka, Bangladesh</p>
<p>We aim to respond to all inquiries within 24 hours.</p>',
                'meta_title' => 'Contact Us — Apnar Business',
                'meta_description' => 'Get in touch with Apnar Business. We\'re here to help.',
            ],
            [
                'title' => 'FAQ',
                'slug' => 'faq',
                'is_published' => true,
                'content' => '<h2>How do I enroll in a course?</h2>
<p>Browse our course catalog, choose a course, and click "Enroll Now". Free courses are instantly accessible. Paid courses require checkout.</p>
<h2>What payment methods do you accept?</h2>
<p>We accept all major payment methods through SSLCommerz, including bKash, Nagad, credit/debit cards, and internet banking.</p>
<h2>How do I access my purchased services?</h2>
<p>Go to your Dashboard → My Services to view your purchased services with download links and credentials.</p>
<h2>Can I cancel my subscription?</h2>
<p>Yes, you can cancel your subscription anytime from your Dashboard → Subscriptions.</p>
<h2>How do I get a certificate?</h2>
<p>Complete all lectures in a course, and your certificate will be automatically generated and available in your Dashboard.</p>',
                'meta_title' => 'FAQ — Apnar Business',
                'meta_description' => 'Frequently asked questions about Apnar Business courses, payments, subscriptions, and services.',
            ],
        ];

        foreach ($pages as $page) {
            Page::firstOrCreate(
                ['slug' => $page['slug']],
                $page
            );
        }
    }
}
