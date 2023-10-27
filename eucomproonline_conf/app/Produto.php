<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Helpers\HelperAnuncio;
use App\Helpers\HelperUser;

class Produto extends Model
{
    protected $table = 'TB_ANUNCIO_PRODUTO';

    protected $fillable = [
        'ID_ANUNCIO_PRODUTO','ID_ANUNCIANTE','ID_PRODUTO','ID_TIPO_ANUNCIO','DS_ANUNCIO_PRODUTO' ,'QT_VISITA','IN_PUBLICAR','DS_DETALHE_PRODUTO','ID_TIPO_PRODUTO','DT_ANUNCIO_PRODUTO'];

    public static function listAll(){
        $listAllProdutos = DB::table('TB_PRODUTO')
            ->join('TB_TIPO_PRODUTO','TB_TIPO_PRODUTO.ID_TIPO_PRODUTO','=','TB_PRODUTO.ID_TIPO_PRODUTO')
            ->select('TB_PRODUTO.ID_PRODUTO','TB_PRODUTO.ID_TIPO_PRODUTO','TB_PRODUTO.DS_PRODUTO','TB_PRODUTO.DS_FOTO_PRODUTO')
            ->limit(12)
            ->get();

        return $listAllProdutos;

    }

    public static function listByCategoria($id, $user){
        $listAllProdutos = DB::table('TB_CATEGORIA_PRODUTO')
            ->Join('TB_TIPO_PRODUTO','TB_TIPO_PRODUTO.ID_CATEGORIA_PRODUTO','TB_CATEGORIA_PRODUTO.ID_CATEGORIA_PRODUTO')
            ->join('TB_PRODUTO','TB_PRODUTO.ID_TIPO_PRODUTO','TB_TIPO_PRODUTO.ID_TIPO_PRODUTO')
            ->join('TB_ANUNCIO_PRODUTO','TB_ANUNCIO_PRODUTO.ID_PRODUTO','TB_PRODUTO.ID_PRODUTO')
            ->join('TB_TIPO_ANUNCIO','TB_TIPO_ANUNCIO.ID_TIPO_ANUNCIO','TB_ANUNCIO_PRODUTO.ID_TIPO_ANUNCIO')
            ->where('TB_CATEGORIA_PRODUTO.DS_CATEGORIA_PRODUTO','like','%'.$id.'%')
            ->where('TB_ANUNCIO_PRODUTO.ID_ANUNCIANTE','!=', $user)
            ->select(
                'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO'
                ,'TB_ANUNCIO_PRODUTO.ID_ANUNCIANTE'
                ,'TB_ANUNCIO_PRODUTO.DS_ANUNCIO_PRODUTO'
                ,'TB_ANUNCIO_PRODUTO.DS_DETALHE_PRODUTO'
                ,'TB_CATEGORIA_PRODUTO.DS_CATEGORIA_PRODUTO'
                ,'TB_ANUNCIO_PRODUTO.VL_DESCONTO'
                ,'TB_TIPO_ANUNCIO.VL_TIPO_ANUNCIO'
                ,'TB_TIPO_PRODUTO.DS_TIPO_PRODUTO'
            )
           ->limit(12)
           ->orderBy('TB_TIPO_ANUNCIO.VL_TIPO_ANUNCIO', 'DSC')
            ->get();
           
        foreach ($listAllProdutos as $item ){

            $foto =  FotoAnuncio::getfotoAnuncio($item->ID_ANUNCIO_PRODUTO);

            if(count($foto)<=0){
                $item->foto = 'foto.png';
            }else{

                $item->foto = $foto['0']->foto;
            }

        }

        return $listAllProdutos;
    }

