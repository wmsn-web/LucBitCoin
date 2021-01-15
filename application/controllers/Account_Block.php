<?php
/**
 * 
 */
class Account_Block extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("UserModel");
		$this->load->model("AdminModel");
		if(!$this->session->userdata("userName"))
		{
			return redirect("Login"); 
		}
		$this->db->where("username",$this->session->userdata("userName"));
		$checkBlock = $this->db->get("users")->row();
		if($checkBlock->status == 1)
		{
			return redirect("Rules");
		}
	}

	public function index()
	{
		$this->load->view("users/Account_Block");
	}					
}