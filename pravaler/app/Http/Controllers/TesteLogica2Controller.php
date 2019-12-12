<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TesteLogica2Controller extends Controller
{
    public function index(){
        return view('teste-logica2.teste2', []);
    }
}
