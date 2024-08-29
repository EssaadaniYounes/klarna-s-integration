<?php

namespace App\Contacts\Crud;

interface IDelete
{
    public function delete($identifier): bool;
}