<?php

namespace App\Models;

use App\Traits\GeneralDatabaseOperation;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassRoom extends BaseModel
{
    use HasFactory, GeneralDatabaseOperation;

    protected $table = 'classes';

    protected $fillable = ['name'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public static function getClassesWithNoTeacher($excludedTeacherId = '')
    {
        $classRooms = self::whereNull('teacher_id');
        if (!empty($excludedTeacherId))
            $classRooms = $classRooms->orWhere('teacher_id', $excludedTeacherId);

        $classRooms = $classRooms->select('id', 'name')
            ->get();

        return $classRooms;
    }
}
