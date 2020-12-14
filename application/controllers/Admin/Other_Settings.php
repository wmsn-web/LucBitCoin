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
		$getSetting = $this->AdminModel->getSetting();
		$this->load->view("admin/Other_Settings",["settings"=>$getSetting]);
	}

	public function SetChrge()
	{
		$chrg = $this->input->post("chrg");
		$this->db->update("settings",["sale_charge"=>$chrg]);
		$this->session->set_flashdata("Feed","Sale Charge Updated");
		return redirect("Admin/Other_Settings");
	}

	public function SetCureency()
	{
		$btcRate = $this->input->post("btcRate");
		$ethRate = $this->input->post("ethRate");
		$this->db->update("Settings",["btc_rate"=>$btcRate,"eth_rate"=>$ethRate]);
		$this->session->set_flashdata("Feed","Currency Rate Updated");
		return redirect("Admin/Other_Settings");
	}
}