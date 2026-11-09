<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('services_pages')->insert([
            // Hero Section
            'hero_h1' => 'Үйлдвэрлэл',
            'hero_h2' => 'Уламжлалаас өнөөг хүртэл',
            'hero_p'  => 'Шилдэг түүхий эдийг гар урлалын нарийвчлалтай хослуулж, өдөр бүр шинэхэн нарийн боов, талх, бялуу үйлдвэрлэдэг.',

            // Section 1: Product categories
            'sec1_h2' => 'Манай бүтээгдэхүүний төрөл',
            'sec1_cards' => json_encode([
                [
                    'title' => 'Нарийн боов',
                    'description' => 'Уламжлалт жороор хийсэн боорцог, боов, жигнэмэг — амтат явдал болгонд тохирно.',
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-10 h-10 text-[#831518] mx-auto"><path stroke-linecap="round" stroke-linejoin="round" d="M12 22V10M12 10c-1.5-1.5-1.5-3.5 0-5M12 10c1.5-1.5 1.5-3.5 0-5M9 13c-1.5-1-1.5-2.5 0-4M15 13c1.5-1 1.5-2.5 0-4M8 17c-1.5-1-1.5-2.5 0-4M16 17c1.5-1 1.5-2.5 0-4"/></svg>',
                ],
                [
                    'title' => 'Бялуу & Торт',
                    'description' => 'Төрсөн өдөр, баяр ёслолд зориулсан захиалгат бялуу, тортыг гараар чимэглэнэ.',
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-10 h-10 text-[#831518] mx-auto"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18M3 12l2 8h14l2-8M3 12l9-8 9 8M9 12V9m6 3V9"/><circle cx="12" cy="5" r="1" fill="currentColor" stroke="none"/></svg>',
                ],
                [
                    'title' => 'Талх & Гурилан бүтээгдэхүүн',
                    'description' => 'Өдөр бүр шинэхэн жигнэсэн талх, бун, франц талх зэрэг өргөн сонголт.',
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-10 h-10 text-[#831518] mx-auto"><path stroke-linecap="round" stroke-linejoin="round" d="M4 12c0-4 3.5-7 8-7s8 3 8 7-3.5 6-8 6-8-2-8-6Z"/><path stroke-linecap="round" d="M8 11c.5-1 1-1.5 2-1.5M13 10c.5-1 1-1.5 2-1.5"/></svg>',
                ],
            ]),

            // Section 2: Production process timeline
            'sec2_h2' => 'Үйлдвэрлэлийн үе шат',
            'sec2_p'  => 'Түүхий эдээс эхлээд хэрэглэгчийн ширээнд хүрэх хүртэл бүтээгдэхүүн бүр чанарын хатуу хяналтаар дамждаг.',
            'sec2_cards' => json_encode([
                [
                    'step' => '01',
                    'title' => 'Түүхий эд сонголт',
                    'description' => 'Шилдэг үндэсний гурил, байгалийн орц найрлагыг сайтар шалгаж сонгоно.',
                ],
                [
                    'step' => '02',
                    'title' => 'Хутгалт & Хэлбэржүүлэлт',
                    'description' => 'Гар урлалын нарийвчлалтай хутгаж, уламжлалт хэлбэрт оруулна.',
                ],
                [
                    'step' => '03',
                    'title' => 'Жигнэлт',
                    'description' => 'Оновчтой температурт жигнэж, шинэхэн амт, үнэрийг хадгална.',
                ],
                [
                    'step' => '04',
                    'title' => 'Баглаа & Хүргэлт',
                    'description' => 'Эрүүл ахуйн стандартын дагуу баглаж, салбаруудад шуурхай хүргэнэ.',
                ],
            ]),

            // Section 3: Quality guarantees
            'sec3_h2' => 'Чанарын баталгаа',
            'sec3_p'  => 'Бид үйлдвэрлэлийн бүх шатанд эрүүл ахуй, чанарын хатуу стандартыг баримталж, хэрэглэгчдийнхээ итгэлийг эрхэмлэдэг.',
            'sec3_skills' => json_encode([
                ['name' => 'Байгалийн цэвэр орц найрлага', 'percentage' => 100],
                ['name' => 'Гар урлалын нарийвчлал', 'percentage' => 96],
                ['name' => 'Эрүүл ахуйн стандарт', 'percentage' => 98],
                ['name' => 'Хүргэлтийн шуурхай байдал', 'percentage' => 90],
            ]),

            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
