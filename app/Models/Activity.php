<?php

namespace App\Models;

use App\Traits\GeneralDatabaseOperation;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activity extends BaseModel
{
    use HasFactory, GeneralDatabaseOperation;

    protected $table = 'activities';

    protected $fillable = ['name', 'subject_id', 'max_score'];

    public function calculateGrade($score)
    {
        if (empty($score)) return 'N/A';
        $maxScore = $this->max_score;
        return $score >= $maxScore * 0.75 ? 'A' : ($score >= $maxScore * 0.5 ? 'B' : ($score >= $maxScore * 0.25 ? 'C' : 'D'));

    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
