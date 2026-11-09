<?php

namespace App\Http\Controllers;

use App\Models\NewsPage;

class NewsController extends Controller
{
    public function index()
    {
        $page = NewsPage::first();
        $news = $page?->news ?? [];

        return view('news', [
            'title' => 'Өв Соёл ХХК - Мэдээ мэдээлэл',
            'activePage' => 'news',
            'page' => $page,
            'news' => $news,
        ]);
    }

    public function show($id)
    {
        $page = NewsPage::first();
        $news = $page?->news ?? [];

        if (!isset($news[$id])) {
            abort(404);
        }

        $news[$id]['views'] = (int) ($news[$id]['views'] ?? 0) + 1;
        $page->update(['news' => $news]);

        $item = $news[$id];

        $others = collect($news)
            ->filter(fn($n, $i) => $i != $id)
            ->all();

        return view('news-show', [
            'title' => 'Өв Соёл ХХК - ' . ($item['title'] ?? 'Мэдээ'),
            'activePage' => 'news',
            'item' => $item,
            'others' => $others,
        ]);
    }
}
