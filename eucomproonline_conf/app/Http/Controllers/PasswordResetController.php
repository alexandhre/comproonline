<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Produto;
use Illuminate\Http\Request;
use App\Notifications\PasswordResetRequest;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\PasswordReset;

class PasswordResetController extends Controller
{
    public static function create(Request $json)
    {
        $currentPath= Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';
        if (preg_match($pattern, $currentPath)) {
            $request = json_decode(json_encode($json['request'],true));
        }else{
            $request = $json->request;
        }
        foreach ($request as $item){
            $email = $item;
        }

        $user = User::where('DS_EMAIL', $email)->first();

        if (!$user){
            $error = [
                'errorId' => 404,
                'errorMessage' => 'Não encontramos seu email'
            ];
            $response = [
                'error' => $error
            ];
            return response()->json(compact('response'), 200);
        }

        $passwordReset = PasswordReset::updateOrCreate(
            ['DS_EMAIL' => $user->DS_EMAIL]
        );
        if ($user && $passwordReset) {

            $array= [
                'senha' => substr(md5(rand(600000 , 12000000)), 0,8),
                'email' => $email
            ];
            try {
                $invitedUser = new User;
                $invitedUser->email = $email;

                $invitedUser->notify(
                    new PasswordResetRequest($user, $array)
                );


            } catch (Exception $e) {
                $error = [
                    'errorId' => 500,
                    'errorMessage' => 'Falha ao enviar email'
                ];
                $response = [
                    'error' => $error
                ];
                return response()->json(compact('response'),200);
            }

            User::updatesenha($array);
            // Usuario::token($passwordReset->remember_token);

            $currentPath= Route::getFacadeRoot()->current()->uri();
            $pattern = '/' . 'api' . '/';

            if (preg_match($pattern, $currentPath)) {
                $success = [
                    'successMessage' => 'Email enviado com secesso!'
                ];

                return response()->json(compact('success'));
            }else{

                $senha = 1;
                $categorias = Categoria::listAll();
                $show = 3;
                //return redirect()->back()->with([$senha,$categoria,$show]);
                return view('index',compact(['categorias','show','senha']));
            }

        }
    }
}
