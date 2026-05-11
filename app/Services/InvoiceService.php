<?php

namespace App\Services;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceService
{
    public function generate(Order $order): \Barryvdh\DomPDF\PDF
    {
        $order->load(['items.itemable', 'user']);

        $pdf = Pdf::loadView('invoices.order', [
            'order' => $order,
        ]);

        return $pdf;
    }

    public function download(Order $order)
    {
        return $this->generate($order)->download(
            'invoice-' . $order->order_number . '.pdf'
        );
    }

    public function stream(Order $order)
    {
        return $this->generate($order)->stream();
    }
}
