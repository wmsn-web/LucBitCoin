<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Wallet extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata("adminUser"))
		{
			return redirect("Admin/Login");
		}
	}
	public function index()
	{
		$walletData = $this->AdminModel->walletData();
		$this->load->view("admin/Admin_Wallet",["walletData"=>$walletData]);
		//echo "<pre>";
		//print_r($walletData);
	}
}