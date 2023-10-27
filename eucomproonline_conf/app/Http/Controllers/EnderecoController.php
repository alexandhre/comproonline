<?php

namespace App\Http\Controllers;

use App\Endereco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class EnderecoController extends Controller
{

    public function listEstado(){
        $currentPath= Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';

        if (preg_match($pattern, $currentPath)) {
            $estado = Endereco::listaEstado();

            $response=[
                'estado' =>  $estado,
            ];

            return response()->json(compact('response'));
        }else{
            $estado = Endereco::listaEstado();

            return $estado;
        }
    }

    public function listCidade(Request $uf){
        $currentPath= Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';

        if (preg_match($pattern, $currentPath)) {

            $response = Endereco::listaCidade($uf['request']['uf']);

            return response()->json(compact('response'));
        }else{
            $cidade = Endereco::listaCidade($uf->uf);

            return $cidade;
        }
    }
}
