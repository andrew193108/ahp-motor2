<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlternativeValue extends Model
{
    use HasFactory;

    protected $table = 'alternative_values';
    protected $fillable = ['alternative_id', 'criteria_id', 'value'];

    // Relasi dengan model Alternative
    public function alternative()
    {
        return $this->belongsTo(Alternative::class);
    }

    // Relasi dengan model Criteria
    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }
}
