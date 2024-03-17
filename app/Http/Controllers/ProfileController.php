<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Country;
use App\Services\UserAttributeService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the user's profile form.
     */
    public function index(Request $request): View
    {
        $user = $request->user()->load('userAttribute');
        return view('profile.profile_index', [
            'user' => $user,
            'countries' => Country::getAll(['id', 'name', 'country_code'])
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request)
    {
        $user = $request->user();
        try {
            UserService::update($request, $user);
            $userAttribute = $user->userAttribute;
            UserAttributeService::update($userAttribute, $request);
            return $this->response(['Profile updated']);
        } catch (\Exception $ex) {
            return $this->response([$ex->getMessage()], 422);
        }
    }
}
