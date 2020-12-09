<?php
/**
 * 
 */
class TestPay extends CI_controller
{
	
	function index($amount='100',$user_id='455')
	{
		$this->load->view('TestPay',["amount"=>$amount,"user_id"=>$user_id]);
	}
}