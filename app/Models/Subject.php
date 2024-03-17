<?php

namespace App\Models;

use App\Traits\GeneralDatabaseOperation;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends BaseModel
{
    use HasFactory, GeneralDatabaseOperation;

    protected $table = 'subjects';

    protected $fillable = ['code', 'name'];

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
