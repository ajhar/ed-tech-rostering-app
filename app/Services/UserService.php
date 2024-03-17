<?php

namespace App\Services;

use App\Models\Country;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public static function store($request, $role)
    {
        $user = new User();
        $user->loadFromRequest($request);
        $user->password = Hash::make($request->password);
        $user->role = $role;
        $user->save();
        return $user;
    }

    public static function update($request, User $user)
    {
        $user->loadFromRequest($request);
        if (isset($request->password))
            $user->password = Hash::make($request->password);
        else
            unset($user->password);
        $user->save();
    }

    public static function getAddress($userAttribute)
    {
        $address = $userAttribute->street1;
        if (!empty($userAttribute->strret2))
            $address .= ' ' . $userAttribute->street2;

        $address .= ' ' . $userAttribute->city . ', ' . $userAttribute->postal_code;
        $country = Country::findById($userAttribute->country_id, ['country_code']);
        $address .= ', ' . $country->country_code;
        return $address;
    }
}
