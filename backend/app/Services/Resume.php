<?php namespace App\Services;

    use App\Repositories\ResumeRepository;
    use DB;
    
    class Resume{

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

        /**
         * Ingresos netos
         *
         * @var float
         */
        private $neto;

        /**
         * Ingreso fijo
         *
         * @var float
         */
        private $fijo;

        /**
         * Comisión
         *
         * @var float
         */
        private $comision;

        /**
         * Ganancia total
         *
         * @var array
         */
        private $lucro;

        // /**
        //  * Conjunto de transacciones
        //  *
        //  * @var array
        //  */

        // public $transactions;


        /**
         * Recibo el pk del usuario y el intervalo de tiempo
         *
         * @var string
         */
        public function __construct($users,$interval){
            $this->users = $users;
            $this->interval = (object) $interval;
            $this->model = new ResumeRepository();
        }

        /**
         * Recibo como parametro la transaccion que quiero obtener
         *
         * @var string
         */
        public function get($field){
            return $this->$field;
        }


        public function calculaNeto(){
            $this->neto = DB::table('cao_fatura')
                            ->whereIn('co_usuario',$this->users)
                            ->get();
        }

        public function build(){
            $this->calculaNeto();
        }

        public function resume(){
            $this->build();
            return [
                'neto' => $this->neto
            ];
        }
    }

?>