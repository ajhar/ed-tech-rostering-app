<?php

namespace App\Models;

use App\Traits\GeneralDatabaseOperation;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentActivity extends BaseModel
{
    use HasFactory, GeneralDatabaseOperation;

    protected $table = 'student_activities';

    protected $fillable = ['student_id', 'activity_id', 'score', 'flag'];

    public static function getDetailQuery($studentId)
    {
        return StudentActivity::with('activity.subject')
            ->where('student_id', $studentId);
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
