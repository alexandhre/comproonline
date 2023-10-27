<?php

namespace App\Http\Controllers\chat;

use App\Anunciante;
use App\Categoria;
use App\Chat;
use App\User;
use ExponentPhpSDK\Exceptions\ExpoException;
use ExponentPhpSDK\Exceptions\UnexpectedResponseException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Route;


class ChatController extends Controller
{
    public function listarchatweb(){

        if(!(key_exists('email',session()->all()))){
            $categorias = Categoria::listAll();
            $show = 1;
            return view('index', compact(['categorias','show']));
        }else{

            $id = session()->all()['id'];

            $usuario = Chat::findByid( $id);
            //dd($usuario);
            $usuario = collect($usuario)->map(function ($item) {
                return (object) $item;
            });

            $show = 0;
            return view('usuario.chat',compact(['usuario','show']));
        }
    }

    public function chatDelete(Request $request){
        $currentPath = Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';
        if (preg_match($pattern, $currentPath)) {
            $data = json_decode(json_encode($request['request'], true));

            $chat = Chat::remove($data->chatColation);

            $response = [
                'chat' => $chat
            ];
            return response()->json(compact('response'),200);
        }else{

            $chat = Chat::remove($request->input);

            return $chat;
        }

    }

    public function chatAdd(Request $request)
    {
        $currentPath = Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';
        if (preg_match($pattern, $currentPath)) {
            $data = json_decode(json_encode($request['request'], true));

            if(Chat::where('ID_COLATION', $data->colationId)->limit(1)->orderBy('ID_COLATION','desc')->get()->count() === 0){
                Chat::addchatApp($data);
            }
            $chat = Chat::where('ID_COLATION', $data->colationId)->limit(1)->orderBy('ID_COLATION','desc')->get();

            $response = [
                'chat' => $chat
            ];
            return response()->json(compact('response'),200);
        }else{
            $data = json_decode(json_encode($request->input, true));


            if(Chat::where('ID_COLATION', $data[2])->limit(1)->orderBy('ID_COLATION','desc')->get()->count() === 0){
                Chat::addchat($data);
            }
            $chat = Chat::where('ID_COLATION', $data[2])->limit(1)->orderBy('ID_COLATION','desc')->get();

            return $chat;
        }
    }

    public function listarchatApp($id){


        $chat = Chat::where('ID_ANUNCIANTE', $id)->orWhere('ID_ATACADISTA', $id)->get();

        $usuario = Chat::findByidApp( $id);
        $response = [
            'chat' => $usuario
        ];
            return response()->json(compact('response'),200);

    }

    public function chatnotication(Request $request){

        $currentPath = Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';
        if (preg_match($pattern, $currentPath)) {
            $data = json_decode(json_encode($request['request'], true));

            $receiver =  Anunciante::where('ID_ANUNCIANTE',$data->receiverId)->select('DS_TOKEN')->first();
            $user =  Anunciante::where('ID_ANUNCIANTE',$data->senderId)->select('DS_NOME','DS_FOTO_COMPRADOR','DS_TOKEN')->first();

            if ($receiver->DS_TOKEN != NULL) {

               $notify = Chat::notification($data, $receiver, $user, $data->chatMessage, $data->senderId);

               if($notify == 1){
                   $data = [
                       'sucessId' => 200,
                       'sucessMessage' => 'notificação enviada!'
                   ];
                   $response = [
                       'sucess' => $data
                   ];

                   return response()->json(compact('response'));
               }else{
                   $error = [
                       'errorId' => 500,
                       'errorMessage' => 'Não foi possivel enviar a notificação'
                   ];
                   $response = [
                       'error' => $error
                   ];

                   return response()->json(compact('response'));
               }

            }else{
                return ("sem token");
            }

        }else {
            $data = $request['input'];
            $receiver = Anunciante::where('ID_ANUNCIANTE', $data['receiverId'])->select('DS_TOKEN')->first();
            $user = Anunciante::where('ID_ANUNCIANTE', $data['senderId'])->select('DS_NOME', 'DS_FOTO_COMPRADOR', 'DS_TOKEN')->first();

            Chat::notificationweb();
            if ($receiver->DS_TOKEN != NULL) {
                $notify = Chat::notification($data, $receiver, $user, $data['chatMessage'], $data['senderId']);

                if($notify == 1){
                    return "OK";

                }else{
                    return "erro";
                }
            }else{
                return ("sem token");
            }
        }
    }



}
