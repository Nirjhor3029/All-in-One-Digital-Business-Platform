<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Service;
use App\Models\ServicePlan;
use App\Models\User;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@apnarbusiness.com')->first();
        $serviceCategories = Category::where('type', 'service')->pluck('id', 'name');

        $services = [
            [
                'title' => 'Coaching Management System',
                'short_description' => 'Complete coaching management with student tracking, batch scheduling, and performance analytics.',
                'long_description' => 'A comprehensive coaching management system that handles student enrollment, batch scheduling, attendance tracking, exam management, and performance analytics. Perfect for coaching centers of all sizes.',
                'starting_price' => 3000,
                'delivery_time' => '2-3 weeks',
                'is_featured' => true,
                'is_published' => true,
                'category_name' => 'Coaching Management',
                'plans' => [
                    [
                        'name' => 'Starter',
                        'description' => 'Perfect for small coaching centers',
                        'price' => 3000,
                        'features' => ['Up to 100 students', '1 Branch', 'Basic reports', 'Email support'],
                        'is_popular' => false,
                    ],
                    [
                        'name' => 'Professional',
                        'description' => 'Ideal for growing coaching businesses',
                        'price' => 5000,
                        'features' => ['Up to 500 students', 'Up to 3 branches', 'Advanced reports', 'Priority support', 'Mobile app'],
                        'is_popular' => true,
                    ],
                    [
                        'name' => 'Enterprise',
                        'description' => 'Full-featured solution for large organizations',
                        'price' => 10000,
                        'features' => ['Unlimited students', 'Unlimited branches', 'Custom reports', '24/7 support', 'Mobile app', 'API access'],
                        'is_popular' => false,
                    ],
                ],
            ],
            [
                'title' => 'School ERP System',
                'short_description' => 'All-in-one school management solution with admissions, attendance, and exam management.',
                'long_description' => 'A complete school management system covering admissions, student records, attendance tracking, exam management, grade books, parent communication, and fee collection. Streamline all school operations with one integrated platform.',
                'starting_price' => 5000,
                'delivery_time' => '3-4 weeks',
                'is_featured' => true,
                'is_published' => true,
                'category_name' => 'School Management',
                'plans' => [
                    [
                        'name' => 'Basic',
                        'description' => 'For small schools',
                        'price' => 5000,
                        'features' => ['Up to 200 students', 'Admissions', 'Attendance', 'Grades'],
                        'is_popular' => false,
                    ],
                    [
                        'name' => 'Premium',
                        'description' => 'For medium schools',
                        'price' => 8000,
                        'features' => ['Up to 1000 students', 'All Basic features', 'Exam management', 'Parent portal', 'Fee management', 'SMS notifications'],
                        'is_popular' => true,
                    ],
                ],
            ],
            [
                'title' => 'SMS Automation Platform',
                'short_description' => 'Send bulk SMS campaigns with scheduling, templates, and analytics.',
                'long_description' => 'A powerful SMS automation platform that lets you send bulk SMS campaigns, schedule messages, use templates, and analyze delivery reports. Perfect for marketing, alerts, and notifications.',
                'starting_price' => 1500,
                'delivery_time' => '1 week',
                'is_featured' => false,
                'is_published' => true,
                'category_name' => 'Business Automation',
                'plans' => [
                    [
                        'name' => 'Starter',
                        'description' => 'Up to 500 SMS/day',
                        'price' => 1500,
                        'features' => ['500 SMS/day', '10 templates', 'Basic analytics', 'Email support'],
                        'is_popular' => false,
                        'is_subscription' => true,
                        'billing_interval' => 'monthly',
                    ],
                    [
                        'name' => 'Business',
                        'description' => 'Up to 2000 SMS/day',
                        'price' => 3500,
                        'features' => ['2000 SMS/day', '50 templates', 'Advanced analytics', 'Priority support', 'API access'],
                        'is_popular' => true,
                        'is_subscription' => true,
                        'billing_interval' => 'monthly',
                    ],
                    [
                        'name' => 'Enterprise',
                        'description' => 'Unlimited SMS',
                        'price' => 8000,
                        'features' => ['Unlimited SMS', 'Unlimited templates', 'Full analytics', '24/7 support', 'API access', 'Custom integrations'],
                        'is_popular' => false,
                        'is_subscription' => true,
                        'billing_interval' => 'monthly',
                    ],
                ],
            ],
            [
                'title' => 'Inventory ERP',
                'short_description' => 'Warehouse and inventory management with barcode scanning and real-time tracking.',
                'long_description' => 'A complete inventory management system with barcode scanning, warehouse management, purchase order tracking, supplier management, and real-time stock dashboards. Designed for Bangladeshi retail businesses.',
                'starting_price' => 4000,
                'delivery_time' => '2-3 weeks',
                'is_featured' => false,
                'is_published' => true,
                'category_name' => 'Business Automation',
                'plans' => [
                    [
                        'name' => 'Standard',
                        'description' => 'For small warehouses',
                        'price' => 4000,
                        'features' => ['Up to 500 products', '1 warehouse', 'Barcode scanning', 'Basic reports'],
                        'is_popular' => false,
                    ],
                    [
                        'name' => 'Professional',
                        'description' => 'For medium businesses',
                        'price' => 7000,
                        'features' => ['Up to 5000 products', 'Up to 3 warehouses', 'Barcode scanning', 'Advanced reports', 'Supplier management', 'Purchase orders'],
                        'is_popular' => true,
                    ],
                ],
            ],
            [
                'title' => 'E-commerce Website Builder',
                'short_description' => 'Build and manage your online store with payment integration and inventory sync.',
                'long_description' => 'A complete e-commerce solution that lets you build and manage your online store with SSLCommerz payment integration, inventory management, shipping tracking, and customer management. Ready for the Bangladeshi market.',
                'starting_price' => 6000,
                'delivery_time' => '3-4 weeks',
                'is_featured' => true,
                'is_published' => true,
                'category_name' => 'Technology',
                'plans' => [
                    [
                        'name' => 'Starter',
                        'description' => 'Up to 50 products',
                        'price' => 6000,
                        'features' => ['50 products', 'SSLCommerz', 'Basic template', 'Mobile responsive'],
                        'is_popular' => false,
                    ],
                    [
                        'name' => 'Growth',
                        'description' => 'Up to 500 products',
                        'price' => 10000,
                        'features' => ['500 products', 'SSLCommerz', '5 templates', 'Mobile responsive', 'SEO tools', 'Email marketing'],
                        'is_popular' => true,
                    ],
                    [
                        'name' => 'Scale',
                        'description' => 'Unlimited products',
                        'price' => 20000,
                        'features' => ['Unlimited products', 'SSLCommerz', 'All templates', 'Mobile responsive', 'SEO tools', 'Email marketing', 'Affiliate program'],
                        'is_popular' => false,
                    ],
                ],
            ],
        ];

        foreach ($services as $serviceData) {
            $categoryName = $serviceData['category_name'];
            $categoryId = $serviceCategories[$categoryName] ?? $serviceCategories['Coaching Management'];

            $plans = $serviceData['plans'];
            unset($serviceData['plans'], $serviceData['category_name']);

            $service = Service::create(array_merge($serviceData, [
                'user_id' => $admin->id,
                'category_id' => $categoryId,
                'meta_title' => $serviceData['title'],
                'meta_description' => $serviceData['short_description'],
            ]));

            foreach ($plans as $planOrder => $planData) {
                $features = $planData['features'];
                unset($planData['features']);

                ServicePlan::create(array_merge($planData, [
                    'service_id' => $service->id,
                    'slug' => \Str::slug($service->title . '-' . $planData['name']),
                    'sort_order' => $planOrder + 1,
                ]));
            }
        }
    }
}