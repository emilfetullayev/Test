<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ProductHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Repositories\ProductRepositoryImpl;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    protected $productRepository;

    public function __construct(ProductRepositoryImpl $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $products = $this->productRepository->getAll();
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $categories = $this->productRepository->getCategories();
        return view('admin.product.create', compact('categories'));
    }

    public function store(ProductRequest $productRequest)
    {
        try {
            $result = ProductHelper::prepareProductData($productRequest);
            $result = $this->productRepository->create($result);

            if ($result) {
                $result->categories()->attach($productRequest->category_id);
            }

            if ($productRequest->hasFile('images')) {
                $mediaItems = $productRequest->file('images');
                $path = $mediaItems->store('images');
                $result->addMedia(storage_path('app/' . $path))->toMediaCollection('category-cover');
            }

            return redirect()->route('admin.product.index')
                ->with('success', 'Məhsul uğurla əlavə edildi');
        } catch (\Exception $e) {
            return back()->with('error', 'Xəta baş verdi: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $product =  Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.product.edit', compact('product', 'categories'));
    }


    public function update(ProductRequest $productRequest, $id)
    {
        try {
            $productData = ProductHelper::prepareProductData($productRequest);
            $this->productRepository->update($id, $productData);

            $product = $this->productRepository->find($id);

            if ($product) {
                $product->categories()->sync($productRequest->category_id);
            }

            return redirect()->route('admin.product.index', $product)
                ->with('success', 'Vakansya adı uğurla dəyişdirildi');
        } catch (\Exception $e) {
            return back()->with('error', 'Xəta baş verdi: ' . $e->getMessage());
        }
    }
}
