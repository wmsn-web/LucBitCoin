<?php
/**
 * 
 */
class Fund_Request extends CI_Controller {

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
		$getfundRequest = $this->AdminModel->getfundRequest();
		$this->load->view("admin/Fund_Request",["fndRqst"=>$getfundRequest]);
	}

	public function Addbal($id,$currency,$amount,$rqid)
	{
		$setBalance = $this->AdminModel->setBalance($id,$currency,$amount,$rqid);
		if($setBalance== true)
		{
			$this->session->set_flashdata("Feed","Balance Added");
			return redirect("Admin/Fund_Request");
		}
	}

	public function DelRq($id)
	{
		$this->db->where("id",$id);
		$this->db->update("fund_request",["status"=>2]);
		$this->session->set_flashdata("Feed","Request Cancelled");
			return redirect("Admin/Fund_Request");
	}
}