<?php

namespace App\Services;

use App\Models\UserAttribute;

class UserAttributeService
{
    public static function store($userId, $request): void
    {
        $userAttribute = new UserAttribute();
        $userAttribute->loadFromRequest($request);
        $userAttribute->user_id = $userId;
        $userAttribute->save();
    }

    public static function update($userAttribute, $request)
    {
        $userAttribute->loadFromRequest($request);
        $userAttribute->save();
    }
}
