<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class All_users extends CI_Controller {

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
		$getAllUsers = $this->AdminModel->getAllUsers();
		$this->load->view('admin/All_users',["userData"=>$getAllUsers]);
		
	}

	public function AddUserBalance()
	{
		$id = $this->input->post("userId");
		$currency = $this->input->post("currency");
		$amount = $this->input->post("amount");

		$setBalance = $this->AdminModel->setBalance($id,$currency,$amount);
		if($setBalance== true)
		{
			$this->session->set_flashdata("Feed","Balance Added");
			return redirect("Admin/All_users");
		}
	}

	public function UnlockUser($uid)
	{
		$this->db->where("user_id",$uid);
		$this->db->update("users",["status"=>1]);
		$this->session->set_flashdata("Feed","User Unblocked");
			return redirect("Admin/All_users");
	}

	public function BlockUser($uid)
	{
		$this->db->where("user_id",$uid);
		$this->db->update("users",["status"=>0]);
		$this->session->set_flashdata("Feed","User Unblocked");
			return redirect("Admin/All_users");
	}

}