    public static function ShowMoreyCategoria($id, $inicio, $user){
        $listAllProdutos = DB::table('TB_CATEGORIA_PRODUTO')
            ->Join('TB_TIPO_PRODUTO','TB_TIPO_PRODUTO.ID_CATEGORIA_PRODUTO','TB_CATEGORIA_PRODUTO.ID_CATEGORIA_PRODUTO')
            ->join('TB_PRODUTO','TB_PRODUTO.ID_TIPO_PRODUTO','TB_TIPO_PRODUTO.ID_TIPO_PRODUTO')
            ->join('TB_ANUNCIO_PRODUTO','TB_ANUNCIO_PRODUTO.ID_PRODUTO','TB_PRODUTO.ID_PRODUTO')
            ->join('TB_TIPO_ANUNCIO','TB_TIPO_ANUNCIO.ID_TIPO_ANUNCIO','TB_ANUNCIO_PRODUTO.ID_TIPO_ANUNCIO')
            ->where('TB_CATEGORIA_PRODUTO.DS_CATEGORIA_PRODUTO','like','%'.$id.'%')
            ->where('TB_ANUNCIO_PRODUTO.ID_ANUNCIANTE','!=', $user)
            ->select(
                'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO'
                ,'TB_ANUNCIO_PRODUTO.DS_ANUNCIO_PRODUTO'
                ,'TB_ANUNCIO_PRODUTO.DS_DETALHE_PRODUTO'
                ,'TB_CATEGORIA_PRODUTO.DS_CATEGORIA_PRODUTO'
                ,'TB_ANUNCIO_PRODUTO.VL_DESCONTO'
                ,'TB_TIPO_ANUNCIO.VL_TIPO_ANUNCIO'
            )
            ->limit(4)
            ->orderBy('TB_TIPO_ANUNCIO.VL_TIPO_ANUNCIO', 'DSC')
            ->skip($inicio)
            ->take(4)
            ->limit(4)
            ->get();

        foreach ($listAllProdutos as $item ){

            $foto =  FotoAnuncio::getfotoAnuncio($item->ID_ANUNCIO_PRODUTO);

            if(count($foto)<=0){
                $item->foto = null;
            }else{

                $item->foto = $foto['0']->foto;
            }

        }

        return $listAllProdutos;
    }


