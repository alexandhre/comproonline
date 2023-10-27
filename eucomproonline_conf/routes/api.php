<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
//Route::middleware('auth:api')->get('/user', 'UserController@AuthRouteAPI');
Route::middleware('auth:api')->get('/user', 'UsuarioController@AuthRouteAPI');


//Rotas de usuario
$this->group(['prefix' => 'auth/usuario'], function() {
    $this->post('/registrar', 'UsuarioController@register');
    $this->post('/logout', 'UsuarioController@logout');
    $this->get('/listar', 'UsuarioController@listar');
    $this->post('/login', 'UsuarioController@login');
    $this->post('/update', 'UsuarioController@updateApi');
    $this->post('/foto', 'UsuarioController@uploadFotoUsuario');
    $this->post('/upload/imagem/empresa', 'UsuarioController@uploadfotoempresaweb');
    $this->post('/chat/novo', 'chat\ChatController@chatAdd');
    $this->post('/chat/delete', 'chat\ChatController@chatDelete');
    $this->get('/chat/listar/{id?}', 'chat\ChatController@listarchatApp');
    $this->post('chat/notification', 'chat\ChatController@chatnotication');
    $this->get('/list/{id?}', 'UsuarioController@listarUsuario');
    $this->get('/delete/{id?}', 'UsuarioController@destroy');
    $this->get('/cidade/lista', 'UsuarioController@cidades');
    $this->post('/recuperasenha', 'PasswordResetController@create');
    $this->group(['prefix' => '/favoritos'],function(){
        $this->get('/add/{anuncio?}/{id?}', 'UsuarioController@addFavoritoApp');
        $this->get('/listar/{id?}', 'UsuarioController@favoritoListApp');
        //$this->get('/deletar/{id?}/{anuncio?}', 'UsuarioController@removeFavoritos');
    });
});

$this->group(['prefix' => 'auth/categoria'], function() {
    $this->get('/tipo/{titpo?}/{id?}', 'CategoriaController@tipoCategoriaApp');
    //$this->get('/listar', 'CategoriaController@index');
    $this->get('/todas', 'CategoriaController@showAll');
    $this->get('/menu', 'CategoriaController@menucategoria');
    $this->get('/top/visita', 'CategoriaController@topCategoria');
    $this->get('/add/visita/{type?}', 'CategoriaController@viewCategoria');
    $this->get('/showmore/{id?}/{inicio?}', 'CategoriaController@showMore');
  //  $this->post('/produtos/listar', 'ProdutoController@create');
    $this->post('/produtos', 'ProdutoController@tipoProd');
});

$this->group(['prefix' => 'auth/anuncio'], function() {
    $this->post('novo', 'ProdutoController@createApp')->name('novo');
    $this->post('foto', 'ProdutoController@uploadfotoApp');
    $this->get('/all/{id?}', 'ProdutoController@showProdutosApp');
    $this->get('/more/{id?}/{skip?}', 'ProdutoController@showMoreProdutosApp');
    $this->get('/meus/produtos/{id?}', 'ProdutoController@showMyProdutosApp');
    $this->get('/outros/produtos/{id?}', 'ProdutoController@showMyOtherProdutos');
    $this->get('/produto/detalhe/{id?}/{idUser?}', 'ProdutoController@detalheApp');
    $this->get('/buscar', 'ProdutoController@buscarApi');
    //$this->get('/produtos/{type?}', 'ProdutoController@searchAnuncio');
    $this->post('/produtos/tipo', 'ProdutoController@produtobytipoApp');
    $this->get('/visita/{id?}/{iduser?}', 'ProdutoController@visitaApp');
    $this->get('/remover/{id?}', 'ProdutoController@delet');

});

$this->group(['prefix' => 'auth/enderecos'], function() {
    $this->get('estados','EnderecoController@listEstado');
    $this->post('cidade','EnderecoController@listCidade');
});