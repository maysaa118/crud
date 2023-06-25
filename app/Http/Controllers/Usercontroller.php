<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Usercontroller extends Controller
{
    //
   public function index(){
        return __METHOD__;
    }
    public function show($first, $last ='Fanouna'){
      return $first .'' . $last;
    }
    public function info(){
        return 'info';
      }
}

