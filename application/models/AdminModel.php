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
}