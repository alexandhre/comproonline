<?php

namespace App\Http\Controllers;

use App\Anunciante;
use App\Categoria;
use App\Endereco;
use App\Favorito;
use App\Produto;
use App\User;
use App\Usuario;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Notifications\EmailValidade;
use Illuminate\Support\Facades\DB;
use App\Helpers\HelperAnuncio;

//use  Tymon\JWTAuth\JWTAuth;
class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @var JWTAuth
     */
//    private $jwtAuth;
//
//    public function __construct(JWTAuth $jwtAuth){
//
//        $this->jwtAuth = $jwtAuth;
//    }


    public function index()
    {


        if((key_exists('email',session()->all()))){

            $listaUsers = User::userdetail(session()->all()['id']);
            //$listaUsers = User::userdetail(Auth::User()->id);

            return $listaUsers;

        }else{
            return view('auth.login');
        }
    }
    public function favoritoPage()
    {
        if(!(key_exists('email',session()->all()))){
            $categorias = Categoria::listAll();
            $show = 1;
            return view('usuario.favoritos', compact(['categorias','show']));
        }else{
            $listaUsers = Favorito::favoritoList(session()->all()['id']);
            $show = 0;
            return view('usuario.favoritos',compact(['show','listaUsers']));
        }
    }
    public function favoritoList()
    {

        $listaUsers = Favorito::favoritoList(session()->all()['id']);
        return $listaUsers;
    }

    public function perfilPage()
    {
        if(!(key_exists('email',session()->all()))){
            $categorias = Categoria::listAll();
            $show = 1;

            return view('usuario.perfil', compact(['categorias','show']));
        }else{

            $show = 0;
            return view('usuario.perfil',compact(['show']));
        }
    }

    public function meuAnunciosPage()
    {
        if(!(key_exists('email',session()->all()))){
            $categorias = Categoria::listAll();
            $show = 1;

            return view('usuario.meusAnuncios', compact(['categorias','show']));
        }else{

            $show = 0;
            return view('usuario.meusAnuncios',compact(['show']));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {

        $user = $request->input;

        $id = session()->all()['id'];

        $response = Anunciante::updateByIdWeb($user, $id);
        return $response;
    }
        //update foto Usuario Temporaria
    public function uploadFotoUsuario(Request $request){

        $destinationPath = ("images\\resource\\tmp\\usuario\\");
        // $destinationPath = ("C:\Inetpub\\vhosts\myappnow.com.br\\eucompro.online\\eucomproonline\\images\\resource\\tmp\\usuario\\");


        if($request->has('myFile')){
            $image = $request->file('myFile');
            
            $name = $_FILES['myFile']['name'];

            $extension = $_FILES['myFile']['type'];

            $launch = explode("/", $extension);

            $form = end($launch);
            $name = $name.'.'.$form;


            //$image->move($destinationPath, $name.'.'.$form);
            if(move_uploaded_file($image, $destinationPath.$name)){
                $success = [
                    'successId' => 200,
                    'successMessage' => 'Imagem salva com sucesso!'
                ];
                $response = [
                    'success' =>$success

                ];
            }else{
                $error = [
                    'errorId' => 500,
                    'errorMessage' => 'arquivo nao foi pode ser enviado'
                ];
                $response = [
                    'error' => $request
                ];
            }


        }else{
            $error = [
                'errorId' => 500,
                'errorMessage' => 'arquivo nao existe'
            ];
            $response = [
                'error' => $request
            ];
        }

        return response()->json(compact('response'));



//        if($request->hasFile('myFile')){
//
//            $image = $request->file('myFile');
//
//            $name = $image->getClientOriginalName();
//            $destinationPath = ("C:\Inetpub\\vhosts\myappnow.com.br\\eucompro.online\\eucomproonline\\images\\resource\\tmp\\usuario");
//
//
//            $image->move($destinationPath, $name);
//
//            $success = [
//                'successId' => 200,
//                'successMessage' => 'Imagem salva com sucesso!'
//            ];
//            $response = [
//                'success' => $success
//            ];
//            $response = $image->getClientOriginalName();
//
//        }else{
//            $error = [
//                'errorId' => 500,
//                'errorMessage' => 'arquivo nao existe'
//            ];
//            $response = [
//                'error' => $error
//            ];
//        }

//        return response()->json(compact('response'));
    }

    public function uploadFotoUsuarioWeb(Request $request){

        if($request->has('myFile')){
            $image = $request->file('myFile');
//
            $name = $image->getClientOriginalName();
            $destinationPath = ("C:\Inetpub\\vhosts\myappnow.com.br\\eucompro.online\\eucomproonline\\images\\resource\\tmp\\usuario");


            $image->move($destinationPath, $name);


            $success = [
                'successId' => 200,
                'successMessage' => 'Imagem salva com sucesso!'
            ];
            $response = [
                'success' => $success

            ];

        }else{
            $error = [
                'errorId' => 500,
                'errorMessage' => 'arquivo nao existe'
            ];
            $response = [
                'error' => $request
            ];
        }

        return response()->json(compact('response'));



//        if($request->hasFile('myFile')){
//
//            $image = $request->file('myFile');
//
//            $name = $image->getClientOriginalName();
//            $destinationPath = ("C:\Inetpub\\vhosts\myappnow.com.br\\eucompro.online\\eucomproonline\\images\\resource\\tmp\\usuario");
//
//
//            $image->move($destinationPath, $name);
//
//            $success = [
//                'successId' => 200,
//                'successMessage' => 'Imagem salva com sucesso!'
//            ];
//            $response = [
//                'success' => $success
//            ];
//            $response = $image->getClientOriginalName();
//
//        }else{
//            $error = [
//                'errorId' => 500,
//                'errorMessage' => 'arquivo nao existe'
//            ];
//            $response = [
//                'error' => $error
//            ];
//        }

//        return response()->json(compact('response'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function verificacao($id){

        try {
            User::verificacao($id);
            $categorias = Categoria::listAll();
            $show = 1;
            $validacao =1;
            return view('index', compact(['categorias','show','validacao']));
        } catch (Exception $e) {
            return "falha na verificação";
        }
    }
    public function novasenha(){

        $categorias = Categoria::listAll();
        $show = 0;
        return view('auth.passwords.novasenha', compact(['categorias','show']));
    }

    public function UsuarioChatInfo($id_anuncio){
            $usuario = User::userchat($id_anuncio);

        return $usuario;
    }

    public function validar(){
        $show = 0;
        return view('auth.passwords.validacao', compact('show'));

    }

    //API MOBILE
    public function register(Request $request){
        $json = $request->all();
        //converte json em tipo data
        $data = json_decode(json_encode($json['request']['usuario'],true));

        //cria array de credenciais para validacao
        $credentials = [
            'name' => $data->nome,
            'email' => $data->email,
            'password' => $data->senha,
        ];

        $usuario = User::where('DS_EMAIL', $credentials['email'])->first();

        if(count($usuario)>=1){


            $error = [
                'errorId' => 500,
                'errorMessage' => 'Usuário já autenticado no sistema!'
            ];

            $response = [
                'error' => $error
            ];
            return response()->json(compact('response'),200);
        }else{

//            $user = User::create([
//                'name' => $credentials['name'],
//                'email' => $credentials['email'],
//                'password' => Hash::make($credentials['password']),
//            ]);
//
//            $user_mail = User::where('email', $user->email)->first();

            $usuario = Usuario::insert([
                'DS_NOME' => $credentials['name'],
                'DS_EMAIL' => $credentials['email'],
                'DS_LOGIN' => $credentials['email'],
                'DS_SENHA' => Hash::make($credentials['password']),
                'DT_CADASTRO' => $data = date('Y-m-d H:i:s')
              //  'ID_ANUNCIANTE_LARAVEL' => $user->id,
            ]);
            $usuario = User::where('DS_EMAIL', $credentials['email'])->first();

            $biarro = Endereco::insert([
                'ID_USUARIO' => $usuario->ID_ANUNCIANTE
                ,'ID_CIDADE' => 0

            ]);

            $biarro = Endereco::where('ID_USUARIO', $usuario->ID_ANUNCIANTE)->limit(1)->orderBy('ID_USUARIO','desc')->get();

            $update = DB::table('TB_ANUNCIANTE')
                ->where('ID_ANUNCIANTE',$usuario->ID_ANUNCIANTE)
                ->update([
                    'ID_BAIRRO' => $biarro['0']->ID_BAIRRO
                ]);

            //EMAIL DE VALIDACAO
            if ($usuario) {
//                try {
//                    $invitedUser = new User;
//                    $invitedUser->email = $credentials['email'];
//
//                    $invitedUser->notify(
//                        new EmailValidade($usuario->ID_ANUNCIANTE)
//                    );
//
//
//                } catch (Exception $e) {
//                    $error = [
//                        'errorMessage' => 'Falha ao enviar email de verificação'
//                    ];
//                    $response = [
//                        'error' => $error
//                    ];
//                    return response()->json(compact('response'),200);
//                }

                $success = [
                    'successId' => 200,
                    'successMessage' => 'Usuário cadastrado com sucesso!'
                ];
                $response = [
                    'success' => $success
                ];
                return response()->json(compact('response'),200);
            }else{
                $error = [
                    'errorId' => 404,
                    'errorMessage' => 'O serviço requisitado não existe ou está fora do ar  Tente novamente mais tarde!.'
                ];
                $response = [
                    'error' => $error
                ];
                return response()->json(compact('response'),404);
            }

        }
    }

    public function login(Request $request)
    {
        // grab credentials from the request
        $json = $request->all();
        //$data =  JSON::convertJSONToWeb($json);

        //converte json em tipo data

        $data = json_decode(json_encode($json['request'],true));

        //cria array de credenciais para validacao
        $credentials = [
            'email' => $data->email,
            'password' => $data->password,
            'expoToken' => $data->token
        ];

        $user = User::validacao($credentials['email']);

        //dd($user[0]->DS_VALIDACAO);

        if(1 == 1){

            // Get user by email
            $company = User::where('DS_EMAIL', $credentials['email'])->first();

            // Validate Company
            if(!$company) {
                $error = [
                    'errorId' => 404,
                    'errorMessage' => 'usuário inexistente'
                ];
                $response = [
                    'error' => $error
                ];
                return response()->json(compact('response'));
            }

            // Validate Password
            if (!Hash::check($credentials['password'], $company->DS_SENHA)) {

                $error = [
                    'errorId' => 500,
                    'errorMessage' => 'usuário ou senha errada'
                ];
                $response = [
                    'error' => $error
                ];
                return response()->json(compact('response'), 200);
            }else{

                $toke = User::where('DS_EMAIL', $credentials['email'])->update(['DS_TOKEN' => $credentials['expoToken']]);

                if($toke == 1) {


                    // Generate Token
                    $token = JWTAuth::fromUser($company);

                    // Get expiration time
                    $objectToken = JWTAuth::setToken($token);

                    $expiration = JWTAuth::decode($objectToken->getToken())->get('exp');

                    //criacao da data e array de autenticacao
                    $data = date('Y-m-d H:i:s');
                    $authentication = array('token' => $token, 'creationDate' => date('Y-m-d H:i:s', strtotime('-2 hour', strtotime($data))), 'validTime' => date('Y-m-d H:i:s', strtotime('+2 day', strtotime($data))));


                    $user = User::usuario($company->ID_ANUNCIANTE);

                    if ($user['0']->DS_FOTO_COMPRADOR != null)
                        $user['0']->DS_FOTO_COMPRADOR = 'http://eucompro.online/eucomproonline/images/usuarios/' . $user['0']->ID_ANUNCIANTE . '/' . $user['0']->DS_FOTO_COMPRADOR;

                    $response = [
                        'authentication' => $authentication,
                        'usuario' => $user['0']
                    ];
                    return response()->json(compact('response'));
                }else{
                    $error = [
                        'errorId' => 500,
                        'errorMessage' => 'Não foi possivel atualizar o token'
                    ];
                    $response = [
                        'error' => $error
                    ];

                    return response()->json(compact('response'));
                }
            }
        } else{
            $error = [
                'errorId' => 428,
                'errorMessage' => 'Usuário não autenticado'
            ];
            $response = [
                'error' => $error
            ];

            return response()->json(compact('response'));
        }

    }

    public function logout(Request $request){
        // grab credentials from the request
        $json = $request->all();
        //$data =  JSON::convertJSONToWeb($json);

        //converte json em tipo data

        $data = json_decode(json_encode($json['request'],true));

        //cria array de credenciais para validacao
        $credentials = [
            'email' => $data->email,
        ];

        $toke = User::where('DS_EMAIL', $credentials['email'])->update(['DS_TOKEN' => NULL]);

        if($toke == 1){
            $data = [
                'sucessId' => 200,
                'sucessMessage' => 'token deletado!'
            ];
            $response = [
                'sucess' => $data
            ];

            return response()->json(compact('response'));
        }else{
            $error = [
                'errorId' => 500,
                'errorMessage' => 'Não foi possivel deletar token'
            ];
            $response = [
                'error' => $error
            ];

            return response()->json(compact('response'));
        }

    }

    public function updateApi(Request $request){
        $json = $request->all();

        $data = json_decode(json_encode($json['request']['usuario'],true));

        //implementar updateById
        $response = Anunciante::updateById($data);

        //implementar updateById
//        $response = Atacadista::updateById($data);

        if($response == 0){
            $error = [
                'errorId' => 500,
                'Message' => 'Erro ao atualizar dados'
            ];
            $response = [
                'error' => $error
            ];
            return response()->json(compact('response'));

        }else{

            $sucess = [
                'sucessId' => 200,
                'sucessMessage' => 'Dados atualizados com sucesso'
            ];
            $response = [
                'sucess' => $sucess
            ];
            return response()->json(compact('response'));
        }

    }

    public function addFavoritoApp($idAnuncio, $id){

        $favorito = Produto::favoritosAdd(intval($idAnuncio), intval($id));
         $response = [
             'success' => $favorito
         ];
         return response()->json(compact('response'),200);

    }

    public function favoritoListApp($id)
    {

        $listaUsers = Favorito::favoritoList($id);
        foreach ($listaUsers as $item){            
            $item->foto = HelperAnuncio::checkExistsImage($item->ID_ANUNCIO_PRODUTO, $item->foto);
        }
        $response = [
            'favoritos' => $listaUsers
        ];
        return response()->json(compact('response'),200);

    }

    public function cidades(){
           $cidades = User::listcidade();

           $response=[
               "cidades" => $cidades
           ];

        return response()->json(compact('response'),200);
    }

//    public function refresh(){
//
//        $token = $this->jwtAuth->getToken();
//        $token = $this->jwtAuth->refresh($token);
//
//        return response()->json(compact('token'));
//    }
//
//    public function logout(){
//        $token = $this->jwtAuth->getToken();
//        $this->jwtAuth->invalidate($token);
//
//        return response()->json(['logout']);
//    }

}
