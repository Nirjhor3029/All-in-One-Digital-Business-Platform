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

    public function mount(): void
    {
        $settings = Setting::pluck('value', 'key')->toArray();

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
            'site_logo' => $settings['site_logo'] ?? null,
            'site_name' => $settings['site_name'] ?? config('app.name'),
            'footer_description' => $settings['footer_description'] ?? null,
            'footer_email' => $settings['footer_email'] ?? null,
            'footer_phone' => $settings['footer_phone'] ?? null,
            'footer_address' => $settings['footer_address'] ?? null,
            'hero_badge' => $settings['hero_badge'] ?? "Bangladesh's All-in-One Platform",
            'hero_headline_line1' => $settings['hero_headline_line1'] ?? 'শিখুন।',
            'hero_headline_line2' => $settings['hero_headline_line2'] ?? 'বানান।',
            'hero_headline_line3' => $settings['hero_headline_line3'] ?? 'বাড়ান।',
            'hero_subtitle' => $settings['hero_subtitle'] ?? "Bangladesh's first platform where you get premium courses, ready-made SaaS products, and expert support — all in one place.",
            'hero_cta_text' => $settings['hero_cta_text'] ?? 'কোর্স দেখুন',
            'hero_cta_url' => $settings['hero_cta_url'] ?? '/courses',
            'hero_demo_text' => $settings['hero_demo_text'] ?? 'Demo দেখুন',
            'hero_social_proof' => $settings['hero_social_proof'] ?? '2,450+ জন শিখছেন',
            'hero_rating_text' => $settings['hero_rating_text'] ?? '4.9/5',
            'stats' => $stats,
            'social_facebook' => $settings['social_facebook'] ?? null,
            'social_twitter' => $settings['social_twitter'] ?? null,
            'social_linkedin' => $settings['social_linkedin'] ?? null,
            'social_youtube' => $settings['social_youtube'] ?? null,
        ]);
    }

    public function form(Form $form): Form
    {
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
                        TextInput::make('hero_headline_line1')
                            ->label('Headline Line 1')
                            ->required(),
                        TextInput::make('hero_headline_line2')
                            ->label('Headline Line 2')
                            ->required(),
                        TextInput::make('hero_headline_line3')
                            ->label('Headline Line 3')
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
                            ->label('Demo Button Text'),
                        TextInput::make('hero_social_proof')
                            ->label('Social Proof Text')
                            ->helperText('e.g. "2,450+ জন শিখছেন"'),
                        TextInput::make('hero_rating_text')
                            ->label('Rating Text')
                            ->helperText('e.g. "4.9/5"'),
                    ])->columns(2),

                Section::make('Statistics Bar')
                    ->description('Stats shown below the hero section. Add up to 4 items.')
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
                            ->defaultItems(4),
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
            if ($key === 'stats') {
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
        if ($key === 'stats') return 'stats';
        return 'general';
    }
}
