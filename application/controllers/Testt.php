<?php /**
 * 
 */
class Testt extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		/*
		$json = file_get_contents('https://api.coingecko.com/api/v3/simple/price?ids=ethereum&vs_currencies=usd');
		$js = json_decode($json);
		print_r($js);
		echo $js->ethereum->usd;

	 ?>

		<form action="<?= base_url('Products/PurchaseCard'); ?>" method="post">
			<input type="text" name="user_id" placeholder="userid"><br>
			<input type="text" name="price" placeholder="price"><br>
			<input type="text" name="curecy" placeholder="cur"><br>
			<input type="text" name="proId" placeholder="pro"><br>
			<button>Save</button>
		</form>



<?php	}
*/
			/*	$response = file_get_contents('https://api.bincodes.com/cc/?format=json&api_key=e718447ce3ccc921d446dc16417c5763&cc=5524902750227582');
				$response = json_decode($response);
				print_r($response); */


				$url1 = 'https://api.bincodes.com/cc/?format=json&api_key=e718447ce3ccc921d446dc16417c5763&cc=5524902750227582';
					$ch1 = curl_init();
					curl_setopt($ch1, CURLOPT_URL, $url1);
					curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($ch1, CURLOPT_TIMEOUT, 0);
					echo $response = curl_exec($ch1);
					
}
}