<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@apnarbusiness.com')->first();
        $blogCategories = Category::where('type', 'blog')->pluck('id', 'name');

        $tags = ['Laravel', 'PHP', 'Business', 'Startup', 'Technology', 'Tutorial', 'Tips', 'Bangladesh', 'SaaS', 'SEO', 'Marketing'];
        $tagModels = [];
        foreach ($tags as $tagName) {
            $tagModels[$tagName] = Tag::firstOrCreate(['slug' => \Str::slug($tagName)], ['name' => $tagName]);
        }

        $posts = [
            [
                'title' => 'বাংলাদেশে স্টার্টআপ থেকে SaaS পর্যন্ত: আপনার প্রথম ডিজিটাল পণ্য গড়ে তোলা',
                'excerpt' => 'Learn how to identify your first SaaS product idea in the Bangladeshi market and validate it before writing any code.',
                'content' => '<p>Starting a SaaS product in Bangladesh can be challenging, but with the right approach, it can be highly rewarding. This guide walks you through identifying problems, validating ideas, and building your first digital product.</p><h2>Identify Market Problems</h2><p>The best SaaS products solve real problems that people face every day. In Bangladesh, there are numerous opportunities in education technology, logistics, agriculture, and small business management.</p><h2>Validate Before Building</h2><p>Don\'t build first and hope people will come. Validate your idea by talking to potential users, creating mockups, and testing assumptions before writing code.</p><h2>Start Small, Think Big</h2><p>Build an MVP (Minimum Viable Product) that solves the core problem. Then iterate based on user feedback. This approach saves time, money, and ensures you build something people actually want.</p>',
                'category_name' => 'Technology',
                'is_published' => true,
                'published_at' => now()->subDays(5),
                'tags' => ['SaaS', 'Startup', 'Technology'],
            ],
            [
                'title' => 'Laravel 11 vs Laravel 10: কী নতুন আছে এবং কিন্তে আপগ্রেড করা উচিত?',
                'excerpt' => 'A detailed comparison of Laravel 11 features and improvements over Laravel 10, with recommendations for when to upgrade.',
                'content' => '<p>Laravel 11 brings significant improvements including better performance, enhanced security, and streamlined development workflows. Let\'s explore what\'s new and when you should upgrade.</p><h2>Performance Improvements</h2><p>Laravel 11 includes optimizations that reduce memory usage and improve response times. These improvements are particularly noticeable in large-scale applications.</p><h2>New Features</h2><p>The new release introduces features like improved middleware handling, better queue management, and enhanced testing capabilities.</p>',
                'category_name' => 'Technology',
                'is_published' => true,
                'published_at' => now()->subDays(10),
                'tags' => ['Laravel', 'PHP', 'Tutorial'],
            ],
            [
                'title' => 'ব্যবসা শুরু করার আগে ১০টি গুরুত্বপূর্ণ টুলস সংগ্রহ',
                'excerpt' => 'A comprehensive toolkit of 10 essential resources every Bangladeshi entrepreneur should know about when starting their business.',
                'content' => '<p>Starting a business in Bangladesh requires the right tools. From accounting software to marketing platforms, here are the 10 essential tools every entrepreneur needs:</p><h2>Financial Management</h2><p>Succeed, Pathao Pay, and bKash Business provide financial infrastructure for startups.</p><h2>Marketing and Sales</h2><p>Google Workspace, Canva, and Facebook Ads Manager help you reach customers effectively.</p><h2>Productivity</h2><p>Slack, Notion, and Trello keep your team organized and productive.</p>',
                'category_name' => 'Tutorials',
                'is_published' => true,
                'published_at' => now()->subDays(15),
                'tags' => ['Business', 'Startup', 'Tips'],
            ],
            [
                'title' => 'ডিজিটাল মার্কেটিং ২০২৪: বাংলাদেশিদের জন্য SEO টিউটোরিয়াল',
                'excerpt' => 'Master SEO strategies specifically tailored for the Bangladeshi market, including local SEO and content marketing tips.',
                'content' => '<p>SEO for Bangladeshi businesses requires a unique approach. Here\'s how to optimize your website for local search and attract more customers.</p><h2>Local SEO</h2><p>Focus on local keywords, Google My Business, and local directory listings to improve visibility in Bangladesh.</p><h2>Content Marketing</h2><p>Create content in Bengali that addresses local pain points and interests. This helps build authority and trust with your audience.</p>',
                'category_name' => 'Tutorials',
                'is_published' => true,
                'published_at' => now()->subDays(20),
                'tags' => ['SEO', 'Marketing', 'Tips'],
            ],
            [
                'title' => 'কিভাবে স্টার্টআপের জন্য রাউন্ড ১ ইনভেস্টমেন্ট পাবেন: গাইড',
                'excerpt' => 'A step-by-step guide on how Bangladeshi startups can secure their first round of investment, from pitch decks to investor meetings.',
                'content' => '<p>Raising your first round of investment is a critical milestone for any startup. This comprehensive guide covers everything from crafting your pitch deck to negotiating terms with investors.</p><h2>Building Your Pitch Deck</h2><p>Your pitch deck should tell a compelling story about your problem, solution, market, and team. Keep it concise and data-driven.</p><h2>Finding Investors</h2><p>Bangladesh has a growing startup ecosystem with angel investors, venture capital firms, and government-backed funds. Network at events and leverage your connections.</p>',
                'category_name' => 'News',
                'is_published' => true,
                'published_at' => now()->subDays(25),
                'tags' => ['Startup', 'Business', 'Tips'],
            ],
        ];

        foreach ($posts as $postData) {
            $postTags = $postData['tags'];
            $categoryName = $postData['category_name'];
            unset($postData['tags'], $postData['category_name']);

            $categoryId = $blogCategories[$categoryName] ?? $blogCategories->first();

            $post = Post::create(array_merge($postData, [
                'user_id' => $admin->id,
                'category_id' => $categoryId,
                'meta_title' => $postData['title'],
                'meta_description' => $postData['excerpt'],
            ]));

            $post->tags()->sync(
                collect($postTags)->map(fn($t) => $tagModels[$t]?->id)->filter()->toArray()
            );
        }
    }
}