<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Criteria;
use App\Models\PairwiseComparison;

class PairwiseComparisonController extends Controller
{
    public function create()
    {
        $criterias = Criteria::all();
        $comparisons = [];
        $comparisonScale = [
            1 => '(1) Sama Penting',
            3 => '(3) Sedikit Lebih Penting',
            5 => '(5) Lebih Penting',
            7 => '(7) Sangat Lebih Penting',
            9 => '(9) Mutlak Lebih Penting',
            2 => '(2) Antara Sama Penting dan Sedikit Lebih Penting',
            4 => '(4) Antara Sedikit Lebih Penting dan Lebih Penting',
            6 => '(6) Antara Lebih Penting dan Sangat Lebih Penting',
            8 => '(8) Antara Sangat Lebih Penting dan Mutlak Lebih Penting',
        ];

        foreach ($criterias as $i => $criteria1) {
            for ($j = $i + 1; $j < count($criterias); $j++) {
                $criteria2 = $criterias[$j];
                $comparisons[] = [
                    'criteria1' => $criteria1,
                    'criteria2' => $criteria2
                ];
            }
        }

        return view('pairwise_comparisons.create', compact('comparisons', 'comparisonScale'));
    }

    public function store(Request $request)
    {
        $comparisons = $request->input('comparisons');
        foreach ($comparisons as $criteria1_id => $values) {
            foreach ($values as $criteria2_id => $value) {
                PairwiseComparison::updateOrCreate(
                    [
                        'criteria1_id' => $criteria1_id,
                        'criteria2_id' => $criteria2_id,
                    ],
                    [
                        'value' => $value,
                    ]
                );
            }
        }

        return redirect()->route('criterias.index')->with('success', 'Perbandingan berpasangan berhasil disimpan.');
    }
}