    public static function listMy($id){
        $listAllProdutos = DB::table('TB_ANUNCIO_PRODUTO')
            ->join('TB_ANUNCIANTE','TB_ANUNCIANTE.ID_ANUNCIANTE','TB_ANUNCIO_PRODUTO.ID_ANUNCIANTE')
            ->join('TB_TIPO_ANUNCIO','TB_TIPO_ANUNCIO.ID_TIPO_ANUNCIO','TB_ANUNCIO_PRODUTO.ID_TIPO_ANUNCIO')
            ->where('TB_ANUNCIANTE.ID_ANUNCIANTE',$id )
            ->select('TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO'
            ,'TB_ANUNCIO_PRODUTO.ID_ANUNCIANTE'
            ,'ID_PRODUTO'
            ,'TB_ANUNCIO_PRODUTO.ID_TIPO_ANUNCIO'
            ,'DS_ANUNCIO_PRODUTO'
            ,'DS_DETALHE_PRODUTO'
            ,'VL_DESCONTO'
            ,'TB_TIPO_ANUNCIO.VL_TIPO_ANUNCIO')
           // ->limit(12)
            ->get();
        foreach ($listAllProdutos as $item ){
            $item->VL_TIPO_ANUNCIO = number_format($item->VL_TIPO_ANUNCIO, 2, ',', '.');
            $foto =  FotoAnuncio::getfotoAnuncio($item->ID_ANUNCIO_PRODUTO);

            if(count($foto)<=0){
                $item->foto = null;
            }else{

                $item->foto = $foto['0']->foto;
            }

        }
        return $listAllProdutos;
    }
    public static function otherAnuncios($id){
        $listAllProdutos = DB::table('TB_ANUNCIO_PRODUTO')
            ->join('TB_ANUNCIANTE','TB_ANUNCIANTE.ID_ANUNCIANTE','TB_ANUNCIO_PRODUTO.ID_ANUNCIANTE')
            ->join('TB_TIPO_ANUNCIO','TB_TIPO_ANUNCIO.ID_TIPO_ANUNCIO','TB_ANUNCIO_PRODUTO.ID_TIPO_ANUNCIO')
            ->where('TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO','!=', $id)
            ->select('TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO'
            ,'TB_ANUNCIO_PRODUTO.ID_ANUNCIANTE'
            ,'ID_PRODUTO'
            ,'TB_ANUNCIO_PRODUTO.ID_TIPO_ANUNCIO'
            ,'DS_ANUNCIO_PRODUTO'
            ,'DS_DETALHE_PRODUTO')
            ->limit(8)
            ->get();
        foreach ($listAllProdutos as $item ){
            
            $foto =  FotoAnuncio::getfotoAnuncio($item->ID_ANUNCIO_PRODUTO);

            if(count($foto)<=0){
                $item->foto = null;
            }else{

                $item->foto = $foto['0']->foto;
            }
        }
        return $listAllProdutos;
    }
    public static function GetAnuncio($id){
        $listAllProdutos = DB::table('TB_ANUNCIO_PRODUTO')
            ->join('TB_ANUNCIANTE','TB_ANUNCIANTE.ID_ANUNCIANTE','TB_ANUNCIO_PRODUTO.ID_ANUNCIANTE')
            ->join('TB_TIPO_ANUNCIO','TB_TIPO_ANUNCIO.ID_TIPO_ANUNCIO','TB_ANUNCIO_PRODUTO.ID_TIPO_ANUNCIO')
            ->join('TB_BAIRRO','TB_BAIRRO.ID_BAIRRO','TB_ANUNCIANTE.ID_BAIRRO')
            ->join('TB_PRODUTO','TB_PRODUTO.ID_PRODUTO','TB_ANUNCIO_PRODUTO.ID_PRODUTO')
            ->join('TB_TIPO_PRODUTO','TB_TIPO_PRODUTO.ID_TIPO_PRODUTO','TB_PRODUTO.ID_TIPO_PRODUTO')
            ->join('TB_CATEGORIA_PRODUTO','TB_CATEGORIA_PRODUTO.ID_CATEGORIA_PRODUTO','TB_TIPO_PRODUTO.ID_CATEGORIA_PRODUTO')
            ->where('TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO', $id)
            ->select('TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO'
                ,'TB_ANUNCIO_PRODUTO.ID_ANUNCIANTE'
                ,'TB_ANUNCIO_PRODUTO.ID_PRODUTO'
                ,'TB_ANUNCIO_PRODUTO.ID_TIPO_ANUNCIO'
                ,'DS_ANUNCIO_PRODUTO','DS_DETALHE_PRODUTO'
                ,'VL_DESCONTO'
                ,'TB_TIPO_ANUNCIO.VL_TIPO_ANUNCIO'
                ,'TB_ANUNCIANTE.DS_NOME'
                ,'TB_ANUNCIANTE.DS_SOBRENOME'
                ,'TB_ANUNCIANTE.DS_FOTO_COMPRADOR'
                ,'TB_CATEGORIA_PRODUTO.DS_CATEGORIA_PRODUTO'
             //   ,'TB_ANUNCIANTE.ID_ANUNCIANTE_LARAVEL'
                ,'TB_BAIRRO.DS_BAIRRO'
                ,'TB_BAIRRO.NR_ENDERECO'
                ,'TB_TIPO_PRODUTO.DS_TIPO_PRODUTO'
                ,'TB_CATEGORIA_PRODUTO.DS_CATEGORIA_PRODUTO'
            )
            ->get();
            
            $listAllProdutos['0']->avaliacao = DB::table('TB_AVALIACAO_PRODUTO')
                    ->where('ID_ANUNCIO_PRODUTO', $id)
                    ->select(
                         DB::raw( 'SUM(TB_AVALIACAO_PRODUTO.VL_AVALIACAO)/ COUNT(TB_AVALIACAO_PRODUTO.VL_AVALIACAO) as avaliacao' )
                        ,DB::raw( 'COUNT(TB_AVALIACAO_PRODUTO.VL_AVALIACAO) as qt_avaliacao' )
                    )->get(); 

        foreach ($listAllProdutos as $item ){

            $item->urlsearch = '/eucompro.online/eucomproonline/anuncio/searchproduto/'.Crypt::encrypt($item->ID_ANUNCIO_PRODUTO);
            $foto =  FotoAnuncio::getAllfotoAnuncio($item->ID_ANUNCIO_PRODUTO);


            if(count($foto)<=0){
                $item->foto = null;
            }else{

                $item->foto = $foto;
            }

            $item->avaliacao[0]->avaliacao = intval($item->avaliacao[0]->avaliacao);

            if(key_exists('email',session()->all())){
                $data =  Favorito::getData($item->ID_ANUNCIO_PRODUTO, session()->all()['id']);
                if(count($data)<=0){
                    $item->favorito = null;
                }else{
                    $item->favorito = 1;
                }
            }else{
                $item->favorito = null;
            }

        }
        return $listAllProdutos;
    }
    public static function GetAnuncioApp($id,$idUser){
        $listAllProdutos = DB::table('TB_ANUNCIO_PRODUTO')
            ->join('TB_ANUNCIANTE','TB_ANUNCIANTE.ID_ANUNCIANTE','TB_ANUNCIO_PRODUTO.ID_ANUNCIANTE')
            ->join('TB_TIPO_ANUNCIO','TB_TIPO_ANUNCIO.ID_TIPO_ANUNCIO','TB_ANUNCIO_PRODUTO.ID_TIPO_ANUNCIO')
            ->join('TB_BAIRRO','TB_BAIRRO.ID_BAIRRO','TB_ANUNCIANTE.ID_BAIRRO')
            ->join('TB_PRODUTO','TB_PRODUTO.ID_PRODUTO','TB_ANUNCIO_PRODUTO.ID_PRODUTO')
            ->join('TB_TIPO_PRODUTO','TB_TIPO_PRODUTO.ID_TIPO_PRODUTO','TB_PRODUTO.ID_TIPO_PRODUTO')
            ->join('TB_CATEGORIA_PRODUTO','TB_CATEGORIA_PRODUTO.ID_CATEGORIA_PRODUTO','TB_TIPO_PRODUTO.ID_CATEGORIA_PRODUTO')
            ->where('TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO', $id)
            ->select('TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO'
                ,'TB_ANUNCIO_PRODUTO.ID_ANUNCIANTE'
                ,'TB_ANUNCIO_PRODUTO.ID_PRODUTO'
                ,'TB_ANUNCIO_PRODUTO.ID_TIPO_ANUNCIO'
                ,'DS_ANUNCIO_PRODUTO','DS_DETALHE_PRODUTO'
                ,'VL_DESCONTO'
                ,'TB_TIPO_ANUNCIO.VL_TIPO_ANUNCIO'
                ,'TB_ANUNCIANTE.DS_NOME'
                ,'TB_ANUNCIANTE.DS_SOBRENOME'
                ,'TB_ANUNCIANTE.DS_FOTO_COMPRADOR'
              //  ,'TB_ANUNCIANTE.ID_ANUNCIANTE_LARAVEL'
                ,'TB_BAIRRO.DS_BAIRRO'
                ,'TB_BAIRRO.NR_ENDERECO'
                ,'TB_TIPO_PRODUTO.DS_TIPO_PRODUTO'
                ,'TB_CATEGORIA_PRODUTO.DS_CATEGORIA_PRODUTO'
            )
            ->get();

        foreach ($listAllProdutos as $item ){
            $item->VL_TIPO_ANUNCIO = number_format($item->VL_TIPO_ANUNCIO, 2, ',', '.');
            $item->DS_FOTO_COMPRADOR = HelperUser::checkExistsImage($item->ID_ANUNCIANTE, $item->DS_FOTO_COMPRADOR);            
            $foto =  FotoAnuncio::getAllfotoAnuncio($item->ID_ANUNCIO_PRODUTO);

            if(count($foto)<=0){
                $item->foto = null;
            }else{
                $item->foto = $foto;
                foreach($item->foto as $i){
                    $i->foto = HelperAnuncio::checkExistsImage($item->ID_ANUNCIO_PRODUTO, $i->foto);
                }
            }
            if($idUser != 0){
                $data =  Favorito::getData($item->ID_ANUNCIO_PRODUTO, $idUser);
                if(count($data)<=0){
                    $item->favorito = false;
                }else{
                    $item->favorito = true;
                }
            }else{
                $item->favorito = false;
            }


        }
        return $listAllProdutos;
    }

