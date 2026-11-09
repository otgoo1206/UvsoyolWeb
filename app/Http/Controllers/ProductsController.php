<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductsPage;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $page = ProductsPage::first();
        $products = $page?->products ?? [];

        $categories = collect($products)
            ->pluck('category')
            ->filter()
            ->unique()
            ->values()
            ->all();

        $query = trim((string) $request->query('q', ''));

        if ($query !== '') {
            $needle = mb_strtolower($query);
            $products = array_filter($products, function ($product) use ($needle) {
                return str_contains(mb_strtolower($product['name'] ?? ''), $needle)
                    || str_contains(mb_strtolower($product['description'] ?? ''), $needle);
            });
        }

        return view('products', [
            'title' => 'Өв Соёл ХХК - Бүтээгдэхүүн',
            'activePage' => 'products',
            'page' => $page,
            'products' => $products,
            'categories' => $categories,
            'searchQuery' => $query,
        ]);
    }

    public function show($id)
    {
        $page = ProductsPage::first();
        $products = $page?->products ?? [];

        if (!isset($products[$id])) {
            abort(404);
        }

        $product = $products[$id];

        $related = collect($products)
            ->filter(fn($p, $i) => $i != $id && ($p['category'] ?? null) === ($product['category'] ?? null))
            ->take(4)
            ->all();

        if (empty($related)) {
            $related = collect($products)
                ->filter(fn($p, $i) => $i != $id)
                ->take(4)
                ->all();
        }

        return view('products-show', [
            'title' => 'Өв Соёл ХХК - ' . ($product['name'] ?? 'Бүтээгдэхүүн'),
            'activePage' => 'products',
            'product' => $product,
            'related' => $related,
        ]);
    }
}
