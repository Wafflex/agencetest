<?php

namespace App\Models;

class User extends Authenticatable
{
    /**
     * Nombre de la tabla
     *
     * @var string
     */

    protected $table = 'cao_usuario';

    /**
     * Primary key
     *
     * @var string
     */

    protected $primaryKey = 'co_usuario';

    public function permission(){
        return $this->belongsTo(Permission::class,'co_usuario','co_usuario');
    }
}
