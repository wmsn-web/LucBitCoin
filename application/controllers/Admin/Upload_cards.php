<?php
/**
 * 
 */
class Upload_cards extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model("UserModel");
		$this->load->model("AdminModel");
		if(!$this->session->userdata("adminUser"))
		{
			return redirect("Admin/Login");
		}
	}

	public function index()
	{
		$getAllUsers = $this->AdminModel->getAllUsers();
		$this->load->view("admin/Upload_cards",["userData"=>$getAllUsers]);
	}

	public function getSellerbase()
	{
		$seller = $this->input->post("seller");
		$this->db->where("seller",$seller);
		$get = $this->db->get("bases");
		if($get->num_rows()==0)
		{
			echo "<option value=''>Select Base</option>";
			echo "<option value='New Base'>New Base</option>";
		}
		else
		{
			$res = $get->result();
			echo "<option value=''>Select Base</option>";
			echo "<option value='New Base'>New Base</option>";
			foreach($res as $key)
			{
				echo "<option value='".$key->basename."'>".$key->basename."</option>";
			}
		}
	}
}