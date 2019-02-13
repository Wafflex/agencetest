<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\Repository;
use App\Services\Response;

class UserController extends Controller
{   
    /**
     * Instancia del modelo
     *
     * @var object
     */
    protected $model;


    /**
     * Instancia de clase respuesta
     *
     * @var object
     */
    protected $response;

    public function __construct(User $user){
        $this->model = new Repository($user);  // Suelo utilizar el patron de diseño repository pattern..
        $this->response = new Response();
    }   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $users = $this->model->getModel() // Obtengo el modelo para utilizar la funcion 'whereHas' propia de eloquent
            ->whereHas('permission', function ($query){
                $query->where('permissao_sistema.co_sistema',1)
                        ->where('permissao_sistema.in_ativo','S') //Establezco las condiciones indicadas en las instrucciones
                        ->whereIn('permissao_sistema.co_tipo_usuario',[0,1,2]);
            })
            ->get(['co_usuario','no_usuario']);

        $this->response->meta = [
            'code' => 200
        ];

        $this->response->status = 'OK!';
        $this->response->data = $users;
        $this->response->errors = NULL;

        return $response->toJson(200);
    }

    /**
     * Obtener los resultados de los usuarios
     *
     * @param  string  $username
     */
    public function show(Request $request)
    {   
        $pks = explode(',',$request->users);

        $months = self::diffBetween2Dates($request);

        return $months;

        return var_dump(date_diff($since,$until));
        
        $users = $this->model->showMany($pks);

        foreach ($users as $user){
            $data[$user['no_usuario']][$since] = 1; 
        }

  

        // $data[
        //     ''
        // ]
    }

    private function diffBetween2Dates($request){
        $since = $request->since;
        $until = $request->until;

        $output = [];
        $time   = strtotime($since);
        $last   = date('m-Y', strtotime($until));

        do {
            $month = date('m', $time);
            $year = date('Y',$time);

            // $days = date('t', $time);

            $date = date('m-Y',$time);
            

            $output[] = $date;
            $time = strtotime('+1 month', $time);
        } while ($date != $last);

        return $output;
    }


}
