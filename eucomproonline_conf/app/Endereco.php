<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class Endereco extends Model
{
    protected $table = 'TB_BAIRRO';

    protected $fillable = [
        'ID_BAIRRO'
        ,'ID_CIDADE'
        ,'DS_BAIRRO'
        ,'DS_COMPLEMENTO'
        ,'NR_ENDERECO'
        ,'DS_CEP'
        ,'ID_USUARIO'
    ];
    public static function updateOrCreat($data, $id)
    {
        $address = Endereco::join('TB_ANUNCIANTE','TB_BAIRRO.ID_BAIRRO','TB_ANUNCIANTE.ID_BAIRRO')->where('TB_ANUNCIANTE.ID_ANUNCIANTE', '=', $id)->get();

        $data[10] = Endereco::cidade($data[10]);


        if(count($address)>0){


            $endereco = DB::table('TB_BAIRRO')
                ->join('TB_ANUNCIANTE','TB_BAIRRO.ID_BAIRRO','TB_ANUNCIANTE.ID_BAIRRO')
                ->where('TB_ANUNCIANTE.ID_ANUNCIANTE',$id)
                ->update([
                    'ID_USUARIO' => $id,
                    'ID_CIDADE'=>$data[10],
                    'TB_BAIRRO.DS_COMPLEMENTO'=>$data[5],
                    'TB_BAIRRO.DS_BAIRRO'=>$data[6],
                    'TB_BAIRRO.NR_ENDERECO'=>$data[7],
                    'TB_BAIRRO.DS_CEP'=>$data[8],

                ]);

                if($endereco == 1) return $address['0']->ID_BAIRRO;
            return 1;

        }else{
           $endereco= Endereco::insert([
                'ID_CIDADE' => $data[10],
                'DS_COMPLEMENTO' =>$data[5],
                'DS_BAIRRO' =>$data[6],
                'NR_ENDERECO' =>$data[7],
                'DS_CEP' => $data[8],

            ]);
            return $endereco->id;
        }

    }

    public static function listaEstado(){
        $currentPath= Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';

        if (preg_match($pattern, $currentPath)) {
            $estados = DB::table('cepbr_estado')
                ->Select('uf', 'estado')
                ->get();
            return $estados;
        }else{
            $estados = DB::table('cepbr_estado')
                ->Select('uf', 'estado')
                ->get();

            foreach ($estados as $item){
                $estado[] = $item->uf."-".$item->estado;

            }

            return $estado;
        }
    }

    public static function listaCidade($uf){
        $currentPath= Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';


        if (preg_match($pattern, $currentPath)) {

            $cidades = DB::table('cepbr_cidade')
                ->where('uf',$uf)
                ->Select('cidade','id_cidade')
                ->orderBy('cidade','ASC')
                ->get();
            
                foreach($cidades as $item){
                    $item->id_cidade = intval( $item->id_cidade);
                }



            $response=[
                'cidades'=> $cidades
            ];

            return $response;

        }else{

            $uf = explode('-',$uf);
            $cidades = DB::table('cepbr_cidade')
                ->where('uf',$uf[0])
                ->Select('cidade')
                ->orderBy('cidade','ASC')
                ->get();

            return $cidades;
        }
    }

    public static function cidadeId($id){
        $cidades = DB::table('cepbr_cidade')
            ->where('id_cidade', $id)
            ->Select('id_cidade')
            ->get();

        foreach ($cidades as $item){
            $cidade = intval($item);

        }
        return $cidade;
    }

    public static function cidade($id){
        $cidades = DB::table('cepbr_cidade')
            ->where('cidade', $id)
            ->Select('id_cidade')
            ->get();

        return $cidades[0]->id_cidade;
    }

}