    public static function allAnuncios($id){
        $listAllProdutos = DB::table('TB_ANUNCIO_PRODUTO')
            ->join('TB_ANUNCIANTE','TB_ANUNCIANTE.ID_ANUNCIANTE','TB_ANUNCIO_PRODUTO.ID_ANUNCIANTE')
            ->join('TB_TIPO_ANUNCIO','TB_TIPO_ANUNCIO.ID_TIPO_ANUNCIO','TB_ANUNCIO_PRODUTO.ID_TIPO_ANUNCIO')
            ->where('TB_ANUNCIO_PRODUTO.ID_ANUNCIANTE','!=',$id)
            ->select('TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO'
                ,'TB_ANUNCIO_PRODUTO.ID_ANUNCIANTE'
                ,'ID_PRODUTO'
                ,'TB_ANUNCIO_PRODUTO.ID_TIPO_ANUNCIO'
                ,'DS_ANUNCIO_PRODUTO'
                ,'DS_DETALHE_PRODUTO'
                ,'VL_DESCONTO'
                ,'TB_TIPO_ANUNCIO.VL_TIPO_ANUNCIO')
            ->limit(12)
            ->orderBy('QT_VISITA','DSC')
            ->get();
        foreach ($listAllProdutos as $item ){
            if( $item->VL_DESCONTO === null){
                $item->VL_DESCONTO = 0;
            }
            $item->VL_TIPO_ANUNCIO = $item->VL_TIPO_ANUNCIO - $item->VL_DESCONTO;
            $item->VL_TIPO_ANUNCIO = number_format($item->VL_TIPO_ANUNCIO, 2, ',', '.');
            $foto =  FotoAnuncio::getfotoAnuncio($item->ID_ANUNCIO_PRODUTO);           
            if(count($foto)<=0){
                $item->foto = 'photo.png';
            }else{
                $item->foto = $foto['0']->foto;
            }
        }
        //dd($listAllProdutos);
        return $listAllProdutos;
    }
    public static function MoreAnuncios($id, $qt){

        $listAllProdutos = DB::table('TB_ANUNCIO_PRODUTO')
            ->join('TB_ANUNCIANTE','TB_ANUNCIANTE.ID_ANUNCIANTE','TB_ANUNCIO_PRODUTO.ID_ANUNCIANTE')
            ->join('TB_TIPO_ANUNCIO','TB_TIPO_ANUNCIO.ID_TIPO_ANUNCIO','TB_ANUNCIO_PRODUTO.ID_TIPO_ANUNCIO')
            ->where('TB_ANUNCIO_PRODUTO.ID_ANUNCIANTE','!=',$id)
            ->select('TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO'
                ,'TB_ANUNCIO_PRODUTO.ID_ANUNCIANTE'
                ,'ID_PRODUTO'
                ,'TB_ANUNCIO_PRODUTO.ID_TIPO_ANUNCIO'
                ,'DS_ANUNCIO_PRODUTO'
                ,'DS_DETALHE_PRODUTO'
                ,'VL_DESCONTO'
                ,'TB_TIPO_ANUNCIO.VL_TIPO_ANUNCIO')

            ->orderBy('QT_VISITA','DSC')
            ->skip($qt)
            ->limit(10)
            ->get();
        foreach ($listAllProdutos as $item ){

            $foto =  FotoAnuncio::getfotoAnuncio($item->ID_ANUNCIO_PRODUTO);

            if(count($foto)<=0){
                $item->foto = null;
            }else{
                $item->foto = $foto['0']->foto;
            }
        }
        return $listAllProdutos;
    }




