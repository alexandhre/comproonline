<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Endereco;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
class Anunciante extends Model
{
    protected $table = 'TB_ANUNCIANTE';

    protected $fillable = [
        'ID_ANUNCIANTE'
        ,'ID_BAIRRO'
        ,'DS_NOME'
        ,'DS_SOBRENOME'
        ,'DS_SENHA'
        ,'DS_EMAIL'
        ,'DS_LOGIN'
        ,'NR_DDD_TELEFONE'
        ,'NR_TELEFONE'
        ,'IN_PROFISSIONAL'
        ,'IN_SEXO'
        ,'DS_FOTO_COMPRADOR'
        ,'DS_TOKEN'
    ];

    protected $tableBairro = 'TB_BAIRRO';

    protected $fillableBairro = [
        'ID_CIDADE'
        ,'DS_BAIRRO'
        ,'DS_COMPLEMENTO'
        ,'NR_ENDERECO'
        ,'DS_CEP'
    ];

    public static function updateByIdWeb($data, $id)
    {

        $bairro = Endereco::updateOrCreat($data, $id);


        if($data[12]!= null){

            $newPath =  ("images\\usuarios\\".$id);
            $extecao = explode(".",$data[12]);
            $extecao = end($extecao);
            if(!file_exists($newPath)){
                mkdir($newPath,0777,true);
                chmod($newPath,0777);
            }

            $file = new Filesystem();
            $num = substr(md5(rand(600000 , 12000000)), 0,4);
            //adicionar na pasta usuario
            if ($file->moveDirectory('images\\resource\\tmp\\usuario\\'.$data[12],  "images\\usuarios\\".$id."\\photoUser".$num.".".$extecao)) {
                $files = glob("images/usuarios/" . $id . "/*"); // get all file names
                foreach ($files as $file) { // iterate files

                    if ($file !== 'images/usuarios/'.$id.'/' . "photoUser".$num.".".$extecao)
                        unlink($file); // delete file
                }
                $update = DB::table('TB_ANUNCIANTE')
                    ->where('ID_ANUNCIANTE',$id)
                    ->update([
                        'DS_NOME'=>$data[0],
                        'NR_TELEFONE'=>$data[1],
                        'NR_DDD_TELEFONE'=>$data[2],
                        'DS_EMAIL'=>$data[3],
                        'DS_SOBRENOME'=>$data[4],
                        'DS_FOTO_COMPRADOR' => "photoUser".$num.".".$extecao,
                        'ID_BAIRRO' => $bairro

      //                'IN_PROFISSIONAL'=>$data[3],
      //                'IN_SEXO'=>$data[5],
                    ]);
                session([
                    'photo' => "photoUser".$num.".".$extecao,
                ]);
                if($data[11] != ""){
                    $update = DB::table('TB_ANUNCIANTE')
                        ->where('ID_ANUNCIANTE',$id)
                        ->update([  'DS_SENHA'=> Hash::make($data[11]),]);
                }

            } else {

                $errors = error_get_last();
                $error = $errors['type'];
                return $error;
            }
        }else{

            $update = DB::table('TB_ANUNCIANTE')
                ->where('ID_ANUNCIANTE',$id)
                ->update([
                    'DS_NOME'=>$data[0],
                    'NR_TELEFONE'=>$data[1],
                    'NR_DDD_TELEFONE'=>$data[2],
                    'DS_EMAIL'=>$data[3],
                    'DS_SOBRENOME'=>$data[4],

                    'ID_BAIRRO' => $bairro

//                'IN_PROFISSIONAL'=>$data[3],
//                'IN_SEXO'=>$data[5],
                ]);

        }

//        $update = DB::table('users')
//            ->where('id',$id)
//            ->update([
//                'email' =>$data[3]
//            ]);
        if($data[11] != ""){
            $update = DB::table('TB_ANUNCIANTE')
                ->where('ID_ANUNCIANTE',$id)
                ->update([  'DS_SENHA'=> Hash::make($data[11]),]);
        }

        $anuciante = Anunciante::select('DS_FOTO_COMPRADOR','DS_NOME')->where('ID_ANUNCIANTE',$id)->first();
        if($anuciante->DS_FOTO_COMPRADOR === null){
            $anuciante->DS_FOTO_COMPRADOR = 'null';
        }
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/http/controllers/eucompronline-fa251-firebase-adminsdk-7tj8d-198bfdc8b7.json');
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->create();

        $database = $firebase->getDatabase();

        $conversas = $database->getReference('users/'.$id)->update([
            'name' => $anuciante->DS_NOME,
            'profilePicture' => 'http://eucompro.online/eucomproonline/images\usuarios\\'.$id.'\\'.$anuciante->DS_FOTO_COMPRADOR
        ]);



        return $update;

    }


