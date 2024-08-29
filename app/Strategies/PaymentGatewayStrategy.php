<?php

namespace App\Strategies;
use App\Contracts\Payment\IPaymentGateway;
use App\Implementations\PaymentGateways\KlarnaGateway;
use Exception;
use Illuminate\Support\Facades\App;

class PaymentGatewayStrategy
{
    public function getPaymentGateway(): IPaymentGateway
    {
        $gateway = config('payment.gateway');

        if (!$gateway) {
            throw new Exception('Payment gateway not configured');
        }

        switch ($gateway) {
            case 'klarna':
                return App::make(KlarnaGateway::class);
            default:
                throw new Exception("Unsupported payment gateway {$gateway}");
        }
    }
}