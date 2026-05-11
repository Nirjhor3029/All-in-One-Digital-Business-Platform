<div>
    <div class="flex flex-col lg:flex-row gap-6">
        <div class="lg:w-64 shrink-0">
            <div class="bg-white rounded-card shadow-card p-5 space-y-5">
                <div>
                    <label class="block text-sm font-medium text-primary mb-1.5">Search</label>
                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search courses..."
                           class="w-full rounded-btn border-gray-300 text-sm focus:border-accent focus:ring-accent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-primary mb-1.5">Category</label>
                    <div class="space-y-2 max-h-56 overflow-y-auto pr-1">
                        @foreach($categories as $category)
                        <label class="flex items-center gap-2 text-sm">
                            <input type="checkbox" wire:model.live="selectedCategories" value="{{ $category->id }}"
                                   class="rounded border-gray-300 text-accent focus:ring-accent">
                            {{ $category->name }}
                        </label>
                        @endforeach
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-primary mb-1.5">Level</label>
                    <div class="space-y-2">
                        @foreach(['beginner' => 'Beginner', 'intermediate' => 'Intermediate', 'advanced' => 'Advanced', 'all' => 'All Levels'] as $value => $label)
                        <label class="flex items-center gap-2 text-sm">
                            <input type="checkbox" wire:model.live="selectedLevels" value="{{ $value }}"
                                   class="rounded border-gray-300 text-accent focus:ring-accent">
                            {{ $label }}
                        </label>
                        @endforeach
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-primary mb-1.5">Price</label>
                    <div class="space-y-2">
                        <label class="flex items-center gap-2 text-sm">
                            <input type="radio" wire:model.live="priceRange" value="all" name="priceRange"
                                   class="border-gray-300 text-accent focus:ring-accent">
                            All
                        </label>
                        <label class="flex items-center gap-2 text-sm">
                            <input type="radio" wire:model.live="priceRange" value="free" name="priceRange"
                                   class="border-gray-300 text-accent focus:ring-accent">
                            Free
                        </label>
                        <label class="flex items-center gap-2 text-sm">
                            <input type="radio" wire:model.live="priceRange" value="paid" name="priceRange"
                                   class="border-gray-300 text-accent focus:ring-accent">
                            Paid
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-1 min-w-0">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-muted">{{ $courses->total() }} courses found</p>
                <select wire:model.live="sortBy" class="text-sm rounded-btn border-gray-300 focus:border-accent focus:ring-accent">
                    <option value="newest">Newest</option>
                    <option value="popular">Most Popular</option>
                    <option value="price_asc">Price: Low to High</option>
                    <option value="price_desc">Price: High to Low</option>
                </select>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($courses as $courseItem)
                    <x-course-card :course="$courseItem" />
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-muted">No courses found matching your criteria.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $courses->links() }}
            </div>
        </div>
    </div>
</div>
