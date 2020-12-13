<?php
/**
 * 
 */
class Withdraw_Request extends CI_Controller {

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
		$gtWdr = $this->AdminModel->getAllWdrRqst();
		$this->load->view("admin/Withdraw_Request",["gtWdr"=>$gtWdr]);
		//print_r($gtWdr);
	}

	public function CancelRqst($id)
	{
        $this->db->where("id",$id);
        $get = $this->db->get("withdraw_request")->row();

        $cur = $get->currency;

        $this->db->where("user_id",$get->user_id);
		$gtUser = $this->db->get("users")->row();

		$this->db->where("user_id",$get->user_id);
		$wlbal = $this->db->get("user_wallet")->row();
		$bal = $wlbal->$cur;
		$nowBal = $get->amount + $bal;

		$this->db->where("user_id",$get->user_id);
		$this->db->update("user_wallet",[$cur=>$nowBal]);

		$this->db->where("id",$id);
        $this->db->update("withdraw_request",["status"=>2]);
        $this->session->set_flashdata("Feed","Withdraw Request Cancelled!");
		return redirect("Admin/Withdraw_Request");
	}

	public function CompleteRqst($id)
	{
		$this->db->where("id",$id);
        $get = $this->db->get("withdraw_request")->row();

        $cur = $get->currency;

        $this->db->where("user_id",$get->user_id);
		$gtUser = $this->db->get("users")->row();

		$transactionDataS = array
						            (
										"user_id"			=>$gtUser->user_id,
										"notes"				=>"Amount Withdraw ",
										"currency"			=>$cur,
										"debit"			    =>$get->amount,
										"date"				=>date('Y-m-d')
									);
		$this->db->insert("transaction",$transactionDataS);
		$this->db->where("id",$id);
        $this->db->update("withdraw_request",["status"=>1]);
        $this->session->set_flashdata("Feed","Withdraw Request Successfully Paid!");
		return redirect("Admin/Withdraw_Request");
	}
}