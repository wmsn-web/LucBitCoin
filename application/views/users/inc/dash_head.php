<?php
$user = $this->session->userdata("userName");
$this->db->where("username",$user);
$row = $this->db->get("users")->row();
if($row->crypto_select =="BTC")
{
    $useBtc = "style='display:block'";
    $slctBtc = "style='display:none'";
    $useEth = "style='display:none'";
    $slctEth = "style='display:block'";
    $inuseBtc = "inuse";
    $inuseEth = "unsed";
}
else
{
    $useBtc = "style='display:none'";
    $slctBtc = "style='display:block'";
    $useEth = "style='display:block'";
    $slctEth = "style='display:none'";
    $inuseBtc = "unsed";
    $inuseEth = "inuse";
}
$username = $this->session->userdata("userName"); 
  $this->db->where("username",$username);
  $gtU = $this->db->get("users")->row();
  $this->db->where("user_id",$gtU->user_id);
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
            $eth = "0.000000000";
          }
          else
          {
            $eth = number_format($eths,9);
          }
        }
?>
<div class="col-md-8">
                    <div class="sm-right">
                        <div class="row">
                            <div class="col-sm-4 unsed text-center">
                                <span class="text-muted">Equivalent</span><span>USD 0.00</span>
                            </div>
                            <div class="col-sm-4 <?= $inuseBtc; ?> text-center">
                                <span class="text-muted">Bitcoin <small <?= $useBtc; ?> id="useBtc">in Use</small> <span <?= $slctBtc; ?> id="slctBtc"><<a href="javascript:void(0)">Select</a>></span></span> <span>BTC <?= $btc; ?></span>
                            </div>
                            <div class="col-sm-4 <?= $inuseEth; ?> text-center">
                              <span class="text-muted">Ethereum <small <?= $useEth; ?> id="useEth">in Use</small> <span <?= $slctEth; ?> id="slctEth"><<a href="javascript:void(0)">Select</a>></span></span><span>ETH <?= $eth; ?></span></div>
                        </div>
                    </div>
                </div>