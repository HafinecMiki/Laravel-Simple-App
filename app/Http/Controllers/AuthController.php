<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Mail\VerifyCodeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\VerifyCode;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Login
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function login(Request $request): RedirectResponse
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($data)) {
            return redirect('/');
        }

        return back()->with('error', 'Error Email or Password');
    }

    /**
     * register
     *
     * @param RegisterUserRequest $request
     * @return RedirectResponse
     */
    public function register(RegisterUserRequest $request): RedirectResponse
    {
        $user = new User($request->validated());

        $user->password = Hash::make($request->password);

        $user->save();

        return back()->with('success', 'Register successfully');
    }

    /**
     * Logout
     *
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        Auth::logout();

        return redirect()->route('login');
    }

    /**
     * Login 2 FA
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function login2FA(Request $request): RedirectResponse
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::validate($data)) {

            $user = User::firstWhere('email', $request->email);

            $code = Str::random(12);

            //check
            $verify_code = VerifyCode::firstWhere('user_id', $user->id);

            if ($verify_code) {
                $verify_code->update([
                    'code' => $code
                ]);
            } else {
                VerifyCode::create([
                    'code' => $code,
                    'user_id' => $user->id
                ]);
            }

            //send email
            Mail::to($request->email)->send(new VerifyCodeMail($code));

            return redirect(route('verify', $user->id));
        }

        return redirect('/')->with('error', 'Error Email or Password');
    }

    /**
     * login verify code
     *
     * @param User $user
     * @param Request $request
     * @return RedirectResponse
     */
    public function loginVerifyCode(User $user, Request $request): RedirectResponse
    {
        try {
            $verifyCode = VerifyCode::with(['user'])
                ->where('code', $request->code)
                ->where('user_id', $user->id)
                ->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            return back()->with('error', 'Invalid code!');
        }
        // login
        Auth::login($verifyCode->user);
        //remove code
        $verifyCode->delete();
        return redirect('/')->with('success', 'Login Success');
    }
}