    public static function novoProduto($data){

        $idCat = Categoria::getIdTipopoCat($data[4]);
       
        $produto = DB::table('TB_PRODUTO')->insertGetId(['ID_TIPO_PRODUTO' => intval($idCat), 'DS_PRODUTO' => $data[0], 'DS_FOTO_PRODUTO' => $data[5][0]]);

        return $produto;
    }

    public static function Remove($id){
        if(Favorito::where('ID_ANUNCIO_PRODUTO',$id)->count()>0){
            Favorito::where('ID_ANUNCIO_PRODUTO',$id)->delete();
        }
        try {
            Visita::where('ID_ANUNCIO_PRODUTO',$id)->delete();

            FotoAnuncio::where('ID_ANUNCIO_PRODUTO',$id)->delete();

            Produto::where('ID_ANUNCIO_PRODUTO',$id)->delete();

            return 1;
        } catch (Exception $e) {
            return 0;
        }

       // DB::table('TB_TIPO_ANUNCIO')->where('')

    }

    //listar tipo Produto
    public function TipoProduto($id){
        $produtos = Categoria::listaProduto($id);
        return $produtos;
    }

    public static function novoAnuncio($data,$produto, $preco, $id){
        $idCat = Categoria::getIdTipopoCat($data[4]);



        $userInfo = Produto::insert([
            'ID_ANUNCIANTE' => $id
            ,'ID_PRODUTO' =>$produto
            ,'ID_TIPO_ANUNCIO' =>$preco
            ,'DS_ANUNCIO_PRODUTO' =>$data[0]
            ,'DS_DETALHE_PRODUTO' =>$data[1]
            ,'QT_VISITA' => 0
            ,'IN_PUBLICAR' =>'1'
            ,'ID_TIPO_PRODUTO' => $idCat
            ,'DT_ANUNCIO_PRODUTO' => $data = date('Y-m-d H:i:s')
        ]);

        $userInfo=  produto::where('ID_ANUNCIANTE', $id)->select('ID_ANUNCIO_PRODUTO as id')->orderBy('ID_ANUNCIO_PRODUTO','desc')->limit(1)->get();


        return $userInfo;
    }

