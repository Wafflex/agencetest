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
            
            if ($data->count() > 0){
                foreach ($data as $dat){
                    $date = "$dat->anio-$dat->mes";
    
                    $date = date("F Y",strtotime($date));
    
                    $structure = [
                        'no_usuario' => $dat->no_usuario, 
                        'data' => [[
                            'date' => $date,
                            'neto' => $dat->neto,
                            'comision' => $dat->comision,
                            'salario' => $dat->salario,
                            'lucro' => $dat->neto - ($dat->salario - $dat->comision)
                        ]]
                    ];
                    
                    
                    $results[] = $structure;
                }
    
                $this->data = $this->unique_multidim_array($results,'no_usuario');
            }else{
                $this->data = NULL;
            } 
            

            return $this->data;
        }

        private function unique_multidim_array($array, $key) { 
            $temp_array = [];
            foreach ($array as $index => $result){
                if ($temp_array == []){
                    $temp_array[] = $result;
                }else{
                    $found = false;
                    foreach ($temp_array as $index => $temp){
                        if ($result[$key] == $temp[$key]){
                            $found = true;
                        }
                    }

                    if ($found){
                        $temp_array[$index]['data'] = array_merge($temp_array[$index]['data'],$result['data']);
                    }else{
                        $temp_array[] = $result;
                    }
                }
            }

            return $temp_array;
        } 

        public function resume(){
            return $this->build();
        }
    }

?>