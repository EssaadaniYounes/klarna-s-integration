<?php

namespace App\Contracts\Payment;

interface IPaymentInterceptor
{
    public function handle(mixed $data): mixed;
}