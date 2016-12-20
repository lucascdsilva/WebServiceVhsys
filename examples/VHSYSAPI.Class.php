<?php
/*!
 * NFe VHSYS
 *
 * Copyright 2011, (http://www.vhsys.com.br)
 * API DE COMUNICAÇÃO WEBSERVICE
 * Versão da API: v1.0
 *
 * Documentação: http://docs.vhsys.com.br
 * 
 * NÃO ALTERAR
 */

class CommunicationVHSYS 
{
	var $params = ""; //CAMPOS ARRAY QUE SERAM TRANSMITIDOS PARA O NFe VHSYS
	var $response = true; //RETORNA O RESULTADO
	
	private function prepare()
	{
		if (function_exists('curl_exec')) {
			return "https://www.vhsys.com/Communication/WebService/";
		} else { return false; }
	}

	function transmit()
	{
		$urlCom = CommunicationVHSYS::prepare();
		if (!$urlCom) {
			die("Funcao 'curl_exec' nao existe!");
		}


		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $urlCom);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $this->params);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		$result = curl_exec($ch);

		$error = curl_error($ch);
		
		if (!$error) {
			if ($this->response) {
				return $result;
			}
		}
		echo $error;
		
		curl_close($ch);
		
	}
}