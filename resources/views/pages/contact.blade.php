<x-app-layout>
    <section class="py-20 max-w-4xl mx-auto px-4">
        <h1 class="font-display text-4xl font-bold mb-6">Contact Us</h1>
        <p class="text-muted text-lg mb-10">Have questions? We'd love to hear from you.</p>
        <div class="grid md:grid-cols-2 gap-8">
            <div>
                <form class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-primary mb-1">Name</label>
                        <input type="text" class="w-full rounded-btn border-gray-300 shadow-sm focus:border-accent focus:ring-accent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-primary mb-1">Email</label>
                        <input type="email" class="w-full rounded-btn border-gray-300 shadow-sm focus:border-accent focus:ring-accent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-primary mb-1">Message</label>
                        <textarea rows="4" class="w-full rounded-btn border-gray-300 shadow-sm focus:border-accent focus:ring-accent"></textarea>
                    </div>
                    <button type="submit" class="px-6 py-2.5 bg-accent text-white rounded-btn hover:bg-accent-hover transition font-medium">Send Message</button>
                </form>
            </div>
            <div class="space-y-6">
                <div>
                    <h3 class="font-semibold mb-1">Email</h3>
                    <p class="text-muted">hello@apnarbusiness.com</p>
                </div>
                <div>
                    <h3 class="font-semibold mb-1">Phone</h3>
                    <p class="text-muted">+880 1700 000000</p>
                </div>
                <div>
                    <h3 class="font-semibold mb-1">Address</h3>
                    <p class="text-muted">Dhaka, Bangladesh</p>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
