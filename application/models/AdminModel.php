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
								"balEth"		=>$eth	
							);
			}
		}

		return $data;
	}

	public function setBalance($id,$currency,$amount)
	{
		$this->db->where("user_id",$id);
		$gtWllet = $this->db->get("user_wallet");
		if($gtWllet->num_rows()==0)
		{
			$this->db->insert("user_wallet",["user_id"=>$id,$currency=>$amount]);
			$return = true;
		}
		else
		{
			$row = $gtWllet->row();
			$bal = $row->$currency + $amount;

			$this->db->where("user_id",$id);
			$this->db->update("user_wallet",["user_id"=>$id,$currency=>$bal]);
			$return = "added";
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

	public function getSaleCharg()
	{
		$get = $this->db->get("settings")->row();
		$SaleCharg = $get->sale_charge;
		return $SaleCharg;
	}
}