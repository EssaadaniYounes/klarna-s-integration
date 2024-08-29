<?php

namespace App\Contracts\Crud;

interface IUpdate
{
    public function update($identifier, $data): bool;
}