<?php 

namespace App\Helpers;

class HelperAnuncio
{
    public static function checkExistsImage($id, $image)
    {              
        if(file_exists( $_SERVER['DOCUMENT_ROOT'] . '\eucomproonline\images\anuncios\/' . $id.'\/'. $image)){
            $image = 'http://eucompro.online/eucomproonline/images/anuncios/' . $id.'/'. $image;
        } else {
            $image = 'http://eucompro.online/eucomproonline/images/photo.png';
        }
        return $image;
    }
}