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
	{ ?>

		<form action="<?= base_url('Products/PurchaseCard'); ?>" method="post">
			<input type="text" name="user_id" placeholder="userid"><br>
			<input type="text" name="price" placeholder="price"><br>
			<input type="text" name="curecy" placeholder="cur"><br>
			<input type="text" name="proId" placeholder="pro"><br>
			<button>Save</button>
		</form>

<?php	}
}