<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Copenboleto extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('openboleto');
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){
		redirect();
	}
	
	public function bancodobrasil(){
		$sacado = $this->openboleto->Agente('Fernando Maia', '023.434.234-34', 'ABC 302 Bloco N', '72000-000', 'Brasília', 'DF');
		$cedente = $this->openboleto->Agente('Empresa de cosméticos LTDA', '02.123.123/0001-11', 'CLS 403 Lj 23', '71000-000', 'Brasília', 'DF');
		$boleto = $this->openboleto->BancoDoBrasil(array(
			// Parâmetros obrigatórios
			'dataVencimento' => new DateTime('2013-01-24'),
			'valor' => 23.00,
			'sequencial' => 1234567,
			'sacado' => $sacado,
			'cedente' => $cedente,
			'agencia' => 1724, // Até 4 dígitos
			'carteira' => 18,
			'conta' => 10403005, // Até 8 dígitos
			'convenio' => 1234, // 4, 6 ou 7 dígitos

			// Caso queira um número sequencial de 17 dígitos, a cobrança deverá:
			// - Ser sem registro (Carteiras 16 ou 17)
			// - Convênio com 6 dígitos
			// Para isso, defina a carteira como 21 (mesmo sabendo que ela é 16 ou 17, isso é uma regra do banco)

			// Parâmetros recomendáveis
			//'logoPath' => 'http://empresa.com.br/logo.jpg', // Logo da sua empresa
			'contaDv' => 2,
			'agenciaDv' => 1,
			'descricaoDemonstrativo' => array( // Até 5
				'Compra de materiais cosméticos',
				'Compra de alicate',
			),
			'instrucoes' => array( // Até 8
				'Após o dia 30/11 cobrar 2% de mora e 1% de juros ao dia.',
				'Não receber após o vencimento.',
			),

			// Parâmetros opcionais
			//'resourcePath' => '../resources',
			//'moeda' => BancoDoBrasil::MOEDA_REAL,
			//'dataDocumento' => new DateTime(),
			//'dataProcessamento' => new DateTime(),
			//'contraApresentacao' => true,
			//'pagamentoMinimo' => 23.00,
			//'aceite' => 'N',
			//'especieDoc' => 'ABC',
			//'numeroDocumento' => '123.456.789',
			//'usoBanco' => 'Uso banco',
			//'layout' => 'layout.phtml',
			//'logoPath' => 'http://boletophp.com.br/img/opensource-55x48-t.png',
			//'sacadorAvalista' => new Agente('Antônio da Silva', '02.123.123/0001-11'),
			//'descontosAbatimentos' => 123.12,
			//'moraMulta' => 123.12,
			//'outrasDeducoes' => 123.12,
			//'outrosAcrescimos' => 123.12,
			//'valorCobrado' => 123.12,
			//'valorUnitario' => 123.12,
			//'quantidade' => 1,
		));

		echo $boleto;
	}
	
	public function bradesco(){
		$sacado = $this->openboleto->Agente('Fernando Maia', '023.434.234-34', 'ABC 302 Bloco N', '72000-000', 'Brasília', 'DF');
		$cedente = $this->openboleto->Agente('Empresa de cosméticos LTDA', '02.123.123/0001-11', 'CLS 403 Lj 23', '71000-000', 'Brasília', 'DF');
		$boleto = $this->openboleto->Bradesco(array(
			// Parâmetros obrigatórios
			'dataVencimento' => new DateTime('2013-01-24'),
			'valor' => 23.00,
			'sequencial' => 75896452, // Até 11 dígitos
			'sacado' => $sacado,
			'cedente' => $cedente,
			'agencia' => 1172, // Até 4 dígitos
			'carteira' => 6, // 3, 6 ou 9
			'conta' => 0403005, // Até 7 dígitos
			// Parâmetros recomendáveis
			//'logoPath' => 'http://empresa.com.br/logo.jpg', // Logo da sua empresa
			'contaDv' => 2,
			'agenciaDv' => 1,
			'descricaoDemonstrativo' => array( // Até 5
				'Compra de materiais cosméticos',
				'Compra de alicate',
			),
			'instrucoes' => array( // Até 8
				'Após o dia 30/11 cobrar 2% de mora e 1% de juros ao dia.',
				'Não receber após o vencimento.',
			),
			// Parâmetros opcionais
			//'resourcePath' => '../resources',
			//'cip' => '000', // Apenas para o Bradesco
			//'moeda' => Bradesco::MOEDA_REAL,
			//'dataDocumento' => new DateTime(),
			//'dataProcessamento' => new DateTime(),
			//'contraApresentacao' => true,
			//'pagamentoMinimo' => 23.00,
			//'aceite' => 'N',
			//'especieDoc' => 'ABC',
			//'numeroDocumento' => '123.456.789',
			//'usoBanco' => 'Uso banco',
			//'layout' => 'layout.phtml',
			//'logoPath' => 'http://boletophp.com.br/img/opensource-55x48-t.png',
			//'sacadorAvalista' => new Agente('Antônio da Silva', '02.123.123/0001-11'),
			//'descontosAbatimentos' => 123.12,
			//'moraMulta' => 123.12,
			//'outrasDeducoes' => 123.12,
			//'outrosAcrescimos' => 123.12,
			//'valorCobrado' => 123.12,
			//'valorUnitario' => 123.12,
			//'quantidade' => 1,
		));
		echo $boleto;
	}
	
	public function brb(){
		$sacado = $this->openboleto->Agente('Fernando Maia', '023.434.234-34', 'ABC 302 Bloco N', '72000-000', 'Brasília', 'DF');
		$cedente = $this->openboleto->Agente('Empresa de cosméticos LTDA', '02.123.123/0001-11', 'CLS 403 Lj 23', '71000-000', 'Brasília', 'DF');
		$boleto = $this->openboleto->Brb(array(
			// Parâmetros obrigatórios
			'dataVencimento' => new DateTime('2013-01-24'),
			'valor' => 23.00,
			'sequencial' => 758964, // Até 6 dígitos
			'sacado' => $sacado,
			'cedente' => $cedente,
			'agencia' => 172, // Até 3 dígitos
			'carteira' => 1, // 1 ou 2
			'conta' => 0403005, // Até 7 dígitos
			// Parâmetros recomendáveis
			//'logoPath' => 'http://empresa.com.br/logo.jpg', // Logo da sua empresa
			'contaDv' => 2,
			'agenciaDv' => 1,
			'descricaoDemonstrativo' => array( // Até 5
				'Compra de materiais cosméticos',
				'Compra de alicate',
			),
			'instrucoes' => array( // Até 8
				'Após o dia 30/11 cobrar 2% de mora e 1% de juros ao dia.',
				'Não receber após o vencimento.',
			),
			// Parâmetros opcionais
			//'resourcePath' => '../resources',
			//'moeda' => Brb::MOEDA_REAL,
			//'dataDocumento' => new DateTime(),
			//'dataProcessamento' => new DateTime(),
			//'contraApresentacao' => true,
			//'pagamentoMinimo' => 23.00,
			//'aceite' => 'N',
			//'especieDoc' => 'ABC',
			//'numeroDocumento' => '123.456.789',
			//'usoBanco' => 'Uso banco',
			//'layout' => 'layout.phtml',
			//'logoPath' => 'http://boletophp.com.br/img/opensource-55x48-t.png',
			//'sacadorAvalista' => new Agente('Antônio da Silva', '02.123.123/0001-11'),
			//'descontosAbatimentos' => 123.12,
			//'moraMulta' => 123.12,
			//'outrasDeducoes' => 123.12,
			//'outrosAcrescimos' => 123.12,
			//'valorCobrado' => 123.12,
			//'valorUnitario' => 123.12,
			//'quantidade' => 1,
		));
		echo $boleto;
	}
	
	public function caixa(){
		$sacado = $this->openboleto->Agente('Fernando Maia', '023.434.234-34', 'ABC 302 Bloco N', '72000-000', 'Brasília', 'DF');
		$cedente = $this->openboleto->Agente('Empresa de cosméticos LTDA', '02.123.123/0001-11', 'CLS 403 Lj 23', '71000-000', 'Brasília', 'DF');
		$boleto = $this->openboleto->Caixa(array(
			// Parâmetros obrigatórios
			'dataVencimento' => new DateTime('2013-01-24'),
			'valor' => 23.00,
			'sequencial' => 1234567,
			'sacado' => $sacado,
			'cedente' => $cedente,
			'agencia' => '0501', // Até 4 dígitos
			'carteira' => 'SR', // SR => Sem Registro ou RG => Registrada
			'conta' => '433756', // Até 6 dígitos
			// Parâmetros recomendáveis
			//'logoPath' => 'http://empresa.com.br/logo.jpg', // Logo da sua empresa
			'contaDv' => 2,
			'agenciaDv' => 1,
			'descricaoDemonstrativo' => array( // Até 5
				'Compra de materiais cosméticos',
				'Compra de alicate',
			),
			'instrucoes' => array( // Até 8
				'Após o dia 30/11 cobrar 2% de mora e 1% de juros ao dia.',
				'Não receber após o vencimento.',
			),
			// Parâmetros opcionais
			//'resourcePath' => '../resources',
			//'moeda' => Caixa::MOEDA_REAL,
			//'dataDocumento' => new DateTime(),
			//'dataProcessamento' => new DateTime(),
			//'contraApresentacao' => true,
			//'pagamentoMinimo' => 23.00,
			//'aceite' => 'N',
			//'especieDoc' => 'ABC',
			//'numeroDocumento' => '123.456.789',
			//'usoBanco' => 'Uso banco',
			//'layout' => 'caixa.phtml',
			//'logoPath' => 'http://boletophp.com.br/img/opensource-55x48-t.png',
			//'sacadorAvalista' => new Agente('Antônio da Silva', '02.123.123/0001-11'),
			//'descontosAbatimentos' => 123.12,
			//'moraMulta' => 123.12,
			//'outrasDeducoes' => 123.12,
			//'outrosAcrescimos' => 123.12,
			//'valorCobrado' => 123.12,
			//'valorUnitario' => 123.12,
			//'quantidade' => 1,
		));
		echo $boleto;
	}
	
	public function itau(){
		$sacado = $this->openboleto->Agente('Fernando Maia', '023.434.234-34', 'ABC 302 Bloco N', '72000-000', 'Brasília', 'DF');
		$cedente = $this->openboleto->Agente('Empresa de cosméticos LTDA', '02.123.123/0001-11', 'CLS 403 Lj 23', '71000-000', 'Brasília', 'DF');
		$boleto = $this->openboleto->Itau(array(
			// Parâmetros obrigatórios
			'dataVencimento' => new DateTime('2013-01-24'),
			'valor' => 23.00,
			'sequencial' => 12345678, // 8 dígitos
			'sacado' => $sacado,
			'cedente' => $cedente,
			'agencia' => 1724, // 4 dígitos
			'carteira' => 112, // 3 dígitos
			'conta' => 12345, // 5 dígitos
			
			// Parâmetro obrigatório somente se a carteira for
			// 107, 122, 142, 143, 196 ou 198
			'codigoCliente' => 12345, // 5 dígitos
			'numeroDocumento' => 1234567, // 7 dígitos
			// Parâmetros recomendáveis
			//'logoPath' => 'http://empresa.com.br/logo.jpg', // Logo da sua empresa
			'contaDv' => 2,
			'agenciaDv' => 1,
			'descricaoDemonstrativo' => array( // Até 5
				'Compra de materiais cosméticos',
				'Compra de alicate',
			),
			'instrucoes' => array( // Até 8
				'Após o dia 30/11 cobrar 2% de mora e 1% de juros ao dia.',
				'Não receber após o vencimento.',
			),
			// Parâmetros opcionais
			//'resourcePath' => '../resources',
			//'moeda' => Itau::MOEDA_REAL,
			//'dataDocumento' => new DateTime(),
			//'dataProcessamento' => new DateTime(),
			//'contraApresentacao' => true,
			//'pagamentoMinimo' => 23.00,
			//'aceite' => 'N',
			//'especieDoc' => 'ABC',
			//'usoBanco' => 'Uso banco',
			//'layout' => 'layout.phtml',
			//'logoPath' => 'http://boletophp.com.br/img/opensource-55x48-t.png',
			//'sacadorAvalista' => new Agente('Antônio da Silva', '02.123.123/0001-11'),
			//'descontosAbatimentos' => 123.12,
			//'moraMulta' => 123.12,
			//'outrasDeducoes' => 123.12,
			//'outrosAcrescimos' => 123.12,
			//'valorCobrado' => 123.12,
			//'valorUnitario' => 123.12,
			//'quantidade' => 1,
		));
		echo $boleto;
	}
	
	public function santander(){
		$sacado = $this->openboleto->Agente('Fernando Maia', '023.434.234-34', 'ABC 302 Bloco N', '72000-000', 'Brasília', 'DF');
		$cedente = $this->openboleto->Agente('Empresa de cosméticos LTDA', '02.123.123/0001-11', 'CLS 403 Lj 23', '71000-000', 'Brasília', 'DF');
		$boleto = $this->openboleto->Santander(array(
			// Parâmetros obrigatórios
			'dataVencimento' => new DateTime('2013-01-24'),
			'valor' => 23.00,
			'sequencial' => 12345678901, // Até 13 dígitos
			'sacado' => $sacado,
			'cedente' => $cedente,
			'agencia' => 1234, // Até 4 dígitos
			'carteira' => 102, // 101, 102 ou 201
			'conta' => 1234567, // Código do cedente: Até 7 dígitos
			 // IOS – Seguradoras (Se 7% informar 7. Limitado a 9%)
			 // Demais clientes usar 0 (zero)
			'ios' => '0', // Apenas para o Santander
			// Parâmetros recomendáveis
			//'logoPath' => 'http://empresa.com.br/logo.jpg', // Logo da sua empresa
			'contaDv' => 2,
			'agenciaDv' => 1,
			'descricaoDemonstrativo' => array( // Até 5
				'Compra de materiais cosméticos',
				'Compra de alicate',
			),
			'instrucoes' => array( // Até 8
				'Após o dia 30/11 cobrar 2% de mora e 1% de juros ao dia.',
				'Não receber após o vencimento.',
			),
			// Parâmetros opcionais
			//'resourcePath' => '../resources',
			//'moeda' => Santander::MOEDA_REAL,
			//'dataDocumento' => new DateTime(),
			//'dataProcessamento' => new DateTime(),
			//'contraApresentacao' => true,
			//'pagamentoMinimo' => 23.00,
			//'aceite' => 'N',
			//'especieDoc' => 'ABC',
			//'numeroDocumento' => '123.456.789',
			//'usoBanco' => 'Uso banco',
			//'layout' => 'layout.phtml',
			//'logoPath' => 'http://boletophp.com.br/img/opensource-55x48-t.png',
			//'sacadorAvalista' => new Agente('Antônio da Silva', '02.123.123/0001-11'),
			//'descontosAbatimentos' => 123.12,
			//'moraMulta' => 123.12,
			//'outrasDeducoes' => 123.12,
			//'outrosAcrescimos' => 123.12,
			//'valorCobrado' => 123.12,
			//'valorUnitario' => 123.12,
			//'quantidade' => 1,
		));
		echo $boleto;
	}
	
	public function unicred(){
		$sacado = $this->openboleto->Agente('Fernando Maia', '023.434.234-34', 'ABC 302 Bloco N', '72000-000', 'Brasília', 'DF');
		$cedente = $this->openboleto->Agente('Empresa de cosméticos LTDA', '02.123.123/0001-11', 'CLS 403 Lj 23', '71000-000', 'Brasília', 'DF');
		$boleto = $this->openboleto->Unicred(array(
			// Parâmetros obrigatórios
			'dataVencimento' => new DateTime('2013-07-20'),
			'valor' => 1093.79,
			'sacado' => $sacado,
			'cedente' => $cedente,
			'agencia' => 3302, // Até 4 dígitos
			'carteira' => 51, // 11, 21, 31, 41 ou 51
			'conta' => 2259, // Até 10 dígitos
			'sequencial' => '13951', // Até 10 dígitos
			// Parâmetros recomendáveis
			//'logoPath' => 'http://empresa.com.br/logo.jpg', // Logo da sua empresa
			// 'contaDv' => 2,
			// 'agenciaDv' => 1,
			'descricaoDemonstrativo' => array( // Até 5
				'Compra de materiais cosméticos',
				'Compra de alicate',
			),
			'instrucoes' => array( // Até 8
				'Após o dia 30/11 cobrar 2% de mora e 1% de juros ao dia.',
				'Não receber após o vencimento.',
			),
			// Parâmetros opcionais
			//'resourcePath' => '../resources',
			//'moeda' => BancoDoBrasil::MOEDA_REAL,
			//'dataDocumento' => new DateTime(),
			//'dataProcessamento' => new DateTime(),
			//'contraApresentacao' => true,
			//'pagamentoMinimo' => 23.00,
			//'aceite' => 'N',
			//'especieDoc' => 'ABC',
			//'numeroDocumento' => '123.456.789',
			//'usoBanco' => 'Uso banco',
			//'layout' => 'layout.phtml',
			//'logoPath' => 'http://boletophp.com.br/img/opensource-55x48-t.png',
			//'sacadorAvalista' => new Agente('Antônio da Silva', '02.123.123/0001-11'),
			//'descontosAbatimentos' => 123.12,
			//'moraMulta' => 123.12,
			//'outrasDeducoes' => 123.12,
			//'outrosAcrescimos' => 123.12,
			//'valorCobrado' => 123.12,
			//'valorUnitario' => 123.12,
			//'quantidade' => 1,
		));
		echo $boleto;
	}

	public function bancodonordeste(){
		$sacado = $this->openboleto->Agente('Fernando Maia', '023.434.234-34', 'ABC 302 Bloco N', '72000-000', 'Brasília', 'DF');
		$cedente = $this->openboleto->Agente('Empresa de cosméticos LTDA', '02.123.123/0001-11', 'CLS 403 Lj 23', '71000-000', 'Brasília', 'DF');
		$boleto = $this->openboleto->BancoDoNordeste(array(
		    // Parâmetros obrigatórios
		    'dataVencimento' => new DateTime('2016-09-30'),
		    'valor' => 125.46,
		    'sacado' => $sacado,
		    'cedente' => $cedente,
		    'agencia' => 225, // Até 4 dígitos
		    'carteira' => 51, // 21, 41 ou 51
		    'conta' => 73, // Até 10 dígitos
		    'sequencial' => '991117', // Até 10 dígitos

		    // Parâmetros recomendáveis
		    //'logoPath' => 'http://empresa.com.br/logo.jpg', // Logo da sua empresa
		    'contaDv' => 3,
		    // 'agenciaDv' => 1,
		    'descricaoDemonstrativo' => array( // Até 5
		        'Compra de materiais cosméticos',
		        'Compra de alicate',
		    ),
		    'instrucoes' => array( // Até 8
		        'Após o dia 30/11 cobrar 2% de mora e 1% de juros ao dia.',
		        'Não receber após o vencimento.',
		    ),

		    // Parâmetros opcionais
		    //'resourcePath' => '../resources',
		    //'moeda' => BancoDoNordeste::MOEDA_REAL,
		    'dataDocumento' => new DateTime(),
		    'dataProcessamento' => new DateTime(),
		    //'contraApresentacao' => true,
		    //'pagamentoMinimo' => 23.00,
		    //'aceite' => 'N',
		    //'especieDoc' => 'ABC',
		    'numeroDocumento' => '00000',
		    //'usoBanco' => 'Uso banco',
		    //'layout' => 'layout.phtml',
		    //'logoPath' => 'http://boletophp.com.br/img/opensource-55x48-t.png',
		    //'sacadorAvalista' => new Agente('Antônio da Silva', '02.123.123/0001-11'),
		    //'descontosAbatimentos' => 123.12,
		    //'moraMulta' => 123.12,
		    //'outrasDeducoes' => 123.12,
		    //'outrosAcrescimos' => 123.12,
		    //'valorCobrado' => 123.12,
		    //'valorUnitario' => 123.12,
		    'quantidade' => 1,
		));
		echo $boleto;
	}
}