    public static function updateById($data){



        $foto_usuario = '0';
        $items = [];
        $userItem =[];
        $ends = [];
        if(array_key_exists("nome", $data)){
            $items['DS_NOME']=$data->nome;
        }
        if(array_key_exists("sobrenome", $data)){
            $items['DS_SOBRENOME']= $data->sobrenome;
        }
        if(array_key_exists("email", $data)){
            $items['DS_EMAIL'] = $data->email ;
        }if(array_key_exists("email", $data)){
            $items['DS_LOGIN'] = $data->email ;
        }  if(array_key_exists("senha", $data)){
            $items['DS_SENHA'] = Hash::make($data->senha);
        } if(array_key_exists("telefone", $data)){
            $items['NR_TELEFONE'] = $data->telefone ;
        } if(array_key_exists("dddTelefone", $data)){
            $items['NR_DDD_TELEFONE'] = $data->dddTelefone ;
        } if(array_key_exists("foto", $data)){
           // $items['DS_FOTO_COMPRADOR'] = $data->foto ;
                  $foto_usuario = $data->foto;
        }if(array_key_exists("profissional", $data)){
            $items['IN_PROFISSIONAL'] = $data->profissional ;
        }if(array_key_exists("sexo", $data)){
            $items['IN_SEXO'] = $data->sexo ;
        }


        if(array_key_exists("nrendereco", $data)){
            $ends['NR_ENDERECO'] = $data->nrendereco;
        }if(array_key_exists("complemento", $data)){
            $ends['DS_COMPLEMENTO'] = $data->complemento;
        }if(array_key_exists("bairro", $data)){
            $ends['DS_BAIRRO'] = $data->bairro;
        }if(array_key_exists("cep", $data)){
            $ends['DS_CEP'] = $data->cep;
        }if(array_key_exists("idcidade", $data)){
            $ends['ID_CIDADE'] = $data->idcidade;
        }
        if($ends != []) {
            $update = DB::table('TB_ANUNCIANTE')
                ->where('ID_ANUNCIANTE', $data->id)
                ->update($items);
        }
        if($ends != []){
            $update = DB::table('TB_BAIRRO')
                ->where( 'ID_USUARIO',$data->id)
                ->update($ends);
        }




        if($foto_usuario === '0'){
            \File::delete("images\\usuarios\\".$data->id);
        }else{
            $newPath =  ("images\\usuarios\\".$data->id);
            $oldPath = ("images\\resource\\tmp\\usuario\\".$foto_usuario);

            $launch = explode(".", $foto_usuario);
            
            $form = end($launch);
            $string = substr(md5(rand(600000 , 12000000)), 0,4);
            $foto = "photoUser".$string.".".$form;
            if(!file_exists($newPath)){
                mkdir($newPath,0777,true);
                chmod($newPath,0777);
            }
            $file = new Filesystem();

//            if ($file->moveDirectory("images\\resource\\tmp\\usuario\\".$foto_usuario,  "images\\usuarios\\".$data->id.'\\'.$foto)) {

            //adicionar pasta usuario

            if ($file->moveDirectory("C:\Inetpub\\vhosts\myappnow.com.br\\eucompro.online\\eucomproonline\\images\\resource\\tmp\\usuario\\".$foto_usuario,  "C:\Inetpub\\vhosts\myappnow.com.br\\eucompro.online\\eucomproonline\\images\\usuarios\\".$data->id.'\\'.$foto)) {

                $update = DB::table('TB_ANUNCIANTE')
                    ->where('ID_ANUNCIANTE',$data->id)
                    ->update(['DS_FOTO_COMPRADOR' => $foto ]);

            } else {

                $error = 0;

                return $error;
            }
        }

        $anuciante = Anunciante::select('DS_FOTO_COMPRADOR','DS_NOME')->where('ID_ANUNCIANTE',$data->id)->first();
        if($anuciante->DS_FOTO_COMPRADOR === null){
            $anuciante->DS_FOTO_COMPRADOR = 'null';
        }
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/http/controllers/eucompronline-fa251-firebase-adminsdk-7tj8d-198bfdc8b7.json');
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->create();

        $database = $firebase->getDatabase();

        $conversas = $database->getReference('users/'.$data->id)->update([
            'name' => $anuciante->DS_NOME,
            'profilePicture' => 'http://eucompro.online/eucomproonline/images\usuarios\\'.$data->id.'\\'.$anuciante->DS_FOTO_COMPRADOR
        ]);
        if($update == 1){
            return $update;
        }else{
            return response()->json(['error' => 'update erro'], 423);
        }
    }

}
