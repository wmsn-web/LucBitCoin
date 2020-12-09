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

		$this->db->where(["user_id"=>$user_id,"tr_type"=>"earning"]);
		$this->db->select_sum("credit");
		$gtTr = $this->db->get("transaction")->row();
		return $gtTr->credit;
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
}