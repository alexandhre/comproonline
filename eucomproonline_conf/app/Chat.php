<?php

namespace App;

use ExponentPhpSDK\Exceptions\ExpoException;
use ExponentPhpSDK\Exceptions\UnexpectedResponseException;
use Illuminate\Database\Eloquent\Model;

use App\User;
use Illuminate\Support\Facades\DB;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\ServiceAccount;
use Auth;

class Chat extends Model
{
    protected $table = 'TB_CHAT';

    protected $fillable = [
        'ID_ANUNCIANTE'
        ,'ID_ATACADISTA'
        ,'ID_ANUNCIO_PRODUTO'
        ,'ID_COLATION'
    ];

    public static function findByid($id){

        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/http/controllers/eucompronline-fa251-firebase-adminsdk-7tj8d-198bfdc8b7.json');
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->create();

        $database = $firebase->getDatabase();

        $conversas = $database->getReference('message');

        $ref[] = $conversas->getValue();

        $arrayconversa = json_decode(json_encode($ref,true));
        $chat = [];
        $ids = Chat::where('ID_ATACADISTA', $id)->orwhere('ID_ANUNCIANTE', $id)->select('ID_COLATION')->get();

        foreach ($ids as $key => $value){
            //dd();

            $pieces = explode("_", $value->ID_COLATION);


            if((intval($pieces['0']) == $id)||(intval($pieces['1']) == $id)){

                if(intval($pieces['0']) == $id){

                    $usuario = User::userdetail($pieces['1']);

                }else{

                    $usuario = User::userdetail($pieces['0']);
                }
                
                if(count($usuario) > 0){
                    $array = end($ref['0'][$value->ID_COLATION]);
                    //count($array);
//                    if($ref['0'][$key][$id] == 0){
                    $menssagem = $array['chatMessage'];
                    $time = $array['timestamp'];
                    date_default_timezone_set("america/sao_paulo");

                    if(date('Y-m-d', $time/1000) ==  date('Y-m-d')){
                        $data = "hoje";
                    }else{
                        $data = date('d-m-y', $time/1000);
                        $data = str_replace("-", "/", $data);
                    }
                   
                    $chat[] = [

                        'usuarioId' => $usuario['0']->ID_ANUNCIANTE,
                        'nome'=>  $usuario['0']->DS_NOME,
                        'foto' =>  "/eucomproonline/images/usuarios/".$usuario['0']->ID_ANUNCIANTE.'/'.$usuario['0']->DS_FOTO_COMPRADOR,
                        'colletctionId' => $value->ID_COLATION,
                        'mensagem' => $menssagem,
                        'dataMensagem' => $data,
                        'usuarioLogin' => "".$id,
                        'avaliacao' =>$usuario['0']->avaliacao
                    ];
                }
            }
        }

        $horario = array();
        foreach ($chat as $key => $row)
        {
            $horario[$key] = $row['dataMensagem'];

        }
        array_multisort($horario, SORT_DESC, $chat);

        if(count($chat) == 0 ){
            $chat[] = [
                'menssagem' =>  "sem conversa",
                'usuarioLogin' => "".$id,
            ];
        }

        return $chat;
    }

    public static function findByidApp($id){

        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/http/controllers/eucompronline-fa251-firebase-adminsdk-7tj8d-198bfdc8b7.json');
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->create();

        $database = $firebase->getDatabase();

        $conversas = $database->getReference('message');

        $ref[] = $conversas->getValue();

        $arrayconversa = json_decode(json_encode($ref,true));
        $chat = [];
        $ids = Chat::where('ID_ATACADISTA', $id)->orwhere('ID_ANUNCIANTE', $id)->select('ID_COLATION')->get();

        foreach ($ids as $key => $value){
            //dd();
            //dd($key);
            $pieces = explode("_", $value->ID_COLATION);


            if((intval($pieces['0']) == $id)||(intval($pieces['1']) == $id)){

                if(intval($pieces['0']) == $id){

                    $usuario = User::userdetail($pieces['1']);

                }else{

                    $usuario = User::userdetail($pieces['0']);
                }

                if(count($usuario) > 0){
                    $array = end($ref['0'][$value->ID_COLATION]);


//                    if($ref['0'][$key][$id] == 0){
                    $menssagem = $array['chatMessage'];
                    $time = $array['timestamp'];
                    date_default_timezone_set("america/sao_paulo");

                    $chat[] = [

                        'usuarioId' => $usuario['0']->ID_ANUNCIANTE,
                        'nome'=>  $usuario['0']->DS_NOME,
                        'foto' =>  "http://eucompro.online/eucomproonline/images/usuarios/".$usuario['0']->ID_ANUNCIANTE.'/'.$usuario['0']->DS_FOTO_COMPRADOR,
                        'colletctionId' => $value->ID_COLATION,
                        'mensagem' => $menssagem,
                        'dataMensagem' =>  $data = date('H:m', $time/1000),
                        'usuarioLogin' => "".$id
                    ];
                }
            }
        }

        $horario = array();
        foreach ($chat as $key => $row)
        {
            $horario[$key] = $row['dataMensagem'];

        }
        array_multisort($horario, SORT_DESC, $chat);

        if(count($chat) == 0 ){
            $chat = [
                'menssagem' =>  "sem conversa",
                'usuarioLogin' => "".$id,
            ];
        }

        return $chat;
    }

