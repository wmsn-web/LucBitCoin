<?php
/**
 * 
 */
class Checker extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("UserModel");
		$this->load->model("AdminModel");
		if(!$this->session->userdata("userName"))
		{
			return redirect("Login"); 
		}
	}					
	public function index()
	{
		$this->load->view("users/Checker");
	}

	public function CheckCard()
	{
		$ccn = $this->input->post("ccn");
		$user = $this->input->post("user");
		$getSetting = $this->AdminModel->getSetting();
		$this->db->where("username",$user);
		$gtUser = $this->db->get("users")->row();

		$cryptoSelect = strtolower($gtUser->crypto_select);

		$this->db->where("user_id",$gtUser->user_id);
		$wll = $this->db->get("user_wallet");
		if($wll->num_rows()==0)
		{
			echo "<b class='text-danger'>Not Enough Balance</b>";
		}
		else
		{
			$wlBal = $wll->row()->$cryptoSelect;
			$chkPrc = "checker_price_".$cryptoSelect;
			if($getSetting[$chkPrc] > $wlBal)
			{
				echo "<b class='text-danger'>Not Enough Balance</b>";
			}
			else
			{
				$newBal = $wlBal - $getSetting[$chkPrc];
				$this->db->where("user_id",$gtUser->user_id);
				$this->db->update("user_wallet",[$cryptoSelect=>$newBal]);

				$trData = array
										(
											"user_id"			=>$gtUser->user_id,
											"notes"				=>"Checker Used",
											"currency"			=>$cryptoSelect,
											"debit"				=>$getSetting[$chkPrc],
											"date"				=>date('Y-m-d')
										);
				$this->db->insert("transaction",$trData);
				//Admin Wallet
				$adminWalletData = array
									(
										"customer_id"		=>$gtUser->user_id,
										"report"			=>"Card Checked by user (".$user.")",
										$cryptoSelect		=>$getSetting[$chkPrc],
										"date"				=>date('Y-m-d')
									);

				$this->db->insert("admin_wallet",$adminWalletData);

				$response = file_get_contents('https://api.bincodes.com/cc/?format=json&api_key=e718447ce3ccc921d446dc16417c5763&cc='.$ccn);
					$resp = json_decode($response);
					//$this->session->set_userdata("CardDtls",$response);
					//$resp = $this->session->userdata("CardDtls");
					if(@$resp->valid ==true)
					{
						$valid = "<i class='fa fa-check text-success'></i>";
					}
					else
					{
						$valid = "<i class='fas fa-close text-danger'></i>";
					}
					
					?>
						<table class="table table-bordered">
							<tr>
								<th>Bin</th>
								<td><?= @$resp->bin; ?></td>
							</tr>
							<tr>
								<th>Bank</th>
								<td><?= @$resp->bank; ?></td>
							</tr>
							<tr>
								<th>Card Type</th>
								<td><?= @$resp->card." ". @$resp->type; ?></td>
							</tr>
							<tr>
								<th>Country</th>
								<td><?= @$resp->countrycode; ?></td>
							</tr>
							<tr>
								<th>Valid</th>
								<td><?= @$valid; ?></td>
							</tr>
						</table>
					<?php
			}
		}
		
	} 
}