<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("UserModel");
		if(!$this->session->userdata("userName"))
		{
			return redirect("Login");
		}
		$this->db->where("username",$this->session->userdata("userName"));
		$checkBlock = $this->db->get("users")->row();
		if($checkBlock->status == "0")
		{
			return redirect("Account-Block");
		}
	}

	public function index()
	{
		$dashData = $this->UserModel->getDashData();
		$this->load->view('users/Home',["dashData"=>$dashData]);
		//echo "<pre>";
		//print_r($dashData);

		
	}

	public function logout()
	{
		$this->session->unset_userdata("userName");
		return redirect("Login");
	}
}

