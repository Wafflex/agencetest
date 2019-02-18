<?php namespace App\Services;

Use Carbon\Carbon;

class Date 
{
    public function __construct(){
        
    }

    public function convert($dates,$format){

        foreach ($dates as $date){
            $output[] = Carbon::parse($date)->format($format);
        }

        return $output;
    }
}