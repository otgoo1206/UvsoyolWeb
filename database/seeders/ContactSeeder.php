<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contact')->insert([
            'whatsapp'   => '9769-4466',
            'email'      => 'info@uvsoyol.mn',
            'address'     => 'Сонгинохайрхан дүүрэг, Улаанбаатар хот, Монгол улс',
            'working_hours'  => 'Даваа - Бямба: 08:00 - 20:00',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
