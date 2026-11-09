<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('about')->insert([
            // Hero Section
            [
                'key' => 'hero_section',
                'value' => json_encode([
                    'title' => 'Өв Соёл ХХК',
                    'subtitle' => 'Уламжлалт жороор, өнөөдрийн амтаар',
                    'description' => 'Бид Монголын уламжлалт нарийн боовны жороо орчин үеийн технологитой хослуулан, гар урлалын чанарыг олон нийтэд хүргэдэг үндэсний үйлдвэр юм. Эх орныхоо түүхэн амтыг хойч үедээ дамжуулах эрхэм зорилготой.',
                    'image' => 'mainphoto.jpg',
                    'video' => '',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Skills / Strengths
            [
                'key' => 'skills',
                'value' => json_encode([
                    ['name' => 'Гар урлалын нарийвчлал', 'percentage' => 96],
                    ['name' => 'Байгалийн цэвэр орц найрлага', 'percentage' => 100],
                    ['name' => 'Уламжлалт жорын үнэнч байдал', 'percentage' => 92],
                    ['name' => 'Хүргэлтийн шуурхай байдал', 'percentage' => 88],
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Counters
            [
                'key' => 'counters',
                'value' => json_encode([
                    ['title' => 'Жилийн туршлага', 'value' => 15],
                    ['title' => 'Салбарын тоо', 'value' => 8],
                    ['title' => 'Өдөрт үйлдвэрлэх бүтээгдэхүүн', 'value' => 5000],
                    ['title' => 'Сэтгэл ханамжтай харилцагч', 'value' => 20000],
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Timeline / History
            [
                'key' => 'timeline',
                'value' => json_encode([
                    [
                        'year' => '2011',
                        'title' => 'Үндэслэгдсэн',
                        'description' => 'Гэр бүлийн жижиг зууханд эхэлсэн "Өв Соёл" анхны нарийн боовоо хийж эхэлсэн.',
                        'image' => 'mainphoto2.jpg',
                    ],
                    [
                        'year' => '2015',
                        'title' => 'Анхны салбар',
                        'description' => 'Улаанбаатар хотод анхны борлуулалтын салбараа нээж, өдөр бүр шинэ бүтээгдэхүүнээр үйлчилж эхэлсэн.',
                        'image' => 'team1.jpg',
                    ],
                    [
                        'year' => '2019',
                        'title' => 'Үйлдвэрлэлээ өргөтгөв',
                        'description' => 'Орчин үеийн тоног төхөөрөмж нэвтрүүлж, өдөрт мянга мянган ширхэг бүтээгдэхүүн үйлдвэрлэх хүчин чадалтай боллоо.',
                        'image' => 'mainbackground.jpg',
                    ],
                    [
                        'year' => '2023',
                        'title' => 'Үндэсний брэнд боллоо',
                        'description' => 'Улс орон даяар 8 салбартай, өдөр бүр 20,000 гаруй хэрэглэгчид үйлчилдэг болов.',
                        'image' => 'uvsoyol.jpg',
                    ],
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Gallery
            [
                'key' => 'gallery',
                'value' => json_encode([
                    ['image' => 'mainphoto.jpg', 'caption' => 'Гар урлалын нарийн боов'],
                    ['image' => 'mainphoto2.jpg', 'caption' => 'Шинэхэн жигнэмэг'],
                    ['image' => 'team1.jpg', 'caption' => 'Манай мэргэжлийн баг'],
                    ['image' => 'mainbackground.jpg', 'caption' => 'Үйлдвэрлэлийн цех'],
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Video Section
            [
                'key' => 'video_section',
                'value' => json_encode([
                    'title' => 'Үйлдвэрлэлийн нүүр хуудас',
                    'description' => 'Гурил зуурснаас эхлээд халуун зуухнаас гарах хүртэлх бүтээгдэхүүний аяллыг бидний видеогоор үзээрэй.',
                    'video' => '',
                    'poster' => 'mainbackground.jpg',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
