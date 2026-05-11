<x-app-layout>
    <section class="py-20 max-w-4xl mx-auto px-4">
        <h1 class="font-display text-4xl font-bold mb-10">FAQ</h1>
        <div class="space-y-6">
            @foreach([
                ['q' => 'What is Apnar Business?', 'a' => 'Apnar Business is an all-in-one digital platform offering courses, software solutions, and business management tools.'],
                ['q' => 'How do I purchase a course?', 'a' => 'Simply register an account, browse our courses, and complete payment via SSLCommerz, bKash, or Nagad.'],
                ['q' => 'Can I get a refund?', 'a' => 'Yes, we offer a 7-day refund policy for most courses if you are not satisfied.'],
                ['q' => 'How do I access my purchased software?', 'a' => 'After purchase, you will get instant access from your dashboard. Setup instructions are included.'],
                ['q' => 'What payment methods are accepted?', 'a' => 'We accept SSLCommerz, bKash, Nagad, and card payments.'],
            ] as $faq)
            <div class="bg-white rounded-card shadow-card p-6">
                <h3 class="font-semibold text-lg mb-2">{{ $faq['q'] }}</h3>
                <p class="text-muted">{{ $faq['a'] }}</p>
            </div>
            @endforeach
        </div>
    </section>
</x-app-layout>
