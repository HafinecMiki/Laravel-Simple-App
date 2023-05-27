<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SocialLoginController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return RedirectResponse
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * google callback
     * 
     * @return RedirectResponse
     */
    public function handleProviderCallback()
    {
        $socialiteUser = Socialite::driver('google')->user();

        if (!empty($socialiteUser)) {
            $user = User::query()->where('email', $socialiteUser->getEmail())->first();

            if(!$user) {
                return redirect('/register')->with('error', 'User does not exist! Please do the registration!');
            }

            Auth::login($user);

            return redirect('/');
        }

        return redirect('/')->with('error', 'Failed to retrieve the user from Google callback');
    }
}
