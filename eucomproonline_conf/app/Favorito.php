<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Favorito extends Model
{
    protected $table = 'TB_FAVORITO';

    protected $fillable = [
        'ID_ANUNCIO_PRODUTO','ID_ANUNCIANTE','DT_FAVORITO'
    ];

    public static function getData($id,$usuario){

        $data =  DB::table('TB_FAVORITO')
            ->where('ID_ANUNCIO_PRODUTO', intval($id))
            ->where('ID_ANUNCIANTE',$usuario)
            ->select(
                'DT_FAVORITO')
            ->get();

        return $data;
    }
    public static function favoritoList($id){

        //$ID = User::getId($id);

        $listAllProdutos = DB::table('TB_ANUNCIO_PRODUTO')
            ->join('TB_ANUNCIANTE','TB_ANUNCIANTE.ID_ANUNCIANTE','TB_ANUNCIO_PRODUTO.ID_ANUNCIANTE')
            ->join('TB_TIPO_ANUNCIO','TB_TIPO_ANUNCIO.ID_TIPO_ANUNCIO','TB_ANUNCIO_PRODUTO.ID_TIPO_ANUNCIO')
            ->join('TB_FAVORITO','TB_FAVORITO.ID_ANUNCIO_PRODUTO','TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO')
            ->where('TB_FAVORITO.ID_ANUNCIANTE', $id)
            ->select('TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO'
               // ,'TB_ANUNCIO_PRODUTO.ID_ANUNCIANTE'
                ,'ID_PRODUTO'
                ,'TB_ANUNCIO_PRODUTO.ID_TIPO_ANUNCIO'
                ,'DS_ANUNCIO_PRODUTO','DS_DETALHE_PRODUTO'
                ,'VL_DESCONTO'
                ,'TB_TIPO_ANUNCIO.VL_TIPO_ANUNCIO'
              //  ,'TB_ANUNCIANTE.ID_ANUNCIANTE_LARAVEL'
            )
            ->get();
          
        foreach ($listAllProdutos as $item ){

            // Remove a virgula do valor
            $value = str_replace(',', '', $item->VL_TIPO_ANUNCIO);

            // Formata usando o numero de casas decimais desejado
            $item->VL_TIPO_ANUNCIO = number_format($value, 2, ',', '.');

            $foto =  FotoAnuncio::getfotoAnuncio($item->ID_ANUNCIO_PRODUTO);

            if(count($foto)<=0){
                $item->foto = 'photo.png';
            }else{
                $item->foto = $foto['0']->foto;
            }
        }

        return $listAllProdutos;
    }
}
