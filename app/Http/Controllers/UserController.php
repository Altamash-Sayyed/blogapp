<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use function Laravel\Prompts\password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Login.
     */
    public function login(Request $request)
    {
        $incomingFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($incomingFields)) {
            $request->session()->regenerate();
            return redirect('/');
        }

        return redirect('login')->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * render the register view.
     */
    public function register_view()
    {
        return view('auth.register');
    }

    /**
     * create new user or register.
     */
    public function register(Request $request)
    {
        $incomingFields = Validator::make($request->all(), [
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        if ($incomingFields->fails()) {
            return redirect('register')
                ->withErrors($incomingFields)
                ->withInput();
        }

        $incomingFieldsData = $incomingFields->validated();
        $incomingFieldsData['password'] = bcrypt($incomingFieldsData['password']);

        $user = User::create($incomingFieldsData);
        Auth::login($user);

        return redirect('/');
    }




    /**
     * logout the user.
     */
    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
