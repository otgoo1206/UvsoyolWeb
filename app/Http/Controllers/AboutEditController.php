<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\About;

class AboutEditController extends Controller
{
    public function index()
    {
        $tentangData = About::all()->keyBy('key');

        return view('about-edit', [
            'title' => 'About Page',
            'activePage' => 'about-edit',
            'tentangData' => $tentangData
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'hero_image' => 'nullable|file|image|mimes:jpg,jpeg,png,webp|max:10240',
            'hero_video' => 'nullable|file|mimes:mp4,webm,mov|max:102400',
            'timeline.*.image' => 'nullable|file|image|mimes:jpg,jpeg,png,webp|max:10240',
            'gallery.*.image' => 'nullable|file|image|mimes:jpg,jpeg,png,webp|max:10240',
            'video_poster' => 'nullable|file|image|mimes:jpg,jpeg,png,webp|max:10240',
            'video_file' => 'nullable|file|mimes:mp4,webm,mov|max:102400',
            'page_background' => 'nullable|file|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        $oldHero = About::where('key', 'hero_section')->first()?->value ?? [];
        $oldTimeline = About::where('key', 'timeline')->first()?->value ?? [];
        $oldGallery = About::where('key', 'gallery')->first()?->value ?? [];
        $oldVideoSection = About::where('key', 'video_section')->first()?->value ?? [];
        $oldPageBackground = About::where('key', 'page_background')->first()?->value ?? [];

        // --- HERO SECTION ---
        $heroImage = $oldHero['image'] ?? '';
        if ($request->hasFile('hero_image')) {
            $heroImage = $this->storeReplacing($request->file('hero_image'), 'about/hero', $heroImage);
        }

        $heroVideo = $oldHero['video'] ?? '';
        if ($request->hasFile('hero_video')) {
            $heroVideo = $this->storeReplacing($request->file('hero_video'), 'about/hero', $heroVideo);
        }

        About::updateOrCreate(
            ['key' => 'hero_section'],
            ['value' => [
                'title' => $request->hero_title,
                'subtitle' => $request->hero_subtitle,
                'description' => $request->hero_description,
                'image' => $heroImage,
                'video' => $heroVideo,
            ]]
        );

        // --- SKILLS ---
        About::updateOrCreate(
            ['key' => 'skills'],
            ['value' => $this->cleanList($request->input('skills', []), ['name', 'percentage'])]
        );

        // --- COUNTERS ---
        About::updateOrCreate(
            ['key' => 'counters'],
            ['value' => $this->cleanList($request->input('counters', []), ['title', 'value'])]
        );

        // --- TIMELINE ---
        $timeline = $request->input('timeline', []);
        $timelineFiles = $request->file('timeline', []);
        foreach ($timeline as $i => $item) {
            $oldImage = $oldTimeline[$i]['image'] ?? '';
            if (isset($timelineFiles[$i]['image']) && $timelineFiles[$i]['image'] instanceof UploadedFile) {
                $timeline[$i]['image'] = $this->storeReplacing($timelineFiles[$i]['image'], 'about/timeline', $oldImage);
            } else {
                $timeline[$i]['image'] = $oldImage;
            }
        }
        About::updateOrCreate(
            ['key' => 'timeline'],
            ['value' => $this->cleanList($timeline, ['year', 'title', 'description', 'image'])]
        );

        // --- GALLERY ---
        $gallery = $request->input('gallery', []);
        $galleryFiles = $request->file('gallery', []);
        foreach ($gallery as $i => $item) {
            $oldImage = $oldGallery[$i]['image'] ?? '';
            if (isset($galleryFiles[$i]['image']) && $galleryFiles[$i]['image'] instanceof UploadedFile) {
                $gallery[$i]['image'] = $this->storeReplacing($galleryFiles[$i]['image'], 'about/gallery', $oldImage);
            } else {
                $gallery[$i]['image'] = $oldImage;
            }
        }
        About::updateOrCreate(
            ['key' => 'gallery'],
            ['value' => $this->cleanList($gallery, ['image', 'caption'])]
        );

        // --- VIDEO SECTION ---
        $videoPoster = $oldVideoSection['poster'] ?? '';
        if ($request->hasFile('video_poster')) {
            $videoPoster = $this->storeReplacing($request->file('video_poster'), 'about/video', $videoPoster);
        }

        $videoFile = $oldVideoSection['video'] ?? '';
        if ($request->hasFile('video_file')) {
            $videoFile = $this->storeReplacing($request->file('video_file'), 'about/video', $videoFile);
        }

        About::updateOrCreate(
            ['key' => 'video_section'],
            ['value' => [
                'title' => $request->video_title,
                'description' => $request->video_description,
                'video' => $videoFile,
                'poster' => $videoPoster,
            ]]
        );

        // --- PAGE BACKGROUND ---
        $pageBackground = $oldPageBackground['image'] ?? '';
        if ($request->hasFile('page_background')) {
            $pageBackground = $this->storeReplacing($request->file('page_background'), 'about/background', $pageBackground);
        }

        About::updateOrCreate(
            ['key' => 'page_background'],
            ['value' => ['image' => $pageBackground]]
        );

        return back()->with('success', 'Page updated successfully!');
    }

    /**
     * Store a new upload, delete the previous file if it lived on the
     * public disk, and return the new stored path.
     */
    private function storeReplacing(UploadedFile $file, string $folder, ?string $oldPath): string
    {
        if ($oldPath && Storage::disk('public')->exists($oldPath)) {
            Storage::disk('public')->delete($oldPath);
        }

        return $file->store($folder, 'public');
    }

    /**
     * Trim each item to the given fields and drop entries that are
     * entirely empty (no text and no stored file).
     */
    private function cleanList(array $items, array $fields): array
    {
        return collect($items)
            ->map(fn($item) => collect($fields)->mapWithKeys(fn($f) => [$f => trim((string) ($item[$f] ?? ''))])->all())
            ->filter(fn($item) => collect($item)->some(fn($v) => $v !== ''))
            ->values()
            ->all();
    }
}
