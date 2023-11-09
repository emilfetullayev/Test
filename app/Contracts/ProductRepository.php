<?php

namespace App\Contracts;


interface ProductRepository
{
    public function getAll();
    public function create(array $data);
    public function update($id, array $data);
    public function getCategories();
    public function find($id);
}
