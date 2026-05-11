<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { font-size: 24px; margin: 0; }
        .header p { color: #666; margin: 5px 0 0; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { padding: 10px 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f5f5f5; font-weight: 600; }
        .totals { margin-top: 20px; text-align: right; }
        .totals p { margin: 5px 0; }
        .totals .grand-total { font-size: 16px; font-weight: bold; }
        .footer { margin-top: 40px; text-align: center; color: #999; font-size: 11px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ config('app.name') }}</h1>
        <p>Invoice #{{ $order->order_number }}</p>
        <p>Date: {{ $order->created_at->format('d M Y, h:i A') }}</p>
    </div>

    <h3>Bill To:</h3>
    <p>{{ $order->billing_name }}<br>
    {{ $order->billing_email }}<br>
    {{ $order->billing_phone }}<br>
    {{ $order->billing_address }}</p>

    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th>Type</th>
                <th style="text-align: right">Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->itemable?->title ?? 'N/A' }}</td>
                <td>{{ class_basename($item->itemable_type) }}</td>
                <td style="text-align: right">${{ number_format($item->price, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totals">
        <p>Subtotal: ${{ number_format($order->subtotal, 2) }}</p>
        @if($order->discount > 0)
            <p>Discount: -${{ number_format($order->discount, 2) }}</p>
        @endif
        <p class="grand-total">Total: ${{ number_format($order->total, 2) }}</p>
        <p>Payment: {{ ucfirst($order->payment_status) }}</p>
    </div>

    <div class="footer">
        <p>Thank you for your purchase!</p>
        <p>{{ config('app.name') }} — {{ config('app.url') }}</p>
    </div>
</body>
</html>
