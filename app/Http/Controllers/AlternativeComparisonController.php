<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alternative;
use App\Models\Criteria;
use App\Models\AlternativeComparison;

class AlternativeComparisonController extends Controller
{
    public function create()
    {
        $criterias = Criteria::all();
        $alternatives = Alternative::all();
        $comparisons = [];
        $comparisonScale = [
            1 => 'Sama Penting',
            3 => 'Sedikit Lebih Penting',
            5 => 'Lebih Penting',
            7 => 'Sangat Lebih Penting',
            9 => 'Mutlak Lebih Penting',
            2 => 'Antara Sama Penting dan Sedikit Lebih Penting',
            4 => 'Antara Sedikit Lebih Penting dan Lebih Penting',
            6 => 'Antara Lebih Penting dan Sangat Lebih Penting',
            8 => 'Antara Sangat Lebih Penting dan Mutlak Lebih Penting',
        ];

        foreach ($criterias as $criteria) {
            foreach ($alternatives as $i => $alternative1) {
                for ($j = $i + 1; $j < count($alternatives); $j++) {
                    $alternative2 = $alternatives[$j];
                    $comparisons[$criteria->id][] = [
                        'alternative1' => $alternative1,
                        'alternative2' => $alternative2
                    ];
                }
            }
        }

        return view('alternative_comparinsons.create', compact('criterias', 'alternatives', 'comparisons', 'comparisonScale'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        foreach ($data['comparisons'] as $criteriaId => $criteriaComparisons){
            foreach ($criteriaComparisons as $comparison) {
                $alternativeComparison = new AlternativeComparison();
                $alternativeComparison->criteria_id = $criteriaId;
                $alternativeList = explode(",", $comparison['alternatives']);
                $alternativeComparison->alternative_id_1 = $alternativeList[0];
                $alternativeComparison->alternative_id_2 = $alternativeList[1];
                $alternativeComparison->value = $comparison['value'];
                $alternativeComparison->save();
            }
        }


        return redirect()->route('alternative_comparison.create')->with('success', 'Comparisons saved successfully.');
    }
}
