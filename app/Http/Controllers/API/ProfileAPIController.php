<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Resources\ProfileResource;
use App\Models\UserAttribute;
use App\Services\UserAttributeService;
use App\Services\UserService;
use Illuminate\Http\Request;

class ProfileAPIController extends BaseAPIController
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(Request $request)
    {
        $user = $request->user()->load('userAttribute');
        return new ProfileResource($user);
    }

    public function update(ProfileUpdateRequest $request)
    {
        $user = $request->user();
        try {
            UserService::update($request, $user);
            if ($user->userAttribute()->exists()) {
                $userAttribute = $user->userAttribute;
            } else {
                $userAttribute = new UserAttribute();
                $userAttribute->user_id = $user->id;
            }

            UserAttributeService::update($userAttribute, $request);
            $user = $request->user()->load('userAttribute');
            return new ProfileResource($user);
        } catch (\Exception $ex) {
            return $this->errorMessage([$ex->getMessage()], 422);
        }
    }
}