    public static function favoritosAdd($anuncio,$id_comprador){
        //adicionar anuncio

        if (DB::table('TB_FAVORITO')->where('ID_ANUNCIANTE', $id_comprador)->where('ID_ANUNCIO_PRODUTO', $anuncio)->count() == 0) {
            $data = date('Y-m-d H:i:s');

            DB::table('TB_FAVORITO')->insert(['ID_ANUNCIANTE' => $id_comprador, 'ID_ANUNCIO_PRODUTO' => intval($anuncio), 'DT_FAVORITO' =>$data]);
            return 1;

        }else{
            DB::table('TB_FAVORITO')->where('ID_ANUNCIANTE', $id_comprador)->where('ID_ANUNCIO_PRODUTO', $anuncio)->delete();
            return 0;
        }
    }

    public static function searchProduto($type){
        $listAllProdutos = DB::table('TB_ANUNCIO_PRODUTO')
            ->join('TB_ANUNCIANTE','TB_ANUNCIANTE.ID_ANUNCIANTE','TB_ANUNCIO_PRODUTO.ID_ANUNCIANTE')
            ->join('TB_TIPO_ANUNCIO','TB_TIPO_ANUNCIO.ID_TIPO_ANUNCIO','TB_ANUNCIO_PRODUTO.ID_TIPO_ANUNCIO')
            ->where('TB_ANUNCIO_PRODUTO.DS_ANUNCIO_PRODUTO','like','%'.$type.'%')
            ->select('TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO'
                ,'TB_ANUNCIO_PRODUTO.ID_ANUNCIANTE'
                ,'ID_PRODUTO'
                ,'TB_ANUNCIO_PRODUTO.ID_TIPO_ANUNCIO'
                ,'DS_ANUNCIO_PRODUTO'
                ,'DS_DETALHE_PRODUTO'
                ,'VL_DESCONTO'
                ,'TB_TIPO_ANUNCIO.VL_TIPO_ANUNCIO'
            )
            ->get();

        foreach ($listAllProdutos as $item ){

            $foto =  FotoAnuncio::getfotoAnuncio($item->ID_ANUNCIO_PRODUTO);

            if(count($foto)<=0){
                $item->foto = null;
            }else{

                $item->foto = $foto['0']->foto;
            }
        }
        return $listAllProdutos;
    }

