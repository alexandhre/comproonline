<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    protected $table = 'TB_ANUNCIANTE';

    protected $fillable = [
        'ID_ANUNCIANTE','ID_BAIRRO','DS_LOGIN','DS_NOME','DS_SOBRENOME','DS_SENHA','DS_EMAIL','DT_CADASTRO','NR_DDD_TELEFONE','NR_TELEFONE',
        'IN_PROFISSIONAL','IN_SEXO'
    ];
}
