<?php

namespace App\Http\Controllers;

use App\Services\SocialiteService;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function init(): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        return Socialite::driver('vkontakte')->redirect();
    }

    public function callback(SocialiteService $service): \Illuminate\Http\RedirectResponse
    {
        $user = Socialite::driver('vkontakte')->user();
        $service->login($user);
        return redirect()->route('admin.news.index');
    }
}
