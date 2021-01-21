<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bases extends CI_Controller {

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
		$getBaseData = $this->AdminModel->getBaseData();
		$this->load->view('admin/Bases',["baseData"=>$getBaseData]);
		//echo "<pre>";
		//print_r($getBaseData);
		
	}

	public function updtPrcnt()
	{
		$id = $this->input->post("id");
		$prcnt = $this->input->post("prcnt");
		$this->db->where("id",$id);
		$this->db->update("bases",["prcnt"=>$prcnt]);
	}
}