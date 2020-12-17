<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("UserModel");
		if(!$this->session->userdata("userName"))
		{
			return redirect("Login"); 
		}
	}

	public function index()
	{
		$seller = $this->session->userdata("userName");
		$basenames = $this->UserModel->getBasenames($seller); 
		$getSaleCards = $this->UserModel->getSaleCards($seller);
		$gtTransactions = $this->UserModel->gtTransactions($seller);
		$earning = $this->UserModel->earning($seller);
		$getUserDetails = $this->UserModel->getUserDetails($seller);
		$getWithdrawRequests = $this->UserModel->getWithdrawRequests($seller);
		$getBaseData = $this->UserModel->getBaseData($seller);
		//print_r($getBaseData);
		$this->load->view("users/newSeller",["base"=>$basenames,"saleData"=>$getSaleCards,"trData"=>$gtTransactions,"earning"=>$earning,"userDatas"=>$getUserDetails,"rqData"=>$getWithdrawRequests,"getBaseData"=>$getBaseData]);
		/*
			$response = file_get_contents('https://api.bincodes.com/cc/?format=json&api_key=e718447ce3ccc921d446dc16417c5763&cc=5157359818590564');
			$response = json_decode($response);
			print_r($response);

			*/
			//print_r($getWithdrawRequests);
		
	}

	public function parseUpload()
	{//Function Start

		$seller = $this->session->userdata("userName");
		$price = $this->input->post("price");
		$ccn = $this->input->post("ccn");
		$month = $this->input->post("month");
		$year = $this->input->post("year");
		$cvv = $this->input->post("cvv");
		$name = $this->input->post("name");
		$address = $this->input->post("address");
		$city = $this->input->post("city");
		$state = $this->input->post("state");
		$zip = $this->input->post("zip");
		$country = $this->input->post("country");
		$basename = $this->input->post("basename");
		$cd = $this->input->post("cd");

			

		if($price =="" | $ccn == "" | $month=="" | $year=="" | $cvv=="" | $name=="" | $address=="" | $city=="" | $state=="" | $zip=="" | $country=="" | $basename == "" | $cd =="")
		{//Check if empty Parameters start
			$return = array("msg"=>"error","note"=>"<b>Error:</b> Invalid Format");
			//echo json_encode($return);

		}
		else
		{//No Empty lets start
			$this->db->where("card_no",$ccn);
			$get = $this->db->get("cards")->num_rows();
			if($get >0)
			{
				$return = array("msg"=>"error","note"=>"<b>Error:</b> Card Alreadt Exists!");
			}
			else
			{
				$response = file_get_contents('https://api.bincodes.com/cc/?format=json&api_key=e718447ce3ccc921d446dc16417c5763&cc='.$ccn);
				$response = json_decode($response);
				//print_r($response);
				if(@$response->error)
				{//response Errors start
					if(@$response->error=="1004")
					{
						$return = array("msg"=>"error","note"=>"<b>Error:</b> Internal Server Error!");
						//echo json_encode($return);
					}
					elseif(@$response->error=="1016")
					{
						$return = array("msg"=>"error","note"=>"<b>Error:</b> Invalid Card");
						//echo json_encode($return);
					}
				}
				else
				{
					$data = array
								(
									"name"		=>$name,
									"card_no"	=>$ccn,
									"bin"		=>@$response->bin,
									"exp"		=>$month."/".$year,
									"cvv"		=>$cvv,
									"type"		=>$response->type,
									"card_name"	=>$response->card,
									"bank"		=>$response->bank,
									"address"	=>$address.", ".$city.", ".$state."-".$zip.", ".$country,
									"seller"	=>$seller,
									"base"		=>$basename,
									"price"		=>$price,
									"valid"		=>$response->valid,
									"cd"		=>$cd,
									"status"	=>1,
									"country_code"=>$response->countrycode,
									"date"		=>date('Y-m-d')
								);
					
						//echo $ccn;
						$this->db->insert("cards",$data);
						$this->db->where(["basename"=>$basename,"seller"=>$seller]);
						$getBase = $this->db->get("bases")->num_rows();
						if($getBase ==0)
						{
							$this->db->insert("bases",["basename"=>$basename,"seller"=>$seller]);
						}
						$return = array("msg"=>"succ","note"=>"<b><i class='fa fa-check-circle'></i> </b> Card added Succesfuly");
						//echo json_encode($return);
					
				}//response Errors start
			}
			

			
		}//Check if empty Parameters start///No Empty lets start

		echo json_encode($return);
		/*
			$response = file_get_contents('https://api.bincodes.com/cc/?format=json&api_key=e718447ce3ccc921d446dc16417c5763&cc=5157359818590564');
			$response = json_decode($response);
			print_r($response);
			*/
		
	}//Function End

	public function updateWithdrawAddress()
	{
		$withdrawBtc = $this->input->post("withdrawBtc");
		$withdrawEth = $this->input->post("withdrawEth");
		$username = $this->input->post("username");

		$setAddress = $this->UserModel->setWithdrawAddress($withdrawBtc,$withdrawEth,$username);
		$this->session->set_flashdata("Feed","Withdraw Address Updated Successfully");
		return redirect("Seller");
	}

	public function SendWthdrRequest()
	{
		$username = $this->input->post("user");
		$currency = $this->input->post("currency");
		$rqAmt = $this->input->post("rqAmt");
		$sentWithdraw = $this->UserModel->sentWithdraw($username,$currency,$rqAmt);
		if($sentWithdraw =="nobal")
		{
			echo "No Balance Available";
		}
		elseif($sentWithdraw =="invbal")
		{
			echo "Insufficient Balance";
		}
		else
		{
			echo "Request has been sent Successfully";
		}
	}


}