<?php namespace App\Services;

    class Resume{

        /**
         * User de la transaccion
         *
         * @var string
         */
        public $user;

        /**
         * Ingresos netos
         *
         * @var float
         */
        public $neto;

        /**
         * Ingreso fijo
         *
         * @var float
         */
        public $fijo;

        /**
         * Comisión
         *
         * @var float
         */
        public $comision;

        /**
         * Ganancia total
         *
         * @var array
         */
        public $lucro;

        /**
         * Conjunto de transacciones
         *
         * @var array
         */

        public $transactions;


        /**
         * Recibo el pk del usuario
         *
         * @var string
         */
        public function __construct($user){
            $this->user = $user;
        }

        
        public function getNeto(){
           
        }

    }

?>