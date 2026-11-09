<?php

namespace App\Http\Controllers;

use App\Models\Index;
use App\Models\NewsPage;
use App\Models\MediaPage;
use App\Models\ProductsPage;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $indexData = Index::firstOrCreate([], []);
        $newsPage = NewsPage::first();
        $mediaPage = MediaPage::first();
        $productsPage = ProductsPage::first();

        return view('index', [
            'title' => 'Өв Соёл ХХК - Нүүр хуудас',
            'activePage' => 'index',
            'indexData' => $indexData,
            'homeNews' => collect($newsPage?->news ?? [])->take(6),
            'homeVideos' => collect($mediaPage?->videos ?? [])->take(3),
            'mediaH2' => $mediaPage?->hero_h2 ?? 'Медиа',
            'homeProducts' => collect($productsPage?->products ?? [])->take(9),
        ]);
    }
}
