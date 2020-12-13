<?php
/**
 * 
 */
class Products extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("AdminModel");
		if(!$this->session->userdata("adminUser"))
		{
			return redirect("Admin/Login");
		}
	}					

	public function index()
	{
		$getProd = $this->AdminModel->getAllProducts();
		$this->load->view("admin/Products",["proData"=>$getProd]);
		//print_r($getProd);
	}

	public function DisbleProduct($id='')
	{
		$this->db->where("id",$id);
		$this->db->update("cards",["status"=>0]);
		$this->session->set_flashdata("Feed","Card Disabled");
		return redirect("Admin/Products");
	}

	public function EnaleProduct($id='')
	{
		$this->db->where("id",$id);
		$this->db->update("cards",["status"=>1]);
		$this->session->set_flashdata("Feed","Card Enabled");
		return redirect("Admin/Products");
	}
}