<?php

namespace App\Contracts\Crud;

interface ICreate
{
    public function create($data): void;
}