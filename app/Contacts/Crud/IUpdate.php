<?php

namespace App\Contacts\Crud;

interface IUpdate
{
    public function update($identifier, $data): bool;
}