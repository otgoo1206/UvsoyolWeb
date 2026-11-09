<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products_pages')->insert([
            'hero_h1' => 'Бүтээгдэхүүн',
            'hero_h2' => 'Амтат мөчүүдийг эндээс сонгоорой',
            'hero_p'  => 'Өдөр бүр шинэхэн жигнэсэн нарийн боов, талх, бялуунаас өөрт тохирсныг сонгож захиална уу.',

            'products' => json_encode([
                [
                    'name' => 'Уламжлалт боорцог',
                    'category' => 'Нарийн боов',
                    'description' => 'Гар урлалын нарийвчлалтай, уламжлалт жороор хийсэн зөөлөн боорцог.',
                    'image' => 'mainphoto.jpg',
                    'price' => 3500,
                ],
                [
                    'name' => 'Ул боов',
                    'category' => 'Нарийн боов',
                    'description' => 'Наадам, баяр ёслолд зориулсан том хэмжээний уламжлалт боов.',
                    'image' => 'mainphoto.jpg',
                    'price' => 25000,
                ],
                [
                    'name' => 'Идээн боов',
                    'category' => 'Нарийн боов',
                    'description' => 'Зөгийн бал, тостой хослуулсан зөөлөн, амтат жижиг боов.',
                    'image' => 'mainphoto.jpg',
                    'price' => 4200,
                ],
                [
                    'name' => 'Франц батон',
                    'category' => 'Талх',
                    'description' => 'Гадуураа хатанги, дотроо зөөлөн франц маягийн батон талх.',
                    'image' => 'copy.jpeg',
                    'price' => 5500,
                ],
                [
                    'name' => 'Бүтэн будаа талх',
                    'category' => 'Талх',
                    'description' => 'Эрүүл мэндэд сайн, шаардлагатай ширхэглэгтэй бүтэн будааны талх.',
                    'image' => 'copy.jpeg',
                    'price' => 6800,
                ],
                [
                    'name' => 'Бун талх',
                    'category' => 'Талх',
                    'description' => 'Өглөөний цайнд тохиромжтой, зөөлөн жижиг бун талх.',
                    'image' => 'copy.jpeg',
                    'price' => 2500,
                ],
                [
                    'name' => 'Шоколадан торт',
                    'category' => 'Бялуу & Торт',
                    'description' => 'Бельгийн шоколадаар хийсэн, давхаргатай баялаг амттай торт.',
                    'image' => 'image_copy.png',
                    'price' => 45000,
                ],
                [
                    'name' => 'Ванилин бялуу',
                    'category' => 'Бялуу & Торт',
                    'description' => 'Захиалгат төрсөн өдрийн бялуу, гараар чимэглэсэн.',
                    'image' => 'image_copy.png',
                    'price' => 38000,
                ],
                [
                    'name' => 'Жимсний тарт',
                    'category' => 'Бялуу & Торт',
                    'description' => 'Улирлын шинэхэн жимсээр чимэглэсэн, зөөлөн тарт.',
                    'image' => 'image_copy.png',
                    'price' => 9500,
                ],
            ]),

            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
