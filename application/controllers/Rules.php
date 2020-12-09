<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rules extends CI_Controller {

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
		$getRules = $this->UserModel->getRules();
		$this->load->view("users/Rules",["data"=>$getRules]);
	}
}