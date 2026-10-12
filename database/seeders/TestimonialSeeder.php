<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Rahat Chowdhury',
                'role' => 'Owner',
                'company' => 'Chowdhury Coaching Center',
                'quote' => "We moved our entire admissions and batch tracking to the Coaching Management System. What used to take a full day of spreadsheet work now takes an hour.",
                'avatar_color' => '#6366F1',
                'rating' => 5,
                'sort_order' => 1,
            ],
            [
                'name' => 'Sarah Islam',
                'role' => 'Founder',
                'company' => 'EduNext BD',
                'quote' => "The Automation Masterclass course gave our small team a clear playbook for automating customer follow-ups. We applied it the same week we finished it.",
                'avatar_color' => '#EC4899',
                'rating' => 5,
                'sort_order' => 2,
            ],
            [
                'name' => 'Tanvir Ahmed',
                'role' => 'Operations Lead',
                'company' => 'RetailFlow',
                'quote' => "SMS Automation Platform replaced three separate tools we were paying for. Delivery reports and scheduling just work, and support actually responds.",
                'avatar_color' => '#22D3EE',
                'rating' => 4,
                'sort_order' => 3,
            ],
        ];

        foreach ($testimonials as $data) {
            Testimonial::create($data);
        }
    }
}
