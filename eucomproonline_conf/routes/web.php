<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



$this->get('/', function () {
    return view('welcome');
});
Route::get('/home', 'CategoriaController@index')->name('home');

Route::get('logar', 'Auth\LoginController@showLoginForm')->name('logar');
Route::get('registro', 'Auth\RegisterController@showRegisterForm');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('register', 'Auth\RegisterController@cadastro')->name('register');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');


Route::get('funcionamento', 'ProdutoController@ComoFunciona');

Route::get('validacao', function(){
    $show = 0;
    return view('auth.passwords.validacao', compact('show'));
});


$this->group(['prefix' => '/usuario'], function() {
     $this->get('favoritos', 'UsuarioController@favoritoPage');
     $this->get('perfil', 'UsuarioController@perfilPage');
     $this->get('meusAnuncios', 'UsuarioController@meuAnunciosPage');
     $this->get('detail', 'UsuarioController@index');
     $this->post('update', 'UsuarioController@edit');
     $this->post('foto/update', 'UsuarioController@uploadFotoUsuarioWeb');
     $this->get('chat', 'chat\ChatController@listarchatweb');
     $this->get('chat/{id}', 'UsuarioController@UsuarioChatInfo');
     $this->post('chat/novo', 'chat\ChatController@chatAdd');
     $this->post('chat/delete', 'chat\ChatController@chatDelete');
     $this->post('chat/notification', 'chat\ChatController@chatnotication');
     $this->get('validade','UsuarioController@validar')->name('validade');
     $this->get('validacao/email/{id?}', 'UsuarioController@verificacao');
     $this->post('recuperasenha', 'PasswordResetController@create')->name('recuperasenha');
     $this->get('esquecisenha', 'UsuarioController@novasenha');
     $this->group(['prefix' => 'favorito'],function(){
        $this->get('add/{anuncio?}', 'ProdutoController@addFavorito');
        $this->get('page', 'UsuarioController@favoritoPage');
        $this->get('listar', 'UsuarioController@favoritoList');
//        $this->get('deletar/{id?}/{anuncio?}', 'UsuarioController@removeFavoritos');
    });
});

$this->group(['prefix' => '/categoria'], function() {
    $this->get('/','CategoriaController@CategoriaPage');
    $this->get('tipo/{titpo?}', 'CategoriaController@tipoCategoria');
    $this->get('listar', 'CategoriaController@index');
    $this->get('todas', 'CategoriaController@showAll');
    $this->get('menu', 'CategoriaController@menucategoria');
    $this->get('showmore/{id?}/{inicio?}', 'CategoriaController@showMore');
    $this->post('produtos/listar', 'ProdutoController@create');
    $this->post('produtos', 'ProdutoController@tipoProd');
});

$this->group(['prefix' => '/anuncio'], function() {
//    $this->get('/detalhe', function () {
//        return view('produto.detalhe');
//    });
    $this->get('searchproduto/{id?}', 'ProdutoController@produtoinfo');
    $this->get('subir', 'ProdutoController@subirPage');
    $this->get('all', 'ProdutoController@showProdutos');
    $this->post('upload/foto', 'ProdutoController@uploadfotoWeb');
    $this->post('novo', 'ProdutoController@create')->name('novo');
    $this->post('foto', 'ProdutoController@uploadfotoWeb');
    $this->get('meus/produtos', 'ProdutoController@showMyProdutos');
    $this->get('outros/produtos/{id?}', 'ProdutoController@showMyOtherProdutos');
    $this->get('meus/produtos/page', 'ProdutoController@showMyProdutospage');
    $this->get('produto/detalhe', 'ProdutoController@detalhePage');
    $this->get('produto/detalhe/{id?}', 'ProdutoController@detalhe');
    $this->post('buscar', 'ProdutoController@buscar');
    $this->get('produtos/{type?}', 'ProdutoController@searchAnuncio');
    $this->get('showmore/{inicio?}', 'ProdutoController@showMore');
    $this->get('produto/type', 'ProdutoController@searchAnunciopage');
    $this->get('/remover/{id?}', 'ProdutoController@delet');
    $this->get('/editar/page', 'ProdutoController@edit');
    $this->get('/editar/{id?}', 'ProdutoController@editar');
    $this->post('/editar', 'ProdutoController@update');
//    $this->get('/produto/page', function () {
//        return view('produto.detalhe');
//    });
    $this->get('visita/{id?}', 'ProdutoController@visita');

});


$this->group(['prefix' => '/enderecos'], function() {
    $this->get('estados','EnderecoController@listEstado');
    $this->post('cidade','EnderecoController@listCidade');
});

//Auth::routes();


//Route::get('/categorias', 'CategoriaController@showAll')->name('categorias');

Route::get('/comofunciona', 'CategoriaController@showComoFunciona')->name('comofunciona');

Route::get('produtos', 'ProdutoController@showProdutos')->name('produtos');
