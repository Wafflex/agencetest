<?php namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserRepository extends Repository
{
    public function __construct(){
        $this->model = new User();
    }

    public function getConsultores(){
        $consultores = $this->model->getModel() // Obtengo el modelo para utilizar la funcion 'whereHas' propia de eloquent
            ->whereHas('permission', function ($query){
                $query->where('permissao_sistema.co_sistema',1)
                        ->where('permissao_sistema.in_ativo','S') //Establezco las condiciones indicadas en las instrucciones
                        ->whereIn('permissao_sistema.co_tipo_usuario',[0,1,2]);
            })
            ->get(['co_usuario','no_usuario']);
        
        return $consultores;
    }
}