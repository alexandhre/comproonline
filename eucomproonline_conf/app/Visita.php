<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Visita extends Model
{
    protected $table = 'TB_VISITA_ANUNCIO';

    protected $fillable=[
        'ID_ANUNCIANTE',
        'ID_ANUNCIO_PRODUTO',
        'DT_VISITA',
    ];

    public static function novo($id, $comprador ){

        date_default_timezone_set("america/sao_paulo");
        if(count(DB::table('TB_VISITA_ANUNCIO')->where('ID_ANUNCIO_PRODUTO',$id )->where('ID_ANUNCIANTE',$comprador )->get()) == 0){

            $userInfo = Visita::insert([
                'ID_ANUNCIANTE' => $comprador,
                'ID_ANUNCIO_PRODUTO' => $id,
                'DT_VISITA' => date('m/d/Y h:i:s a', time())
            ]);


        }else{
            $userInfo = null;
        }
        return $userInfo;
    }
}
