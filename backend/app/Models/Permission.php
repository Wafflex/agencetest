<?php

namespace App\Models;

class Permission extends Authenticatable
{
    /**
     * Name of table
     *
     * @var string
     */

    protected $table = 'permissao_sistema';

    public function user(){
        return $this->belongsTo(User::class,'co_usuario','co_usuario');
    }
}
