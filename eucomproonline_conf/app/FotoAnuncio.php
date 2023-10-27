<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FotoAnuncio extends Model
{
    protected $table = 'TB_FOTO_PRODUTO';

    protected $fillable = [
        'ID_ANUNCIO_PRODUTO','DS_FOTO_PRODUTO'];

    public static function updatefoto($anuncio_id, $i){
        $anuncio = FotoAnuncio::create([
            'ID_ANUNCIO_PRODUTO' => $anuncio_id,
            'DS_FOTO_PRODUTO' => $i,
        ]);

        return $anuncio;
    }

    public static function getfotoAnuncio($id){
        $fotos =  DB::table('TB_FOTO_PRODUTO')
            ->where('ID_ANUNCIO_PRODUTO',$id )
            ->select(
                'DS_FOTO_PRODUTO as foto')
            ->limit(1)
            ->get();

        return $fotos;
    }
    public static function getAllfotoAnuncio($id){
        $fotos =  DB::table('TB_FOTO_PRODUTO')
            ->where('ID_ANUNCIO_PRODUTO',$id )
            ->select(
                'DS_FOTO_PRODUTO as foto')
            ->get();

        return $fotos;
    }

}
