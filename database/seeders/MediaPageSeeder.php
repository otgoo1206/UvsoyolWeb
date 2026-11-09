<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MediaPageSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('media_pages')->insert([
            'hero_h2' => 'Медиа',

            'videos' => json_encode([
                [
                    'title' => 'Үйлдвэрлэлийн үйл явц',
                    'description' => 'Гурил зуурснаас эхлээд бэлэн бүтээгдэхүүн болтол.',
                    'video' => '',
                    'poster' => 'mainbackground.jpg',
                ],
                [
                    'title' => 'Манай баг',
                    'description' => 'Чанарын хяналт хийж буй мэргэжилтнүүд.',
                    'video' => '',
                    'poster' => 'mainphoto.jpg',
                ],
                [
                    'title' => 'Шинэ бүтээгдэхүүн',
                    'description' => 'Өдөр бүр шинэхэн жигнэмэг.',
                    'video' => '',
                    'poster' => 'copy.jpeg',
                ],
            ]),

            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
