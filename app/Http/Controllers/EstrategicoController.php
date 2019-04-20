<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstrategicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function producto_P1()
    {
        return view('estrategico.producto_P1');
    }
    public function producto_P2()
    {
        return view('estrategico.producto_P2');
    }
    public function materia_prima_P3()
    {
        return view('estrategico.materia_prima_P3');
    }
    public function clientes_P4()
    {
        return view('estrategico.clientes_P4');
    }
    public function clientes_P5()
    {
        return view('estrategico.clientes_P5');
    }
}
