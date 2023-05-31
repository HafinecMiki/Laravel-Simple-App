<?php

namespace App\Http\Controllers;

use App\Exceptions\UserNofFoundException;
use App\Exceptions\UserNotfFoundException;
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
    public function redirectToProvider(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * google callback
     *
     * @return RedirectResponse
     */
    public function handleProviderCallback(): RedirectResponse
    {
        $socialiteUser = Socialite::driver('google')->user();

        if (!empty($socialiteUser)) {
            $user = User::query()->where('email', $socialiteUser->getEmail())->first();

            if(!$user) {
                return redirect( route('register') )->withErrors(['User not found!']);
            }

            Auth::login($user);

            return redirect('/');
        }

        return redirect('/')->with('error', 'Failed to retrieve the user from Google callback');
    }
}
