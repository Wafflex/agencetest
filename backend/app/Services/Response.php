<?php namespace App\Services;

    class Response{

        /**
         * Meta data
         *
         * @var array
         */
        public $meta;

        /**
         * Mensaje de respuesta
         *
         * @var string
         */
        public $status;

        /**
         * Data a enviar
         *
         * @var array
         */
        public $data;

        /**
         * Errores
         *
         * @var array
         */

        public $errors;


        /**
         * Se puede construir la respuesta mediante asignacion de atributos o pasandole un array
         *
         * @var array
         */
        public function __construct($data = NULL){
            $this->meta = $data['meta'];
            $this->status = $data['status'];
            $this->data = $data['data'];
            $this->errors = $data['errors'];
        }

        /**
         * Construcction del json, recibe como parametro el codigo http a enviar.
         *
         * @var integer
         */
        public function toJson($http){
            return response()->json($this,$http);
        }

    }

?>