    public static function findByidpage($id){

        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/http/controllers/eucompronline-fa251-firebase-adminsdk-7tj8d-198bfdc8b7.json');
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->create();

        $database = $firebase->getDatabase();

        $conversas = $database->getReference('message');

        $ref[] = $conversas->getValue();

        $arrayconversa = json_decode(json_encode($ref,true));
        $chat = [];

        foreach ($arrayconversa['0'] as $key => $value){

            $pieces = explode("_", $key);

            if(($pieces['0'] == $id)||($pieces['1'] == $id)){

                if(intval($pieces['0']) != $id){

                    $usuario = User::userdetail($pieces['0']);
                }else{
                    $usuario = User::userdetail($pieces['1']);
                }

                if(count($usuario) > 0){
                    $array = end($ref['0'][$key]);

//                    if($ref['0'][$key][$id] == 0){
                    $menssagem = $array['chatMessage'];
                    $time = $array['timestamp'];
                    date_default_timezone_set("america/sao_paulo");

                    $chat[] = [

                       // 'usuarioId' => $usuario['0']->ID_ANUNCIANTE_LARAVEL,
                        'nome'=>  $usuario['0']->DS_NOME,
                        'foto' =>  $usuario['0']->DS_FOTO_COMPRADOR,
                        'colletctionId' => $key,
                        'mensagem' => $menssagem,
                        'dataMensagem' => date('Y-m-d H:i:s', $time/1000),
                        'usuarioLogin' => "".$id
                    ];
                }
            }
        }

        $horario = array();
        foreach ($chat as $key => $row)
        {
            $horario[$key] = $row['dataMensagem'];

        }
        array_multisort($horario, SORT_DESC, $chat);


        if(count($chat) == 0 ){
            $chat[] = [
                'menssagem' =>  "sem conversa",
                'usuarioLogin' => "".$id,
            ];
        }

        return $chat;
    }

    public static function remove($id){
        try {

            Chat::where('ID_COLATION',$id)->delete();

            $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/http/controllers/eucompronline-fa251-firebase-adminsdk-7tj8d-198bfdc8b7.json');
            $firebase = (new Factory)
                ->withServiceAccount($serviceAccount)
                ->create();

            $database = $firebase->getDatabase();

            $conversas = $database->getReference('message')->getChild($id)->remove();
            $conversas = 1;
        } catch (Exception $e) {
            $conversas = 0;
        }
        return $conversas;
    }

    public static function addchat($input){

        $anuciante = Anunciante::select('DS_FOTO_COMPRADOR','DS_NOME')->where('ID_ANUNCIANTE',$input[0])->first();
        if($anuciante->DS_FOTO_COMPRADOR === null){
            $anuciante->DS_FOTO_COMPRADOR = 'null';
        }
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/http/controllers/eucompronline-fa251-firebase-adminsdk-7tj8d-198bfdc8b7.json');
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->create();

        $database = $firebase->getDatabase();

        $conversas = $database->getReference('users/'.$input[0])->update([
            'name' => $anuciante->DS_NOME,
            'profilePicture' => 'http://eucompro.online/eucomproonline/images\usuarios\\'.$input[0].'\\'.$anuciante->DS_FOTO_COMPRADOR
        ]);

        $chat = DB::table('TB_CHAT')
            ->insert([
                'ID_ANUNCIANTE' => $input[1]
                ,'ID_ATACADISTA'  => $input[0]
                ,'ID_ANUNCIO_PRODUTO'  => $input[3]
                ,'ID_COLATION'  => $input[2]
            ]);
        }

    public static function addchatApp($input){

        $chat = DB::table('TB_CHAT')
            ->insert([
                'ID_ANUNCIANTE' => $input->AnuncianteId
                ,'ID_ATACADISTA'  => $input->atacadistaId
                ,'ID_ANUNCIO_PRODUTO'  => $input->anucioId
                ,'ID_COLATION'  => $input->colationId
            ]);
    }

    public static function notification($request,$receiver,$user, $chatMessage,$senderId ){

        //require_once 'C:\xampp\htdocs\testeNotif\vendor\autoload.php';
        require_once 'C:\Inetpub\vhosts\myappnow.com.br\eucompro.online\eucomproonline_conf\vendor\autoload.php';
        //C:\Inetpub\\vhosts\myappnow.com.br\\eucompro.online\\eucomproonline\\
        $channelName = 'news';
        $recipient= $receiver->DS_TOKEN;

        // You can quickly bootup an expo instance
        $expo = \ExponentPhpSDK\Expo::normalSetup();

        // Subscribe the recipient to the server
        $expo->subscribe($channelName, $recipient);

        // Build the notification data
        $notification = [
            'title' => $user->DS_NOME, // nome do user
            'body' => $chatMessage,   // mensagem
            'data' => [
                'message' => $request, //objeto referente à mensagem armazenada no
                'senderUser' => [  //que deve ser um objeto contendo name e profilePicture (URL)
                    'name' => $user->DS_NOME,
                    'profilePicture' => 'http://eucompro.online/eucomproonline/images/usuarios/'.$senderId.'/'.$user->DS_FOTO_COMPRADOR
                ]
            ]
        ];

        // Notify an interest with a notification
        try {
            $expo->notify([$channelName], $notification, false);
            return (1);
        } catch (ExpoException $e) {
            return (0);
        } catch (UnexpectedResponseException $e) {
            return (0);
        }

    }

    public static function notificationweb(){

        $messaging = app('firebase.messaging');


        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/http/controllers/eucompronline-fa251-firebase-adminsdk-7tj8d-198bfdc8b7.json');
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->create();

        $database = $firebase->getDatabase();

        $conversas = $database->getReference('message');
        dd($conversas->getValue());

        $message = CloudMessage::withTarget('token','123456')
            ->withNotification(Notification::create('Title', 'Body'))
            ->withData(['key' => 'teste']);

        //$messaging->send($message);
    }


}
