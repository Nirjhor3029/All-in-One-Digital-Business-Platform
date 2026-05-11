<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SslCommerzService
{
    protected string $storeId;
    protected string $storePassword;
    protected bool $sandbox;

    public function __construct()
    {
        $this->storeId = config('sslcommerz.store_id');
        $this->storePassword = config('sslcommerz.store_password');
        $this->sandbox = config('sslcommerz.sandbox', true);
    }

    public function isConfigured(): bool
    {
        return ! empty($this->storeId) && ! empty($this->storePassword);
    }

    protected function baseUrl(): string
    {
        return $this->sandbox
            ? 'https://sandbox.sslcommerz.com'
            : 'https://secure.sslcommerz.com';
    }

    public function initiatePayment(Order $order): ?array
    {
        if (! $this->isConfigured()) {
            Log::warning('SSLCommerz not configured — skipping payment initiation.');
            return null;
        }

        $postData = [
            'store_id' => $this->storeId,
            'store_passwd' => $this->storePassword,
            'total_amount' => $order->total,
            'currency' => 'BDT',
            'tran_id' => $order->order_number,
            'success_url' => route('payment.success'),
            'fail_url' => route('payment.fail'),
            'cancel_url' => route('payment.cancel'),
            'ipn_url' => route('payment.ipn'),
            'cus_name' => $order->billing_name,
            'cus_email' => $order->billing_email,
            'cus_phone' => $order->billing_phone,
            'cus_add1' => $order->billing_address,
            'product_name' => 'Order ' . $order->order_number,
            'product_category' => 'Digital',
            'product_profile' => 'general',
            'shipping_method' => 'NO',
            'num_of_item' => $order->items->count(),
        ];

        try {
            $response = Http::timeout(10)->asForm()->post($this->baseUrl() . '/gwprocess/v4/api.php', $postData);

            if ($response->successful()) {
                $data = $response->json();
                Log::info('SSLCommerz initiation response', $data);
                return $data;
            }

            Log::error('SSLCommerz initiation failed', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
        } catch (\Exception $e) {
            Log::error('SSLCommerz initiation exception', [
                'message' => $e->getMessage(),
            ]);
        }

        return null;
    }

    public function validatePayment(array $requestData): bool
    {
        if (! $this->isConfigured()) {
            return ($requestData['status'] ?? '') === 'VALID';
        }

        try {
            $response = Http::timeout(10)->get($this->baseUrl() . '/validator/api/validationserverAPI.php', [
                'val_id' => $requestData['val_id'] ?? '',
                'store_id' => $this->storeId,
                'store_passwd' => $this->storePassword,
                'format' => 'json',
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return ($data['status'] ?? '') === 'VALID';
            }
        } catch (\Exception $e) {
            Log::error('SSLCommerz validation exception', [
                'message' => $e->getMessage(),
            ]);
        }

        return ($requestData['status'] ?? '') === 'VALID';
    }
}
