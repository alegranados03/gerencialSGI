<?php

namespace App\Exports;
use DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
class Export implements FromArray, ShouldAutoSize, WithHeadings
{
	protected $resultado;
	protected $array;
	public function __construct($resultado,$header){
		$this->resultado=$resultado;
		$this->array = $header;
	}

    public function array(): array
    {
        return $this->resultado;
    }
    public function headings(): array
    {
        return $this->array;
    }

}