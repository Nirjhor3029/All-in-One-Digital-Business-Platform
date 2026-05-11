<table class="w-full text-sm">
    <thead>
        <tr class="border-b border-gray-200">
            <th class="py-2 pr-4 text-left font-medium text-gray-500">Item</th>
            <th class="py-2 pr-4 text-left font-medium text-gray-500">Type</th>
            <th class="py-2 text-right font-medium text-gray-500">Price</th>
        </tr>
    </thead>
    <tbody>
        @php
            $items = $order->items ?? collect();
        @endphp
        @forelse($items as $item)
            @php
                if ($item->itemable_type === 'App\Models\ServicePlan') {
                    $plan = $item->itemable;
                    $service = $plan?->service;
                    $displayTitle = $service ? "{$service->title} — {$plan->name}" : ($plan->name ?? 'Unknown');
                    $displayType = 'Service';
                } else {
                    $displayTitle = $item->itemable?->title ?? 'Unknown';
                    $displayType = class_basename($item->itemable_type);
                }
            @endphp
            <tr class="border-b border-gray-100">
                <td class="py-2.5 pr-4 font-medium">{{ $displayTitle }}</td>
                <td class="py-2.5 pr-4 text-gray-500">{{ $displayType }}</td>
                <td class="py-2.5 text-right">${{ number_format($item->price, 2) }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="py-4 text-center text-gray-400">No items</td>
            </tr>
        @endforelse
    </tbody>
</table>
