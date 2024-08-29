<?php

namespace App\Contracts\Order;
use App\Models\Order;

interface IOrderStatus{
    public function update($orderId, $data): Order;
}