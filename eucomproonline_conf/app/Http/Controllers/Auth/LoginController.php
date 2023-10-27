<?php

namespace App\Http\Controllers\Auth;

use App\Categoria;
use App\Http\Controllers\Controller;
use App\User;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['only'=> 'showLoginForm']);
    }

    public function showLoginForm(){
//        if(key_exists('email',session()->all())){
//
//            return view('home');
//        }else{
//
//            return view('auth.login');
//        }

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function login(){


        Session()->flush();
        Auth()->logout();
        $crendentials = $this->validate(request(),[
            'email' => 'email|required|string',
            'password' => 'required|string',
        ]);
        // dd($crendentials['email']);
        // Get user by email
        $company = User::where('DS_EMAIL', $crendentials['email'])->first();



        // Validate Company
        if(!$company) {
            $show = 1;
            $categorias = Categoria::listAll();

            return back()->withErrors([
                'email' => 'email ou senha errados'
            ])->withInput(\request(['email']));
        }

         //Validate Company

        if( $company->DS_VALIDACAO == null) {
            $show = 1;
            $categorias = Categoria::listAll();


            return back()->withErrors([
                'email' => 'Usuário não autenticado'
            ])->withInput(\request(['email']), compact('show'));
        }

            if (Auth::attempt( array (
                'DS_EMAIL' => $crendentials['email'],
                'password' =>  $crendentials['password']
            ) )) {
                session()->flush(); // Removes a specific variable
                session ([
                    'email' => $crendentials['email'],
                    'nome' => $company->DS_NOME,
                    'photo' => $company->DS_FOTO_COMPRADOR,
                    'id' => $company->ID_ANUNCIANTE
                ]);

            } else {
                $show = 1;
                $categorias = Categoria::listAll();

                return back()->withErrors([
                    'email' => 'email ou senha errados'
                ])->withInput(\request(['email']));
            }
        return redirect()->route('home');

    }

    public function logout() {


        Session()->flush();
        Auth()->logout();

        // dd(key_exists('email',session()->all()));
        return redirect()->route('home');
    }
}
