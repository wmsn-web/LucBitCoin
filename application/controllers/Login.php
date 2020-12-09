<?php 
/**
 * 
 */
class Login extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view("users/Login");
	}

	public function ProcessSugnup()
	{
		$user = $this->input->post("user");
		$pass = $this->input->post("pass");
		$scPin = $this->input->post("security");

		$password = password_hash($pass, PASSWORD_DEFAULT);
		$this->db->where("username",$user);
		$getNum = $this->db->get("users")->num_rows();
		if($getNum > 0)
		{
			echo "exst";
		}
		else
		{
			$data = array
						(
							"username" =>$user,
							"password"	=>$password,
							"security_pin"	=>$scPin,
							"user_type"	=>"user"
						);
			$this->db->insert("users",$data);
			$this->session->set_userdata("userName",$user);
			echo "done";

		}
	}

	public function ProcessLogin()
	{
		$user = $this->input->post("user");
		$pass = $this->input->post("pass");

		$this->db->where("username",$user);
		$get = $this->db->get("users");
		$getNum = $get->num_rows();
		$row = $get->row();
		if($getNum > 0)
		{
			$pas = $row->password;
			if(!password_verify($pass, $pas))
			{
				echo "invPs";
			}
			else
			{
				$this->session->set_userdata("userName",$user);
				echo "done";
			}
		}
		else
		{
			
			echo "inv";

		}
	}
}