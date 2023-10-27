<?php 

namespace App\Helpers;

class HelperUser
{
    public static function checkExistsImage($id, $image)
    {        
        if(file_exists('C:\Inetpub\vhosts\myappnow.com.br\eucompro.online\eucomproonline\images\usuarios\/' . $id.'\/'. $image)){
            $image = 'http://recicla-app.com.br/recicla/images/usuarios/' . $id.'/'. $image;
        } else {
            $image = 'http://recicla-app.com.br/recicla/images/default-user.png';
        }
        return $image;
    }
}