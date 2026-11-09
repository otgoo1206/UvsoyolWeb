<?php

namespace App\Http\Controllers;

use App\Models\ServicesPage;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ServiceEditController extends Controller
{
  public function index()
  {
    $serviceData = ServicesPage::firstOrCreate([], [
      'hero_h1' => '',
      'hero_h2' => '',
      'hero_p'  => '',
      'sec1_h2' => '',
      'sec1_cards' => [],
      'sec2_h2' => '',
      'sec2_p' => '',
      'sec2_cards' => [],
      'sec3_h2' => '',
      'sec3_p' => '',
      'sec3_equipment' => [],
    ]);

    return view('service-edit', [
      'title' => 'service Page',
      'activePage' => 'service-edit',
      'serviceData' => $serviceData
    ]);
  }

  public function update(Request $request)
  {
    $data = $request->validate([
      'hero_h1' => 'required|string|max:255',
      'sec1_h2' => 'required|string|max:255',
      'sec1_cards' => 'nullable|array',
      'sec2_h2' => 'required|string|max:255',
      'sec2_p' => 'nullable|string',
      'sec2_cards' => 'nullable|array',
      'sec3_h2' => 'required|string|max:255',
      'sec3_p' => 'nullable|string',
      'sec3_equipment' => 'nullable|array',
      'sec3_equipment.*.image' => 'nullable|file|image|mimes:jpg,jpeg,png,webp|max:10240',
    ]);

    $page = ServicesPage::first();
    $oldEquipment = $page->sec3_equipment ?? [];

    $equipment = $request->input('sec3_equipment', []);
    $equipmentFiles = $request->file('sec3_equipment', []);

    foreach ($equipment as $i => $item) {
      $oldImage = $oldEquipment[$i]['image'] ?? '';

      if (isset($equipmentFiles[$i]['image']) && $equipmentFiles[$i]['image'] instanceof UploadedFile) {
        if ($oldImage && Storage::disk('public')->exists($oldImage)) {
          Storage::disk('public')->delete($oldImage);
        }
        $equipment[$i]['image'] = $equipmentFiles[$i]['image']->store('service/equipment', 'public');
      } else {
        $equipment[$i]['image'] = $oldImage;
      }
    }

    $equipment = collect($equipment)
      ->map(fn($item) => [
        'name' => trim((string) ($item['name'] ?? '')),
        'description' => trim((string) ($item['description'] ?? '')),
        'image' => $item['image'] ?? '',
      ])
      ->filter(fn($item) => $item['name'] !== '' || $item['description'] !== '' || $item['image'] !== '')
      ->values()
      ->all();

    $page->update([
      'hero_h1' => $data['hero_h1'],
      'sec1_h2' => $data['sec1_h2'],
      'sec1_cards' => $data['sec1_cards'] ?? [],
      'sec2_h2' => $data['sec2_h2'],
      'sec2_p' => $data['sec2_p'],
      'sec2_cards' => $data['sec2_cards'] ?? [],
      'sec3_h2' => $data['sec3_h2'],
      'sec3_p' => $data['sec3_p'],
      'sec3_equipment' => $equipment,
    ]);

    return back()->with('success', 'Page updated successfully!');
  }
}
