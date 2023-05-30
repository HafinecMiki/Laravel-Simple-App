<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Mail\VerifyCodeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\VerifyCode;
use App\Models\User;
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
    public function login(Request $request)
    {
        $credetials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credetials)) {
            return redirect('/')->with('success', 'Login Success');
        }

        return back()->with('error', 'Error Email or Password');
    }

    /**
     * register
     * 
     * @param RegisterUserRequest $request
     * @return RedirectResponse 
     */
    public function register(RegisterUserRequest $request)
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
    public function logout()
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
    public function login2FA(Request $request)
    {
        $credetials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::validate($credetials)) {

            $user = User::firstWhere('email', $request->email);

            $code = Str::random(12) . '-' . $user->id;

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

            return redirect('/verify/'. $user->id);
        }

        return redirect('/')->with('error', 'Error Email or Password');
    }

    /**
     * login verify code
     * 
     * @param Request $request
     * @return RedirectResponse
     */
    public function loginVerifyCode(User $user, Request $request): RedirectResponse
    {
        $verifyCode = VerifyCode::with(['user'])
            ->where('code', $request->code)
            ->where('user_id', $user->id)
            ->first();

        if ($verifyCode) {
            // login
            Auth::login($verifyCode->user);
            //remove code
            $verifyCode->delete();
            return redirect('/')->with('success', 'Login Success');
        }

        return back()->with('error', 'Invalid code!');
    }
}
