<style>
    .fi-rm-content {
        transition: opacity 300ms ease, filter 300ms ease;
    }

    .fi-rm-content.fi-rm-loading {
        opacity: 0.5;
        filter: blur(2px);
    }
</style>

<x-filament-panels::page
    @class([
        'fi-resource-view-record-page',
        'fi-resource-' . str_replace('/', '-', $this->getResource()::getSlug()),
        'fi-resource-record-' . $record->getKey(),
    ])
>
    @php
        $relationManagers = $this->getRelationManagers();
        $hasCombinedRelationManagerTabsWithContent = $this->hasCombinedRelationManagerTabsWithContent();
        $activeManager = strval($this->activeRelationManager ?? array_key_first($relationManagers));

        if (! array_key_exists($activeManager, $relationManagers)) {
            $activeManager = strval(array_key_first($relationManagers));
        }
    @endphp

    @if ((! $hasCombinedRelationManagerTabsWithContent) || (! count($relationManagers)))
        @if ($this->hasInfolist())
            {{ $this->infolist }}
        @else
            <div
                wire:key="{{ $this->getId() }}.forms.{{ $this->getFormStatePath() }}"
            >
                {{ $this->form }}
            </div>
        @endif
    @endif

    @if (count($relationManagers))
        <div class="flex flex-col gap-y-6">
            <x-filament::tabs>
                @foreach ($relationManagers as $tabKey => $manager)
                    @php
                        $tabKey = strval($tabKey);
                    @endphp

                    <x-filament::tabs.item
                        :active="$activeManager === $tabKey"
                        :badge="$manager::getBadge($record, static::class)"
                        :badge-color="$manager::getBadgeColor($record, static::class)"
                        :badge-tooltip="$manager::getBadgeTooltip($record, static::class)"
                        :icon="$manager::getIcon($record, static::class)"
                        :icon-position="$manager::getIconPosition($record, static::class)"
                        :wire:click="'$set(\'activeRelationManager\', ' . '\'' . $tabKey . '\')'"
                    >
                        {{ $manager::getTitle($record, static::class) }}
                    </x-filament::tabs.item>
                @endforeach
            </x-filament::tabs>

            @php
                $manager = $relationManagers[$activeManager];
            @endphp

            <div class="relative">
                <div
                    wire:key="{{ $this->getId() }}.relation-managers.active"
                    wire:loading.class="fi-rm-loading"
                    wire:target="activeRelationManager"
                    class="fi-rm-content flex flex-col gap-y-4"
                >
                    @livewire(
                        $manager,
                        [
                            'ownerRecord' => $record,
                            'pageClass' => static::class,
                            ...$manager::getDefaultProperties(),
                        ],
                        key($manager),
                    )
                </div>

                <div
                    wire:loading
                    wire:target="activeRelationManager"
                    class="pointer-events-none absolute inset-0 z-10 flex items-center justify-center"
                >
                    <x-filament::loading-indicator class="h-9 w-9 text-primary-600 dark:text-primary-400" />
                </div>
            </div>
        </div>
    @endif
</x-filament-panels::page>
