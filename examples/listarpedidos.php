<?php
	namespace(W)
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
		"TOKEN" => "AAAYbMyQDtwYTNUTTNTTDMyADczBDM0U7M",
		"METODO" => "LISTARPED",
		"QTDELISTA" => 20 /*LISTAR OS ULTIMOS 20 PEDIDOS*/
	);
	$response = $vhsys->transmit();
	
	//TRATA O RETORNO DO NFE VHSYS
	if ($response) {
		$data = json_decode($response);
		echo "<pre>";
		print_r($data);
	} else {
		echo "Houve uma falha na comunicação!";	
	}