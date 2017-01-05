<?php defined('BASEPATH') OR exit('No direct script access allowed');

define('DS', DIRECTORY_SEPARATOR);
require(APPPATH . 'third_party' . DS . 'PagSeguro' . DS . 'autoload.php');

use PagSeguro\Library;

class PagSeguro {

	private $_pagSeguro;

	private $_credentials = NULL;

	public function __construct(){
		$this->_pagSeguro = new Library();
	}

	private function credentialsVerify(){
		if( $this->_credentials == NULL ){
			echo '<b>'.get_class($this).':</b> As credenciais precisam ser definidas.';
			die();
		}
	}

	public function setCredentials($email, $token){
		$this->_credentials = array();
		$this->_credentials['email'] = $email;
		$this->_credentials['token'] = $token;
		return $this->_pagSeguro->setCredentials($this->_credentials);
	}

	public function getSessionID(){
		$this->credentialsVerify();
		return $this->_pagSeguro->getSessionID();
	}

	public function doPayment(array $params){
		$this->credentialsVerify();
		return $this->_pagSeguro->doPayment( $params );
	}

	public function getNotifications(){
		$this->credentialsVerify();
		return $this->_pagSeguro->getNotifications();
	}

	public function getScriptURL(){
		return $this->_pagSeguro->getJavascriptURL();
	}

	public function transactionsAbandoned(array $params = array()){
		return json_decode(json_encode( $this->_pagSeguro->listTransactions($params, true) ));
	}

	public function listTransactions(array $params = array()){
		return json_decode(json_encode( $this->_pagSeguro->listTransactions($params) ));
	}

	public function transactionByCode($code){
		return json_decode(json_encode( $this->_pagSeguro->transactionByCode($code) ));
	}

	public function transactionByReference($ref){
		return json_decode(json_encode( $this->_pagSeguro->transactionByReference($ref) ));
	}

	public function cancelTransaction($code){
		return json_decode(json_encode( $this->_pagSeguro->cancelTransaction($code) ));
	}

}