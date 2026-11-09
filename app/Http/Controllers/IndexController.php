<?php

namespace App\Http\Controllers;

use App\Models\Index;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class IndexController extends Controller
{
    public function index()
    {
        $indexData = Index::firstOrCreate([], [
            // ...default initialization as before...
        ]);

        return view('index-edit', [
            'title' => 'Нүүр хуудас',
            'activePage' => 'index-edit',
            'indexData' => $indexData
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'main_video' => 'nullable|file|mimes:mp4,webm,mov|max:102400',

            'sec6_cards' => 'nullable|array',
            'sec6_cards.*.h3' => 'nullable|string|max:255',
            'sec6_cards.*.p' => 'nullable|string',
            'sec6_cards.*.img' => 'nullable|file|image|mimes:jpg,jpeg,png,webp|max:10240',

            'sec7_cards' => 'nullable|array',
            'sec7_cards.*.feedback' => 'nullable|string',
            'sec7_cards.*.profile' => 'nullable|file|image|mimes:jpg,jpeg,png,webp|max:10240',
            'sec7_cards.*.name' => 'nullable|string|max:255',
        ]);

        $index = Index::firstOrCreate([], []);

        // Plain text/link fields — pulled directly since request->validate()
        // above only returns the two card rule sets, not these.
        $textFields = $request->only([
            'main_h1', 'main_h2', 'main_p', 'main_button_text', 'main_button_link',
            'sec2_h2', 'sec2_p',
            'sec3_h2', 'sec3_p', 'sec3_button_text', 'sec3_button_link', 'sec3_video_link',
            'sec4_h2', 'sec4_p', 'sec4_button_text', 'sec4_button_link',
            'sec6_h2', 'sec6_p',
            'sec7_h2', 'sec7_p', 'sec7_button_text',
            'sec8_h2',
        ]);

        // --- HANDLE MAIN HERO VIDEO
        $mainVideo = $index->main_video ?? '';
        if ($request->hasFile('main_video')) {
            if ($mainVideo && Storage::disk('public')->exists($mainVideo)) {
                Storage::disk('public')->delete($mainVideo);
            }
            $mainVideo = $request->file('main_video')->store('hero', 'public');
        }

        // --- HANDLE SEC4 (sudah ada)
        $sec4_cards = $request->input('sec4_cards', []);
        $sec4_files = $request->file('sec4_cards', []);
        if (is_array($sec4_cards)) {
            foreach ($sec4_cards as $i => $card) {
                if (isset($sec4_files[$i]['image']) && $sec4_files[$i]['image'] instanceof UploadedFile) {
                    $oldPath = $index->sec4_cards[$i]['image'] ?? null;
                    if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                        Storage::disk('public')->delete($oldPath);
                    }
                    $path = $sec4_files[$i]['image']->store('cards/sec4', 'public');
                    $sec4_cards[$i]['image'] = $path;
                } else {
                    $sec4_cards[$i]['image'] = $index->sec4_cards[$i]['image'] ?? '';
                }
            }
        }

        // --- HANDLE SEC6 (gambar img)
        $sec6_cards = $request->input('sec6_cards', []);
        $sec6_files = $request->file('sec6_cards', []);
        if (is_array($sec6_cards)) {
            foreach ($sec6_cards as $i => $card) {
                if (isset($sec6_files[$i]['img']) && $sec6_files[$i]['img'] instanceof UploadedFile) {
                    $oldPath = $index->sec6_cards[$i]['img'] ?? null;
                    if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                        Storage::disk('public')->delete($oldPath);
                    }
                    $path = $sec6_files[$i]['img']->store('cards/sec6', 'public');
                    $sec6_cards[$i]['img'] = $path;
                } else {
                    $sec6_cards[$i]['img'] = $index->sec6_cards[$i]['img'] ?? '';
                }
            }
        }

        // --- HANDLE SEC7 (foto profile)
        $sec7_cards = $request->input('sec7_cards', []);
        $sec7_files = $request->file('sec7_cards', []);
        if (is_array($sec7_cards)) {
            foreach ($sec7_cards as $i => $card) {
                if (isset($sec7_files[$i]['profile']) && $sec7_files[$i]['profile'] instanceof UploadedFile) {
                    $oldPath = $index->sec7_cards[$i]['profile'] ?? null;
                    if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                        Storage::disk('public')->delete($oldPath);
                    }
                    $path = $sec7_files[$i]['profile']->store('cards/sec7', 'public');
                    $sec7_cards[$i]['profile'] = $path;
                } else {
                    $sec7_cards[$i]['profile'] = $index->sec7_cards[$i]['profile'] ?? '';
                }
            }
        }

        // --- GABUNGKAN DATA
        $payload = array_merge($textFields, [
            'main_video' => $mainVideo,
            'sec2_cards' => $this->cleanCards($request->input('sec2_cards', []), ['title', 'description']),
            'sec4_cards' => $this->cleanCards($sec4_cards, ['title', 'image']),
            'sec5_cards' => $this->cleanCards($request->input('sec5_cards', []), ['count', 'h2']),
            'sec6_cards' => $this->cleanCards($sec6_cards, ['h3', 'p', 'img']),
            'sec7_cards' => $this->cleanCards($sec7_cards, ['feedback', 'profile', 'name']),
            'sec8_cards' => $this->cleanCards($request->input('sec8_cards', []), ['title', 'description']),
        ]);

        $index->update($payload);

        return redirect()->back()->with('success', 'Updated successfully!');
    }


    /**
     * Helper untuk membersihkan data cards — TIDAK MENGGUNAKAN $request
     * Helper for cleaning data cards — DOES NOT USE $request
     */
    private function cleanCards(array $cards, array $fields): array
    {
        return collect($cards)
            ->map(fn($c) => collect($fields)->mapWithKeys(fn($f) => [$f => trim($c[$f] ?? '')])->all())
            ->filter(fn($c) => collect($c)->some(fn($v) => $v !== ''))
            ->values()
            ->all();
    }
}
