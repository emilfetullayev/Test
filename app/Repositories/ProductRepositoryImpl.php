<?php

namespace App\Repositories;

use App\Contracts\ProductRepository;
use App\Models\Category;
use App\Models\Product;

class ProductRepositoryImpl implements ProductRepository
{
    protected $products;
    protected $categories;
    protected $productModel;

    public function __construct(Product $productModel)
    {
        $this->products = Product::whereNotNull('title->' . app()->getLocale())->get();
        $this->categories = Category::all();
        $this->productModel = $productModel;
    }

    public function getAll()
    {
        return $this->products;
    }

    public function getCategories()
    {
        return $this->categories;
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function update($id, array $data)
    {
        return $this->productModel->whereId($id)->update($data);
    }

    public function find($id)
    {
        return $this->productModel->find($id);
    }
}
