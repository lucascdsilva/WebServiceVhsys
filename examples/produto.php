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
		"API" => "Produtos",
		"TOKEN" => "SEU_TOKEN",
		"METODO" => "ALTERAR",
		
		//CAMPOS
		"id_categoria" => "152",
		"id_subcategoria" => "137",
		"cod_produto" => "001",
		"marca_produto" => "VHSYS",
		"desc_produto" => "teste de integração",
		"unidade_produto" => "Un",
		"valor_produto" => 5.79,
		"valor_custo_produto" => 1.98,
		"peso_produto" => 5.00, //KG
		"ncm_produto" => "00000000",
		"obs_produto" => "teste de observação",
		"tipo_produto" => "Produto", //PRODUTO OU SERVIÇO
		"status_produto" => "Ativo",
		"id_produto" => "" //UTILIZADO APENAS PARA ALTERAR E EXCLUIR
	);
	$response = $vhsys->transmit();
	
	//TRATA O response DO NFE VHSYS
	if ($response) {
		if(@$xml = simplexml_load_string($response)) {
			//CRIA AS VARIAVEIS
			$error = $xml->error;
			$reason = $xml->xreason; //MENSAGEM DE RETORNO
			$status = $xml->status; //STATUS DO RETORNO
			$id_product = $xml->id_product; //ID DO PRODUTO
					
			if ($error == 1) {
				//SE HOUVER ALGUM error
				echo "erro: ".$reason."<br>";
			} else {
				echo $reason;
				print_r($xml);
			}
		} else {
			echo "Houve uma falha na leitura da resposta!<br>".$retorno;	
		}
	} else {
		echo "Houve uma falha na comunicação!";	
	}