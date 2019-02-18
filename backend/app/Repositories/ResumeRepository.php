<?php namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Services\Date;
use DB;

class ResumeRepository extends Repository
{
    /**
     * Users de las transacciones
     *
     * @var string
     */
    public $users;

    /**
     * Intérvalo de tiempo del resumen
     *
     * @var array
     */
    public $interval;

    public function __construct($users,$interval){
        $this->users = $users;
        $this->interval = $interval;
        $this->model = new User();
    }

    public function getResume(){
        $dateService = new Date();

        $interval = $dateService->convert($this->interval,'Y-m-d');

        return DB::table('cao_fatura as factura')
                    ->selectRaw('os.co_usuario, MONTH(factura.data_emissao) as mes, YEAR(factura.data_emissao) as anio, SUM(factura.valor - (factura.total_imp_inc/100)) as neto, SUM(factura.valor - (factura.valor * factura.total_imp_inc/100) * factura.comissao_cn) as comision, cao_salario.brut_salario as salario')
                    ->leftJoin('cao_os as os','factura.co_os','=','os.co_os')
                    ->leftJoin('cao_usuario as usuario','os.co_usuario','=','usuario.co_usuario')
                    ->leftJoin('cao_salario','usuario.co_usuario','=','cao_salario.co_usuario')
                    ->whereIn('usuario.co_usuario',$this->users)
                    ->whereBetween('factura.data_emissao',$interval)
                    ->groupBy('mes','anio','co_usuario','salario')
                    ->orderBy('co_usuario')
                    ->orderBy('mes','ASC')
                    ->get();
    }
}