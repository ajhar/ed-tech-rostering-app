<?php

namespace App\Helpers;

use Faker\Provider\Base;
use Illuminate\Support\Str;

class UniqueStringGenerator extends Base
{
    public function uniqueString($length = 5, $prefix = '')
    {
        $str = $prefix;
        while (strlen($str) < $length)
            $str .= $this->generator->lexify('?????');

        return Str::upper(substr($str, 0, $length));
    }
}
