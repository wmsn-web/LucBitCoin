<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if($this->session->userdata("adminUser"))
		{
			return redirect("Admin/Dashboard");
		}
	}

	public function index()
	{
		
		$this->load->view('admin/Login');
		
	}

	//process Login
	public function ProcessLogin()
	{
		$user = $this->input->post("username");
		$pass = $this->input->post("password");
		$this->db->where("username",$user);
		$getAdmin = $this->db->get("admin");
		if($getAdmin->num_rows()==0)
		{
			$this->session->set_flashdata("Feed","Invalid Username!");
			return redirect("Admin/Login");
		}
		else
		{
			$row = $getAdmin->row();
			if(!password_verify($pass, $row->password))
			{
				$this->session->set_flashdata("Feed","Invalid Password!");
				return redirect("Admin/Login");
			}
			else
			{
				$this->session->set_userdata("adminUser",$user);
				return redirect("Admin/Dashboard");
			}
		}
	}
}