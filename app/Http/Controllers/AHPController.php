<?php
namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Alternative;
use App\Models\PairwiseComparison;
use App\Models\AlternativeValue;
use Illuminate\Http\Request;

class AHPController extends Controller
{
    public function calculate()
    {
        $criterias = Criteria::all();
        $alternatives = Alternative::all();
        $pairwiseComparisons = PairwiseComparison::all();

        $matrixCriteria = $this->buildPairwiseMatrix($criterias, $pairwiseComparisons);
        $normalizedMatrix = $this->normalizeMatrix($matrixCriteria);
        $weights = $this->calculateWeights($normalizedMatrix);
        $consistencyRatio = $this->calculateConsistencyRatio($matrixCriteria, $weights);

        // Ambil nilai alternatif dari database
        $alternativeValues = $this->getAlternativeValues($alternatives, $criterias);

        // Hitung skor akhir untuk setiap alternatif
        $finalScores = $this->calculateFinalScores($alternatives, $criterias, $alternativeValues, $weights);

        // Mengurutkan skor akhir untuk menampilkan peringkat
        $rankedScores = $this->rankFinalScores($finalScores);

        return view('result', compact('criterias', 'alternatives', 'weights', 'consistencyRatio', 'rankedScores', 'finalScores'));
    }

    private function buildPairwiseMatrix($criterias, $pairwiseComparisons)
    {
        $matrix = array_fill(0, count($criterias), array_fill(0, count($criterias), 1));

        foreach ($pairwiseComparisons as $comparison) {
            $i = $criterias->search(function($criteria) use ($comparison) {
                return $criteria->id == $comparison->criteria1_id;
            });
            $j = $criterias->search(function($criteria) use ($comparison) {
                return $criteria->id == $comparison->criteria2_id;
            });
            $matrix[$i][$j] = $comparison->value;
            $matrix[$j][$i] = 1 / $comparison->value;
        }

        return $matrix;
    }

    private function normalizeMatrix($matrix)
    {
        $normalized = [];
        $sumColumn = array_fill(0, count($matrix), 0);

        foreach ($matrix as $row) {
            foreach ($row as $key => $value) {
                $sumColumn[$key] += $value;
            }
        }

        foreach ($matrix as $row) {
            $normalizedRow = [];
            foreach ($row as $key => $value) {
                $normalizedRow[] = $value / $sumColumn[$key];
            }
            $normalized[] = $normalizedRow;
        }

        return $normalized;
    }

    private function calculateWeights($matrix)
    {
        $weights = [];
        foreach ($matrix as $row) {
            $weights[] = array_sum($row) / count($row);
        }
        return $weights;
    }

    private function calculateConsistencyRatio($matrix, $weights)
    {
        $n = count($matrix);
        $lambdaMax = $this->calculateLambdaMax($matrix, $weights);
        $consistencyIndex = $this->calculateConsistencyIndex($lambdaMax, $n);

        // Nilai rata-rata indeks acak untuk matriks ukuran 1-10
        $randomIndex = [0.00, 0.00, 0.58, 0.90, 1.12, 1.24, 1.32, 1.41, 1.45, 1.49];
        $randomIndexValue = $randomIndex[$n - 1];

        $consistencyRatio = $consistencyIndex / $randomIndexValue;

        return $consistencyRatio;
    }

    private function getAlternativeValues($alternatives, $criterias)
    {
        $values = [];
        foreach ($alternatives as $alternative) {
            foreach ($criterias as $criteria) {
                \Log::info('Processing Alternative ID: ' . $alternative->id . ', Criteria ID: ' . $criteria->id);

                // Periksa apakah nilai ada dalam tabel alternative_values
                $value = AlternativeValue::where('alternative_id', $alternative->id)
                    ->where('criteria_id', $criteria->id)
                    ->first();

                if ($value) {
                    \Log::info('Value found: ' . $value->value);
                    $values[$alternative->id][$criteria->id] = $value->value;
                } else {
                    \Log::warning("Nilai tidak ditemukan untuk Alternative ID: {$alternative->id}, Criteria ID: {$criteria->id}");
                    $values[$alternative->id][$criteria->id] = 0;
                }
            }
        }
        \Log::info('Final Values:', $values); // Tambahkan ini untuk debugging
        return $values;
    }

    private function calculateFinalScores($alternatives, $criterias, $alternativeValues, $weights)
    {
        $scores = [];
        foreach ($alternatives as $alternative) {
            $score = 0;
            foreach ($criterias as $key => $criteria) {
                if (isset($alternativeValues[$alternative->id][$criteria->id]) && isset($weights[$key])) {
                    $score += $alternativeValues[$alternative->id][$criteria->id] * $weights[$key];
                } else {
                    // Menambahkan log untuk debugging
                    \Log::error("Missing data for alternative ID: {$alternative->id}, criteria ID: {$criteria->id}, or weight index: {$key}");
                }
            }
            $scores[] = [
                'alternative' => $alternative,
                'score' => $score
            ];
        }

        // Log untuk memeriksa skor akhir
        \Log::info('Final Scores:', $scores);

        // Urutkan berdasarkan skor
        usort($scores, function ($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        return $scores;
    }

    private function rankFinalScores($finalScores)
    {
        $rankedScores = [];
        foreach ($finalScores as $index => $result) {
            $rankedScores[] = [
                'rank' => $index + 1,
                'alternative' => $result['alternative'],
                'score' => $result['score']
            ];
        }
        return $rankedScores;
    }

    private function calculateLambdaMax($matrix, $weights)
    {
        $n = count($matrix);
        $weightedSum = [];

        for ($i = 0; $i < $n; $i++) {
            $sum = 0;
            for ($j = 0; $j < $n; $j++) {
                $sum += $matrix[$i][$j] * $weights[$j];
            }
            $weightedSum[] = $sum;
        }

        $lambdaMax = 0;
        for ($i = 0; $i < $n; $i++) {
            $lambdaMax += $weightedSum[$i] / $weights[$i];
        }
        return $lambdaMax / $n;
    }

    private function calculateConsistencyIndex($lambdaMax, $n)
    {
        return ($lambdaMax - $n) / ($n - 1);
    }
}
