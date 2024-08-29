<?php

namespace App\Contracts\Crud;

use Illuminate\Database\Eloquent\Model;

interface IRead
{
    public function getAll(): array;

    public function getById($identifier): Model;
}