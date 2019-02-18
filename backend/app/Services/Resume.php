<?php namespace App\Services;

    use App\Repositories\ResumeRepository;

    class Resume{
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
        
        /**
         * Recibo el pk del usuario y el intervalo de tiempo
         *
         * @var string
         */
        public function __construct($users,$interval){
            $this->model = new ResumeRepository($users,$interval);
        }

        /**
         * Recibo como parametro la transaccion que quiero obtener
         *
         * @var string
         */
        public function get($field){
            return $this->$field;
        }

        public function build(){
            $this->neto = $this->model->getNeto();
            $this->fijo = $this->model->getFijo();
        }

        public function resume(){
            $this->build();
            return [
                'neto' => $this->neto
            ];
        }
    }

?>