    public static function addvisita($id){


        $listAnuncio = DB::table('TB_ANUNCIO_PRODUTO')
            ->where('ID_ANUNCIO_PRODUTO', $id)
            ->select('QT_VISITA')
            ->get();


        $promocao = DB::table('TB_ANUNCIO_PRODUTO')
            ->where('ID_ANUNCIO_PRODUTO', $id)
            ->update(['QT_VISITA'=> intval($listAnuncio[0]->QT_VISITA)+1]);

        return $promocao;

    }

    public static function AnunciosVisited($id){

        //$id_anunciante = User::getId(15);

        $listAllProdutos = DB::table('TB_VISITA_ANUNCIO')
            ->join('TB_ANUNCIO_PRODUTO','TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO','TB_VISITA_ANUNCIO.ID_ANUNCIO_PRODUTO')
            ->join('TB_ANUNCIANTE','TB_ANUNCIANTE.ID_ANUNCIANTE','TB_ANUNCIO_PRODUTO.ID_ANUNCIANTE')
            ->join('TB_TIPO_ANUNCIO','TB_TIPO_ANUNCIO.ID_TIPO_ANUNCIO','TB_ANUNCIO_PRODUTO.ID_TIPO_ANUNCIO')
            ->where('TB_VISITA_ANUNCIO.ID_ANUNCIANTE',session()->all()['id'])
            ->where('TB_ANUNCIO_PRODUTO.ID_ANUNCIANTE','!=',$id)
            ->select('TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO'
                ,'TB_ANUNCIO_PRODUTO.ID_ANUNCIANTE'
                ,'ID_PRODUTO'
                ,'TB_ANUNCIO_PRODUTO.ID_TIPO_ANUNCIO'
                ,'DS_ANUNCIO_PRODUTO'
                ,'DS_DETALHE_PRODUTO'
                ,'VL_DESCONTO'
                ,'TB_TIPO_ANUNCIO.VL_TIPO_ANUNCIO')
            ->limit(12)
            ->orderBy('QT_VISITA','DSC')
            ->get();

        foreach ($listAllProdutos as $item ){
            if( $item->VL_DESCONTO === null){
                $item->VL_DESCONTO = 0;
            }
            $item->VL_TIPO_ANUNCIO = $item->VL_TIPO_ANUNCIO - $item->VL_DESCONTO;
            $item->VL_TIPO_ANUNCIO = number_format($item->VL_TIPO_ANUNCIO, 2, ',', '.');

            $foto =  FotoAnuncio::getfotoAnuncio($item->ID_ANUNCIO_PRODUTO);
            if(count($foto)<=0){
                $item->foto = '/eucomproonline/images/photo.png';
            }else{

                $item->foto = '/eucomproonline/images/anuncios/'.$item->ID_ANUNCIO_PRODUTO.'/'.$foto['0']->foto;
            }
        }
        return $listAllProdutos;
    }

    public static function listMoreAnuncio($inicio){

            $listAllProdutos = DB::table('TB_ANUNCIO_PRODUTO')
               // ->join('TB_ANUNCIO_PRODUTO','TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO','TB_VISITA_ANUNCIO.ID_ANUNCIO_PRODUTO')
                ->join('TB_ANUNCIANTE','TB_ANUNCIANTE.ID_ANUNCIANTE','TB_ANUNCIO_PRODUTO.ID_ANUNCIANTE')
                ->join('TB_TIPO_ANUNCIO','TB_TIPO_ANUNCIO.ID_TIPO_ANUNCIO','TB_ANUNCIO_PRODUTO.ID_TIPO_ANUNCIO')
                ->select('TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO'
                    ,'TB_ANUNCIO_PRODUTO.ID_ANUNCIANTE'
                    ,'ID_PRODUTO'
                    ,'TB_ANUNCIO_PRODUTO.ID_TIPO_ANUNCIO'
                    ,'DS_ANUNCIO_PRODUTO'
                    ,'DS_DETALHE_PRODUTO'
                    ,'VL_DESCONTO'
                    ,'TB_TIPO_ANUNCIO.VL_TIPO_ANUNCIO')
                ->orderBy('TB_ANUNCIO_PRODUTO.QT_VISITA', 'DSC')
                ->skip($inicio)
                ->take(4)
                ->limit(4)
                ->get();

        foreach ($listAllProdutos as $item ){

            $foto =  FotoAnuncio::getfotoAnuncio($item->ID_ANUNCIO_PRODUTO);

            if(count($foto)<=0){
                $item->foto = null;
            }else{
                $item->foto = $foto['0']->foto;
            }
        }

        return $listAllProdutos;
    }

