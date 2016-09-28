<?php defined('BASEPATH') OR exit('No direct script access allowed');

define('DS', DIRECTORY_SEPARATOR);
require(APPPATH . 'third_party' . DS . 'OpenBoleto' . DS . 'autoload.php');

use OpenBoleto\Agente;
use OpenBoleto\Banco\BancoDoBrasil;
use OpenBoleto\Banco\BancoDoNordeste;
use OpenBoleto\Banco\Brb;
use OpenBoleto\Banco\Bradesco;
use OpenBoleto\Banco\Santander;
use OpenBoleto\Banco\Itau;
use OpenBoleto\Banco\Caixa;
use OpenBoleto\Banco\Unicred;

class Openboleto {

	public function Agente($nome, $documento, $endereco = null, $cep = null, $cidade = null, $uf = null){
		return new Agente($nome, $documento, $endereco, $cep, $cidade, $uf);
	}
	
	public function BancoDoBrasil($params){
		$boleto = new BancoDoBrasil($params);
		return $boleto->getOutput();
	}
	
	public function Bradesco($params){
		$boleto = new Bradesco($params);
		return $boleto->getOutput();
	}
	
	public function Brb($params){
		$boleto = new Brb($params);
		return $boleto->getOutput();
	}
	
	public function Caixa($params){
		$boleto = new Caixa($params);
		return $boleto->getOutput();
	}
	
	public function Itau($params){
		$boleto = new Itau($params);
		return $boleto->getOutput();
	}
	
	public function Santander($params){
		$boleto = new Santander($params);
		return $boleto->getOutput();
	}
	
	public function Unicred($params){
		$boleto = new Unicred($params);
		return $boleto->getOutput();
	}

	public function BancoDoNordeste($params){
		$boleto = new BancoDoNordeste($params);
		return $boleto->getOutput();
	}

}