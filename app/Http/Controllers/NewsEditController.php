<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\NewsPage;

class NewsEditController extends Controller
{
    public function index()
    {
        $newsData = NewsPage::firstOrCreate([], [
            'hero_h1' => '',
            'hero_h2' => '',
            'hero_p' => '',
            'news' => [],
        ]);

        return view('news-edit', [
            'title' => 'News Page',
            'activePage' => 'news-edit',
            'newsData' => $newsData,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'hero_h1' => 'nullable|string|max:255',
            'hero_h2' => 'nullable|string|max:255',
            'hero_p' => 'nullable|string',
            'hero_image' => 'nullable|file|image|mimes:jpg,jpeg,png,webp|max:10240',
            'news.*.image' => 'nullable|file|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        $page = NewsPage::firstOrCreate([], []);
        $oldNews = $page->news ?? [];

        $heroImage = $page->hero_image ?? '';
        if ($request->hasFile('hero_image')) {
            if ($heroImage && Storage::disk('public')->exists($heroImage)) {
                Storage::disk('public')->delete($heroImage);
            }
            $heroImage = $request->file('hero_image')->store('news', 'public');
        }

        $news = $request->input('news', []);
        $files = $request->file('news', []);

        foreach ($news as $i => $item) {
            $oldImage = $oldNews[$i]['image'] ?? '';
            $news[$i]['views'] = $oldNews[$i]['views'] ?? 0;

            if (isset($files[$i]['image']) && $files[$i]['image'] instanceof UploadedFile) {
                if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }
                $news[$i]['image'] = $files[$i]['image']->store('news', 'public');
            } else {
                $news[$i]['image'] = $oldImage;
            }
        }

        $news = collect($news)
            ->map(fn($item) => [
                'title' => trim((string) ($item['title'] ?? '')),
                'description' => trim((string) ($item['description'] ?? '')),
                'content' => trim((string) ($item['content'] ?? '')),
                'date' => trim((string) ($item['date'] ?? '')),
                'image' => $item['image'] ?? '',
                'views' => (int) ($item['views'] ?? 0),
            ])
            ->filter(fn($item) => $item['title'] !== '' || $item['description'] !== '' || $item['image'] !== '')
            ->values()
            ->all();

        $page->update([
            'hero_h1' => $request->hero_h1,
            'hero_h2' => $request->hero_h2,
            'hero_p' => $request->hero_p,
            'hero_image' => $heroImage,
            'news' => $news,
        ]);

        return back()->with('success', 'News page updated successfully!');
    }
}
