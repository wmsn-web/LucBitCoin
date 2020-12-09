<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata("userName"))
		{
			return redirect("Login");
		}
	}

	public function index()
	{
		
		$this->load->view('users/Home');
		
	}

	public function logout()
	{
		$this->session->unset_userdata("userName");
		return redirect("Login");
	}
}

