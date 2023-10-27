<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Categoria extends Model
{
    protected $table = 'TB_CATEGORIA_PRODUTO';

    protected $fillable = [
        'ID_CATEGORIA_PRODUTO','DS_CATEGORIA_PRODUTO','DS_FOTO_CATEGORIA_PRODUTO','DS_DESCRICAO_CATEGORIA_PRODUTO'
    ];


        //lista todas as categorias
    public static function listAll(){
        $listAllCategoria = DB::table('TB_CATEGORIA_PRODUTO')
            ->select('ID_CATEGORIA_PRODUTO','DS_CATEGORIA_PRODUTO','DS_FOTO_CATEGORIA_PRODUTO','DS_DESCRICAO_CATEGORIA_PRODUTO')
           // ->limit(12)
            ->get();
        return $listAllCategoria;

    }

        //lista 4 categorias
    public static function list4Categorias(){
        $list4Categorias = DB::table('TB_CATEGORIA_PRODUTO')
            ->select('ID_CATEGORIA_PRODUTO','DS_CATEGORIA_PRODUTO','DS_FOTO_CATEGORIA_PRODUTO','DS_DESCRICAO_CATEGORIA_PRODUTO')
            ->limit(4)
            ->get();

        return $list4Categorias;
    }

        //lista 4 categorias
    public static function tipoCategorias($id){
        $list4Categorias = DB::table('TB_CATEGORIA_PRODUTO')
            ->where('DS_CATEGORIA_PRODUTO', $id)
            ->select('ID_CATEGORIA_PRODUTO','DS_CATEGORIA_PRODUTO','DS_FOTO_CATEGORIA_PRODUTO','DS_DESCRICAO_CATEGORIA_PRODUTO')
            ->limit(4)
            ->get();

        return $list4Categorias;
    }

    //listar produto
    public static function listaProduto($cat){

        $listProduto = DB::table('TB_TIPO_PRODUTO')
            ->join('TB_CATEGORIA_PRODUTO','TB_CATEGORIA_PRODUTO.ID_CATEGORIA_PRODUTO','TB_TIPO_PRODUTO.ID_CATEGORIA_PRODUTO')
            //->where('DS_TIPO_PRODUTO','like','%'.$prod.'%')
            ->where('TB_CATEGORIA_PRODUTO.DS_CATEGORIA_PRODUTO',$cat)
            ->select('TB_TIPO_PRODUTO.ID_TIPO_PRODUTO','TB_TIPO_PRODUTO.DS_TIPO_PRODUTO')
            ->get();

        return $listProduto;
    }

    //id categoria
    public static function getId($cat){

        $listProduto = DB::table('TB_CATEGORIA_PRODUTO')
            ->where('TB_CATEGORIA_PRODUTO.DS_CATEGORIA_PRODUTO',$cat)
            ->select('ID_CATEGORIA_PRODUTO')
            ->get();

        return $listProduto['0']->ID_CATEGORIA_PRODUTO;
    }

    //id tipo categoria
    public static function getIdTipopoCat($cat){

        $listProduto = DB::table('TB_TIPO_PRODUTO')
            ->where('TB_TIPO_PRODUTO.DS_TIPO_PRODUTO',$cat)
            ->select('ID_TIPO_PRODUTO')
            ->get();

        return $listProduto['0']->ID_TIPO_PRODUTO;
    }

    //lista categorias
    public static function tipoCategoriasApp(){
        $list4Categorias = DB::table('TB_CATEGORIA_PRODUTO')
            ->select('ID_CATEGORIA_PRODUTO','DS_CATEGORIA_PRODUTO','DS_FOTO_CATEGORIA_PRODUTO','DS_DESCRICAO_CATEGORIA_PRODUTO')
            ->get();

        return $list4Categorias;
    }

        //lista top 5 categorias
    public static function topcategoria(){
        $listAllCategoria = DB::table('TB_CATEGORIA_PRODUTO')
            ->select('ID_CATEGORIA_PRODUTO','DS_CATEGORIA_PRODUTO','DS_FOTO_CATEGORIA_PRODUTO','DS_DESCRICAO_CATEGORIA_PRODUTO')
            ->orderBy('TB_CATEGORIA_PRODUTO.QT_VISITA','DSC')
            ->limit(5)
            ->get();
        return $listAllCategoria;

    }

    public static function addviewcategoria($cat)
    {
        $categoria = Categoria::where('TB_CATEGORIA_PRODUTO.ID_CATEGORIA_PRODUTO', $cat)->select('TB_CATEGORIA_PRODUTO.QT_VISITA')->first();

        $viewCategoria = DB::table('TB_CATEGORIA_PRODUTO')
            ->where('TB_CATEGORIA_PRODUTO.ID_CATEGORIA_PRODUTO',$cat)
            ->update([
                'TB_CATEGORIA_PRODUTO.QT_VISITA' => $categoria->QT_VISITA +1
            ]);
        return $viewCategoria;
    }


}
