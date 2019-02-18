<?php namespace App\Services;

    use App\Repositories\ResumeRepository;

    class Resume{

        /**
         * Instancia del repositorio
         *
         * @var model
         */
        private $model;

        /**
         * data a retornar
         *
         * @var array
         */
        private $data;

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
         * Recibo el pk del usuario y el intervalo de tiempo
         *
         * @var string
         */
        public function __construct($users,$interval){
            $this->users = $users;
            $this->interval = $interval;
            $this->model = new ResumeRepository();
        }

        private function build(){
            $data = $this->model->getResume($this->users,$this->interval);

            foreach ($data as $dat){
                $date = "$dat->anio-$dat->mes";

                $date = date("F Y",strtotime($date));

                $this->data[$dat->co_usuario][$date]['neto'] = $dat->neto;
                $this->data[$dat->co_usuario][$date]['comision'] = $dat->comision;
                $this->data[$dat->co_usuario][$date]['salario'] = $dat->salario;
                $this->data[$dat->co_usuario][$date]['lucro'] = $dat->neto - ($dat->salario + $dat->comision);
            }

            return $this->data;
        }

        public function resume(){
            return $this->build();
        }
    }

?>