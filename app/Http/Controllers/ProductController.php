<?php

namespace App\Http\Controllers;

use Domain\Product\Models\Product;

class ProductController extends Controller
{
    public function __invoke(Product $product): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $product->load(['optionValues.option']);

        $also = Product::query()->where(function ($q) use ($product) {
            $q->whereIn('id', session('also') ?: [])
                ->where('id', '!=', $product->id);
        })
            ->get();

        session()->put('also.' . $product->id, $product->id);

        return view('product.show', [
            'product' => $product,
            'options' => $product->optionValues->keyValues(),
            'also' => $also,
        ]);
    }
}
