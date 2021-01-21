<?php
/**
 * 
 */
class AdminModel extends CI_model
{
	
	public function getRules()
	{
		$get = $this->db->get("site_rules");
		if($get->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$rows = $get->result();
			foreach($rows as $row):
			$data[] = array
						(
							"descr" =>$row->description,
							"id"	=>$row->id
						);
			endforeach;
		}

		return $data;
	}

	public function getAllUsers()
	{
		$get = $this->db->get("users");
		if($get->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $get->result();
			foreach ($res as $key) {
				$this->db->where("user_id",$key->user_id);
				$gtWllet = $this->db->get("user_wallet");
				if($gtWllet->num_rows()==0)
				{
					$btc = "0.00000000";
					$eth = "0.000000000";
				}
				else
				{
					$row = $gtWllet->row();
					$btcs = $row->btc;
					$eths = $row->eth;
					if($btcs==null)
					{
						$btc = "0.00000000";
					}
					else
					{
						$btc = number_format($btcs,8);
					}
					if($eths==null)
					{
						$eth = "0.0000000000";
					}
					else
					{
						$eth = number_format($eths,9);
					}
				}
				$data[] = array
							(
								"username"		=>$key->username,
								"user_id"		=>$key->user_id,
								"withdraw_btc"	=>$key->withdraw_btc,
								"withdraw_eth"	=>$key->withdraw_eth,
								"balBtc"		=>$btc,
								"balEth"		=>$eth,
								"status"		=>$key->status
							);
			}
		}

		return $data;
	}

	public function setBalance($id,$currency,$amount,$rqid)
	{
		$this->db->where("user_id",$id);
		$gtWllet = $this->db->get("user_wallet");
		if($gtWllet->num_rows()==0)
		{
			$this->db->insert("user_wallet",["user_id"=>$id,$currency=>$amount]);
			$return = true;
			$trdata = array
							(
								"user_id"			=>$id,
								"notes"				=>"Diposit to Wallet",
								"currency"			=>$currency,
								"tr_type"			=>null,
								"credit"			=>$amount,
								"date"				=>date('Y-m-d')
							);
					$this->db->insert("transaction",$trdata);
			$this->db->where("id",$rqid);
			$this->db->update("fund_request",["status"=>1]);
							
		}
		else
		{
			$row = $gtWllet->row();
			$bal = $row->$currency + $amount;

			$this->db->where("user_id",$id);
			$this->db->update("user_wallet",["user_id"=>$id,$currency=>$bal]);
			$return = "added";

			$trdata = array
							(
								"user_id"			=>$id,
								"notes"				=>"Diposit to Wallet",
								"currency"			=>$currency,
								"tr_type"			=>null,
								"credit"			=>$amount,
								"date"				=>date('Y-m-d')
							);
					$this->db->insert("transaction",$trdata);
					$this->db->where("id",$rqid);
			$this->db->update("fund_request",["status"=>1]);
		}

		return true;
	}

	public function getAllProducts()
	{

		$this->db->order_by("id","DESC");
		$get = $this->db->get("cards");
		if($get->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $get->result();
			foreach ($res as $key) {
				$this->db->where("basename",$key->base);
				$gtBases = $this->db->get("bases")->row();
				$prcnt = @$gtBases->prcnt;
				$dt = $key->date;
				$dts = date_create($dt);
				$date = date_format($dts,'d-m-Y');
				$this->db->where("product_id",$key->id);
				$getSell = $this->db->get("orders")->num_rows();
				$data[] = array
								(
									"id"		=>$key->id,
									"date"		=>$date,
									"bin"		=>$key->bin,
									"exp"		=>$key->exp,
									"cvv"		=>$key->cvv,
									"type"		=>$key->type,
									"brand"		=>$key->card_name,
									"bank"		=>$key->bank,
									"address"	=>$key->address,
									"seller"	=>$key->seller,
									"base"		=>$key->base,
									"lives"		=>$prcnt." %",
									"price"		=>$key->price,
									"getSell"	=>$getSell,
									"status"	=>$key->status,
									"cntr_cd"	=>strtolower($key->country_code)
									
								);
			}
		}

		return $data;
	}

