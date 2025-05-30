<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class AuthenticationController extends Controller
{
    public function showRegister(): View
    {
        return view('register');
    }

    public function register(Request $request): RedirectResponse
    {
        $rules = [
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'name' => ['required', 'string', 'min:3', 'max:20', 'alpha_num', 'unique:users,name'],
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()->uncompromised()],
        ];

        $messages = [
            // Email validation error messages
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Make sure you enter a valid email format.',
            'email.max' => 'Your email may not be longer than 255 characters.',
            'email.unique' => 'This email is already in use.',

            // Username validation error messages
            'name.required' => 'Please choose a username.',
            'name.string' => 'Your username must be text.',
            'name.min' => 'Your username must be at least 3 characters.',
            'name.max' => 'Your username may not be longer than 20 characters.',
            'name.alpha_num' => 'Usernames may only contain letters and numbers.',
            'name.unique' => 'This username is already taken.',

            // Password validation error messages
            'password.required' => 'Please enter a password.',
            'password.confirmed' => 'Passwords do not match.',
            'password.min' => 'Your password must be at least 8 characters.',
            'password.letters' => 'Your password must contain at least one letter.',
            'password.numbers' => 'Your password must contain at least one number.',
            'password.uncompromised' => 'This password has appeared in a data breach. Please choose a more secure one.',
        ];

        $validator = Validator::make(
            $request->only(['email', 'name', 'password', 'password_confirmation']),
            $rules, $messages
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $validated_data = $validator->validated();
        $user = new User;

        $user->email = $validated_data['email'];
        $user->name = $validated_data['name'];
        $user->password = Hash::make($validated_data['password']);

        $user->save();
        event(new Registered($user));

        return redirect()->back()->with('account_created', 'Account created successfully. You can now sign in.');
    }

    public function showLogin(): View
    {
        return view('login');
    }

    public function login(Request $request): RedirectResponse
    {
        $rules = [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];

        $messages = [
            // Email validation error messages
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Make sure your email address is in a valid format.',

            // Password validation error messages
            'password.required' => 'Please enter your password.',
        ];

        $validator = Validator::make(
            $request->only(['email', 'password']),
            $rules, $messages
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->onlyInput('email');
        }

        $remember = $request->has('remember-me');

        if (Auth::attempt($validator->validated(), $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials are incorrect.',
        ])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.show')->with('system', 'Successfully signed out');
    }
}
