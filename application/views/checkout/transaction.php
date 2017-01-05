<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Detalhes da Transação - PagSeguro</title>

    <!-- Bootstrap core CSS -->
    <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="http://getbootstrap.com/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://getbootstrap.com/examples/starter-template/starter-template.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="http://getbootstrap.com/assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Transações - PagSeguro</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="<?php echo base_url('checkout'); ?>">Checkout</a></li>
            <li><a href="<?php echo base_url('checkout/transactions'); ?>">Transações</a></li>
            <li><a href="<?php echo base_url('checkout/abandoned'); ?>">Abandonadas</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <?php

      switch($transaction->status){
        case 1:
          $transactionStatus = 'Aguardando Pagamento';
          break;
        case 2:
          $transactionStatus = 'Em Análise';
          break;
        case 3:
          $transactionStatus = 'Paga';
          break;
        case 4:
          $transactionStatus = 'Disponível';
          break;
        case 5:
          $transactionStatus = 'Em Disputa';
          break;
        case 6:
          $transactionStatus = 'Devolvida';
          break;
        case 7:
          $transactionStatus = 'Cancelada';
          break;
        case 8:
          $transactionStatus = 'Debitado';
          break;
        case 9:
          $transactionStatus = 'Retenção Temporária';
          break;
        default:
          $transactionStatus = 'Unknow';
      }

      $pagamentoMensagem = psPaymentType($transaction->paymentMethod->type);
      // Se for cartão, adiciona parcelas na mensagem...
      if( $transaction->paymentMethod->type == 1 ){
        $pagamentoMensagem .= " (parcelado em {$transaction->installmentCount}x)";
      }

    ?>

    <div class="container">

      <h3>Detalhes da Transação</h3>

      <p><b>Status:</b> <?php echo $transactionStatus; ?></p>
      <p><b>Código da Transação:</b> <?php echo $transaction->code; ?></p>
      <p><b>Código de Referência:</b> <?php echo $transaction->reference; ?></p>
      <p><b>Valor:</b> R$ <?php echo psMoneyBR($transaction->grossAmount); ?></p>
      <p><b>Taxas:</b> R$ <?php echo psMoneyBR($transaction->feeAmount); ?></p>
      <p><b>Total (líquido):</b> R$ <?php echo psMoneyBR($transaction->netAmount); ?></p>
      <p><b>Meio de Pagamento:</b> <?php echo $pagamentoMensagem; ?></p>

      <hr>

      <h4>Comprador</h4>

      <p><b>Nome:</b> <?php echo $transaction->sender->name; ?></p>
      <p><b>E-mail:</b> <?php echo $transaction->sender->email; ?></p>
      <p><b>Pontuação:</b> </p>
      <p><b>Telefone:</b> <?php echo "({$transaction->sender->phone->areaCode}) {$transaction->sender->phone->number}"; ?></p>

      <hr>

      <h4>Endereço de Entrega</h4>

      <p><b>CEP:</b> <?php echo psCpfFormat($transaction->shipping->address->postalCode); ?></p>
      <p><b>Endereço:</b> <?php echo $transaction->shipping->address->street; ?></p>
      <p><b>Número:</b> <?php echo $transaction->shipping->address->number; ?></p>
      <p><b>Complemento:</b> <?php echo $transaction->shipping->address->complement; ?></p>
      <p><b>Bairro:</b> <?php echo $transaction->shipping->address->district; ?></p>
      <p><b>Cidade:</b> <?php echo $transaction->shipping->address->city; ?></p>
      <p><b>Estado:</b> <?php echo $transaction->shipping->address->state; ?></p>
    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="http://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>