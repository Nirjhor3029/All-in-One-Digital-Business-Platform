<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class SettingsPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $title = 'Site Settings';
    protected static ?string $slug = 'settings';
    protected static string $view = 'filament.pages.settings';

    public array $data = [];

    protected function getMaterialIcons(): array
    {
        return [
            'lightbulb' => 'Lightbulb',
            'edit_note' => 'Edit Note',
            'brush' => 'Brush',
            'language' => 'Language',
            'terminal' => 'Terminal',
            'automation' => 'Automation',
            'trending_up' => 'Trending Up',
            'partner_exchange' => 'Partner Exchange',
            'developer_mode' => 'Developer Mode',
            'smartphone' => 'Smartphone',
            'web' => 'Web',
            'precision_manufacturing' => 'Precision Manufacturing',
            'school' => 'School',
            'inventory_2' => 'Inventory 2',
            'transform' => 'Transform',
            'storefront' => 'Storefront',
            'rocket_launch' => 'Rocket Launch',
            'psychology' => 'Psychology',
            'handshake' => 'Handshake',
            'shield' => 'Shield',
            'verified' => 'Verified',
            'star' => 'Star',
            'check_circle' => 'Check Circle',
            'bolt' => 'Bolt',
            'cloud' => 'Cloud',
            'devices' => 'Devices',
            'analytics' => 'Analytics',
            'support_agent' => 'Support Agent',
            'groups' => 'Groups',
            'public' => 'Public',
            'workspace_premium' => 'Workspace Premium',
        ];
    }

    public function mount(): void
    {
        $settings = Setting::pluck('value', 'key')->toArray();

        $parseJson = function (string $key, array $default = []): array {
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

        $rawStats = json_decode($settings['stats'] ?? '[]', true);
        $stats = is_array($rawStats) && count($rawStats) > 0
            ? array_map(fn($s) => [
                'icon' => $s['icon'] ?? '📚',
                'value' => $s['value'] ?? '',
                'label' => $s['label'] ?? '',
                'sub' => $s['sub'] ?? '',
            ], $rawStats)
            : [
                ['icon' => '📚', 'value' => '50+', 'label' => 'Courses', 'sub' => 'Expert-led'],
                ['icon' => '👥', 'value' => '2,450+', 'label' => 'Students', 'sub' => 'Active learners'],
                ['icon' => '🛠', 'value' => '20+', 'label' => 'Products', 'sub' => 'SaaS solutions'],
                ['icon' => '⭐', 'value' => '4.9/5', 'label' => 'Rating', 'sub' => 'Student reviews'],
            ];

        $this->form->fill([
            // General
            'site_logo' => $settings['site_logo'] ?? null,
            'site_name' => $settings['site_name'] ?? config('app.name'),
            'footer_description' => $settings['footer_description'] ?? null,
            'footer_email' => $settings['footer_email'] ?? null,
            'footer_phone' => $settings['footer_phone'] ?? null,
            'footer_address' => $settings['footer_address'] ?? null,

            // Hero
            'hero_badge' => $settings['hero_badge'] ?? "Bangladesh's All-in-One Platform",
            'hero_headline' => $settings['hero_headline'] ?? 'আপনার ব্যবসা শুরু থেকে Scale পর্যন্ত।',
            'hero_subtitle' => $settings['hero_subtitle'] ?? 'We help businesses launch, automate and grow with technology. Experience precision engineering for the modern entrepreneur.',
            'hero_cta_text' => $settings['hero_cta_text'] ?? 'Start Your Business',
            'hero_cta_url' => $settings['hero_cta_url'] ?? '/courses',
            'hero_demo_text' => $settings['hero_demo_text'] ?? 'Book Consultation',
            'hero_demo_url' => $settings['hero_demo_url'] ?? '/contact',
            'hero_image' => $settings['hero_image'] ?? null,
            'hero_bg_image' => $settings['hero_bg_image'] ?? null,

            // Journey Steps
            'journey_steps' => $parseJson('journey_steps', $defaultJourneySteps),

            // Core Services
            'core_services' => $parseJson('core_services', $defaultCoreServices),

            // SaaS Products
            'saas_products' => $parseJson('saas_products', $defaultSaasProducts),

            // Business Courses
            'business_courses' => $parseJson('business_courses', $defaultBusinessCourses),

            // Why Points
            'why_points' => $parseJson('why_points', $defaultWhyPoints),

            // Success Stories
            'success_stories' => $parseJson('success_stories', $defaultSuccessStories),

            // Roadmap Stages
            'roadmap_stages' => $parseJson('roadmap_stages', $defaultRoadmapStages),

            // Journey Cards
            'journey_cards' => $parseJson('journey_cards', $defaultJourneyCards),

            // Consultation CTA
            'consultation_headline' => $settings['consultation_headline'] ?? 'পরবর্তী ধাপে যেতে প্রস্তুত?',
            'consultation_description' => $settings['consultation_description'] ?? 'আপনার বিজনেস আইডিয়া বা চলমান সমস্যা নিয়ে আমাদের সাথে আলোচনা করুন। আমরা আছি আপনার পাশে।',
            'consultation_cta_text' => $settings['consultation_cta_text'] ?? 'Book Your Free Call',
            'consultation_cta_url' => $settings['consultation_cta_url'] ?? '/register',

            // Stats
            'stats' => $stats,

            // Social Links
            'social_facebook' => $settings['social_facebook'] ?? null,
            'social_twitter' => $settings['social_twitter'] ?? null,
            'social_linkedin' => $settings['social_linkedin'] ?? null,
            'social_youtube' => $settings['social_youtube'] ?? null,
        ]);
    }

    public function form(Form $form): Form
    {
        $materialIcons = $this->getMaterialIcons();

        return $form
            ->schema([
                Section::make('General')
                    ->description('Basic site information and branding.')
                    ->schema([
                        FileUpload::make('site_logo')
                            ->label('Site Logo')
                            ->directory('settings')
                            ->image()
                            ->imageEditor()
                            ->imageCropAspectRatio('1:1')
                            ->maxSize(1024)
                            ->disk('public')
                            ->visibility('public'),
                        TextInput::make('site_name')
                            ->label('Site Name')
                            ->required(),
                        Textarea::make('footer_description')
                            ->label('Footer Description')
                            ->rows(3),
                        TextInput::make('footer_email')
                            ->label('Footer Email')
                            ->email(),
                        TextInput::make('footer_phone')
                            ->label('Footer Phone'),
                        TextInput::make('footer_address')
                            ->label('Footer Address'),
                    ])->columns(2),

                Section::make('Hero Section')
                    ->description('Customize the main hero area of the homepage.')
                    ->schema([
                        TextInput::make('hero_badge')
                            ->label('Badge Text')
                            ->required(),
                        Textarea::make('hero_headline')
                            ->label('Headline')
                            ->rows(2)
                            ->required(),
                        Textarea::make('hero_subtitle')
                            ->label('Subtitle')
                            ->rows(3)
                            ->required(),
                        TextInput::make('hero_cta_text')
                            ->label('Primary CTA Text')
                            ->required(),
                        TextInput::make('hero_cta_url')
                            ->label('Primary CTA URL'),
                        TextInput::make('hero_demo_text')
                            ->label('Secondary CTA Text'),
                        TextInput::make('hero_demo_url')
                            ->label('Secondary CTA URL'),
                        FileUpload::make('hero_image')
                            ->label('Hero Image (Right Side)')
                            ->directory('settings')
                            ->image()
                            ->maxSize(2048)
                            ->disk('public')
                            ->visibility('public'),
                        FileUpload::make('hero_bg_image')
                            ->label('Hero Background Image (Mobile)')
                            ->directory('settings')
                            ->image()
                            ->maxSize(2048)
                            ->disk('public')
                            ->visibility('public'),
                    ])->columns(2),

                Section::make('Business Journey Steps')
                    ->description('7-step journey icons and labels displayed in the process section.')
                    ->schema([
                        Repeater::make('journey_steps')
                            ->label('Steps')
                            ->schema([
                                Select::make('icon')
                                    ->label('Material Icon')
                                    ->options($materialIcons)
                                    ->required()
                                    ->searchable(),
                                TextInput::make('label')
                                    ->label('Step Label')
                                    ->required()
                                    ->maxLength(30),
                            ])
                            ->columns(2)
                            ->minItems(7)
                            ->maxItems(7)
                            ->defaultItems(7)
                            ->reorderableWithButtons(),
                    ]),

                Section::make('Core Services Grid')
                    ->description('8 service cards displayed in the Core Services section.')
                    ->schema([
                        Repeater::make('core_services')
                            ->label('Services')
                            ->schema([
                                Select::make('icon')
                                    ->label('Material Icon')
                                    ->options($materialIcons)
                                    ->required()
                                    ->searchable(),
                                TextInput::make('title')
                                    ->label('Service Title')
                                    ->required()
                                    ->maxLength(60),
                                Textarea::make('description')
                                    ->label('Description')
                                    ->required()
                                    ->rows(2)
                                    ->maxLength(200),
                            ])
                            ->columns(3)
                            ->minItems(8)
                            ->maxItems(8)
                            ->defaultItems(8)
                            ->reorderableWithButtons(),
                    ]),

                Section::make('SaaS Products')
                    ->description('3 proprietary SaaS product cards.')
                    ->schema([
                        Repeater::make('saas_products')
                            ->label('Products')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Product Title')
                                    ->required()
                                    ->maxLength(60),
                                Textarea::make('description')
                                    ->label('Description')
                                    ->required()
                                    ->rows(2)
                                    ->maxLength(250),
                            ])
                            ->columns(2)
                            ->minItems(3)
                            ->maxItems(3)
                            ->defaultItems(3)
                            ->reorderableWithButtons(),
                    ]),

                Section::make('Business Courses')
                    ->description('3 featured course cards with image, modules, and price.')
                    ->schema([
                        Repeater::make('business_courses')
                            ->label('Courses')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Course Title')
                                    ->required()
                                    ->maxLength(80),
                                Textarea::make('description')
                                    ->label('Description')
                                    ->required()
                                    ->rows(2)
                                    ->maxLength(200),
                                FileUpload::make('image')
                                    ->label('Course Image')
                                    ->directory('courses')
                                    ->image()
                                    ->maxSize(2048)
                                    ->disk('public')
                                    ->visibility('public')
                                    ->required(),
                                TextInput::make('modules')
                                    ->label('Modules Count')
                                    ->required()
                                    ->numeric()
                                    ->minValue(1),
                                TextInput::make('price')
                                    ->label('Price (BDT)')
                                    ->required()
                                    ->placeholder('e.g. ৫,০০০'),
                            ])
                            ->columns(3)
                            ->minItems(3)
                            ->maxItems(3)
                            ->defaultItems(3)
                            ->reorderableWithButtons(),
                    ]),

                Section::make('Why Apnar Business')
                    ->description('3 value proposition points.')
                    ->schema([
                        Repeater::make('why_points')
                            ->label('Points')
                            ->schema([
                                TextInput::make('number')
                                    ->label('Number (e.g. 01)')
                                    ->required()
                                    ->maxLength(3),
                                TextInput::make('title')
                                    ->label('Title')
                                    ->required()
                                    ->maxLength(60),
                                Textarea::make('description')
                                    ->label('Description')
                                    ->required()
                                    ->rows(2)
                                    ->maxLength(250),
                            ])
                            ->columns(3)
                            ->minItems(3)
                            ->maxItems(3)
                            ->defaultItems(3)
                            ->reorderableWithButtons(),
                    ]),

                Section::make('Success Stories')
                    ->description('2 client testimonial cards.')
                    ->schema([
                        Repeater::make('success_stories')
                            ->label('Stories')
                            ->schema([
                                Select::make('icon')
                                    ->label('Material Icon')
                                    ->options($materialIcons)
                                    ->required()
                                    ->searchable(),
                                Textarea::make('quote')
                                    ->label('Quote')
                                    ->required()
                                    ->rows(3)
                                    ->maxLength(300),
                                TextInput::make('name')
                                    ->label('Client Name')
                                    ->required()
                                    ->maxLength(60),
                                TextInput::make('role')
                                    ->label('Role & Company')
                                    ->required()
                                    ->maxLength(80),
                            ])
                            ->columns(2)
                            ->minItems(2)
                            ->maxItems(2)
                            ->defaultItems(2)
                            ->reorderableWithButtons(),
                    ]),

                Section::make('Client Roadmap Stages')
                    ->description('8-stage roadmap timeline.')
                    ->schema([
                        Repeater::make('roadmap_stages')
                            ->label('Stages')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Stage Title')
                                    ->required()
                                    ->maxLength(50),
                                TextInput::make('subtitle')
                                    ->label('Subtitle')
                                    ->required()
                                    ->maxLength(50),
                            ])
                            ->columns(2)
                            ->minItems(8)
                            ->maxItems(8)
                            ->defaultItems(8)
                            ->reorderableWithButtons(),
                    ]),

                Section::make('Choose Your Journey (Bento Cards)')
                    ->description('4 journey path cards with image, description, and CTA.')
                    ->schema([
                        Repeater::make('journey_cards')
                            ->label('Journey Cards')
                            ->schema([
                                FileUpload::make('image')
                                    ->label('Card Image')
                                    ->directory('journey')
                                    ->image()
                                    ->maxSize(1024)
                                    ->disk('public')
                                    ->visibility('public')
                                    ->required(),
                                TextInput::make('title')
                                    ->label('Card Title')
                                    ->required()
                                    ->maxLength(60),
                                Textarea::make('description')
                                    ->label('Description')
                                    ->required()
                                    ->rows(2)
                                    ->maxLength(200),
                                TextInput::make('cta_text')
                                    ->label('CTA Button Text')
                                    ->required()
                                    ->maxLength(30),
                                TextInput::make('cta_url')
                                    ->label('CTA URL')
                                    ->required()
                                    ->url(),
                            ])
                            ->columns(2)
                            ->minItems(4)
                            ->maxItems(4)
                            ->defaultItems(4)
                            ->reorderableWithButtons(),
                    ]),

                Section::make('Consultation CTA')
                    ->description('Final CTA banner at the bottom of the homepage.')
                    ->schema([
                        TextInput::make('consultation_headline')
                            ->label('Headline')
                            ->required()
                            ->maxLength(100),
                        Textarea::make('consultation_description')
                            ->label('Description')
                            ->required()
                            ->rows(2)
                            ->maxLength(250),
                        TextInput::make('consultation_cta_text')
                            ->label('Button Text')
                            ->required()
                            ->maxLength(40),
                        TextInput::make('consultation_cta_url')
                            ->label('Button URL')
                            ->required()
                            ->url(),
                    ])->columns(2),

                Section::make('Statistics Bar')
                    ->description('Stats shown below the hero section.')
                    ->schema([
                        Repeater::make('stats')
                            ->label('Statistics')
                            ->schema([
                                Select::make('icon')
                                    ->label('Icon')
                                    ->options([
                                        '📚' => '📚 Books',
                                        '👥' => '👥 People',
                                        '🛠' => '🛠 Tools',
                                        '⭐' => '⭐ Star',
                                        '🎓' => '🎓 Graduation',
                                        '💼' => '💼 Briefcase',
                                        '🌍' => '🌍 Globe',
                                        '📊' => '📊 Chart',
                                        '🏆' => '🏆 Trophy',
                                        '❤️' => '❤️ Heart',
                                        '✅' => '✅ Check',
                                        '🚀' => '🚀 Rocket',
                                    ])
                                    ->required(),
                                TextInput::make('value')
                                    ->label('Value')
                                    ->required()
                                    ->helperText('e.g. 50+, 2,450+'),
                                TextInput::make('label')
                                    ->label('Label')
                                    ->required()
                                    ->helperText('e.g. Courses, Students'),
                                TextInput::make('sub')
                                    ->label('Subtitle')
                                    ->helperText('e.g. Expert-led, Active learners'),
                            ])
                            ->columns(2)
                            ->minItems(1)
                            ->maxItems(8)
                            ->defaultItems(4)
                            ->reorderableWithButtons(),
                    ]),

                Section::make('Social Links')
                    ->description('Social media links displayed in the footer.')
                    ->schema([
                        TextInput::make('social_facebook')
                            ->label('Facebook URL')
                            ->url()
                            ->prefix('facebook.com/'),
                        TextInput::make('social_twitter')
                            ->label('Twitter / X URL')
                            ->url()
                            ->prefix('twitter.com/'),
                        TextInput::make('social_linkedin')
                            ->label('LinkedIn URL')
                            ->url()
                            ->prefix('linkedin.com/'),
                        TextInput::make('social_youtube')
                            ->label('YouTube URL')
                            ->url()
                            ->prefix('youtube.com/'),
                    ])->columns(2),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $state = $this->form->getState();

        foreach ($state as $key => $value) {
            if (in_array($key, [
                'stats',
                'journey_steps',
                'core_services',
                'saas_products',
                'business_courses',
                'why_points',
                'success_stories',
                'roadmap_stages',
                'journey_cards',
            ])) {
                $value = is_array($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : '[]';
            } elseif (is_null($value)) {
                $value = '';
            }

            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'group' => $this->getGroupForKey($key)]
            );
        }

        Notification::make()
            ->title('Settings saved successfully!')
            ->success()
            ->send();
    }

    private function getGroupForKey(string $key): string
    {
        if (str_starts_with($key, 'hero_')) return 'hero';
        if (str_starts_with($key, 'social_')) return 'social';
        if (in_array($key, ['stats', 'journey_steps', 'core_services', 'saas_products', 'business_courses', 'why_points', 'success_stories', 'roadmap_stages', 'journey_cards', 'consultation_headline', 'consultation_description', 'consultation_cta_text', 'consultation_cta_url'])) {
            if (str_starts_with($key, 'consultation_')) return 'cta';
            return 'homepage';
        }
        return 'general';
    }
}