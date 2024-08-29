<?php

namespace App\Implementations\PaymentGateways;
use App\Contracts\Payment\IPaymentGateway;
use App\Models\Product;

class KlarnaGateway implements IPaymentGateway
{
    private string $api; // = 'https://api.playground.klarna.com/checkout/v3/orders';
    private string $username;
    private string $password;

    public function __construct(){
        $this->api = config('')
    }

    public function placeOrder(Product $product, int $quantity): array
    {
        $amount = $quantity * $product->price;
        $purchase_country = "US";
        $purchase_currency = "USD";
        $local = "en-US";
        $order_amount = $amount;
        $order_tax_amount = 0;

        //Asserting we have only one product
        $order_lines = [
            [
                'type' => 'physical',
                'name' => $product->name,
                'quantity' => $quantity,
                'unit_price' => $product->price,
                'tax_rate' => 0,
                'total_amount' => $order_amount,
                'total_tax_amount' => $order_tax_amount,
            ]
        ];

        $merchant_urls = [
            'terms' => 'https://dashboard.ngrok.com/get-started/setup/windows#terms',  // Make sure this URL is valid and returns content
            'checkout' => 'https://dashboard.ngrok.com/get-started/setup/windows#checkout?klarna_order_id={checkout.order.id}',  // This should be the checkout page
            'confirmation' => 'https://81fd-196-84-1-34.ngrok-free.app/confirm?klarna_order_id={checkout.order.id}',  // This URL must be valid and accessible
            'push' => 'https://81fd-196-84-1-34.ngrok-free.app/api/v1/handle-webhook?klarna_order_id={checkout.order.id}',  // Try using a stable URL
        ];
        $data = [
            'purchase_country' => $purchase_country,
            'purchase_currency' => $purchase_currency,
            'local' => $local,
            'order_amount' => $order_amount,
            'order_tax_amount' => $order_tax_amount,
            'order_lines' => $order_lines,
            'merchant_urls' => $merchant_urls
        ];
        return [];
    }

    public function handleWebhook(array $data): void
    {
        // TODO: Implement handleWebhook() method.
    }
}