<?php

namespace Database\Seeders;

use App\Models\Alternative;
use Illuminate\Database\Seeder;

class AlternativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $alternativeNames = [
            'Annas Lumbantobing',
            'Drijen',
            'Emi Amalia',
            'Endi',
            'Sulton Nuddin Faqih',
            'Ismali Ali',
            'Hamdani H.M',
            'Hariyanto',
            'Herlis Libanon',
            'Ika Dewayani',
            'Indah Agoestina Iriantin',
            'Lasma Sitanggang',
            'Muhamad Zain',
            'Mangatas Haposan',
            'Meriana Sinaga',
            'Misyani',
            'Ibnu Athoillah',
            'Mugi Santoso',
            'Nunung Nurjana',
            'Nurmala Meirta Situmorang',
            'Pramono',
            'Refniati',
            'Rita Yulmiati',
            'Setyorini Nurul Safitri',
            'Sigit Wicaksono Budi',
            'Sugeng Rusmantono',
            'Titik Rahmawati',
            'Umi Harti',
            'Wiwik Setyarini',
            'Wiwit Hariyanti',
            'Yenni Zirta',
        ];

        foreach ($alternativeNames as $name) {
            Alternative::create(['name' => $name]);
        }
    }
}
