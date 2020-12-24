<?php
/**
 * 
 */
class Fund_Request extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("UserModel");
		$this->load->model("AdminModel");
		if(!$this->session->userdata("userName"))
		{
			return redirect("Login"); 
		}
		$this->db->where("username",$this->session->userdata("userName"));
		$checkBlock = $this->db->get("users")->row();
		if($checkBlock->status == "0")
		{
			return redirect("Account-Block");
		}
	}									

	public function index()
	{
		$getfundRequest = $this->UserModel->getfundRequest($this->session->userdata("userName"));
		$this->load->view("users/Fund_Request",["fndRqst"=>$getfundRequest]);
		//echo "<pre>";
		//print_r($getfundRequest);
	}

	public function SendRequest($user)
	{
        $currency = $this->input->post("currency");
        $amount = $this->input->post("amount");
        $from_addr = $this->input->post("from_addr");
        $notes = $this->input->post("notes");
        $data = array
        			(
        				"username"	=>$user,
        				"currency"	=>$currency,
        				"amount"	=>$amount,
        				"notes"		=>$notes,
        				"from_addr"	=>$from_addr,
        				"status"	=>0,
        				"date"		=>date('Y-m-d h:i:s')
        			);
        $this->db->insert("fund_request",$data);
        $this->session->set_flashdata("Feed","Fund Request has been sent successfully");
        return redirect("Fund-Request");
	}

	public function DelReq($id)
	{
		$this->db->where("id",$id);
		$this->db->delete("fund_request");
		$this->session->set_flashdata("Feed","Fund Request Deleted");
        return redirect("Fund-Request");
	
		
	}
}