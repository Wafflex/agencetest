<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\UserRepository;
use App\Services\Resume;
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

    public function __construct(){
        $this->model = new UserRepository();  // Suelo utilizar el patron de diseño repository pattern..
        $this->response = new Response();
    }   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $consultores = $this->model->getConsultores();

        $this->response->meta = [
            'code' => 200
        ];

        $this->response->status = 'OK!';
        $this->response->data = $consultores;
        $this->response->errors = NULL;

        return $this->response->toJson(200);
    }

    /**
     * Obtener los resultados de los usuarios
     *
     * @param  string  $username
     */
    public function show(Request $request)
    {   
        $pks = explode(',',$request->users);

        $interval = [$request->since,$request->until];

        $resume = new Resume($pks,$interval);

        $resume = $resume->resume();

        // return $resume;

        $this->response->meta = [
            'code' => 200
        ];

        $this->response->status = 'OK!';
        $this->response->data = $resume;
        $this->response->errors = NULL;

        return $this->response->toJson(200);
        
    }
}
