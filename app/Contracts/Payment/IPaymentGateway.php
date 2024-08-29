<?php

namespace App\Contracts\Payment;
use App\Dtos\CheckoutRequestDto;
use App\Models\Product;

interface IPaymentGateway{
    public function placeOrder(Product $product, int $quantity): mixed;
    public function handleWebhook(array $data): void;
}
