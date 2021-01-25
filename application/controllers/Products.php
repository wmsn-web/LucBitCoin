<?php
/**
 * 
 */
class Products extends CI_Controller {

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

	public function index($types='')
	{
		$getProd = $this->UserModel->getAllProducts($types);
		$this->load->view("users/Products",["proData"=>$getProd]);
		//echo "<pre>";
		//print_r($getProd);
		/*
		// set API Endpoint and API key 
            $endpoint = 'live';
            $access_key = '70d19982004ef8aa2c639ae10d4c06af';

           // Initialize CURL:
            $json = file_get_contents('http://api.coinlayer.com/api/'.$endpoint.'?access_key='.$access_key.'');
            
              $exchangeRates = json_decode($json);	

              	echo "<pre>";
              	print_r($exchangeRates);

              // Access the exchange rate values, e.g. GBP:
             echo $exchangeRates->rates->BTC;
             */
	}

	public function ChangetoEth()
	{
		$user = $this->input->post("user");
		$this->db->where("username",$user);
		$this->db->update("users",["crypto_select"=>"ETH"]); 
	}

	public function ChangetoBtc()
	{
		$user = $this->input->post("user");
		$this->db->where("username",$user);
		$this->db->update("users",["crypto_select"=>"BTC"]);
	}

	public function ChkUserbal()
	{
		$user_id = $this->input->post("user_id");
		$price = $this->input->post("price");
		$curency = strtolower($this->input->post("curecy"));
		
		$this->db->where("user_id",$user_id);
		$get = $this->db->get("user_wallet");
		if($get->num_rows()==0)
		{
			echo "no";
		}
		else
		{
			$row = $get->row();
			if($price > $row->$curency)
			{
				echo "no";
			}
			else
			{
				echo "ok";
			}
		}
		
	}

	public function PurchaseCard()
	{
		$user_id = $this->input->post("user_id");
		$price = $this->input->post("price");
		$curency = strtolower($this->input->post("curecy"));
		$proId = $this->input->post("proId");
		$getSetting = $this->AdminModel->getSetting();
		$referReward = $getSetting['refer_reward'];
		$rewardss = $price * $referReward /100;
		if($curency=="btc")
		{
			$reward = number_format($rewardss,8);
		}
		else
		{
			$reward = number_format($rewardss,9);
		}
		

		//get Seller From Products
		$this->db->where("id",$proId);
		$getCard = $this->db->get("cards")->row();
		$seller = $getCard->seller;
		//Get Bin Number
		$bin = $getCard->bin;

		//Get Seller Id
		$this->db->where("username",$seller);
		$gtSeller = $this->db->get("users")->row();
		$sellerId = $gtSeller->user_id;

		//get Admin Percentage Charge
		$getsaleCharge = $this->db->get("settings")->row();
		$saleCharge = $getsaleCharge->sale_charge;

		//Seller Will Get
		$percent = $saleCharge /100;
		$percentPrice = $price*$percent;
		$sellerPrice = $price - $percentPrice;
		//Admin Get
		$adminPrice = $price - $sellerPrice;

		//Check Referral
		$this->db->where("user_id",$user_id);
		$gtOrdr = $this->db->get("orders")->num_rows();
		if($gtOrdr==0)
		{
			$this->db->where("user_id",$user_id);
			$gtUssers = $this->db->get("users")->row();

			if($gtUssers->parent_referral == null)
			{

			}
			else
			{
				$this->db->where("referral_code",$gtUssers->parent_referral);
				$gtrefer = $this->db->get("users")->row();
				$referId = $gtrefer->user_id;

				//Get Referer Wallet
				$this->db->where("user_id",$referId);
				$gtWllR = $this->db->get("user_wallet");
				if($gtWllR->num_rows()==0)
				{
					$wlBalR = 0;
				}
				else
				{
					$wlBalR = $gtWllR->row()->$curency;
				}
					$referBalance = $wlBalR+$reward;
					if($gtWllR->num_rows()==0)
					{
						$this->db->insert("user_wallet",["user_id"=>$referId,$curency=>$referBalance]);
					}
					else
					{
						$this->db->where("user_id",$referId);
						$this->db->update("user_wallet",[$curency=>$referBalance]);
					}
					$transactionDataR = array
										(
											"user_id"			=>$referId,
											"notes"				=>"You have rewarded due to Refer",
											"currency"			=>$curency,
											"tr_type"			=>"earning",
											"credit"			=>$reward,
											"date"				=>date('Y-m-d')
										);
					$this->db->insert("transaction",$transactionDataR);

				}
			}




		//Get Seller Wallet
		$this->db->where("user_id",$sellerId);
		$gtWllS = $this->db->get("user_wallet");
		if($gtWllS->num_rows()==0)
		{
			$wlBalS = 0;
		}
		else
		{
			$wlBalS = $gtWllS->row()->$curency;
		}
		$sellerBalance = $wlBalS+$sellerPrice;

		//User Wallet
		$this->db->where("user_id",$user_id);
		$gtWllU = $this->db->get("user_wallet");
		
		if($gtWllU->num_rows()==0)
		{
			$wlBalU = 0;
		}
		else
		{
			$wlBalU = $gtWllU->row()->$curency;
		}
		$userBalance = $wlBalU-$price;

		//Check Order Exists
		$this->db->where("product_id",$proId);
		$getOrders = $this->db->get("orders")->num_rows();
		if($getOrders==0)
		{
			$dataOrders = array
								(
									"user_id"		=>$user_id,
									"seller_id"		=>$sellerId,
									"product_id"	=>$proId,
									"currency"		=>$curency,
									"price"			=>$price,
									"date"			=>date('Y-m-d')
								);
			$adminWalletData = array
									(
										"customer_id"		=>$user_id,
										"seller_id"			=>$sellerId,
										"report"			=>"Card Purchased by user (BIN: ".$bin.")",
										$curency			=>$adminPrice,
										"date"				=>date('Y-m-d')
									);
			$transactionDataU = array
									(
										"user_id"			=>$user_id,
										"notes"				=>"Bin- (".$bin.") Purchased",
										"currency"			=>$curency,
										"debit"				=>$price,
										"date"				=>date('Y-m-d')
									);
			$transactionDataS = array
									(
										"user_id"			=>$sellerId,
										"notes"				=>"Bin- (".$bin.") Sold",
										"currency"			=>$curency,
										"tr_type"			=>"earning",
										"credit"			=>$sellerPrice,
										"date"				=>date('Y-m-d')
									);
			$userWalletSeller = array
									(
										"user_id"			=>$sellerId,
										$curency			=>$sellerBalance
									);
			$userWalletUser =  array
									(
										"user_id"			=>$user_id,
										$curency			=>$userBalance
									);
			//Insert Into Orders
			$this->db->insert("orders",$dataOrders);
			//Insert AdminWallet
			$this->db->insert("admin_wallet",$adminWalletData);
			//Insert into Transaction For Saller
			$this->db->insert("transaction",$transactionDataS);
			//Insert into Transaction for User
			$this->db->insert("transaction",$transactionDataU);
			//Update user wallet for Saller
			if($gtWllS->num_rows()==0)
			{
				$this->db->insert("user_wallet",$userWalletSeller);
			}else
			{
				$this->db->where("user_id",$sellerId);
				$this->db->update("user_wallet",$userWalletSeller);
			}
			//Update user wallet for User
			if($gtWllU->num_rows()==0)
			{
				$this->db->insert("user_wallet",$userWalletUser);
			}
			else
			{
				$this->db->where("user_id",$user_id);
				$this->db->update("user_wallet",$userWalletUser);
			}
			//Update Product Status
			$this->db->where("id",$proId);
			$this->db->update("cards",["status"=>0, "mtr_status"=>"saled"]);
			echo "succ";


		}
		else
		{
			echo "inv";
		}
	

	}

