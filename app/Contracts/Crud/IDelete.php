<?php

namespace App\Contracts\Crud;

interface IDelete
{
    public function delete($identifier): bool;
}