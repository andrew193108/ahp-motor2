<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AlternativeValue;

class AlternativeValueSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['alternative_id' => 1, 'criteria_id' => 1, 'value' => 3],
            ['alternative_id' => 1, 'criteria_id' => 2, 'value' => 4],
            ['alternative_id' => 2, 'criteria_id' => 1, 'value' => 5],
            ['alternative_id' => 2, 'criteria_id' => 2, 'value' => 2],
            // Tambahkan data lainnya sesuai kebutuhan
        ];

        foreach ($data as $item) {
            AlternativeValue::create($item);
        }
    }
}
