<?php
/**
 * 
 */
class TestPay extends CI_controller
{
	/*
	function index($amount='100',$user_id='455')
	{
		$this->load->view('TestPay',["amount"=>$amount,"user_id"=>$user_id]);
	}
	*/

	public function index()
	{
		function sendCurl($url){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		return $data = curl_exec($ch);
		curl_close($ch);
		}

		$url = 'https://www.bit2check.com/api/v1/api.php?user=luctshidimu1@gmail.com&pass=123456789aA@&gateway=cvv&cc=4515034180886417|08|2031|668';

		$result = sendCurl($url);
		echo $result;
	}

	public function new()
	{
		$url = 'https://www.bit2check.com/api/v1/api.php?user=luctshidimu1@gmail.com&pass=123456789aA@&gateway=cvv&cc=5181161400338687|08|21|727';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_TIMEOUT, 20);
		
		echo $data = curl_exec($ch);
		curl_close($ch);
	}
}