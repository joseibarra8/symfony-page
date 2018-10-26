<?php
namespace App\Service;

class OperacionesClass{
	protected $valor1;
	protected $valor2;
	protected $resultado;
	const CONS = 1;

	public function cargar1($v1)
	{
		$this->valor1 = $v1;
	}
	public function cargar2($v2){
		$this->valor2 = $v2;
	}
	public function imprimirResultado()
	{
	  return $this->resultado;
	}
}
