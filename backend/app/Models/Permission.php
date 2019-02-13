<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * Name of table
     *
     * @var string
     */

    protected $table = 'permissao_sistema';

    /**
     * Primary key
     *
     * @var string
     */

    protected $primaryKey = 'co_usuario';

    public function user(){
        return $this->belongsTo(User::class,'co_usuario','co_usuario');
    }
}
