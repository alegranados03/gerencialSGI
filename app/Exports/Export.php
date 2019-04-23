<?php

namespace App\Exports;
use DB;
use Maatwebsite\Excel\Concerns\FromArray;

class Export implements FromArray
{
	public $resultado;

	public function __construct($resultado){
		$this->resultado=$resultado;
	}
    public function array(): array
    {
        return $this->resultado;
    }
}