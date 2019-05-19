<?php

namespace App\Exports;
use DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
class Export implements FromArray, ShouldAutoSize,WithTitle, WithHeadings
{
	protected $resultado;
    protected $header;
    protected $titulo;
	public function __construct($resultado,$header,$titulo){
		$this->resultado=$resultado;
        $this->header = $header;
        $this->titulo = $titulo;
	}

    public function array(): Array
    {
        return $this->resultado;
    }
    public function headings(): Array
    {
        return $this->header;
    }

    public function title(): String
    {
        return $this->titulo;
    }
}