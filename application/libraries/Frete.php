<?php defined('BASEPATH') OR exit('No direct script access allowed');

define('DS', DIRECTORY_SEPARATOR);
require(APPPATH . 'third_party' . DS . 'PagSeguro' . DS . 'autoload.php');

use PagSeguro\Correios;

class Frete {

	private $_correios;

	public function __construct(){
		$this->_correios = new Correios();
	}

	public function setCredenciais( $code, $senha ){
		$this->_correios->setCredenciais($code, $senha);
		return $this;
	}

	public function setCepOrigem( $cep ){
		$this->_correios->setCepOrigem( $cep );
		return $this;
	}

	public function setCepDestino( $cep ){
		$this->_correios->setCepDestino( $cep );
		return $this;
	}

	public function setFormato( $formato ){
		$this->_correios->setFormato( $formato );
		return $this;
	}

	public function setDimensoes($peso, $comp, $larg, $alt, $diam = 0){
		$this->_correios->setDimensoes($peso, $comp, $larg, $alt, $diam);
		return $this;
	}

	public function setValorDeclarado( $valor ){
		$this->_correios->setValorDeclarado( $valor );
		return $this;
	}

	public function consultar(){
		return $this->_correios->consultar();
	}
}