<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsPageSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('news_pages')->insert([
            'hero_h1' => 'Мэдээ мэдээлэл',
            'hero_h2' => 'Шинэ мэдээллийг эндээс аваарай',
            'hero_p'  => 'Манай үйлдвэрийн үйл ажиллагаа, шинэ бүтээгдэхүүн, урамшууллын талаарх сүүлийн үеийн мэдээллүүд.',

            'news' => json_encode([
                [
                    'title' => 'Шинэ үйлдвэрлэлийн шугам нэвтэрлээ',
                    'description' => 'Бид орчин үеийн автоматжуулсан жигнэх шугамыг нэвтрүүлж, өдөрт үйлдвэрлэх бүтээгдэхүүний хэмжээг нэмэгдүүллээ.',
                    'image' => 'mainbackground.jpg',
                    'date' => '2026-08-01',
                ],
                [
                    'title' => '"Өв Соёл" 8 дахь салбараа нээлээ',
                    'description' => 'Улаанбаатар хотод найм дахь борлуулалтын салбараа нээж, хэрэглэгчиддээ илүү ойр боллоо.',
                    'image' => 'uvsoyol.jpg',
                    'date' => '2026-07-15',
                ],
                [
                    'title' => 'Чанарын олон улсын гэрчилгээ авлаа',
                    'description' => 'Манай үйлдвэр хүнсний аюулгүй байдлын олон улсын стандартын гэрчилгээг амжилттай авлаа.',
                    'image' => 'mainphoto.jpg',
                    'date' => '2026-06-20',
                ],
            ]),

            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
