<?php

namespace App\Http\Controllers\Auth;

use App\Endereco;
use App\User;
use App\Usuario;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Notifications\EmailValidade;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/usuario/validade';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function cadastro(Request $data)
    {
//        $userLaravel = User::create([
//            'name' => $data['name'],
//            'email' => $data['email'],
//            'password' => Hash::make($data['password']),
//        ]);
        $email = $data['email'];
        
        if(User::where('DS_EMAIL', $email)->count() > 0){
            return back()->withErrors([
                'email' => 'email já cadastrado'
            ])->withInput(\request(['emailRegistro']));
        }

       $usuario = User::insert([
            'DS_NOME' => $data['name'],
            'DS_EMAIL' => $data['email'],
            'DS_LOGIN' => $data['email'],
            'DS_SENHA' => Hash::make($data['password']),
            'DT_CADASTRO' => $data = date('Y-m-d H:i:s')
        //    'ID_ANUNCIANTE_LARAVEL' => $userLaravel->id,
        ]);
        $usuario = User::where('DS_EMAIL', $email)->limit(1)->orderBy('DS_EMAIL','desc')->get();

        $biarro = Endereco::insert([
            'ID_USUARIO' => $usuario[0]->ID_ANUNCIANTE
            ,'ID_CIDADE' => 0
        ]);
        $biarro = Endereco::where('ID_USUARIO', $usuario[0]->ID_ANUNCIANTE)->limit(1)->orderBy('ID_USUARIO','desc')->get();

        $update = DB::table('TB_ANUNCIANTE')
            ->where('ID_ANUNCIANTE',$usuario[0]->ID_ANUNCIANTE)
            ->update([
                'ID_BAIRRO' => $biarro[0]->ID_BAIRRO
            ]);

        //EMAIL DE VALIDACAO
        if ($usuario) {
                try {
                    $invitedUser = new User;
                    $invitedUser->email = $email;

                    $invitedUser->notify(
                        new  EmailValidade($usuario[0]->ID_ANUNCIANTE)
                    );

                } catch (Exception $e) {
                    return back()->withErrors([
                        'email' => 'erro ao validar email'
                    ])->withInput(\request(['emailRegistro']));
                }
            $success = [
                'successId' => 200,
                'successMessage' => 'Usuário cadastrado com sucesso!'
            ];
            $response = [
                'success' => $success
            ];

        }
        return redirect('/usuario/validade');
    }
}
