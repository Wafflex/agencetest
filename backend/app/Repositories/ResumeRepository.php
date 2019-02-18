<?php namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ResumeRepository extends Repository
{
    public function __construct(){
        $this->model = new User();
    }
}