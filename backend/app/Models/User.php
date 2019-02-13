<?php

namespace App\Models;

class User extends Authenticatable
{
    /**
     * Name of table
     *
     * @var string
     */

    protected $table = 'cao_usuario';

    public function permission(){
        return $this->belongsTo(Permission::class,'co_usuario','co_usuario');
    }
}
