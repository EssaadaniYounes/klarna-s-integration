<?php

namespace App\Adapters;
use App\Dtos\OrderUpdatedDto;
use App\Enums\OrderStatus;

class OrderStatusAdapter
{
    public function getStatus(string $status): OrderStatus
    {
        $gateway = config('payment.gateway');
        if (!$gateway) {
            throw new \Exception('Payment gateway not configured');
        }

        if ($gateway == 'klarna') {
            return match ($status) {
                'CHECKOUT_INCOMPLETE' => OrderStatus::PENDING,
                'checkout_complete' => OrderStatus::PAID,
                'checkout_cancelled' => OrderStatus::CANCELLED,
                'checkout_failed' => OrderStatus::FAILED,
                default => throw new \Exception('Invalid Klarna status'),
            };
        }
        //TODO: add other gateways when needed

        return OrderStatus::PENDING;
    }

    public function getOrderUpdated(array $data): OrderUpdatedDto
    {
        $gateway = config('payment.gateway');
        if (!$gateway) {
            throw new \Exception('Payment gateway not configured');
        }

        if ($gateway == 'klarna') {
            return new OrderUpdatedDto(
                $data['order_id'],
                $data['order_lines'][0]['name'],
                $data['order_amount'],
                $data['order_lines'][0]['quantity'],
                $data['shipping_address']['given_name'] . ' ' . $data['shipping_address']['family_name'],
                $data['shipping_address']['email']
            );
        }

        //TODO: add other gateways when needed
        throw new \Exception('Unsupported payment gateway');
    }
}