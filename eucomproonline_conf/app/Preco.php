<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preco extends Model
{
    protected $table = 'TB_TIPO_ANUNCIO';

    protected $fillable = [
        'ID_TIPO_ANUNCIO','DS_TIPO_ANUNCIO','VL_TIPO_ANUNCIO','DT_DIAS_DURACAO_ANUNCIO'
    ];

    public static function novo($data){


        $userInfo = Preco::create([
            'DS_TIPO_ANUNCIO' => $data[0]
            ,'VL_TIPO_ANUNCIO' => floatval($data[2])
            ,'DT_DIAS_DURACAO_ANUNCIO' => 1
        ]);

        return $userInfo->id;
    }


}
