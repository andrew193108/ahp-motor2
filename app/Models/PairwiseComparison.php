<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PairwiseComparison extends Model
{
    use HasFactory;
    protected $fillable = ['criteria1_id', 'criteria2_id', 'value'];

    public function criteria1()
    {
        return $this->belongsTo(Criteria::class, 'criteria1_id');
    }

    public function criteria2()
    {
        return $this->belongsTo(Criteria::class, 'criteria2_id');
    }
}
