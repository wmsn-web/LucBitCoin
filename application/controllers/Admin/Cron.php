<?php
/**
 * 
 */
class Cron extends CI_controller
{
	
	function currencyRate()
	{
		$json1 = file_get_contents('https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=usd');
                              $ex1 = json_decode($json1);  
                              $ccrr1 = $ex1->bitcoin->usd;
        $json2 = file_get_contents('https://api.coingecko.com/api/v3/simple/price?ids=ethereum&vs_currencies=usd');
                              $ex2 = json_decode($json2);  
                              $ccrr2 = $ex2->ethereum->usd;
		$this->db->update("settings",["btc_rate"=>$ccrr1, "eth_rate"=>$ccrr2]);
	}
}