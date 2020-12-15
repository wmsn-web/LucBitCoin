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
}