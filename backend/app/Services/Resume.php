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
         * Recibo el pk del usuario y el intervalo de tiempo
         *
         * @var string
         */
        public function __construct($users,$interval){
            $this->model = new ResumeRepository($users,$interval);
        }

        public function build(){
            $data = $this->model->getResume();

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
            return [
                'neto' => $this->neto,
                'fijo' => $this->fijo,
                'comision' => $this->comision
            ];
        }
    }

?>