<?php

namespace PagSeguro;

use PagSeguro\Http;
use PagSeguro\XmlParser;

class Library {
	
	private $_sandbox = false;

	private $_sandboxData = array(
		'credentials' => array(
			'email' => 'YOUR_SANDBOX_EMAIL',
			'token' => 'YOUR_SANDBOX_TOKEN'
		),
		'sessionURL' => 'https://ws.sandbox.pagseguro.uol.com.br/v2/sessions',
		'transactionsURL' => 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions',
		'notificationsURL' => "https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/notifications/",
		'javascriptURL' => 'https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js'
	);

	private $_productionData = array(
		'credentials' => array(
			'email' => 'YOUR_PRODUCTION_EMAIL',
			'token' => 'YOUR_PRODUCTION_TOKEN'
		),
		'sessionURL' => 'https://ws.pagseguro.uol.com.br/v2/sessions',
		'transactionsURL' => 'https://ws.pagseguro.uol.com.br/v2/transactions',
		'notificationsURL' => "https://ws.pagseguro.uol.com.br/v2/transactions/notifications/",
		'javascriptURL' => 'https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js'
	);

	public function __construct( $sandbox = true ){
		$this->_sandbox = (bool)$sandbox;
	}

	public function setCredentials($cred){
		if ($this->_sandbox) {
			$this->_sandboxData['credentials'] = $cred;
		} else {
			$this->_productionData['credentials'] = $cred;
		}
		return;
	}

	private function getEnviromentData($key) {
		if ($this->_sandbox) {
			return $this->_sandboxData[$key];
		} else {
			return $this->_productionData[$key];
		}
	}
	
	public function getSessionURL() {
		return $this->getEnviromentData('sessionURL');
	}
	
	public function getTransactionsURL() {
		return $this->getEnviromentData('transactionsURL');
	}
	
	public function getJavascriptURL() {
		return $this->getEnviromentData('javascriptURL');
	}
	
	public function getNotificationsURL() {
		return $this->getEnviromentData('notificationsURL');
	}
	
	public function getCredentials() {
		return $this->getEnviromentData('credentials');
	}

	private function parseSessionIdFromXml($data) {
		// Creating an xml parser 
		$xmlParser = new XmlParser($data);
		// Verifying if is an XML
		if ($xml = $xmlParser->getResult("session")) {
			// Retrieving the id from "session node"
			return $xml['id'];
		} else {
			throw new \Exception("[$data] is not an XML");
		}
	}

	private function paymentResultXml($data) {
		// Creating an xml parser 
		$xmlParser = new XmlParser($data);
		// Verifying if is an XML
		if ($xml = $xmlParser->getResult()) {
			return $xml;
		} else {
			throw new \Exception("[$data] is not an XML");
		}
	}

	public function getSessionID() {
		// Creating a http connection (CURL abstraction)
		$httpConnection = new Http();
		// Request to PagSeguro Session API using Credentials
		$httpConnection->post($this->getSessionURL(), $this->getCredentials());
		// Request OK getting the result
		if ($httpConnection->getStatus() === 200) {
			$data = $httpConnection->getResponse();
			return $this->parseSessionIdFromXml($data);
		} else {
			throw new \Exception("API Request Error: ".$httpConnection->getStatus());
		}
	}

	public function doPayment($params) {
		// Adding parameters
		$params += $this->getCredentials(); // add credentials
		$params['paymentMode'] = 'default'; // paymentMode
		$params['currency'] = 'BRL'; // Currency (only BRL)
		// $params['reference'] = rand(0, 9999); // Setting the Application Order to Reference on PagSeguro
		
		// treat parameters here!
		$httpConnection = new Http();
		$httpConnection->post($this->getTransactionsURL(), $params);
		
		// Get Xml From response body
		$xmlArray = $this->paymentResultXml($httpConnection->getResponse());

		// Setting http status and show json as result
		//http_response_code($httpConnection->getStatus());
		header("HTTP/1.1 ".$httpConnection->getStatus());

		return $xmlArray;
	}

	public function getNotifications(){
		header("access-control-allow-origin: https://sandbox.pagseguro.uol.com.br");
		if(isset($_POST['notificationType']) && $_POST['notificationType'] == 'transaction'){
			$url = $this->getNotificationsURL() . $_POST['notificationCode'];
			$httpConnection = new Http();
			$httpConnection->get($url, $this->getCredentials());
			$xmlArray = $this->paymentResultXml($httpConnection->getResponse());
			return (object)$xmlArray['transaction'];
		}
		return FALSE;
	}

