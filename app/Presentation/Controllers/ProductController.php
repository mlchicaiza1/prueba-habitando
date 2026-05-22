<?php

namespace App\Presentation\Controllers;

use App\Application\UseCases\ProductUseCase;
use App\Http\Controllers\Controller;
use App\Presentation\Requests\StoreProductRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductUseCase $useCase
    ) {}

    public function index(Request $request)
    {
        $search = $request->string('search')->toString() ?: null;
        $category = $request->string('category')->toString() ?: null;
        $sortPrice = $request->string('sortPrice')->toString() ?: null;

        $products = $this->useCase->getAll($search, $category, $sortPrice);
        $categories = $this->useCase->getCategories();
        
        return Inertia::render('Products/Index', [
            'products' => $products,
            'categories' => $categories,
            'filters' => [
                'search' => $search,
                'category' => $category,
                'sortPrice' => $sortPrice,
            ]
        ]);
    }

    public function show(int $id)
    {
        $product = $this->useCase->getById($id);

        return Inertia::render('Products/Show', [
            'product' => $product,
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        $product = $this->useCase->create($request->validated());

        return redirect()->route('products.index')
            ->with('message', "Producto '{$product->title}' creado con éxito (Simulado, ID: {$product->id}).");
    }
}
