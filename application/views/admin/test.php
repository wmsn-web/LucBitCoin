<div id="jsn"></div>
<?php include('inc/js.php'); ?>
<script type="text/javascript">
				$(document).ready(function(){
					$.get("https://api.bincodes.com/cc/?format=json&api_key=e718447ce3ccc921d446dc16417c5763&cc=5157359818590564", function(data, status){
				      alert("Data: " + data + "\nStatus: " + status);
				    });
				});
			</script>
			