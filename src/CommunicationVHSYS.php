<?php
namespace WebServiceVhsys;

/*!
 * API DE COMUNICAÇÃO WEBSERVICE
 * Versão da API: v2.0
 * Documentação: http://docs.vhsys.com.br
 */
class CommunicationVHSYS 
{
	private $url = "https://www.vhsys.com/Communication/WebService/";
	private $token;

	public function __construct($token, $url=null)
	{
		if (!is_null($url)) $this->url = $url;
		$this->token = $token;
	}

	public function transmit($params=[])
	{
		$params = $this->validParams($params);
		$params['TOKEN'] = $this->token;
		if (!function_exists('curl_exec')) die("Not exist function 'curl_exec'");

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		$result = curl_exec($ch);
		$error = curl_error($ch);
		curl_close($ch);
		if ($error) throw new \Exception("Error API Vhsys Request", 1);
		return $this->decodeResponse($result);
	}

	private function decodeResponse($response)
	{
		if ($xml = @simplexml_load_string($response)) {
			$response = json_encode($xml);
		}

		$data = json_decode($response, true);
		return $data;
	}

	private function validParams($params)
	{
		if (!is_array($params))
			throw new \Exception("Params not is array", 1);
		return $params;
	}
}
