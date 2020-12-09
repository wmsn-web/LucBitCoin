<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
		
		$this->load->view('admin/Dashboard');
		
	}

	//Set Logout
	public function adminLogout()
	{
		$this->session->unset_userdata("adminUser");
		return redirect("Admin/Login");
	}
}

