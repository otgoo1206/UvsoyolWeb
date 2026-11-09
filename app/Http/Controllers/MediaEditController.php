<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\MediaPage;

class MediaEditController extends Controller
{
    public function index()
    {
        $mediaData = MediaPage::firstOrCreate([], [
            'hero_h2' => '',
            'videos' => [],
        ]);

        return view('media-edit', [
            'title' => 'Media Page',
            'activePage' => 'media-edit',
            'mediaData' => $mediaData,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'hero_h2' => 'nullable|string|max:255',
            'videos.*.video' => 'nullable|file|mimes:mp4,webm,mov|max:102400',
            'videos.*.poster' => 'nullable|file|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        $page = MediaPage::firstOrCreate([], []);
        $oldVideos = $page->videos ?? [];

        $videos = $request->input('videos', []);
        $videoFiles = $request->file('videos', []);

        foreach ($videos as $i => $item) {
            $oldVideo = $oldVideos[$i]['video'] ?? '';
            $oldPoster = $oldVideos[$i]['poster'] ?? '';

            if (isset($videoFiles[$i]['video']) && $videoFiles[$i]['video'] instanceof UploadedFile) {
                if ($oldVideo && Storage::disk('public')->exists($oldVideo)) {
                    Storage::disk('public')->delete($oldVideo);
                }
                $videos[$i]['video'] = $videoFiles[$i]['video']->store('media/video', 'public');
            } else {
                $videos[$i]['video'] = $oldVideo;
            }

            if (isset($videoFiles[$i]['poster']) && $videoFiles[$i]['poster'] instanceof UploadedFile) {
                if ($oldPoster && Storage::disk('public')->exists($oldPoster)) {
                    Storage::disk('public')->delete($oldPoster);
                }
                $videos[$i]['poster'] = $videoFiles[$i]['poster']->store('media/poster', 'public');
            } else {
                $videos[$i]['poster'] = $oldPoster;
            }
        }

        $videos = collect($videos)
            ->map(fn($item) => [
                'title' => trim((string) ($item['title'] ?? '')),
                'description' => trim((string) ($item['description'] ?? '')),
                'video' => $item['video'] ?? '',
                'poster' => $item['poster'] ?? '',
            ])
            ->filter(fn($item) => $item['title'] !== '' || $item['video'] !== '' || $item['poster'] !== '')
            ->values()
            ->all();

        $page->update([
            'hero_h2' => $request->hero_h2,
            'videos' => $videos,
        ]);

        return back()->with('success', 'Media page updated successfully!');
    }
}
