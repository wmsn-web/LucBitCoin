<?php
/**
 * 
 */
class Other_Settings extends CI_Controller {

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
		$getSaleCharg = $this->AdminModel->getSaleCharg();
		$this->load->view("admin/Other_Settings",["saleChrg"=>$getSaleCharg]);
	}

	public function SetChrge()
	{
		$chrg = $this->input->post("chrg");
		$this->db->update("settings",["sale_charge"=>$chrg]);
		$this->session->set_flashdata("Feed","Sale Charge Updated");
		return redirect("Admin/Other_Settings");
	}
}