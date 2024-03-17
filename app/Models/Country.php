<?php

namespace App\Models;

use App\Traits\GeneralDatabaseOperation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory, GeneralDatabaseOperation;

    protected $table = 'countries';

    protected $fillable = ['country_code', 'name', 'alpha3_country_code', 'currency_name', 'currency_code',
        'currency_symbol', 'dial_code'];
}
