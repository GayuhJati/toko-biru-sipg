<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Testimoni;

class TestimoniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Siti Aminah',
                'message' => 'Pelayanan sangat ramah dan cepat, saya sangat puas!',
                'rating' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Budi Santoso',
                'message' => 'Cukup baik, tapi masih bisa ditingkatkan lagi.',
                'rating' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Rina Kurniawati',
                'message' => 'Layanan memuaskan, prosesnya cepat dan tidak ribet!',
                'rating' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($data as $testimonial) {
            Testimoni::create($testimonial);
        }
    }
}
