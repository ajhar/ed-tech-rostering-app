<?php

namespace App\Models;

use App\Traits\GeneralDatabaseOperation;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teacher extends BaseModel
{
    use HasFactory, GeneralDatabaseOperation;

    protected $table = 'teachers';

    protected $fillable = ['user_id', 'employee_id'];

    public static function getDetailQuery($teacherId = '')
    {
        $q = Teacher::with('userAttribute')
            ->with('user')
            ->with('classRooms');
        if (!empty($teacherId))
            $q->find($teacherId);
        return $q;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classRooms()
    {
        return $this->hasMany(ClassRoom::class);
    }

    public function userAttribute()
    {
        return $this->hasOne(UserAttribute::class, 'user_id', 'user_id');
    }
}
