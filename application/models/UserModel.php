<?php
/**
 * 
 */
class UserModel extends CI_model
{
	
	public function getRules()
	{
		$gtRules = $this->db->get("site_rules");
		if($gtRules->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $gtRules->result();
			foreach ($res as $key) {
				$data[] = array
							(
								"rules"	=>$key->description
							);
			}
		}

		return $data;
	}

	public function getBasenames($seller)
	{
		$this->db->where(["seller"=>$seller]);
		$getBase = $this->db->get("bases");
		if($getBase->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $getBase->result();
			foreach ($res as $key) {
				$data[] = array
								(
									"basename"=>$key->basename
								);
			}
		}

		return $data;
	}

	public function getAllProducts($types)
	{
		$this->db->where(["cd"=>$types,"status"=>1]);
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
				
					$prcnt = $gtBases->prcnt;
				
				$dt = $key->date;
				$dts = date_create($dt);
				$date = date_format($dts,'d-m-Y');
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
									"cntr_cd"	=>strtolower($key->country_code)
									
								);
			}
		}

		return $data;
	}

	public function getSaleCards($seller)
	{
		$this->db->where("username",$seller);
		$seller_id = $this->db->get("users")->row()->user_id;

		$this->db->where("seller_id",$seller_id);
		$gtOrders = $this->db->get("orders");
		if($gtOrders->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $gtOrders->result();
			foreach($res as $ordr)
			{
				//Get Buyer Details
				$this->db->where("user_id",$ordr->user_id);
				$gtBuyer = $this->db->get("users")->row();
				$usernameBuyer = $gtBuyer->username;
				//Get Product Details
				$this->db->where("id",$ordr->product_id);
				$getPro = $this->db->get("cards")->row();
				$proDetails = "Bin: ".$getPro->bin.", Card Name: ".$getPro->card_name.", Exp: ".$getPro->exp.", CVV: ".$getPro->cvv;
				$type = $getPro->type;
				$base = $getPro->base;

				$data[] = array
								(
									"date"			=>$ordr->date,
									"base"			=>$base,
									"type"			=>$type,
									"description"	=>$proDetails,
									"buyer"			=>$usernameBuyer,
									"price"			=>$ordr->price,
									"currency"		=>$ordr->currency
								);
			}
		}
		return $data;
	}

	public function gtTransactions($seller)
	{
		$this->db->where("username",$seller);
		$user_id = $this->db->get("users")->row()->user_id;

		$this->db->where("user_id",$user_id);
		$gtTr = $this->db->get("transaction");
		if($gtTr->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $gtTr->result();
			foreach($res as $key)
			{
				$data[] = array
							(
								"date" 		=>$key->date,
								"notes"		=>$key->notes,
								"currency"	=>$key->currency,
								"debit"		=>$key->debit,
								"credit"	=>$key->credit
							);
			}
		}

		return $data;
	}

	public function earning($seller)
	{
		$this->db->where("username",$seller);
		$user_id = $this->db->get("users")->row()->user_id;

		$this->db->where(["user_id"=>$user_id,"tr_type"=>"earning","currency"=>"btc"]);
		$this->db->select_sum("credit");
		$gtTrBtcss = $this->db->get("transaction")->row();
		$gtTrBtc = $gtTrBtcss->credit;

		$this->db->where(["user_id"=>$user_id,"tr_type"=>"earning","currency"=>"eth"]);
		$this->db->select_sum("credit");
		$gtTrEthss = $this->db->get("transaction")->row();
		$gtTrEth = $gtTrEthss->credit;

		$gtTr = ["gtTrBtc"=>$gtTrBtc,"gtTrEth"=>$gtTrEth];
		return $gtTr;
	}

	public function setWithdrawAddress($withdrawBtc,$withdrawEth,$username)
	{
		$this->db->where("username",$username);
		$this->db->update("users",["withdraw_btc"=>$withdrawBtc,"withdraw_eth"=>$withdrawEth]);
		return "ok";
	}

	public function getUserDetails($user)
	{
		$this->db->where("username",$user);
		$users = $this->db->get("users")->row();

		$data = array
					(
						"withdraw_btc"	=>$users->withdraw_btc,
						"withdraw_eth"	=>$users->withdraw_eth
					);
		return $data;
	}

	public function getOrders($user)
	{
		$this->db->where("username",$user);
		$users = $this->db->get("users")->row();
		$this->db->order_by("id","DESC");
		$this->db->where("user_id",$users->user_id);
		$gtOrd = $this->db->get("orders");
		if($gtOrd->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $gtOrd->result();
			foreach ($res as $keyOrd) {
				
				$this->db->where("id",$keyOrd->product_id);
				$gtPro = $this->db->get("cards");
				$key = $gtPro->row();
				$dt = $key->date;
				$dts = date_create($dt);
				$date = date_format($dts,'d-m-Y');
				$data[] = array
								(
									"id"		=>$key->id,
									"date"		=>$date,
									"numbers"	=>$key->card_no,
									"name"		=>$key->name,
									"exp"		=>$key->exp,
									"cvv"		=>$key->cvv,
									"type"		=>$key->type,
									"brand"		=>$key->card_name,
									"bank"		=>$key->bank,
									"address"	=>$key->address,
									"mobile"	=>$key->mobile,
									"email"		=>$key->email,
									"seller"	=>$key->seller,
									"base"		=>$key->base,
									"price"		=>$key->price,
									"cntr_cd"	=>strtolower($key->country_code),
									"currency"	=>$keyOrd->currency,
									"buyPrice"	=>$keyOrd->price
									
								);
			}
		}

		return $data;
	}

	public function sentWithdraw($username,$currency,$rqAmt)
	{
		$this->db->where("username",$username);
		$users = $this->db->get("users")->row();
		$this->db->where("user_id",$users->user_id);
		$gtWllt = $this->db->get("user_wallet");
		$gtaddr = "withdraw_".$currency;
		if($gtWllt->num_rows()==0)
		{
			$return = "nobal";
		}
		else
		{
			$wlbal = $gtWllt->row()->$currency;
			if($rqAmt > $wlbal)
			{
				$return = "invbal";
			}
			else
			{
				$addr = $users->$gtaddr;
				$wthdrData = array
								(
									"user_id"		=>$users->user_id,
									"currency"		=>$currency,
									"address"		=>$addr,
									"amount"		=>$rqAmt,
									"status"		=>0,
									"date"			=>date('Y-m-d')
								);
				$nowBal = $wlbal-$rqAmt;
				$this->db->insert("withdraw_request",$wthdrData);
				$this->db->where("user_id",$users->user_id);
				$this->db->update("user_wallet",[$currency=>$nowBal]);
				$return = "ok";
			}
		}

		return $return;
	}

	public function getWithdrawRequests($user)
	{
		$this->db->where("username",$user);
		$users = $this->db->get("users")->row();
		$this->db->where("user_id",$users->user_id);
		$get = $this->db->get("withdraw_request");
		if($get->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $get->result();
			foreach ($res as $key) {
				$data[] = array
								(
									"user_id"	=>$key->user_id,
									"currency"	=>$key->currency,
									"amount"	=>$key->amount,
									"date"		=>$key->date,
									"status"	=>$key->status
								);
			}
		}

		return $data;
	}

	public function getBaseData($seller) 
	{
		$this->db->where("username",$seller);
		$users = $this->db->get("users")->row();
		$this->db->where(["seller"=>$seller]);
		$getBs = $this->db->get("bases");
		if($getBs->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$resBs = $getBs->result();
			foreach($resBs as $bs)
			{
				$this->db->where(["seller"=>$seller, "base"=>$bs->basename,"status"=>1]);
				$getCrdlive = $this->db->get("cards")->num_rows();

				$this->db->where(["seller"=>$seller, "base"=>$bs->basename,"status"=>0]);
				$getCrdNotlive = $this->db->get("cards")->num_rows();

				$this->db->where(["seller"=>$seller, "base"=>$bs->basename]);
				$getCrd = $this->db->get("cards");
				if($getCrd->num_rows()==0)
				{
					$getCrdNumAll = $getCrd->num_rows();
					$sold_percent = 0;
				}
				else
				{	
					
					$getCrdNumAll = $getCrd->num_rows();
					$st1 = 100 / $getCrdNumAll;
					$sold_percent = number_format($st1*$getCrdNotlive,2);

					$st2 = 100/$getCrdNumAll;
					$lives = number_format($st2*$getCrdlive,2);
				}

				$data[] = array
							(
								"base"	=>$bs->basename,
								"sold"=>$sold_percent. " %",
								"live"=>$bs->prcnt." %"
							);
			}
		}

		return $data;

	}

	public function getDashData()
	{
		
		$this->db->order_by("id","DESC");
		
		$this->db->distinct();
		$this->db->select("base");
		$this->db->where(["status"=>1]);
		$get = $this->db->get("cards");
		
		//$get = $this->db->query("SELECT DISTINCT base FROM cards WHERE status=1 ORDER BY id DESC ");
		if($get->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $get->result();
			foreach ($res as $key) {
				$this->db->order_by("id","DESC");
				$this->db->where(["base"=>$key->base,"status"=>1]);
				$get2 = $this->db->get("cards");
				$tot = $get2->num_rows();
				$row = $get2->row();
				$data[] = array
								(
									"tot"=>$tot,
									"cd"=>$row->cd,
									"user"=>$row->seller,
									"date"=>$row->date,
									"base"=>$key->base
								);
			}
		}
		return $data;
	}

	public function getfundRequest($user)
	{
		$this->db->order_by("id","DESC");
		$this->db->where("username",$user);
		$get = $this->db->get("fund_request");
		if($get->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $get->result();
			foreach ($res as $key => $val) {
				$data[] = array
							(
								"username"	=>$val->username,
		        				"currency"	=>$val->currency,
		        				"amount"	=>$val->amount,
		        				"notes"		=>$val->notes,
		        				"from_addr"	=>$val->from_addr,
		        				"status"	=>$val->status,
		        				"date"		=>$val->date,
		        				"id"		=>$val->id
							);
			}
		}

		return $data;

	}
}