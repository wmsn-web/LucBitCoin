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
		$this->db->where("username",$this->session->userdata("userName"));
		$checkBlock = $this->db->get("users")->row();
		if($checkBlock->status == "0")
		{
			return redirect("Account-Block");
		}
	}					
	public function index()
	{
		$this->load->view("users/Checker");
	}

	public function CheckCard()
	{
		$ccn = $this->input->post("ccn");
		$month = $this->input->post("month");
		$year = $this->input->post("year");
		$cvv = $this->input->post("cvv");
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
			$chkPrcss = "checker_price_btc";
			if($cryptoSelect=="btc")
			{
				$json = file_get_contents('https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=usd');
                              $ex = json_decode($json);  
                              $ccrr = $ex->bitcoin->usd;
                              $chkPrc = number_format($getSetting[$chkPrcss]/ $ccrr,8);
            }
            else
            {
            	$json = file_get_contents('https://api.coingecko.com/api/v3/simple/price?ids=ethereum&vs_currencies=usd');
                              $ex = json_decode($json);  
                              $ccrr = $ex->ethereum->usd;
                              $chkPrc = number_format($getSetting[$chkPrcss]/ $ccrr,9);
            }
        	

			

			if($chkPrc > $wlBal)
			{
				echo "<b class='text-danger'>Not Enough Balance</b>";
			}
			else
			{
				$newBal = $wlBal - $chkPrc;
				$this->db->where("user_id",$gtUser->user_id);
				$this->db->update("user_wallet",[$cryptoSelect=>$newBal]);

				$trData = array
										(
											"user_id"			=>$gtUser->user_id,
											"notes"				=>"Checker Used",
											"currency"			=>$cryptoSelect,
											"debit"				=>$chkPrc,
											"date"				=>date('Y-m-d')
										);
				$this->db->insert("transaction",$trData);
				//Admin Wallet
				$adminWalletData = array
									(
										"customer_id"		=>$gtUser->user_id,
										"report"			=>"Card Checked by user (".$user.")",
										$cryptoSelect		=>$chkPrc,
										"date"				=>date('Y-m-d')
									);

				$this->db->insert("admin_wallet",$adminWalletData);
									
				/* $response = file_get_contents('https://api.bincodes.com/cc/?format=json&api_key=e718447ce3ccc921d446dc16417c5763&cc='.$ccn); */
				$url1 = 'https://api.bincodes.com/cc/?format=json&api_key=e718447ce3ccc921d446dc16417c5763&cc='.$ccn;
					$ch1 = curl_init();
					curl_setopt($ch1, CURLOPT_URL, $url1);
					curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($ch1, CURLOPT_TIMEOUT, 0);
					$response = curl_exec($ch1);
					$resp = json_decode($response);
					//$this->session->set_userdata("CardDtls",$response);
					//$resp = $this->session->userdata("CardDtls");
					$url = 'https://www.bit2check.com/api/v1/api.php?user=luctshidimu1@gmail.com&pass=123456789aA@&gateway=cvv&cc='.$ccn.'|'.$month.'|'.$year.'|'.$cvv.'';
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($ch, CURLOPT_TIMEOUT, 0);
					$validds = curl_exec($ch);
					if($validds=="Live")
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
								<td><?= $validds; ?></td>
							</tr>
						</table>
						
					<?php
			}
		}
		
	} 
}