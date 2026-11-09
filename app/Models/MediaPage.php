<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class MediaPage extends Model
{
    use HasFactory;

    protected $table = 'media_pages';

    protected $fillable = [
        'hero_h2',
        'videos',
    ];

    protected $casts = [
        'videos' => 'array',
    ];

    /**
     * Resolve a stored image/video path into a browser-usable URL.
     * Supports full URLs, files uploaded to the public storage disk,
     * and plain filenames seeded under public/images.
     */
    public static function resolveMedia(?string $path): ?string
    {
        if (empty($path)) {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        if (Storage::disk('public')->exists($path)) {
            return asset('storage/' . $path);
        }

        return asset('images/' . ltrim($path, '/'));
    }
}
