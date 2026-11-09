<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductsPage;

class ProductsEditController extends Controller
{
    public function index()
    {
        $productsData = ProductsPage::firstOrCreate([], [
            'hero_h1' => '',
            'hero_h2' => '',
            'hero_p' => '',
            'products' => [],
        ]);

        return view('products-edit', [
            'title' => 'Products Page',
            'activePage' => 'products-edit',
            'productsData' => $productsData,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'hero_h1' => 'nullable|string|max:255',
            'hero_h2' => 'nullable|string|max:255',
            'hero_p' => 'nullable|string',
            'products.*.image' => 'nullable|file|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        $page = ProductsPage::firstOrCreate([], []);
        $oldProducts = $page->products ?? [];

        $products = $request->input('products', []);
        $files = $request->file('products', []);

        foreach ($products as $i => $item) {
            $oldImage = $oldProducts[$i]['image'] ?? '';

            if (isset($files[$i]['image']) && $files[$i]['image'] instanceof UploadedFile) {
                if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }
                $products[$i]['image'] = $files[$i]['image']->store('products', 'public');
            } else {
                $products[$i]['image'] = $oldImage;
            }
        }

        $products = collect($products)
            ->map(fn($item) => [
                'name' => trim((string) ($item['name'] ?? '')),
                'category' => trim((string) ($item['category'] ?? '')),
                'description' => trim((string) ($item['description'] ?? '')),
                'image' => $item['image'] ?? '',
                'price' => trim((string) ($item['price'] ?? '')),
                'weight' => trim((string) ($item['weight'] ?? '')),
                'ingredients' => trim((string) ($item['ingredients'] ?? '')),
                'calories' => trim((string) ($item['calories'] ?? '')),
                'protein' => trim((string) ($item['protein'] ?? '')),
                'fat' => trim((string) ($item['fat'] ?? '')),
                'carbs' => trim((string) ($item['carbs'] ?? '')),
                'shelf_life' => trim((string) ($item['shelf_life'] ?? '')),
            ])
            ->filter(fn($item) => $item['name'] !== '' || $item['description'] !== '' || $item['image'] !== '')
            ->values()
            ->all();

        $page->update([
            'hero_h1' => $request->hero_h1,
            'hero_h2' => $request->hero_h2,
            'hero_p' => $request->hero_p,
            'products' => $products,
        ]);

        return back()->with('success', 'Products page updated successfully!');
    }
}
