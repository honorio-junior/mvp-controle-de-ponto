<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request): RedirectResponse
    {

        $credentials = $request->validate([

            'cpf' => ['required', 'cpf'],

            'password' => ['required'],

        ]);

        $credentials['cpf'] = preg_replace('/\D/', '', $credentials['cpf']);


        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();



            return redirect()->intended(route('home'));

        }



        return back()->withErrors([

            'cpf' => 'As credenciais fornecidas não correspondem aos nossos registros.',

        ])->onlyInput('cpf');

    }
}
