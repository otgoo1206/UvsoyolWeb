<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Contact extends Model
{
    protected $table = 'contact';

    protected $fillable = [
        'whatsapp',
        'email',
        'address',
        'working_hours',
        'footer_background',
    ];

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
