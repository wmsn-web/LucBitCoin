<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Set_rules extends CI_Controller {

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
		$getRules = $this->AdminModel->getRules();
		$this->load->view('admin/SetRules',["rules"=>$getRules]);
		//print_r($getRules);
		
	}

	public function setRules()
	{
		$rules = htmlentities($this->input->post("rules"));
		$set = $this->db->insert("site_rules",["description"=>$rules]);
		$this->session->set_flashdata("Feed","Rules Successfully Added");
		return redirect("Admin/Set-Rules");
	}

	public function delRule($id = '')
	{
		$this->db->where("id",$id);
		$this->db->delete('site_rules');
		$this->session->set_flashdata("Feed","Rules Deleted!");
		return redirect("Admin/Set-Rules");
	}
}