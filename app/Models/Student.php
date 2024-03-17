<?php

namespace App\Models;

use App\Traits\GeneralDatabaseOperation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory, GeneralDatabaseOperation;

    protected $table = "students";

    protected $fillable = ["registration_number", "class_id"];

    public static function getDetailQuery($teacher = '')
    {
        $q = Student::with('classRoom')
            ->with('userAttribute')
            ->with('user')
            ->with('studentActivities.activity.subject');
        if (!empty($teacher))
            $q = $q->whereHas('classRoom', function ($query) use ($teacher) {
                $query->where('teacher_id', $teacher->id);
            });

        return $q;
    }

    public static function getSingleDetail($studentId)
    {
        return Student::with('classRoom')
            ->with('userAttribute')
            ->with('user')
            ->with('studentActivities.activity.subject')
            ->find($studentId);
    }

    public function classRoom()
    {
        return $this->hasOne(ClassRoom::class, 'id', 'class_id');
    }

    public function userAttribute()
    {
        return $this->hasOne(UserAttribute::class, 'user_id', 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function studentActivities()
    {
        return $this->hasMany(StudentActivity::class);
    }
}
