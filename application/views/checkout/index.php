<?php
function public_url( $str = NULL ){
	return base_url("public/$str");
}
?>
<!DOCTYPE html>
<html>
	
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="<?php echo public_url('assets/css/styles.css'); ?>" />
		<link rel="stylesheet" href="<?php echo public_url('assets/css/colorbox.css'); ?>" />
		<link rel="stylesheet" href="<?php echo public_url('assets/css/sweetalert.css'); ?>" />
	</head>

	<body>
		
		<div class="groupData" id="cartData">
			
			<div id="carWrapper">
				
				<h4>Items</h4>
				
				<table id="cartTable">
					<thead>
						<tr>
							<th>Id</th>
							<th>Descrição</th>
							<th>Valor Unitário</th>
							<th>Quantidade</th>
							<th>Valor</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
				
				<input type="button" id="addItem" value="Adicionar Item" />
				
			</div>
			
			<h3 id="cartTotal"> Valor Total: R$ <span id="totalValue">0.00</span> </h3>
			
			<div id="cartItemHidden" class="cartItem">
				
				<div class="cartItemFields">
					
					<div class="field">
						<label>Item Id:</label>
						<input type="text" class="itemId" name="itemId" value="0001" />
					</div>
					
					<div class="field">
						<label>Item Description:</label>
						<input type="text" class="itemDescription" name="itemDescription" value="Notebook Prata" />
					</div>
					
					<div class="field">
						<label>Item Amount:</label>
						<input type="text" class="itemAmount" name="itemAmount" value="2,00" />
					</div>
					
					<div class="field">
						<label>Item Quantity:</label>
						<input type="text" class="itemQuantity" name="itemQuantity" value="1" />
					</div>
				
					<button class="button addToCart">Adicionar</button>
				</div>
				
			</div>
			
		</div>

		<div class="groupData" id="buyerData">
			
			<h1>Dados do comprador</h1>
			
			<div class="field">
				<label for="senderEmail">E-mail</label>
				<input type="text" name="senderEmail" id="senderEmail" />
			</div>
			
			<div class="field">
				<label for="senderName">Nome completo</label>
				<input type="text" name="senderName" id="senderName" holderField="name" />
			</div>
			
			<div class="field">
				<label for="senderCPF">CPF (somente números)</label>
				<input type="text" name="senderCPF" id="senderCPF" holderField="cpf" maxlength="11" />
			</div>
			
			<div class="field">
				<label for="senderAreaCode">Telefone</label>
				<input type="text" name="senderAreaCode" id="senderAreaCode" holderField="areaCode" class="areaCode" maxlength="2" />
				<input type="text" name="senderPhone" id="senderPhone" holderField="phone" class="phone" maxlength="9" />
			</div>
			
			<h2>Endereço de Residencial</h2>
			
			<div class="field">
				<label for="shippingAddressPostalCode">CEP (somente números)</label>
				<input type="text" name="shippingAddressPostalCode" id="shippingAddressPostalCode" holderField="postalCode" maxlength="8" />
			</div>
			
			<div class="field">
				<label for="shippingAddressStreet">Rua, Avenida, etc ...</label>
				<input type="text" name="shippingAddressStreet" id="shippingAddressStreet" holderField="street" />
			</div>
			
			<div class="field">
				<label for="shippingAddressNumber">Número</label>
				<input type="text" name="shippingAddressNumber" id="shippingAddressNumber" holderField="number" />
			</div>
			
			<div class="field">
				<label for="shippingAddressComplement">Complemento</label>
				<input type="text" name="shippingAddressComplement" id="shippingAddressComplement" holderField="complement" />
			</div>
			
			<div class="field">
				<label for="shippingAddressDistrict">Bairro</label>
				<input type="text" name="shippingAddressDistrict" id="shippingAddressDistrict" holderField="district" />
			</div>
			
			<div class="field">
				<label for="shippingAddressCity">Cidade</label>
				<input type="text" name="shippingAddressCity" id="shippingAddressCity" holderField="city" />
			</div>
			
			<div class="field">
				<label for="shippingAddressState">Estado</label>
				<input type="text" name="shippingAddressState" id="shippingAddressState" holderField="state" class="addressState" maxlength="2" />
			</div>
			
			<div class="field">
				<label for="shippingAddressCountry">País</label>
				<input type="text" name="shippingAddressCountry" id="shippingAddressCountry" holderField="country" value="Brasil" />
			</div>
			
		</div>


		<div class="groupData" id="paymentMethods">
	
			<h1>Meios de Pagamento</h1>
			
			
			<div id="paymentMethodsOptions">
				
				<div class="field radio">
					<input id="creditCardRadio" type="radio" name="changePaymentMethod" value="creditCard" />
					<label for="creditCardRadio">Cartão de Crédito</label>
				</div>
				
				<div class="field radio">
					<input id="boletoRadio" type="radio" name="changePaymentMethod" value="boleto" />
					<label for="boletoRadio">Boleto</label>
				</div>
				
				<div class="field radio">
					<input id="eftRadio" type="radio" name="changePaymentMethod" value="eft" />
					<label for="eftRadio">Débito</label>
				</div>
				
				<div id="paymentMethodLoading">Aguarde...</div>
				
			</div>
			
			<div id="creditCardData" class="paymentMethodGroup" dataMethod="creditCard">
				
				<div id="cardData">
					
					<h2>Dados do Cartão </h2>
					
					<div class="field" id="cardBrand">
						<label for="cardNumber">Número</label>
						<input type="text" name="cardNumber" id="cardNumber" class="cardDatainput" />
					</div>
					
					<div class="field">
						<label for="cardExpirationMonth">Data de Vencimento (99/9999)</label>
						<input type="text" name="cardExpirationMonth" id="cardExpirationMonth" class="cardDatainput month" maxlength="2" /> /
						<input type="text" name="cardExpirationYear" id="cardExpirationYear" class="cardDatainput year" maxlength="4" />
					</div>
					
					<div class="field">
						<label for="cardCvv">Código de Segurança</label>
						<input type="text" name="cardCvv" id="cardCvv" maxlength="5" class="cardDatainput" />
					</div>
					
				</div>
				
				<div class="field" id="installmentsWrapper">
					<label for="installmentQuantity">Parcelamento</label>
					<select name="installmentQuantity" id="installmentQuantity"></select>
					<input type="hidden" name="installmentValue" id="installmentValue" />
				</div>
				
				<h2>Dados do Titular do Cartão</h2>
				
				<div id="holderDataChoice">
					
					<div class="field radio">
						<input type="radio" name="holderType" id="sameHolder" />
						<label for="sameHolder"> mesmo que o comprador</label>
					</div>
					
					<div class="field radio">
						<input type="radio" name="holderType" id="otherHolder" />
						<label for="otherHolder">outro</label>
					</div>
					
				</div>
				
				<div class="field">
					<label for="creditCardHolderBirthDate">Data de Nascimento (99/99/9999)</label>
					<input type="text" name="creditCardHolderBirthDate" id="creditCardHolderBirthDate" maxlength="10" />
				</div>
				
				<div id="holderData">
					
					<div class="field">
						<label for="creditCardHolderName">Nome (Como está impresso no cartão)</label>
						<input type="text" name="creditCardHolderName" id="creditCardHolderName" holderField="name" />
					</div>
					
					<div class="field">
						<label for="creditCardHolderCPF">CPF (somente números)</label>
						<input type="text" name="creditCardHolderCPF" id="creditCardHolderCPF" holderField="cpf" maxlength="11" />
					</div>
					
					<div class="field">
						<label for="creditCardHolderAreaCode">Telefone</label>
						<input type="text" name="creditCardHolderAreaCode" id="creditCardHolderAreaCode" holderField="areaCode" class="areaCode" maxlength="2" />
						<input type="text" name="creditCardHolderPhone" id="creditCardHolderPhone" holderField="phone" class="phone" maxlength="9" />
					</div>
					
					<h2>Endereço de Cobrança</h2>
					
					<div class="field">
						<label for="billingAddressPostalCode">CEP</label>
						<input type="text" name="billingAddressPostalCode" id="billingAddressPostalCode" holderField="postalCode" />
					</div>
					
					<div class="field">
						<label for="billingAddressStreet">Rua, Avenida, etc ...</label>
						<input type="text" name="billingAddressStreet" id="billingAddressStreet" holderField="street" />
					</div>
					
					<div class="field">
						<label for="billingAddressNumber">Número</label>
						<input type="text" name="billingAddressNumber" id="billingAddressNumber" holderField="number" />
					</div>
					
					<div class="field">
						<label for="billingAddressComplement">Complemento</label>
						<input type="text" name="billingAddressComplement" id="billingAddressComplement" holderField="complement" />
					</div>
					
					<div class="field">
						<label for="billingAddressDistrict">Bairro</label>
						<input type="text" name="billingAddressDistrict" id="billingAddressDistrict" holderField="district" />
					</div>
					
					<div class="field">
						<label for="billingAddressCity">Cidade</label>
						<input type="text" name="billingAddressCity" id="billingAddressCity" holderField="city" />
					</div>
					
					<div class="field">
						<label for="billingAddressState">Estado</label>
						<input type="text" name="billingAddressState" id="billingAddressState" holderField="state" class="addressState" maxlength="2" />
					</div>
						
					<div class="field">
						<label for="billingAddressCountry">País</label>
						<input type="text" name="billingAddressCountry" id="billingAddressCountry" holderField="country" />
					</div>
					
				</div>
				
				<input type="hidden" name="creditCardToken" id="creditCardToken"  />
				<input type="hidden" name="creditCardBrand" id="creditCardBrand"  />
				<button type="button" id="creditCardPaymentButton">Pagar</button>
				
			</div>
			
			<div id="eftData" class="paymentMethodGroup" dataMethod="eft">
				<ul>
					<li dataBank="bancodobrasil" class="bank-flag bancodobrasil">Banco do Brasil</li>
					<li dataBank="bradesco" class="bank-flag bradesco">Bradesco</li>
					<li dataBank="itau" class="bank-flag itau">Itau</li>
					<li dataBank="banrisul" class="bank-flag banrisul">Banrisul</li>
					<li dataBank="hsbc" class="bank-flag hsbc">HSBC</li>
				</ul>
			</div>
			
			<div id="boletoData" class="paymentMethodGroup" dataMethod="boleto">
				<input type="button" id="boletoButton" value="Gerar Boleto"/>
			</div>
			
		</div>
		
		<script type="text/javascript">
			function checkout_url( str ){
				str = (typeof str != 'undefined') ? str : '';
				return '<?php echo base_url('checkout'); ?>/' + str;
			}

			function public_url( str ){
				str = (typeof str != 'undefined') ? str : '';
				return '<?php echo base_url('public'); ?>/' + str;
			}
		</script>

		<script type="text/javascript" src="<?php echo $this->pagseguro->getScriptURL(); ?>"></script>
		
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
		<script type="text/javascript" src="<?php echo public_url('assets/js/jquery.colorbox-min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo public_url('assets/js/sweetalert.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo public_url('assets/js/helpers.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo public_url('assets/js/checkout.js'); ?>"></script>

	</body>

</html>