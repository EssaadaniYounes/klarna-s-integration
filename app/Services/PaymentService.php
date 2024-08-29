<?php

namespace App\Services;
use App\Contracts\Payment\IPaymentGateway;

class PaymentService
{

    public function __construct(
        public IPaymentGateway $paymentGateway,
        public ProductService $productService
    ) {
    }

    public function createOrder($productId, $quantity)
    {
        $product = $this->productService->getById($productId);
        $this->paymentGateway->placeOrder($product, $quantity);
        
    }
}