<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServicesPage extends Model
{
    use HasFactory;
    protected $table = 'services_pages';

    protected $fillable = [
        'hero_h1',
        'hero_h2',
        'hero_p',
        'sec1_h2',
        'sec1_cards',
        'sec2_h2',
        'sec2_p',
        'sec2_cards',
        'sec2_capacity',
        'sec3_h2',
        'sec3_p',
        'sec3_skills',
        'sec3_equipment',
    ];

    // Casting JSON biar otomatis array
    protected $casts = [
        'sec1_cards' => 'array',
        'sec2_cards' => 'array',
        'sec3_skills' => 'array',
        'sec3_equipment' => 'array',
    ];

    public static function resolveMedia(?string $path): ?string
    {
        if (empty($path)) {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        if (\Illuminate\Support\Facades\Storage::disk('public')->exists($path)) {
            return asset('storage/' . $path);
        }

        return asset('images/' . ltrim($path, '/'));
    }
}
