<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndexesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('indexes')->insert([

            // Үндсэн хэсэг
            'main_h1' => 'Нарийн боов',
            'main_h2' => 'Таны бизнест зориулсан дижитал шийдэл',
            'main_p' => 'Бид таны бизнесийг хөгжүүлэхэд туслах шилдэг үйлчилгээ, шийдлүүдийг санал болгодог.',
            'main_button_text' => 'Дэлгэрэнгүй үзэх',
            'main_button_link' => '/about',


            // Section 2 (3 карт)
            'sec2_h2' => 'Онцлох үйлчилгээ',
            'sec2_p' => 'Таны хэрэгцээнд тохирсон олон төрлийн үйлчилгээ.',
            'sec2_cards' => json_encode([
                [
                    'title' => 'Веб дизайн',
                    'description' => 'Орчин үеийн, бүх төхөөрөмжид тохирох веб дизайн.'
                ],
                [
                    'title' => 'Аппликэйшн хөгжүүлэлт',
                    'description' => 'Хурдан, найдвартай, аюулгүй аппликэйшн хөгжүүлэлт.'
                ],
                [
                    'title' => 'SEO ба маркетинг',
                    'description' => 'Вебсайтыг хайлтын системд илүү харагдахуйц болгох.'
                ]
            ]),


            // Section 3
            'sec3_h2' => 'Бидэнтэй хамтран ажиллаарай',
            'sec3_p' => 'Хамтын ажиллагаа хамгийн сайн үр дүнг авчирна гэдэгт бид итгэдэг.',
            'sec3_button_text' => 'Холбогдох',
            'sec3_button_link' => '/contact',
            'sec3_video_link' => '',


            // Section 4 (4 карт)
            'sec4_h2' => 'Бидний бүтээлүүд',
            'sec4_p' => 'Бидний амжилттай хэрэгжүүлсэн төслүүдээс.',
            'sec4_button_text' => 'Бүх төслийг үзэх',
            'sec4_button_link' => '/products',

            'sec4_cards' => json_encode([
                [
                    'title' => 'Төсөл A',
                    'image' => '/images/project-a.jpg'
                ],
                [
                    'title' => 'Төсөл B',
                    'image' => '/images/project-b.jpg'
                ],
                [
                    'title' => 'Төсөл C',
                    'image' => '/images/project-c.jpg'
                ],
                [
                    'title' => 'Төсөл D',
                    'image' => '/images/project-d.jpg'
                ],
            ]),


            // Section 5 (4 карт статистик)
            'sec5_cards' => json_encode([
                [
                    'h2' => 'Хурд',
                    'p' => 'Ажлын процессыг хурдан, үр ашигтай гүйцэтгэнэ.',
                    'count' => 100
                ],
                [
                    'h2' => 'Чанар',
                    'p' => 'Өндөр чанартай, найдвартай үр дүн.',
                    'count' => 110
                ],
                [
                    'h2' => 'Инноваци',
                    'p' => 'Шинэ технологи, орчин үеийн шийдлүүдийг ашиглана.',
                    'count' => 100
                ],
                [
                    'h2' => 'Дэмжлэг',
                    'p' => '24/7 хэрэглэгчийн тусламж үйлчилгээ.',
                    'count' => 120
                ]
            ]),


            // Section 6 (Багийн танилцуулга)
            'sec6_h2' => 'Манай баг',
            'sec6_p' => 'Туршлагатай, хариуцлагатай мэргэжилтнүүдээс бүрдсэн баг.',

            'sec6_cards' => json_encode([
                [
                    'img' => '/images/team1.jpg',
                    'h3' => 'Бат',
                    'p' => 'Гүйцэтгэх захирал'
                ],
                [
                    'img' => '/images/team2.jpg',
                    'h3' => 'Сараа',
                    'p' => 'Технологийн захирал'
                ],
                [
                    'img' => '/images/team3.jpg',
                    'h3' => 'Мөнх',
                    'p' => 'Ахлах дизайнер'
                ],
                [
                    'img' => '/images/team4.jpg',
                    'h3' => 'Номин',
                    'p' => 'Маркетингийн менежер'
                ],
            ]),


            // Section 7
            'sec7_h2' => 'Харилцагчдын сэтгэгдэл',
            'sec7_p' => 'Манай үйлчилгэний талаар хэрэглэгчид юу хэлдэг вэ.',
            'sec7_button_text' => 'Бүх сэтгэгдлийг үзэх',

            'sec7_cards' => json_encode([
                [
                    'name' => 'Бат',
                    'feedback' => 'Үйлчилгээ хурдан, мэргэжлийн түвшинд байсан.',
                    'profile' => '/images/team1.jpg'
                ],
                [
                    'name' => 'Болд',
                    'feedback' => 'Дизайны үр дүн маш их таалагдсан.',
                    'profile' => '/images/team1.jpg'
                ],
                [
                    'name' => 'Цэцэг',
                    'feedback' => 'Найрсаг, тусалж дэмждэг баг.',
                    'profile' => '/images/team1.jpg'
                ]
            ]),


            // Section 8 — Hero overlay cards (Vision / Mission / Values)
            'sec8_h2' => null,

            'sec8_cards' => json_encode([
                [
                    'title' => 'Алсын хараа',
                    'description' => 'Үндэсний брэндийг дэлхийд танилцуулна.',
                ],
                [
                    'title' => 'Эрхэм зорилго',
                    'description' => 'Өвөг дээдсээс уламжлагдан ирсэн үнэт өвөг дээдсийн жор, эв найрамдалтай орчинд соёл, түгээмэл, эрдэм хийгээд боловсролтой хамтын байгууллага байх.',
                ],
                [
                    'title' => 'Үнэт зүйлс',
                    'description' => 'Соёлын өвийг дээдэлж, смарт үйлдвэрлэл, тогтвортой хөгжил.',
                ],
            ]),


            'created_at' => now(),
            'updated_at' => now(),

        ]);
    }
}