<?php
/**
 * 
 */
class ChangePassword extends CI_Controller {

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
		$this->load->view("admin/ChangePassword");
	}

	public function CheckOld()
	{
		$oldPass = $this->input->post("oldPass");
		$getAdmin = $this->db->get("admin")->row();

		if(!password_verify($oldPass, $getAdmin->password))
		{
			echo "err";
		}
		else
		{
			echo "okk";
		}
	}

	public function process()
	{
		$oldPass = $this->input->post("oldPass");
		$newPass = $this->input->post("newPass");
		$ConPass = $this->input->post("ConPass");

		$getAdmin = $this->db->get("admin")->row();

		if(!password_verify($oldPass, $getAdmin->password))
		{
			$this->session->set_flashdata("Feed","Invalid Old Password");
			return redirect("Admin/ChangePassword");
		}
		else
		{
			if($newPass == $ConPass)
			{
				//proceed
				$pass = password_hash($ConPass, PASSWORD_DEFAULT);
				$this->db->update("admin",["password"=>$pass]);
				$this->session->unset_userdata("adminUser");
				$this->session->set_flashdata("Feed","Password Successfully Changed. Login with new password");
				return redirect("Admin/Login");
			}
			else
			{
				$this->session->set_flashdata("Feed","Passwprd Does not match");
				return redirect("Admin/ChangePassword");
			}
		}
	}
}