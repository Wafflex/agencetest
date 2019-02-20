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
                        'resume' => [[
                            'date' => $date,
                            'neto' => $dat->neto,
                            'comision' => $dat->comision,
                            'salario' => $dat->salario,
                            'lucro' => round($dat->neto - ($dat->salario - $dat->comision),2)
                        ]]
                    ];
            
                    $results[] = $structure;
                }
    
                $this->data = $this->unique_multidim_array($results,'no_usuario');

                // $salarioPromedio = 0;
                
                foreach ($this->data as $index => $consultor){
                    $totalNeto = $totalSalario = $totalComision = $totalLucro = 0;
                    $tempData = [];
                    foreach ($consultor['resume'] as $data){
                        $totalNeto += $data['neto'];
                        $totalSalario += $data['salario'];
                        $totalComision += $data['comision'];
                        $totalLucro += $data['lucro'];
                        $tempData['monthly'][] = $data;
                    }
                    // $salarioPromedio += $data['salario'];

                    $output['totalNeto'] = $totalNeto;
                    $output['totalSalario'] = $totalSalario;
                    $output['totalComision'] = $totalComision;
                    $output['totalLucro'] = $totalLucro;

                    $tempData['totals'] = $output;
                    
                    $this->data[$index]['resume'] = $tempData;
                }
            }else{
                $this->data = NULL;
            } 

            // $this->data['salarioPromedio'] = $salarioPromedio / COUNT($this->data);

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
                        $temp_array[$index]['resume'] = array_merge($temp_array[$index]['resume'],$result['resume']);
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