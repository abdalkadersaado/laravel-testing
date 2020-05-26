<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct() {
        
        $this->middleware('auth')->except(['show','index']);

    }

     public function show()
    {
        $obj = new \stdClass(); 
        $obj->name = 'abd';
        $obj->id = 1 ; 
        $obj->gender = 'male' ;
        return  view('welcome',compact('obj'));
    }
    public function index()
    {
        $data = [];
        $data['id'] = 5 ;
        $data['name'] = 'abod';
       return view('welcome',$data);
    }
}
