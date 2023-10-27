<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\FotoAnuncio;
use App\Preco;
use App\Produto;
use App\User;
use App\Visita;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Filesystem\Filesystem;
use App\Helpers\HelperAnuncio;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function showProdutos(){
            if((key_exists('email',session()->all()))){

                $showProdutos = Produto::AnunciosVisited(session()->all()['id']);
                //$showProdutos[] = 0;
                if( count($showProdutos)  == 0){
                    $showProdutos = Produto::allAnuncios(session()->all()['id']);

                }
                return $showProdutos;

            }else{

                $showProdutos = Produto::allAnuncios(0);

                return $showProdutos;
            }

    }

    public function showProdutosApp($user){           
            $anuncios = Produto::allAnuncios($user);
            foreach($anuncios as $item){
                $item->foto = HelperAnuncio::checkExistsImage($item->ID_ANUNCIO_PRODUTO, $item->foto);
            }
            $response =[
                'produtos' => $anuncios
            ];
            return response()->json(compact('response'));
    }
    public function showMoreProdutosApp($user, $qtSkip){

        $anuncios = Produto::MoreAnuncios($user, $qtSkip);

        foreach($anuncios as $item){
            $item->foto = 'http://eucompro.online/eucomproonline/images/anuncios/'.$item->ID_ANUNCIO_PRODUTO.'/'.$item->foto;

        }

        $response =[
            'produtos' => $anuncios
        ];
        return response()->json(compact('response'));
    }

    public function showMyProdutos(){

        $showProdutos = Produto::listMy(session()->all()['id']);

        return $showProdutos;
    }
    public function showMyProdutosApp($id){

        $anuncios = Produto::listMy($id);
        foreach($anuncios as $item){
            $item->foto = 'http://eucompro.online/eucomproonline/images/anuncios/'.$item->ID_ANUNCIO_PRODUTO.'/'.$item->foto;

        }

        $response =[
            'produtos' => $anuncios
        ];
        return response()->json(compact('response'));
    }
    public function showMyOtherProdutos($id){

        $showProdutos = Produto::otherAnuncios($id);

        return $showProdutos;
    }
    public function showMyProdutospage(){


        if(!key_exists('email',session()->all())){
            $categorias = Categoria::listAll();
            $show = 1;
            return view('usuario.favoritos', compact(['categorias','show']));
        }else{

            $show = 0;
            return view('usuario.meusanuncios',compact(['show']));
        }

    }
    public function subirPage(){


        if(!key_exists('email',session()->all())){
            $categorias = Categoria::listAll();
            $show = 1;
            return view('produto.subirProduto', compact(['categorias','show']));
        }else{

            $show = 0;
            return view('produto.subirProduto',compact(['show']));
        }

    }

    public function addFavorito($idAnuncio){
        if(!key_exists('email',session()->all())) {
            return -1;
        }else{
            //$id = User::getId(session()->all()->id);

            $favorito = Produto::favoritosAdd(intval($idAnuncio), intval(session()->all()['id']));
            return $favorito;

        }
    }

    public function detalhePage(){
            $show = 0;
            return view('produto.detalhe',compact(['usuario','show']));

    }
    public function detalhe($id){

            $showProdutos = Produto::GetAnuncio($id);

            return $showProdutos;

    }
    public function detalheApp($id, $idUser){


            $produto = Produto::GetAnuncioApp($id,$idUser);

            $response=[
                'produto' =>  $produto[0],
            ];

            return response()->json(compact('response'));

    }

    public function uploadfotoWeb(Request $request){

        if ($request->hasFile('myFile')) {
            $image = $request->file('myFile');

            $destinationPath = ("images\\resource\\tmp\\anuncios");

            $name = $image->getClientOriginalName();

            $image->move($destinationPath, $name);
            $sucess = $name;
        }else{
            $sucess  = "erro";
        }

        return $sucess;
    }
    public function uploadfotoApp(Request $request){

        $destinationPath = ("images\\resource\\tmp\\anuncios\\");

       
        if($request->has('myFile')){
            $image = $request->file('myFile');
           
            $name = $_FILES['myFile']['name'];

            $extension = $_FILES['myFile']['type'];

            $launch = explode("/", $extension);

            $form = end($launch);
            //$name = $name.'.'.$form;

            
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
//        if ($request->hasFile('myFile')) {
//            $image = $request->file('myFile');
//
//            $destinationPath = ("images\\resource\\tmp\\anuncios");
//
//            $name = $image->getClientOriginalName();
//
//            $image->move($destinationPath, $name);
//            $sucess = "OK";
//        }else{
//            $sucess  = "erro";
//        }

        //return $sucess;
    }

    //listar categoria menu
    public function tipoProd(Request $cat){
        $currentPath= Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';

        if (preg_match($pattern, $currentPath)) {
            $cat= $cat['request']['categoria'];

            $categorias = Categoria::listaProduto($cat);

            $response=[
                'categorias' =>  $categorias,
            ];

            return response()->json(compact('response'));

        }else {
            $categoria = Categoria::listaProduto($cat->cat);
            return $categoria;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
    $data = json_decode(json_encode($request->input, true));

    $produto = Produto::novoProduto($data);


     $pieces = explode("R$", $data[2]);
     $data[2] = $pieces[1];
     $data[2] = str_replace(",", ".", $data[2]);

    $preco = Preco::novo($data);

     $id = session()->all()['id'];
    $anuncio = Produto::novoAnuncio($data,$produto,$preco, $id);

    if ($data[5]) {
        foreach ($data[5] as $item => $i) {

            $extencao = explode(".",$i);
            $extencao = end($extencao);
            
            $novafoto = "photoanuncio".substr(md5(rand(600000 , 12000000)), 0,8).".". $extencao;

            $newPath = ("C:\Inetpub\\vhosts\myappnow.com.br\\eucompro.online\\eucomproonline\\images\\anuncios\\" . $anuncio[0]->id);
            $oldPath = ("images\\resource\\tmp\\anuncios\\" . $i);

            if (!file_exists($newPath)) {
                mkdir($newPath, 0777, true);
                chmod($newPath, 0777);
            }

            //adicionar pasta usuario

            if (\File::moveDirectory($oldPath, "C:\Inetpub\\vhosts\myappnow.com.br\\eucompro.online\\eucomproonline\\images\\anuncios\\" .  $anuncio[0]->id. '\\' .  $novafoto)) {
                $foto = FotoAnuncio::updatefoto( $anuncio[0]->id,  $novafoto);

                $success = [
                    'successId' => 200,
                    'successMessage' => 'Anuncio cadastrado com sucesso!'
                ];
                $response = [
                    'success' => $success
                ];

            }
        }
    }
    return $anuncio[0]->id;
}
    public function createApp(Request $request){
        $json = $request->all();
        //converte json em tipo data
        $json = json_decode(json_encode($json['request']['anuncio'],true));

        $data =  array(
            $json->nome,
            $json->descricao,
            $json->preco,
            $json->categoria,
            $json->subcategoria,
            $json->fotos,
        );
       
        foreach ($data[5] as $item => $i) {
            $oldPath = ("images/resource/tmp/anuncios/" . $i);
            if(!file_exists($oldPath)){
                $error = [
                    'errorId' => 404,
                    'errorMessage' => 'erro ao encontrar imagem ' . $i
                ];
                $response = [
                    'error' => $error
                ];
                return response()->json(compact('response'));
            }
           
        }
       
        $produto = Produto::novoProduto($data);

        $preco = Preco::novo($data);

        $anuncio = Produto::novoAnuncio($data,$produto,$preco,$json->usuarioId);

        if ($data[5]) {
            foreach ($data[5] as $item => $i) {

                $newPath = ("images/anuncios/" . $anuncio[0]->id);

                $oldPath = ("images/resource/tmp/anuncios/" . $i);

                if (!file_exists($newPath)) {
                    mkdir($newPath, 0777, true);
                    chmod($newPath, 0777);
                }
                $file = new Filesystem();
                //adicionar pasta usuario
                $launch = explode(".", $i);
                $form = end($launch);
                $string = substr(md5(rand(600000, 12000000)), 0, 4);
                $foto = "photo" . $string . "." . $form;

                    if ($file->moveDirectory("images/resource/tmp/anuncios/" . $i, "images/anuncios/".$anuncio[0]->id. '/' . $foto)) {
                       $foto = FotoAnuncio::updatefoto($anuncio[0]->id, $foto);

                        $success = [
                            'successId' => 200,
                            'successMessage' => 'imagem cadastrada com sucesso!'
                        ];
                        $response = [
                            'success' => $success
                        ];

                    } else {
                        $error = [
                            'errorId' => 500,
                            'errorMessage' => 'erro ao cadastrar imagem ' . $i
                        ];
                        $response = [
                            'error' => $error
                        ];
                        return response()->json(compact('response'));
                    }
                }
            }
            
        if($anuncio[0]->id){
            $success = [
            'anuncioId' => $anuncio[0]->id,
            'successMessage' => 'anuncio salvo com sucesso'
            ];
            $response = [
                'success' => $success
            ];

        }else{
            $error = [
                'errorId' => 500,
                'errorMessage' => 'erro ao cadastrar anuncio'
            ];
            $response = [
                'error' => $error
            ];
        }

        return response()->json(compact('response'));
    }
    public function ComoFunciona(){
        $show = 0;
        $categorias = Categoria::listAll();
        return view('categoria.funcionamento', compact('show','categorias'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        if(!key_exists('email',session()->all())){
            $categorias = Categoria::listAll();
            $show = 1;
            return view('produto.editar',compact(['show']));
        }else{

            $show = 0;
            return view('produto.editar',compact(['show']));
        }

    }
    public function editar($id)
    {
        $showProdutos = Produto::GetAnuncio($id);

        return $showProdutos;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $data = json_decode(json_encode($request->input, true));

        $pieces = explode(" ", $data[2]);
        if(count($pieces) > 1){
            $data[2] = str_replace(',', '.', $pieces[1]);
        }

        $idCat = Categoria::getIdTipopoCat($data[4]);
        
        try{

            Preco::join('TB_ANUNCIO_PRODUTO','TB_TIPO_ANUNCIO.ID_TIPO_ANUNCIO','TB_ANUNCIO_PRODUTO.ID_TIPO_ANUNCIO')
                ->where('TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO', $data[6])
                ->update([
                'DS_TIPO_ANUNCIO' => $data[0]
                ,'VL_TIPO_ANUNCIO' => floatval($data[2])
                ,'DT_DIAS_DURACAO_ANUNCIO' => 1
            ]);
        }catch(\Exception $e){
            return 0;
        }        
        
        try{
          $produto = Produto::where('ID_ANUNCIO_PRODUTO', $data[6])->select('ID_PRODUTO')->first();
            DB::table('TB_PRODUTO')
            ->where('ID_PRODUTO', $produto->ID_PRODUTO)
           ->update([
           'ID_TIPO_PRODUTO' => intval($idCat), 'DS_PRODUTO' => $data[0], 'DS_FOTO_PRODUTO' => $data[5][0]]);
           
         
        }catch(\Exception $e){
            return 0;
        }
        
        try{
            //$id = session()->all()['id'];
            Produto::where('ID_ANUNCIO_PRODUTO', $data[6])->update([
               // ,'ID_PRODUTO' =>$produto
                'DS_ANUNCIO_PRODUTO' =>$data[0]
                ,'DS_DETALHE_PRODUTO' =>$data[1]
                ,'IN_PUBLICAR' =>'1'
                ,'ID_TIPO_PRODUTO' => $idCat
            ]);
        }catch(\Exception $e){
            return 0;
        }

        try{
            $fotos = [];
            $files = glob("images/anuncios/" .  $data[6] . "/*"); // get all file names
           
            foreach ($files as $file) { // iterate files

                $pieces = explode("images/anuncios/" .  $data[6] ."/", $file);
               
                if (!in_array($pieces[1],$data[5])) {
                 
                    array_push($fotos, $pieces[1]);
                    if(unlink($file)){
                        FotoAnuncio::where('DS_FOTO_PRODUTO',$pieces[1])->delete();
                    }
                }
            }

            if ($data[5]) {
                foreach ($data[5] as $item => $i) {

                    $newPath = ("images\\anuncios\\" .$data[6]);
                    $oldPath = ("images\\resource\\tmp\\anuncios\\" . $i);

                    $extencao = explode(".",$i);
                    $extencao = end($extencao);

                    if (!file_exists($newPath)) {
                        mkdir($newPath, 0777, true);
                        chmod($newPath, 0777);
                    }
                    
                   
                    $novafoto = "photoanuncio".substr(md5(rand(600000 , 12000000)), 0,8).".". $extencao;
                    //adicionar pasta usuario

                    if (\File::moveDirectory($oldPath, "images\\anuncios\\" .  $data[6]. '\\' . $novafoto)) {
                        $foto = FotoAnuncio::insert([
                            'ID_ANUNCIO_PRODUTO' => $data[6],
                            'DS_FOTO_PRODUTO' => $novafoto,
                        ]);

                        $success = [
                            'successId' => 200,
                            'successMessage' => 'Anuncio cadastrado com sucesso!'
                        ];
                        $response = [
                            'success' => $success
                        ];

                    }
                }
            }
        }catch(\Exception $e){
            return 0;
        }
        return 1;
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return array
     */
    public function buscar(Request $request){
        $cat = $request->cat;
        $anuncio = [];
        $categoria = DB::table('TB_CATEGORIA_PRODUTO')->where('DS_CATEGORIA_PRODUTO','like','%'.$cat.'%')->select('DS_CATEGORIA_PRODUTO')->get();
        $produtos = DB::table('TB_ANUNCIO_PRODUTO')->where('DS_ANUNCIO_PRODUTO','like','%'.$cat.'%')->select('DS_ANUNCIO_PRODUTO')->get();

        return [$categoria,$produtos];

    }

    public function buscarApi(){

        $produtos = DB::table('TB_ANUNCIO_PRODUTO')
            ->join('TB_TIPO_ANUNCIO','TB_TIPO_ANUNCIO.ID_TIPO_ANUNCIO','TB_ANUNCIO_PRODUTO.ID_TIPO_ANUNCIO')
            ->select('DS_ANUNCIO_PRODUTO','ID_ANUNCIO_PRODUTO','TB_TIPO_ANUNCIO.VL_TIPO_ANUNCIO','DS_DETALHE_PRODUTO')
            ->get();
        foreach ($produtos as $item ) {

            // Remove a virgula do valor
            $value = str_replace(',', '', $item->VL_TIPO_ANUNCIO);

            // Formata usando o numero de casas decimais desejado
            $item->VL_TIPO_ANUNCIO = number_format($value, 2, ',', '.');

            $foto = FotoAnuncio::getfotoAnuncio($item->ID_ANUNCIO_PRODUTO);

            if (count($foto) <= 0) {
                $item->foto = null;
            } else {
                $item->foto =  HelperAnuncio::checkExistsImage($item->ID_ANUNCIO_PRODUTO, $foto['0']->foto);
            }
        }

        $response  = [
          'anuncios' => $produtos
        ];

        return response()->json(compact('response'));



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return array
     */
    public function searchAnuncio($type){

        $categoria = Produto::listByCategoria($type,0);

        $produtos = Produto::searchProduto($type);

        return [$categoria, $produtos];

    }
    public function searchAnunciopage(){
        $show = 0;
        return view('produto.demanda', compact('show' ));

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return array
     */
    public function visita($id){

        if(key_exists('email',session()->all())){

            Visita::novo($id, session()->all()['id']);
        }

        $infoAnuncio = Produto::addvisita($id);
        return $infoAnuncio;
    }

    public function visitaApp($id, $iduser){

        if($iduser != 0){
            Visita::novo($id, $iduser);

            $infoAnuncio = Produto::addvisita($id);

            if( $infoAnuncio == 1){
                $response=[
                    'mensagem' =>  "visualização adicionada",
                ];
            }else{
                $error = [
                    'erroId' => 500,
                    'errorMessage' => 'erro ao adicionar visualização'
                ];

                $response = [
                    'error' => $error
                ];
            }

            return response()->json(compact('response'));
        }


    }

    public function showMore($inicio){

        if(key_exists('email',session()->all())){

            $showProdutos = Produto::listMyMoreAnuncio(session()->all()['id'] , $inicio);

            //dd($showProdutos);
            if(count(Produto::AnunciosVisited(session()->all()['id'])) == 0 && count($showProdutos) == 0){

                 $showProdutos = Produto::listMoreAnuncio($inicio);
            }

            return $showProdutos;

        }else{
            $moreListAnuncio = Produto::listMoreAnuncio($inicio);
            //dd($moreListAnuncio);
            return $moreListAnuncio;
        }

    }

    public function produtobytipoApp(Request $type){

        $cat = $type['request']['categoriaId'];
        $id = $type['request']['userId'];
        $skip = $type['request']['skip'];
       $produtos =  Produto::allAnunciosApp($cat, $id, $skip);

        $response=[
            'produtos' =>  $produtos,
        ];

        return response()->json(compact('response'));

    }

    public function produtoinfo($id){



        $id = Crypt::decrypt($id);
        $ids = DB::table('TB_ANUNCIO_PRODUTO')->where('ID_ANUNCIO_PRODUTO',$id)->select('ID_ANUNCIO_PRODUTO')->get();

        $anuncio =  self::detalhe($ids['0']->ID_ANUNCIO_PRODUTO);

        $show =0;
        $categorias = Categoria::listAll();
        return view('produto.produtosearch', compact(['anuncio','show','categorias']));
    }

    public function delet($id){
        //ADICIONAR VERIFICAÇÂO DE COMPRA DANTE DE DELETAR
        $showProdutos = Produto::Remove( $id);
        if($showProdutos == 1){
            $sucesso = [
                'sucessoId' => 200,
                'sucessoMessage' => 'anuncio removido com sucesso'
            ];

            $response = [
                'sucess' => $sucesso
            ];
        }else{
            $error = [
                'erroId' => 500,
                'errorMessage' => 'não foi possivel remover o anuncio'
            ];

            $response = [
                'error' => $error
            ];
        }

        return response()->json(compact('response'));
    }

}
