<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Hash;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'TB_ANUNCIANTE';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ID_ANUNCIANTE'
        ,'ID_BAIRRO'
        ,'DS_LOGIN'
        ,'DS_NOME'
        ,'DS_SOBRENOME'
        ,'DS_SENHA'
        ,'DS_EMAIL'
        ,'DT_CADASTRO'
        ,'NR_DDD_TELEFONE'
        ,'NR_TELEFONE',
        'IN_PROFISSIONAL'
        ,'IN_SEXO'
        ,'DS_TOKEN'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    public function getAuthPassword()
    {
        return $this->DS_SENHA;
    }

    public static function userdetail($id){

        $usuario = DB::table('TB_ANUNCIANTE')
            ->select(
                'ID_ANUNCIANTE'
                ,'TB_ANUNCIANTE.ID_BAIRRO'
                ,'DS_NOME'
                ,'DS_SOBRENOME'
                ,'DS_EMAIL'
                ,'DT_CADASTRO'
                ,'NR_DDD_TELEFONE'
                ,'NR_TELEFONE'
                ,'IN_PROFISSIONAL'
                ,'IN_SEXO'
                ,'DS_FOTO_COMPRADOR'
                
            )
            ->where('ID_ANUNCIANTE',$id)
            ->get();

        $endereco = DB::table('TB_ANUNCIANTE')
           // ->join('TB_ANUNCIANTE','users.id','TB_ANUNCIANTE.ID_ANUNCIANTE_LARAVEL')
            ->join('TB_BAIRRO','TB_ANUNCIANTE.ID_BAIRRO','TB_BAIRRO.ID_BAIRRO')
            ->join('cepbr_cidade','TB_BAIRRO.ID_CIDADE','cepbr_cidade.id_cidade')
            ->select(
            'TB_BAIRRO.DS_BAIRRO'
                ,'TB_BAIRRO.DS_COMPLEMENTO'
                ,'TB_BAIRRO.NR_ENDERECO'
                ,'TB_BAIRRO.DS_CEP'
                ,'cepbr_cidade.cidade'
                ,'cepbr_cidade.uf')
            ->where('ID_ANUNCIANTE',$id)
            ->get();

        $estados = Endereco::listaEstado();

        $usuario[0]->estados = $estados;
        $usuario[0]->endereco = $endereco;

        $avaliacao = DB::table('TB_AVALIACAO_PRODUTO') 
        ->join('TB_ANUNCIO_PRODUTO','TB_AVALIACAO_PRODUTO.ID_ANUNCIO_PRODUTO','TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO')  
        ->where('TB_ANUNCIO_PRODUTO.ID_ANUNCIANTE', $id)    
        ->select(
            DB::raw( 'SUM(TB_AVALIACAO_PRODUTO.VL_AVALIACAO)/ COUNT(TB_AVALIACAO_PRODUTO.VL_AVALIACAO) as avaliacao' )
                ,DB::raw( 'COUNT(TB_AVALIACAO_PRODUTO.VL_AVALIACAO) as qt_avaliacao' )
        )->get();         

        $usuario[0]->avaliacao = $avaliacao;

        return $usuario;
    }

//    public static function getId($id){
//        $usuario = DB::table('TB_ANUNCIANTE')
//            ->where('ID_ANUNCIANTE_LARAVEL',$id)
//            ->select('ID_ANUNCIANTE')
//            ->get();
//
//        return $usuario[0]->ID_ANUNCIANTE;
//
//    }
    public static function validacao($email){
        $listaUsers = DB::table('TB_ANUNCIANTE')
            ->select('DS_VALIDACAO')
            ->where('DS_EMAIL',$email)
            ->get();

        return $listaUsers;
    }

    public static function verificacao($id){
        $listaUsers = DB::table('TB_ANUNCIANTE')
            ->where('ID_ANUNCIANTE',$id)
            ->update(['DS_VALIDACAO' =>1]);

        return $listaUsers;
    }

    public static function updatesenha(array $array){
        $usuario = DB::table('TB_ANUNCIANTE')
            ->where('DS_EMAIL',$array['email'])
            ->update([
                'DS_SENHA' => Hash::make($array['senha']),
            ]);

        return $array['senha'];
    }

    public static function userchat($id_anuncio){
            $usuario = DB::table('TB_ANUNCIANTE')
          // ->join('TB_ANUNCIANTE','users.id','TB_ANUNCIANTE.ID_ANUNCIANTE_LARAVEL')
            ->join('TB_ANUNCIO_PRODUTO','TB_ANUNCIANTE.ID_ANUNCIANTE','TB_ANUNCIO_PRODUTO.ID_ANUNCIANTE')
            ->select(
                'TB_ANUNCIANTE.ID_ANUNCIANTE as id_user'
                ,'DS_NOME as nome'
                ,'DS_SOBRENOME as sobrenome'
                //,'ID_ANUNCIANTE_LARAVEL as id_laravel'
                ,'DS_FOTO_COMPRADOR as foto'

            )
            ->where('TB_ANUNCIANTE.ID_ANUNCIANTE',$id_anuncio)
            ->get();
        return $usuario;
    }

    public static function usuario($ID_ANUNCIANTE)
    {

        $usuario = DB::table('TB_ANUNCIANTE')
            //  ->join('TB_ANUNCIANTE','users.id','TB_ANUNCIANTE.ID_ANUNCIANTE_LARAVEL')
            ->select(
                'ID_ANUNCIANTE'
                ,'TB_ANUNCIANTE.ID_BAIRRO'
                ,'DS_NOME'
                ,'DS_SOBRENOME'
                ,'DS_EMAIL'
                ,'DT_CADASTRO'
                ,'NR_DDD_TELEFONE'
                ,'NR_TELEFONE'
                ,'IN_PROFISSIONAL'
                ,'IN_SEXO'
                //,'ID_ANUNCIANTE_LARAVEL'
                ,'DS_FOTO_COMPRADOR'
                ,'TB_ANUNCIANTE.DS_TOKEN'
            )
            ->where('ID_ANUNCIANTE',$ID_ANUNCIANTE)
            ->get();

        $endereco = DB::table('TB_ANUNCIANTE')
            // ->join('TB_ANUNCIANTE','users.id','TB_ANUNCIANTE.ID_ANUNCIANTE_LARAVEL')
            ->join('TB_BAIRRO','TB_ANUNCIANTE.ID_BAIRRO','TB_BAIRRO.ID_BAIRRO')
            ->join('cepbr_cidade','TB_BAIRRO.ID_CIDADE','cepbr_cidade.id_cidade')
            ->select(
                'TB_BAIRRO.DS_BAIRRO'
                ,'TB_BAIRRO.DS_COMPLEMENTO'
                ,'TB_BAIRRO.NR_ENDERECO'
                ,'TB_BAIRRO.DS_CEP'
                ,'cepbr_cidade.id_cidade'
                ,'cepbr_cidade.uf')
            ->where('ID_ANUNCIANTE',$ID_ANUNCIANTE)
            ->get();

        $usuario[0]->endereco = $endereco['0'];
        $usuario[0]->endereco->id_cidade = intval($usuario[0]->endereco->id_cidade);

        return $usuario;
    }

    public static function listcidade(){
        $cidade = DB::table('cepbr_cidade')->select('id_cidade','uf','cidade')->orderBy('uf', 'asc')->get();
        foreach( $cidade as $item){
            $item->id_cidade = intval( $item->id_cidade);
        }
        return $cidade;
    }

}
