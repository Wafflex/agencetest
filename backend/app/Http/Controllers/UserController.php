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

    public function __construct(User $user){
        $this->model = new Repository($user);
    }   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $users = $this->model->getModel()
                            ->whereHas('permission', function ($query){
                                $query->where('permissao_sistema.co_sistema',1)
                                        ->where('permissao_sistema.in_ativo','S')
                                        ->whereIn('permissao_sistema.co_tipo_usuario',[0,1,2]);
                            })
                            // ->where('permission.co_sistema',1)
                            // ->where('in_ativo','S')
                            // ->whereIn('co_tipo_usuario',[0,1,2])
                            ->get(['no_usuario']);

        $response = new Response();
        $response->meta = [
            'code' => 200
        ];

        $response->status = 'OK!';
        $response->data = $users;
        $response->errors = NULL;

        return $response->toJson(200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
