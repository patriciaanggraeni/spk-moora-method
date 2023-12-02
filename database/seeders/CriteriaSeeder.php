<?php

namespace Database\Seeders;

use App\Models\Criterion;
use Illuminate\Database\Seeder;

class CriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $criteriaData = [
            [
                'name' => 'Menguasai karakteristik peserta didik',
                'weight' => 5,
                'type' => 'benefit'
            ], [
                'name' => 'Menguasai teori belajar dan prinsip-prinsip pembelajaran yang mendidik',
                'weight' => 10,
                'type' => 'benefit'
            ], [
                'name' => 'Pengembangan kurikulum',
                'weight' => 10,
                'type' => 'benefit'
            ], [
                'name' => 'Kegiatan pembelajaran yang mendidik',
                'weight' => 5,
                'type' => 'benefit'
            ], [
                'name' => 'Pengembangan potensi peserta didik',
                'weight' => 5,
                'type' => 'benefit'
            ], [
                'name' => 'Komunikasi dengan peserta didik',
                'weight' => 5,
                'type' => 'benefit'
            ], [
                'name' => 'Penilaian dan evaluasi',
                'weight' => 10,
                'type' => 'benefit'
            ], [
                'name' => 'Bertindak sesuai dengan norma agama, hukum, sosial dan kebudayaan nasional',
                'weight' => 5,
                'type' => 'cost'
            ], [
                'name' => 'Menunjukkan pribadi yang dewasa dan teladan',
                'weight' => 5,
                'type' => 'cost'
            ], [
                'name' => 'Etos kerja, tanggung jawab tinggi, rasa bangga menjadi guru',
                'weight' => 10,
                'type' => 'benefit'
            ], [
                'name' => 'Bersikap inklusif, bertindak obyektif, serta tidak diskriminatif',
                'weight' => 10,
                'type' => 'cost'
            ], [
                'name' => 'Komunikasi dengan sesama guru, tenaga kependidikan, orang tua, peserta didik, dan masyarakat',
                'weight' => 5,
                'type' => 'cost'
            ], [
                'name' => 'Penguasaan materi, struktur, konsep dan pola pikir keilmuan yang mendukung mata pelajaran yang diampu',
                'weight' => 10,
                'type' => 'benefit'
            ], [
                'name' => 'Mengembangkan keprofesionalan melalui tindakan yang reflektif',
                'weight' => 5,
                'type' => 'cost'
            ],
        ];

        foreach ($criteriaData as $datum) {
            Criterion::create([
                'name' => $datum['name'],
                'weight' => Criterion::toPercentage($datum['weight']),
                'type' => $datum['type'],
            ]);
        }
    }
}
