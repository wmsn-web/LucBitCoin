<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model("UserModel");
		if(!$this->session->userdata("adminUser"))
		{
			return redirect("Admin/Login");
		}
	}

	public function index()
	{
		$dashData = $this->UserModel->getDashData();
		$this->load->view('admin/Dashboard',["dashData"=>$dashData]);
		
	}

	//Set Logout
	public function adminLogout()
	{
		$this->session->unset_userdata("adminUser");
		return redirect("Admin/Login");
	}
}

