<?php
/**
 * 
 */
class Checker extends CI_Controller {

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
		$this->load->view("users/Checker");
	}

	public function CheckCard()
	{
		$ccn = $this->input->post("ccn");
		$response = file_get_contents('https://api.bincodes.com/cc/?format=json&api_key=e718447ce3ccc921d446dc16417c5763&cc='.$ccn);
			$resp = json_decode($response);
			//$this->session->set_userdata("CardDtls",$response);
			//$resp = $this->session->userdata("CardDtls");
			if(@$resp->valid ==true)
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
						<td><?= @$valid; ?></td>
					</tr>
				</table>
			<?php
	} 
}