<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alternative;
use App\Models\Criteria;
use App\Models\CriteriaComparison;

class CriteriaComparisonController extends Controller
{
    public function index()
    {
        $criteria = Criteria::all();
        return view('criteria_comparison.index', compact('criteria'));
    }

    public function store(Request $request)
    {
        // Logika untuk menyimpan hasil perbandingan kriteria
        // ...

        // Setelah menyimpan hasil perbandingan kriteria, lakukan perhitungan ranking
        $rankingResults = $this->calculateRanking();

        // Redirect ke halaman hasil ranking dengan data ranking
        return view('ranking.results', compact('rankingResults'));
    }

    private function calculateRanking()
    {
        // Contoh logika perhitungan ranking dengan AHP
        $alternatives = Alternative::all();
        $criteria = Criteria::all();

        foreach ($alternatives as $alternative) {
            $alternative->score = 0;
            foreach ($criteria as $criterion) {
                $alternative->score += $criterion->weight * $alternative[$criterion->key];
            }
        }

        // Urutkan alternatif berdasarkan skor
        $alternatives = $alternatives->sortByDesc('score');

        return $alternatives;
    }
    public function showRankingResults()
    {
        $rankingResults = $this->calculateRanking();
        return view('ranking.results', compact('rankingResults'));
    }
}