	public function getAllWdrRqst()
	{
		$this->db->order_by("id","DESC");
		$get = $this->db->get("withdraw_request");
		if($get->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $get->result();
			foreach($res as $key)
			{
				$this->db->where("user_id",$key->user_id);
				$gtUser = $this->db->get("users")->row();
				$data[] = array
								(
									"user_id"	=>$key->user_id,
									"user"		=>$gtUser->username,
									"currency"	=>$key->currency,
									"amount"	=>$key->amount,
									"status"	=>$key->status,
									"date"		=>$key->date,
									"addr"		=>$key->address,
									"id"		=>$key->id
								);
			}
		}
		return $data;
	}

	public function getSetting()
	{
		$get = $this->db->get("settings")->row();
		

		$data = array
					(
						"SaleCharg"	=>$get->sale_charge,
						"btcRate"	=>$get->btc_rate,
						"ethRate"	=>$get->eth_rate,
						"refer_reward"=>$get->refer_reward,
						"checker_price_btc"=>$get->checker_price_btc,
						"checker_price_eth"=>$get->checker_price_eth,
						"addr_btc"	=>$get->addr_btc,
						"addr_eth"	=>$get->addr_eth
					);
		return $data;
	}

	public function walletData()
	{
		//Balances
		//btc
		$this->db->select_sum("btc");
		$wlbtc = $this->db->get("admin_wallet");
		if($wlbtc->num_rows()==0)
		{
			$balBtc = 0;
		}
		else
		{
			$rowbtc = $wlbtc->row();
			$balBtc = number_format($rowbtc->btc,8);
		}
		//eth
		$this->db->select_sum("eth");
		$wleth = $this->db->get("admin_wallet");
		if($wleth->num_rows()==0)
		{
			$baletc = 0;
		}
		else
		{
			$roweth = $wleth->row();
			$baletc = number_format($roweth->eth,9);
		}

		$this->db->order_by("id","DESC");
		$get = $this->db->get("admin_wallet");
		if($get->num_rows()==0)
		{
			$trData = array();
		}
		else
		{
			$res = $get->result();
			foreach ($res as $key) {
				$trData[] = array
								(
									"id"		=>$key->id,
									"buyer"		=>$key->customer_id,
									"notes"		=>$key->report,
									"date"		=>$key->date,
									"btc"		=>$key->btc,
									"eth"		=>$key->eth
								);
			}
		}

		$data = ["balanceBtc"=>$balBtc,"balanceEth"=>$baletc,"trData"=>$trData];
		return $data;
	}

	public function getfundRequest()
	{
		$this->db->order_by("id","DESC");
		$get = $this->db->get("fund_request");
		if($get->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $get->result();
			foreach ($res as $key => $val) {
				$this->db->where("username",$val->username);
				$gtUser = $this->db->get("users")->row();
				$data[] = array
							(
								"username"	=>$val->username,
		        				"currency"	=>$val->currency,
		        				"amount"	=>$val->amount,
		        				"notes"		=>$val->notes,
		        				"from_addr"	=>$val->from_addr,
		        				"status"	=>$val->status,
		        				"date"		=>$val->date,
		        				"id"		=>$val->id,
		        				"user_id"	=>$gtUser->user_id
							);
			}
		}

		return $data;
	}

	public function getBaseData()
	{
		$gtbase = $this->db->get("bases");
		if($gtbase->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $gtbase->result();
			foreach($res as $key)
			{
				$this->db->where(["seller"=>$key->seller, "base"=>$key->basename]);
				$gtAllPro = $this->db->get("cards")->num_rows();
				$this->db->where(["seller"=>$key->seller, "base"=>$key->basename, "status"=>0, "mtr_status"=>"disb"]);
				$gtDisbPro = $this->db->get("cards")->num_rows();
				$this->db->where(["seller"=>$key->seller, "base"=>$key->basename, "status"=>0, "mtr_status"=>"saled"]);
				$gtSaldPro = $this->db->get("cards")->num_rows();
				$data[] = array
							(
								"id"		=>$key->id,
								"basename"	=>$key->basename,
								"seller"	=>$key->seller,
								"prcnt"		=>$key->prcnt,
								"allCrd"	=>$gtAllPro,
								"disbPro"	=>$gtDisbPro,
								"saledPro"	=>$gtSaldPro
							);
			}
		}

		return $data;
	}
}