    public static function listMyMoreAnuncio($id, $inicio){

        $listAllProdutos = DB::table('TB_VISITA_ANUNCIO')
            ->join('TB_ANUNCIO_PRODUTO','TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO','TB_VISITA_ANUNCIO.ID_ANUNCIO_PRODUTO')
            ->join('TB_ANUNCIANTE','TB_ANUNCIANTE.ID_ANUNCIANTE','TB_ANUNCIO_PRODUTO.ID_ANUNCIANTE')
            ->join('TB_TIPO_ANUNCIO','TB_TIPO_ANUNCIO.ID_TIPO_ANUNCIO','TB_ANUNCIO_PRODUTO.ID_TIPO_ANUNCIO')
            ->where('TB_VISITA_ANUNCIO.ID_ANUNCIANTE',$id)
            ->where('TB_ANUNCIO_PRODUTO.ID_ANUNCIANTE','!=',$id)
            ->select('TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO'
                ,'TB_ANUNCIO_PRODUTO.ID_ANUNCIANTE'
                ,'ID_PRODUTO'
                ,'TB_ANUNCIO_PRODUTO.ID_TIPO_ANUNCIO'
                ,'DS_ANUNCIO_PRODUTO'
                ,'DS_DETALHE_PRODUTO'
                ,'VL_DESCONTO'
                ,'TB_TIPO_ANUNCIO.VL_TIPO_ANUNCIO')
            ->orderBy('TB_ANUNCIO_PRODUTO.QT_VISITA', 'DSC')
            ->skip($inicio)
            ->take(4)
            ->limit(4)
            ->get();

        foreach ($listAllProdutos as $item ){
            $item->VL_TIPO_ANUNCIO = number_format($item->VL_TIPO_ANUNCIO, 2, ',', '.');
            $foto =  FotoAnuncio::getfotoAnuncio($item->ID_ANUNCIO_PRODUTO);

            if(count($foto)<=0){
                $item->foto = null;
            }else{
                $item->foto = $foto['0']->foto;
            }
        }

        return $listAllProdutos;
    }


    public static function allAnunciosApp($type, $id, $skip){
        $listAllProdutos = DB::table('TB_ANUNCIO_PRODUTO')
            ->join('TB_ANUNCIANTE','TB_ANUNCIANTE.ID_ANUNCIANTE','TB_ANUNCIO_PRODUTO.ID_ANUNCIANTE')
            ->join('TB_TIPO_ANUNCIO','TB_TIPO_ANUNCIO.ID_TIPO_ANUNCIO','TB_ANUNCIO_PRODUTO.ID_TIPO_ANUNCIO')
            ->where('TB_ANUNCIO_PRODUTO.ID_TIPO_PRODUTO', $type)
            ->where('TB_ANUNCIO_PRODUTO.ID_ANUNCIANTE', '!=', $id)
            ->select('TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO'
                ,'TB_ANUNCIO_PRODUTO.ID_ANUNCIANTE'
                ,'ID_PRODUTO'
                ,'TB_ANUNCIO_PRODUTO.ID_TIPO_ANUNCIO'
                ,'DS_ANUNCIO_PRODUTO'
                ,'DS_DETALHE_PRODUTO'
                ,'VL_DESCONTO'
                ,'TB_TIPO_ANUNCIO.VL_TIPO_ANUNCIO')
            ->skip($skip)
            ->limit(5)
            ->get();
        foreach ($listAllProdutos as $item ){
            $item->VL_TIPO_ANUNCIO = number_format($item->VL_TIPO_ANUNCIO, 2, ',', '.');
            $foto =  FotoAnuncio::getfotoAnuncio($item->ID_ANUNCIO_PRODUTO);

            if(count($foto)<=0){
                $item->foto = null;
            }else{

                $item->foto = $foto['0']->foto;
            }
        }
        return $listAllProdutos;
    }
}
