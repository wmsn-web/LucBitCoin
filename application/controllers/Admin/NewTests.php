<?php
/**
 * 
 */
class NewTests extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("UserModel");
		$this->load->model("AdminModel");
		
	}

	public function ppost()
	{
		$ccdata = $this->input->post("ccDeta");
		$basename = $this->input->post("base_name");
		$cd = $this->input->post("cd");
		$seller = $this->input->post("seller");


		$skuList = explode(PHP_EOL, $ccdata);
		$cardCount = count($skuList);
		//print_r($ccdata);
		//die();
		$ln =1;
		if($basename=="")
		{
			$rtn[] = "Please Enter Basename";
		}
		elseif($cd=="")
		{
			$rtn[] = "Please Select Card or Dump";
		}
		elseif($cd=="Dump")
		{
			$rtn[] = "Currently Dump is not available";
		}
		else
		{
	         	foreach  ($skuList as $key1) {
	         	$lnn = $ln++;
	         	$expl = explode("|", $key1);
	         	$count = count($expl);
	         	if($count == 13)
	         	{
	         		$price= @$expl[0];
			        $ccn=  @$expl[1];
			        $month= @$expl[2];
			        $year= @$expl[3];
			        $cvv=   @$expl[4];
			        $name=  @$expl[5];
			        $address=@$expl[6];
			        $city= @$expl[7];
			        $state=@$expl[8];
			        $zip= @$expl[9];
			        $country= @$expl[10];
			       	$basename=@$basename;
			        $cd= @$cd;
			        $mobile= @$expl[11];
			        $email= @$expl[12];


			        //Check Date
			        $mn = $year."-".$month."-30";
                    $n = strtotime($mn)."-";
                    $today = date('Y-m-d');
                    $td = strtotime($today);

                    if($td > $n)
                    {
                    	$return = "Line ".$lnn.": Incorrect Month Year Field<br>";
                    }
                    else
                    {
                    	$cvvStr = strlen($cvv);
                    	if($cvvStr > 4 | $cvvStr < 3)
						{
							$return = "Line ".$lnn.": Incorrect CVV<br>";
						}
						else
						{
							if($price =="")
							{ $return = "Line ".$lnn.": Enter Price Price <br>";}
							elseif ($ccn == "")
							{ $return = "Line ".$lnn.": Enter Card Number <br>";} 
							elseif($month=="")
							{ $return = "Line ".$lnn.": Enter valid Month <br>";} 
							elseif($year=="")
							{ $return = "Line ".$lnn.": Enter Valid year<br>";}
							elseif($cvv=="")
							{ $return = "Line ".$lnn.": Enter Valid CVV<br>";} 
							elseif($name=="")
							{ $return = "Line ".$lnn.": Enter Name<br>";}
							elseif($address=="")
							{ $return = "Line ".$lnn.": Enter Address<br>";}
							/*
							elseif($city=="")
							{ $return = "Line ".$lnn.": Enter City Name<br>";} 
							elseif($state=="")
							{ $return = "Line ".$lnn.": Enter State name<br>";}
							elseif($zip=="")
							{ $return = "Line ".$lnn.": Enter zip code<br>";}
							*/
							elseif($country=="")
							{ $return = "Line ".$lnn.": Enter Country Name<br>";}

							else
							{
				        		$uuppll = $this->uploadCards($price,$ccn,$month,$year,$cvv,$name,$address,$city,$state,$zip,$country,$basename,$cd,$mobile,$email,$seller);
				        		//$uuppll = "success";
				        		$return ="Line ".$lnn.": ". $uuppll."<br>";
				        	}
						}
			        	
                    }

			        
	         	}
	         	else
	         	{
	         		$return = "Line ".$lnn.": Invalid Fields<br>";
	         	}
		        
	         	$rtn[] = $return;
	         
	         }
        }
         //print_r($rtn);
         $this->session->set_flashdata("newFeedupl",$rtn);
         $this->session->set_flashdata("ccdata",$ccdata);
         	return redirect("Admin/Upload-cards");
	}			

  public function uploadCards($price,$ccn,$month,$year,$cvv,$name,$address,$city,$state,$zip,$country,$basename,$cd,$mobile,$email,$seller)
  {
  		$this->db->where("card_no",$ccn);
		$get = $this->db->get("cards")->num_rows();
		if($get >0)
		{
			$return = "Card Alreadt Exists!";
		}
		else
		{
			/*	$response = file_get_contents('https://api.bincodes.com/cc/?format=json&api_key=e718447ce3ccc921d446dc16417c5763&cc='.$ccn);*/
				$url1 = 'https://api.bincodes.com/cc/?format=json&api_key=e718447ce3ccc921d446dc16417c5763&cc='.$ccn;
					$ch1 = curl_init();
					curl_setopt($ch1, CURLOPT_URL, $url1);
					curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($ch1, CURLOPT_TIMEOUT, 0);
					$response = curl_exec($ch1);
				$response = json_decode($response);
				//print_r($response);
				if(@$response->error)
				{//response Errors start
					if(@$response->error=="1004")
					{
						$return = "Internal Server Error!";
						//echo json_encode($return);
					}
					elseif(@$response->error=="1016")
					{
						$return = "Invalid Card";
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
										"type"		=>@$response->type,
										"card_name"	=>@$response->card,
										"bank"		=>$response->bank,
										"address"	=>$address.", ".$city.", ".$state."-".$zip.", ".$country,
										"mobile"	=>$mobile,
										"email"		=>$email,
										"seller"	=>$seller,
										"base"		=>$basename,
										"price"		=>$price,
										"valid"		=>@$response->valid,
										"cd"		=>$cd,
										"status"	=>1,
										"country_code"=>@$response->countrycode,
										"date"		=>date('Y-m-d h:i:s')
									);
						
							//echo $ccn;
							$this->db->insert("cards",$data);
							$this->db->where(["basename"=>$basename,"seller"=>$seller]);
							$getBase = $this->db->get("bases")->num_rows();
							if($getBase ==0)
							{
								$this->db->insert("bases",["basename"=>$basename,"seller"=>$seller]);
							}
							$return = "Card added Succesfuly";
					


			}
  }
  return $return;
}
}