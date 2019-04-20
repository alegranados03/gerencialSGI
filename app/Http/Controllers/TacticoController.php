<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TacticoController extends Controller
{
    //
    public function producto_P1()
    {
        return view('tactico.producto_P1');
    }
    public function producto_P2()
    {
        return view('tactico.producto_P2');
    }
    public function producto_P3()
    {
        return view('tactico.producto_P3');
    }
    public function producto_P4()
    {
        return view('tactico.producto_P4');
    }
    public function materia_prima_P5()
    {
        return view('tactico.materia_prima_P5');
    }
    public function clientes_P6()
    {
        return view('tactico.clientes_P6');
    }
}