	public function ChangeCardPrice()
	{
		$id = $this->input->post("id");
		$price = $this->input->post("price");
		$this->db->where("id",$id);
		$this->db->update("cards",["price"=>$price]);
		$this->session->set_flashdata("Feed","Price Updated Successfully");
		return redirect('Products/index/Card');
	}

	public function ApplyChecker() 
	{
		$proId = $this->input->post("proId");
		$chkprc = $this->input->post("chkprc");
		$user_id = $this->input->post("user_id");
		$curency = strtolower($this->input->post("curecy"));
		$this->db->where("id",$proId);
		$gt = $this->db->get("cards")->row();
		$ccn = $gt->card_no;
		$exp = $gt->exp;
		$cvv = $gt->cvv;
		$spl = explode("/", $exp);
		$month = $spl[0];
		$year = $spl[1];
		//echo $ccn;

		$url = 'https://www.bit2check.com/api/v1/api.php?user=luctshidimu1@gmail.com&pass=123456789aA@&gateway=cvv&cc='.$ccn.'|'.$month.'|'.$year.'|'.$cvv.'';
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($ch, CURLOPT_TIMEOUT, 30);
					$validds = curl_exec($ch);
					echo $validds;
					if($validds=="Live")
					{

					}
					else
					{
						$this->db->where("id",$proId);
						$this->db->delete("cards");
					}
					curl_close($ch);
					
			$this->db->where("id",$proId);
			$getCard = $this->db->get("cards")->row();
			//Get Bin Number
			$bin = $getCard->bin;
			$this->db->where("user_id",$user_id);
			$gtWllU = $this->db->get("user_wallet");
			
			if($gtWllU->num_rows()==0)
			{
				$wlBalU = 0;
			}
			else
			{
				$wlBalU = $gtWllU->row()->$curency;
			}
			$userBalance = $wlBalU-$chkprc;
			$transactionDataU = array
									(
										"user_id"			=>$user_id,
										"notes"				=>"Bin- (".$bin.") Checked by Checker",
										"currency"			=>$curency,
										"debit"				=>$chkprc,
										"date"				=>date('Y-m-d')
									);
			$userWalletUser =  array
									(
										"user_id"			=>$user_id,
										$curency			=>$userBalance
									);
			$this->db->insert("transaction",$transactionDataU);
			if($gtWllU->num_rows()==0)
			{
				$this->db->insert("user_wallet",$userWalletUser);
			}
			else
			{
				$this->db->where("user_id",$user_id);
				$this->db->update("user_wallet",$userWalletUser);
			}

			
	}

	function ChkerPrice()
	{
	  $getSetting = $this->AdminModel->getSetting();
      $ccrr1 = $getSetting['btcRate'];
      $ccrr2 = $getSetting['ethRate'];
                 $user = $this->input->post("userName");
                 $this->db->where("username",$user);
                 $gtUser = $this->db->get("users")->row();
                 $cryptoSelect = $gtUser->crypto_select;
                  if($cryptoSelect=="BTC")
                    {
                      
                        $icn = '<i class="fab fa-btc"></i>';
                        $prc = number_format($getSetting['checker_price_btc'] / $ccrr1,8);
                  }
                  else
                  {
                            
                        $icn = '<i class="fab fa-ethereum"></i>';
                        $prc = number_format($getSetting['checker_price_btc'] / $ccrr2,9);
                   }
                $returns = array("mssg"=>"Price for checker is ".$icn." ".$prc, "chkPrc"=>$prc);
                echo json_encode($returns);
        //echo "Price for checker is ".$icn." ".$prc;

	}
}