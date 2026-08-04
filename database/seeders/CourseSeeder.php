<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Course;
use App\Models\Lecture;
use App\Models\Section;
use App\Models\User;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@apnarbusiness.com')->first();

        $courseCategories = Category::where('type', 'course')->pluck('id', 'name');

        $courses = [
            [
                'title' => 'Startup Foundation 101',
                'short_description' => 'Mastering legal, structural, and financial basics for Bangladeshi entrepreneurs.',
                'long_description' => 'This foundational course covers everything you need to know to start a business in Bangladesh. From business registration to financial planning, we cover all the essentials.',
                'price' => 5000,
                'discount_price' => 4000,
                'level' => 'Beginner',
                'duration' => 360,
                'is_featured' => true,
                'is_published' => true,
                'is_free' => false,
                'category_name' => 'Business & Finance',
                'thumbnail' => 'courses/course-foundation.jpg',
                'sections' => [
                    [
                        'title' => 'Getting Started',
                        'lectures' => [
                            ['title' => 'Welcome to the Course', 'duration' => 15, 'is_free' => true],
                            ['title' => 'Setting Up Your Business Idea', 'duration' => 45, 'is_free' => true],
                            ['title' => 'Legal Structure Options', 'duration' => 60, 'is_free' => false],
                        ],
                    ],
                    [
                        'title' => 'Business Registration',
                        'lectures' => [
                            ['title' => 'Registering Your Business', 'duration' => 45, 'is_free' => false],
                            ['title' => 'Tax Registration Guide', 'duration' => 50, 'is_free' => false],
                        ],
                    ],
                    [
                        'title' => 'Financial Planning',
                        'lectures' => [
                            ['title' => 'Budgeting Basics', 'duration' => 55, 'is_free' => false],
                            ['title' => 'Funding Options', 'duration' => 70, 'is_free' => false],
                        ],
                    ],
                ],
            ],
            [
                'title' => 'Automation Masterclass',
                'short_description' => 'Learn to use Zapier, AI, and APIs to put your business on autopilot.',
                'long_description' => 'Master the art of automation with Zapier, AI tools, and API integrations. Perfect for busy entrepreneurs who want to scale.',
                'price' => 12000,
                'discount_price' => null,
                'level' => 'Advanced',
                'duration' => 720,
                'is_featured' => true,
                'is_published' => true,
                'is_free' => false,
                'category_name' => 'Web Development',
                'thumbnail' => 'courses/course-automation.jpg',
                'sections' => [
                    [
                        'title' => 'Automation Fundamentals',
                        'lectures' => [
                            ['title' => 'What is Automation?', 'duration' => 20, 'is_free' => true],
                            ['title' => 'Identifying Repetitive Tasks', 'duration' => 25, 'is_free' => true],
                        ],
                    ],
                    [
                        'title' => 'Zapier Mastery',
                        'lectures' => [
                            ['title' => 'Zapier Basics', 'duration' => 45, 'is_free' => false],
                            ['title' => 'Advanced Workflows', 'duration' => 60, 'is_free' => false],
                        ],
                    ],
                    [
                        'title' => 'AI Tools Integration',
                        'lectures' => [
                            ['title' => 'Introduction to AI APIs', 'duration' => 50, 'is_free' => false],
                            ['title' => 'Building AI Assistants', 'duration' => 75, 'is_free' => false],
                        ],
                    ],
                    [
                        'title' => 'API Automation',
                        'lectures' => [
                            ['title' => 'REST API Fundamentals', 'duration' => 40, 'is_free' => false],
                            ['title' => 'Building Automated Integrations', 'duration' => 65, 'is_free' => false],
                        ],
                    ],
                ],
            ],
            [
                'title' => 'The Scale Framework',
                'short_description' => 'Advanced strategies for hiring, delegation, and geographic expansion.',
                'long_description' => 'Learn the proven framework for scaling businesses from local to global. Covers hiring, delegation, and expansion strategies.',
                'price' => 15000,
                'discount_price' => 12000,
                'level' => 'Advanced',
                'duration' => 600,
                'is_featured' => true,
                'is_published' => true,
                'is_free' => false,
                'category_name' => 'Business & Finance',
                'thumbnail' => 'courses/course-scale.jpg',
                'sections' => [
                    [
                        'title' => 'Foundation of Scaling',
                        'lectures' => [
                            ['title' => 'Scaling Principles', 'duration' => 30, 'is_free' => true],
                            ['title' => 'Organizational Structure', 'duration' => 45, 'is_free' => true],
                        ],
                    ],
                    [
                        'title' => 'Hiring Strategies',
                        'lectures' => [
                            ['title' => 'Finding Top Talent', 'duration' => 55, 'is_free' => false],
                            ['title' => 'Interview Techniques', 'duration' => 40, 'is_free' => false],
                        ],
                    ],
                    [
                        'title' => 'Delegation Mastery',
                        'lectures' => [
                            ['title' => 'Delegation Framework', 'duration' => 50, 'is_free' => false],
                            ['title' => 'Performance Management', 'duration' => 45, 'is_free' => false],
                        ],
                    ],
                ],
            ],
            [
                'title' => 'Web Development Bootcamp',
                'short_description' => 'Build modern web applications with Laravel, Livewire, and Tailwind CSS.',
                'long_description' => 'A comprehensive bootcamp covering modern PHP development with Laravel 11, Livewire 3, and TailwindCSS 3. From zero to full-stack developer.',
                'price' => 8000,
                'discount_price' => null,
                'level' => 'Intermediate',
                'duration' => 480,
                'is_featured' => true,
                'is_published' => true,
                'is_free' => false,
                'category_name' => 'Web Development',
                'thumbnail' => null,
                'sections' => [
                    [
                        'title' => 'Laravel Fundamentals',
                        'lectures' => [
                            ['title' => 'Introduction to Laravel', 'duration' => 25, 'is_free' => true],
                            ['title' => 'Routing and Controllers', 'duration' => 40, 'is_free' => true],
                            ['title' => 'Database Migrations', 'duration' => 35, 'is_free' => true],
                        ],
                    ],
                    [
                        'title' => 'Frontend with Livewire',
                        'lectures' => [
                            ['title' => 'Livewire Basics', 'duration' => 45, 'is_free' => false],
                            ['title' => 'Reactive Components', 'duration' => 55, 'is_free' => false],
                        ],
                    ],
                    [
                        'title' => 'Advanced Topics',
                        'lectures' => [
                            ['title' => 'API Development', 'duration' => 60, 'is_free' => false],
                            ['title' => 'Testing and Deployment', 'duration' => 50, 'is_free' => false],
                        ],
                    ],
                ],
            ],
            [
                'title' => 'Digital Marketing Essentials',
                'short_description' => 'Master social media, SEO, content marketing, and analytics for your business.',
                'long_description' => 'Learn essential digital marketing skills: SEO, social media marketing, content creation, email marketing, and analytics for Bangladeshi businesses.',
                'price' => 0,
                'discount_price' => null,
                'level' => 'Beginner',
                'duration' => 300,
                'is_featured' => false,
                'is_published' => true,
                'is_free' => true,
                'category_name' => 'Digital Marketing',
                'thumbnail' => null,
                'sections' => [
                    [
                        'title' => 'Marketing Fundamentals',
                        'lectures' => [
                            ['title' => 'Introduction to Digital Marketing', 'duration' => 20, 'is_free' => true],
                            ['title' => 'Understanding Your Audience', 'duration' => 25, 'is_free' => true],
                        ],
                    ],
                    [
                        'title' => 'SEO and Content Marketing',
                        'lectures' => [
                            ['title' => 'SEO Basics', 'duration' => 40, 'is_free' => true],
                            ['title' => 'Content Strategy', 'duration' => 35, 'is_free' => true],
                        ],
                    ],
                ],
            ],
            [
                'title' => 'SaaS Product Design',
                'short_description' => 'Design and launch a SaaS product from idea to market fit.',
                'long_description' => 'Learn the complete process of building a SaaS product: from ideation and validation to design, development, and go-to-market strategy.',
                'price' => 10000,
                'discount_price' => 8000,
                'level' => 'Intermediate',
                'duration' => 540,
                'is_featured' => true,
                'is_published' => true,
                'is_free' => false,
                'category_name' => 'Business & Finance',
                'thumbnail' => null,
                'sections' => [
                    [
                        'title' => 'Product Discovery',
                        'lectures' => [
                            ['title' => 'Finding Product-Market Fit', 'duration' => 35, 'is_free' => true],
                            ['title' => 'MVP Design', 'duration' => 45, 'is_free' => true],
                        ],
                    ],
                    [
                        'title' => 'Development Process',
                        'lectures' => [
                            ['title' => 'Tech Stack Selection', 'duration' => 50, 'is_free' => false],
                            ['title' => 'Building the MVP', 'duration' => 65, 'is_free' => false],
                        ],
                    ],
                    [
                        'title' => 'Go to Market',
                        'lectures' => [
                            ['title' => 'Pricing Strategy', 'duration' => 40, 'is_free' => false],
                            ['title' => 'Launch Planning', 'duration' => 35, 'is_free' => false],
                        ],
                    ],
                ],
            ],
        ];

        foreach ($courses as $courseData) {
            $categoryName = $courseData['category_name'];
            $categoryId = $courseCategories[$categoryName] ?? $courseCategories['Business & Finance'];

            $sections = $courseData['sections'];
            unset($courseData['sections'], $courseData['category_name']);
            $courseData['user_id'] = $admin->id;
            $courseData['category_id'] = $categoryId;

            $course = Course::create($courseData);

            foreach ($sections as $sectionOrder => $sectionData) {
                $section = Section::create([
                    'course_id' => $course->id,
                    'title' => $sectionData['title'],
                    'sort_order' => $sectionOrder + 1,
                ]);

                foreach ($sectionData['lectures'] as $lectureOrder => $lectureData) {
                    Lecture::create([
                        'section_id' => $section->id,
                        'title' => $lectureData['title'],
                        'slug' => \Str::slug($lectureData['title']),
                        'duration' => $lectureData['duration'],
                        'sort_order' => $lectureOrder + 1,
                        'is_free' => $lectureData['is_free'],
                        'video_provider' => 'youtube',
                        'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                    ]);
                }
            }
        }
    }
}