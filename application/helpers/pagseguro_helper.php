<?php defined('BASEPATH') OR exit('No direct script access allowed');

if( !function_exists('psPaymentType') ){
	function psPaymentType( $type ){
		switch( $type ){
			case 1: return 'Cartão de Crédito';
			case 2: return 'Boleto';
			case 3: return 'Débito Online';
			case 4: return 'Saldo PagSeguro';
			case 5: return 'Oi Paggo';
			case 6: return 'Depósito em conta';
			default: return 'Unknow';
		}
	}
}

if( !function_exists('psPaymentCode') ){
	function psPaymentCode( $code ){
		switch( $code ){
			case 100: return 'Cartão de crédito Visa';
			case 102: return 'Cartão de crédito MasterCard';
			case 103: return 'Cartão de crédito American Express';
			case 104: return 'Cartão de crédito Diners';
			case 105: return 'Cartão de crédito Hipercard';
			case 106: return 'Cartão de crédito Aura';
			case 107: return 'Cartão de crédito Elo';
			case 108: return 'Cartão de crédito PLENOCard';
			case 109: return 'Cartão de crédito PersonalCard';
			case 110: return 'Cartão de crédito JCB';
			case 111: return 'Cartão de crédito Discover';
			case 112: return 'Cartão de crédito BrasilCard';
			case 113: return 'Cartão de crédito FORTBRASIL';
			case 114: return 'Cartão de crédito CARDBAN';
			case 115: return 'Cartão de crédito VALECARD';
			case 116: return 'Cartão de crédito Cabal';
			case 117: return 'Cartão de crédito Mais!';
			case 118: return 'Cartão de crédito Avista';
			case 119: return 'Cartão de crédito GRANDCARD';
			case 201: return 'Boleto Bradesco';
			case 202: return 'Boleto Santander';
			case 301: return 'Débito online Bradesco';
			case 302: return 'Débito online Itaú';
			case 303: return 'Débito online Unibanco';
			case 304: return 'Débito online Banco do Brasil';
			case 305: return 'Débito online Banco Real';
			case 306: return 'Débito online Banrisul';
			case 307: return 'Débito online HSBC';
			case 401: return 'Saldo PagSeguro';
			case 501: return 'Oi Paggo';
			case 701: return 'Depósito em conta - Banco do Brasil';
			default: return 'Unknow';
		}
	}
}

if( !function_exists('psMoneyBR') ){
	function psMoneyBR( $value ){
		return number_format($value, 2, ',', '.');
	}
}

if( !function_exists('psMoneyUS') ){
	function psMoneyUS( $value ){
		return number_format($value, 2, '.', ',');
	}
}

if( !function_exists('psCpfFormat') ){
	function psCpfFormat( $cpf ){
		return substr($cpf, 0, 2) . '.' . substr($cpf, 2, 3) . '-' . substr($cpf, 5);
	}
}

if( !function_exists('psToInt') ){
	function psToInt( $value ){
		return preg_replace('/\D/', '', $value);
	}
}

if( !function_exists('arrayToObj') ){
	function arrayToObj( $arr ){
		foreach($arr as $key => $val){
			if( is_array($val) ){
				$arr[$key] = arrayToObj($val);
			}
		}
		return (object)$arr;
	}
}