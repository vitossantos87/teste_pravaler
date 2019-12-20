<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstituicaoModel extends Model
{
    protected $table = 'instituicoes';

    public static function jaExiste($cnpj){
        $instituicao = self::where('cnpj', '=', $cnpj)->first();
        return !$instituicao ? false : true;
    }

}
