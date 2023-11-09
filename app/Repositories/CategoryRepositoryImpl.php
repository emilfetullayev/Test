<?php

namespace App\Repositories;

use App\Contracts\CategoryRepository;
use App\Models\Category;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CategoryRepositoryImpl implements CategoryRepository
{
    protected $model;
    protected $categories;

    public function __construct()
    {
        $locale = app()->getLocale();
        $this->model  = new Category();
        $this->categories = Category::whereNotNull('name->' . $locale)
            ->paginate(15);
    }

    public function getAll()
    {
        return $this->categories;
    }


    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        return $this->model->whereId($id)->update($data);
    }
}
