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

    <title>Transações - PagSeguro</title>

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
            <li class="active"><a href="<?php echo base_url('checkout/abandoned'); ?>">Abandonadas</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

      <h3>Transações Abandonadas</h3>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Código</th>
            <th>Data</th>
            <th>Tipo</th>
            <th>Valor (R$)</th>
            <th>Referência</th>
          </tr>
        </thead>
        <tbody>
          <?php
          for($i = 0; $i < $resultsInThisPage; $i++){
            /**
             * 0 = status
             * 1 = lastEventDate
             * 2 = cancellationSource
             * 3 = date
             * 4 = code
             * 5 = reference
             * 6 = type
             * 7 = discountAmount
             * 8 = escrowEndDate
             * 9 = extraAmount
             * 10 = feeAmount
             * 11 = grossAmount
             * 12 = netAmount
             * 13 = paymentMethod
             *    13.0 = code
             *    13.1 = type
             */
            $transaction = (object)$transactions[$i];

            $transactionDate = new DateTime( $transaction->date );
            $transactionDate = $transactionDate->format('d/m/Y H:i');

            /**
             * Status Code
             * 1 = Aguardando Pagamento
             * 2 = Em análise
             * 3 = Paga
             * 4 = Disponível
             * 5 = Em disputa
             * 6 = Devolvida
             * 7 = Cancelada
             * 8 = Debitado
             * 9 = Retenção temporária
             */
            // switch($transaction->status){
            //   case 1:
            //     $transactionStatus = 'Aguardando Pagamento';
            //     break;
            //   case 3:
            //     $transactionStatus = 'Paga';
            //     break;
            //   case 6:
            //     $transactionStatus = 'Devolvida';
            //     break;
            //   case 7:
            //     $transactionStatus = 'Cancelada';
            //     break;
            //   default:
            //     $transactionStatus = 'Unknow';
            // }

            /**
             * Type Code
             * 1 = Pagamento
             * 11 = Recorrência
             */
            switch($transaction->type){
              case 1:
                $transactionType = 'Pagamento';
                break;
              case 11:
                $transactionType = 'Recorrência';
                break;
              default:
                $transactionType = 'Unknow';
            }
          ?>
          <tr>
            <td><?php echo $transaction->code; ?></td>
            <td><?php echo $transactionDate; ?></td>
            <td><?php echo $transactionType; ?></td>
            <td><?php echo number_format($transaction->grossAmount, 2, ',', '.'); ?></td>
            <td><?php echo $transaction->reference; ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>

      <nav aria-label="Page navigation" class="pull-right">
        <ul class="pagination">
          <li<?php echo (($currentPage == 1) ? ' class="disabled"' : NULL); ?>>
            <a href="<?php echo (($currentPage == 1) ? '#' : ('?page=' . ($currentPage - 1)) ); ?>" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
            </a>
          </li>
          <?php for($i = 1; $i <= $totalPages; $i++){ ?>
          <li<?php echo (($currentPage == $i) ? ' class="active"' : NULL); ?>><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
          <?php } ?>
          <li<?php echo (($currentPage == $totalPages) ? ' class="disabled"' : NULL); ?>>
            <a href="<?php echo (($currentPage == $totalPages) ? '#' : ('?page=' . ($currentPage + 1)) ); ?>" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
            </a>
          </li>
        </ul>
      </nav>

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