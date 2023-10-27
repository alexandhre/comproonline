<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function initial()
    {

        return redirect()->route('home');
    }
    public function index()
    {

        $categorias = Categoria::listAll();
        $show = 0;

        return view ('index', compact(['categorias','show']));
    }


        //listar todas as categorias para a página categoria
    public function showAll(){

        $currentPath= Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';

        if (preg_match($pattern, $currentPath)) {
            $categorias = Categoria::listAll();
            foreach ($categorias as $item){
                $item->DS_FOTO_CATEGORIA_PRODUTO = 'http://eucompro.online/eucomproonline/css/img/categorias/'.$item->DS_FOTO_CATEGORIA_PRODUTO;

            }
            $response=[
                'categorias' =>  $categorias,
            ];

            return response()->json(compact('response'));

        }else {

            $AllCategorias = Categoria::listAll();
            foreach ($AllCategorias as $item){
                $item->DS_FOTO_CATEGORIA_PRODUTO = 'http://eucompro.online/eucomproonline/css/img/categorias/'.$item->DS_FOTO_CATEGORIA_PRODUTO;

            }
            $show = 0;
            return view('categoria.categorias', compact(['AllCategorias', 'show']));
        }
    }

    //top 5 categoria
    public function topCategoria(){
        $categorias = Categoria::topcategoria();

        foreach($categorias as $item){
            $item->DS_FOTO_CATEGORIA_PRODUTO = 'http://eucompro.online/eucomproonline/css/img/categorias/'.$item->DS_FOTO_CATEGORIA_PRODUTO;
        }

        $response=[
            'categorias' =>  $categorias,
        ];

        return response()->json(compact('response'));
    }

    //top add visita categoria
    public function viewCategoria($cat){
        $categorias = Categoria::addviewcategoria($cat);
        if($categorias = 1){
            $response=[
                'categorias' =>  'visualização contada',
            ];
        }else{
            $response=[
                'categorias' =>  'Erro ao contar visualização',
            ];
        }


        return response()->json(compact('response'));
    }

        //listar 4 categorias para a página como funciona
    public function showComoFunciona(){
        $showComoFunciona = Categoria::list4Categorias();
        $show = 0;
        return view('comofunciona', compact(['showComoFunciona','show']));
    }

        //listar categoria menu
    public function menucategoria(){
       // $categoria = Categoria::listAll();

        $currentPath= Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';

        if (preg_match($pattern, $currentPath)) {
            $categoria = Categoria::listAll();

            $response=[
                'categorias' =>  $categoria,
            ];

            return response()->json(compact('response'));

        }else{

            $categoria = Categoria::listAll();

            return $categoria;
        }

        //return $categoria;
    }

        //listar tipo categoria
    public function tipoCategoria($id){
            if((key_exists('email',session()->all()))){
            $categoria = Produto::listByCategoria($id, session()->all()['id']);

            }else{
            $categoria = Produto::listByCategoria($id, 0);

        }
        $show = 0;
        return view('categoria.tipocategoria', compact(['categoria', 'show']));

    }

    public function tipoCategoriaApp($id, $user){

            $produtos = Produto::listByCategoria($id, $user);

            foreach ($produtos as $item){
                if($item->foto != null){
                    $item->foto = 'http://eucompro.online/eucomproonline/images/anuncios/'.$item->ID_ANUNCIO_PRODUTO.'/'.$item->foto;
                }
            }


            $response=[
                'produtos' =>  $produtos,
            ];

            return response()->json(compact('response'));


    }

    //showMore Produtos
    public function showMore($id, $inicio){
        if((key_exists('email',session()->all()))){

            $categoria = Produto::ShowMoreyCategoria($id, $inicio, session()->all()['id']);

        }else{

            $categoria = Produto::ShowMoreyCategoria($id, $inicio, 0);


        }


        return $categoria;

    }

    //categoria Page
    public function CategoriaPage(){

        $show = 0;
        return view('categoria.categorias',compact(['show']));
    }

    //listar categorias Mobile para a página como funciona
    public function CategoriaApp(){
        $showComoFunciona = Categoria::tipoCategoriasApp();
        $show = 0;
        return view('comofunciona', compact(['showComoFunciona','show']));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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



}
