<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Order;
use App\Models\Transaction;
use App\Services\SslCommerzService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function sslSuccess(Request $request): RedirectResponse
    {
        $tranId = $request->tran_id;
        $order = Order::where('order_number', $tranId)->first();

        if (! $order) {
            return redirect()->route('home')->with('error', 'Order not found.');
        }

        $sslCommerz = app(SslCommerzService::class);
        $validation = $sslCommerz->validatePayment($request->all());

        if ($validation) {
            $order->update([
                'payment_status' => 'paid',
                'status' => 'processing',
                'payment_method' => 'sslcommerz',
            ]);

            Transaction::create([
                'order_id' => $order->id,
                'transaction_id' => $request->bank_tran_id ?? $tranId,
                'gateway' => 'sslcommerz',
                'amount' => $order->total,
                'status' => 'success',
                'gateway_response' => $request->all(),
            ]);

            foreach ($order->items as $item) {
                if ($item->itemable_type === 'App\Models\Course') {
                    Enrollment::firstOrCreate([
                        'user_id' => $order->user_id,
                        'course_id' => $item->itemable_id,
                    ], ['status' => 'active']);
                }
            }
        } else {
            $order->update(['payment_status' => 'failed']);

            Transaction::create([
                'order_id' => $order->id,
                'transaction_id' => $tranId,
                'gateway' => 'sslcommerz',
                'amount' => $order->total,
                'status' => 'failed',
                'gateway_response' => $request->all(),
            ]);
        }

        return redirect()->route('checkout.success', $order);
    }

    public function sslFail(Request $request): RedirectResponse
    {
        $order = Order::where('order_number', $request->tran_id)->first();

        if ($order) {
            $order->update(['payment_status' => 'failed']);

            Transaction::create([
                'order_id' => $order->id,
                'transaction_id' => $request->tran_id,
                'gateway' => 'sslcommerz',
                'amount' => $order->total,
                'status' => 'failed',
                'gateway_response' => $request->all(),
            ]);
        }

        return redirect()->route('checkout.failed', $order ?? 0)
            ->with('error', 'Payment was cancelled or failed.');
    }

    public function sslCancel(Request $request): RedirectResponse
    {
        $order = Order::where('order_number', $request->tran_id)->first();

        if ($order) {
            $order->update(['payment_status' => 'failed', 'status' => 'cancelled']);

            Transaction::create([
                'order_id' => $order->id,
                'transaction_id' => $request->tran_id,
                'gateway' => 'sslcommerz',
                'amount' => $order->total,
                'status' => 'cancel',
                'gateway_response' => $request->all(),
            ]);
        }

        return redirect()->route('checkout.failed', $order ?? 0)
            ->with('error', 'Payment was cancelled.');
    }

    public function sslIpn(Request $request): RedirectResponse
    {
        $order = Order::where('order_number', $request->tran_id)->first();

        if (! $order || $order->payment_status === 'paid') {
            return redirect()->route('home');
        }

        $sslCommerz = app(SslCommerzService::class);
        $validated = $sslCommerz->validatePayment($request->all());

        if ($validated && $request->status === 'VALID') {
            $order->update([
                'payment_status' => 'paid',
                'status' => 'processing',
                'payment_method' => 'sslcommerz',
            ]);

            Transaction::updateOrCreate(
                ['transaction_id' => $request->bank_tran_id ?? $request->tran_id],
                [
                    'order_id' => $order->id,
                    'gateway' => 'sslcommerz',
                    'amount' => $order->total,
                    'status' => 'success',
                    'gateway_response' => $request->all(),
                ]
            );

            foreach ($order->items as $item) {
                if ($item->itemable_type === 'App\Models\Course') {
                    Enrollment::firstOrCreate([
                        'user_id' => $order->user_id,
                        'course_id' => $item->itemable_id,
                    ], ['status' => 'active']);
                }
            }
        }

        return redirect()->route('home');
    }
}
