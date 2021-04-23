<?php declare(strict_types=1);


namespace App\Services;


use Laravel\Socialite\Contracts\User as UserAuth2;
use \App\Models\User;

class SocialiteService
{
    public function login(UserAuth2 $user): void
    {
        $email = $user->getEmail();
        $userData = User::where('email', $email)->firstOrFail();
        if ($userData) {
            $userData->fill([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'avatar' => $user->getAvatar()
            ])->save();
            \Auth::loginUsingId($userData->id);
        }
    }
}
