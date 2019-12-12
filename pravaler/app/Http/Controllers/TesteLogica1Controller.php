<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TesteLogica1Controller extends Controller
{
    public function index(){
        return view('teste-logica1.teste1', []);
    }
}
