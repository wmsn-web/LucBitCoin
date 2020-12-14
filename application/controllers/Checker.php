<?php
/**
 * 
 */
class Checker extends CI_Controller {

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
		$this->load->view("users/Checker");
	}
}