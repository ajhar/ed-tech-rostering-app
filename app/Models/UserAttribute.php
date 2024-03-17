<?php

namespace App\Models;

use App\Services\UserService;
use App\Traits\GeneralDatabaseOperation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAttribute extends Model
{
    use HasFactory, GeneralDatabaseOperation;

    protected $table = 'user_attributes';

    protected $fillable = ['user_id', 'street1', 'street2', 'city', 'postal_code', 'country_id', 'phone_number'];

    public function getAddressAttribute()
    {
        return UserService::getAddress($this);
    }
}
