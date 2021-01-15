<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ForgotPass extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model("UserModel");
    
  }

  public function index()
  {
    
    $this->load->view('users/ForgotPass');
    
  }

  public function ProcessForgot()
  {
    $user = $this->input->post("user");
    $pin = $this->input->post("pin");

    $this->db->where(["username"=>$user,"security_pin"=>$pin]);
    $get = $this->db->get("users");
    $getNum = $get->num_rows();
    $row = $get->row();
    if($getNum > 0)
    {
      echo "ok";
    }
    else
    {
      
      echo "inv";

    }
  }
  public function ProcessReset()
  {
    $user = $this->input->post("user");
    $pin = $this->input->post("pin");
    $pass = $this->input->post("pass");
    $ps = password_hash($pass, PASSWORD_DEFAULT);

    $this->db->where(["username"=>$user,"security_pin"=>$pin]);
    $this->db->update("users",["password"=>$ps]);
    echo "ok";
  }
}