	public function listTransactions($params, $isAbandoned = false){
		$params += $this->getCredentials();
		$url = $this->getTransactionsURL();

		$url = ($isAbandoned) ? $url . '/abandoned' : $url;

		// Verifica se initialDate é maior que 6 meses atrás
		if( isset($params['initialDate']) ){
			// Data Atual
			$now = new \DateTime();

			$initialDate = new \DateTime($params['initialDate']);
			$datediff = $now->diff($initialDate);

			// Formata datas para o padrão Y-m-dTH:i
			$params['initialDate'] = $initialDate->format('Y-m-d\TH:i');

			if( $datediff->invert == 1 && $datediff->days > 180 ){
				throw new \Exception("initialDate must be lower than 6 months ago.");
			}
		}

		// Verifica se diferença entre initialDate e finalDate é superior a 30 dias
		if( isset($params['initialDate']) && isset($params['finalDate']) ){
			$initialDate = new \DateTime($params['initialDate']);
			$finalDate = new \DateTime($params['finalDate']);
			$datediff = $initialDate->diff($finalDate);

			// Formata datas para o padrão Y-m-dTH:i
			$params['finalDate'] = $finalDate->format('Y-m-d\TH:i');

			if( $datediff->invert == 0 && $datediff->days > 30 ){
				throw new \Exception("initialDate and finalDate diference must be lower or equal than 30 days.");
			}
		}

		// Se existir, finalDate precisa existir initialDate
		if( !isset($params['initialDate']) && isset($params['finalDate']) ){
			throw new \Exception("initialDate must be set.");
		}

		// Define initialDate para 3 dias atrás, caso não tenha sido definida
		if( !isset($params['initialDate']) ){
			// Data Atual
			$now = new \DateTime();
			$now->modify('-3 days');

			$params['initialDate'] = $now->format('Y-m-d\TH:i');
		}

		// Creating a http connection (CURL abstraction)
		$httpConnection = new Http();
		// Request to PagSeguro Session API using Credentials
		$httpConnection->get($url, $params);
		// Request OK getting the result
		if ($httpConnection->getStatus() === 200) {
			$response = $this->paymentResultXml($httpConnection->getResponse());

			$resultsInThisPage = $response['transactionSearchResult']['resultsInThisPage'];
			if( $resultsInThisPage == 1 ){
				$response['transactionSearchResult']['transactions']['transaction'] = array(0 => $response['transactionSearchResult']['transactions']['transaction']);
			}

			return $response;
		} else {
			throw new \Exception("API Request Error: ".$httpConnection->getStatus());
		}
	}

	public function transactionByCode( $code ){
		// Creating a http connection (CURL abstraction)
		$httpConnection = new Http();
		// Request to PagSeguro Session API using Credentials
		$httpConnection->get($this->getTransactionsURL() . "/$code", $this->getCredentials());
		// Request OK getting the result
		if ($httpConnection->getStatus() === 200) {
			return $this->paymentResultXml($httpConnection->getResponse());
		} else {
			throw new \Exception("API Request Error: ".$httpConnection->getStatus());
		}
	}

	public function transactionByReference( $reference ){
		$params = array('reference' => $reference);
		$params += $this->getCredentials();
		// Creating a http connection (CURL abstraction)
		$httpConnection = new Http();
		// Request to PagSeguro Session API using Credentials
		$httpConnection->get($this->getTransactionsURL(), $params);
		// Request OK getting the result
		if ($httpConnection->getStatus() === 200) {
			return $this->paymentResultXml($httpConnection->getResponse());
		} else {
			throw new \Exception("API Request Error: ".$httpConnection->getStatus());
		}
	}

	/**
	 * Para que uma transação possa ser cancelada,
	 * no momento da requisição seu status deve ser:
	 * Aguardando pagamento ou Em análise.
	 */
	public function cancelTransaction( $code ){
		$params = array('transactionCode' => $code);
		$params += $this->getCredentials();
		// Creating a http connection (CURL abstraction)
		$httpConnection = new Http();
		// Request to PagSeguro Session API using Credentials
		$httpConnection->post($this->getTransactionsURL() . '/cancels', $params);
		// Request OK getting the result
		if ($httpConnection->getStatus() === 200) {
			return $this->paymentResultXml($httpConnection->getResponse());
		} else {
			throw new \Exception("API Request Error: ".$httpConnection->getStatus());
		}
	}

}