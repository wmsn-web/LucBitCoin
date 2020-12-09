<?php
/**
 * 
 */
class Orders extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("UserModel");
		if(!$this->session->userdata("userName"))
		{
			return redirect("Login"); 
		}
	}

	public function index()
	{
		$user = $this->session->userdata("userName");
		$getOrders = $this->UserModel->getOrders($user);
		$this->load->view("users/Orders",["ordData"=>$getOrders]);
		//echo "<pre>";
		//print_r($getOrders);
	}					
}