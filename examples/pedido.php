<?php
	/*!
	 * NFe VHSYS
	 *
	 * Copyright 2013, (http://www.vhsys.com.br)
	 * API DE COMUNICAÇÃO WEBSERVICE
	 * Versão da API: v1.0
	 *
	 * TOKEN (NUMERO GERADO PELO NFE VHSYS) 
	 */
	 
	//FAZ A COMUNICAÇÃO COM O NFE VHSYS
	include("VHSYSAPI.Class.php");
	$vhsys = new CommunicationVHSYS();
	$vhsys->params 	= array(
		//CABEÇARIO
		"API" => "Pedidos",
		"TOKEN" => "SEU_TOKEN",
		"METODO" => "ALTERAR",
		
		//CAMPOS
		"id_pedido" => "45", //O NUMERO DO PEDIDO DEVE SER DEFINIDO PELO APLICATIVO
		"id_cliente" => "18584",
		"nome_cliente" => "Teste de integração",
		"vendedor_pedido" => "Luan",
		"valor_total_produtos" => 305.70,
		"desconto_pedido" => 5.70,
		"frete_pedido" => 50.80,
		"valor_total_nota" => 380.80, //VALOR TOTAL DO PEDIDO
		"frete_por_pedido" => 9, //0 = REMETENTE, 1 = DESTINATARIO, 9 = SEM FRETE
		"transportadora_pedido" => "TESTE TRANS",
		"data_pedido" => "2013-06-20", //XXXX-XX-XX
		"obs_pedido" => "teste obs",
		"status_pedido" => "Em Aberto", //Em Aberto, Em Andamento, Atendido, Cancelado
		
		//PRODUTOS
		"numero_produtos" => 2, //QUANTIDADE DE PRODUTOS DO PEDIDO
		
		"id_produto_1" => "47059",
		"desc_produto_1" => "Teste de integração",
		"qtde_produto_1" => 2.00,
		"valor_unit_produto_1" => 76.42,
		"valor_total_produto_1" => 152.85,
		"peso_produto_1" => 2.50,
							
		"id_produto_2" => "47059",
		"desc_produto_2" => "Teste de integraçãoxxxx",
		"qtde_produto_2" => 2.00,
		"valor_unit_produto_2" => 76.42,
		"valor_total_produto_2" => 152.85,
		"peso_produto_2" => 3.50,
							
		//PARCELAS
		"condicao_pagamento" => 2, //NUMERO DE PARCELAS
							
		"data_parcela_1" => "2013-06-20", //FORMATO: XXXX-XX-XX
		"valor_parcela_1" => 152.85,
		"forma_pagamento_1" => "Dinheiro",
		"observacoes_parcela_1" => "teste",
							
		"data_parcela_2" => "2013-07-20", //FORMATO: XXXX-XX-XX
		"valor_parcela_2" => 152.85,
		"forma_pagamento_2" => "Cheque",
		"observacoes_parcela_2" => "testexxx",
							
		"id_ped" => "" //UTILIZADO APENAS PARA ALTERAR E EXCLUIR
	);
	$response = $vhsys->transmit();
	
	//TRATA O response DO NFE VHSYS
	if ($response) {
		if(@$xml = simplexml_load_string($response)) {
			//CRIA AS VARIAVEIS
			$error = $xml->error;
			$reason = $xml->xreason; //MENSAGEM DE response
			$status = $xml->status; //STATUS DO response
			$id_pedido = $xml->id_pedido; //ID DO PEDIDO
			
			if ($error == 1) {
				//SE HOUVER ALGUM error
				echo "error: ".$reason."<br>";
			} else {
				echo $reason;
				print_r($xml);
			}
		} else {
			echo "Houve uma falha na leitura da resposta!<br>".$response;	
		}
	} else {
		echo "Houve uma falha na comunicação!";	
	}