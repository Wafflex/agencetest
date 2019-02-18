<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salario extends Model
{
    /**
     * Nombre de la tabla
     *
     * @var string
     */

    protected $table = 'cao_salario';

    /**
     * Primary key
     *
     * @var string
     */

    protected $primaryKey = 'co_usuario';

    public function user(){
        return $this->belongsTo(Usuer::class,'co_usuario','co_usuario');
    }
}
