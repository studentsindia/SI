<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url','html'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->model('user_model');
	}
	public function index()
	{
		$this->load->view('login/index');
	}
	public function auth()
	{
		$resheight = $this->input->post("resheight");
		$username = $this->input->post("username");
        $password = $this->input->post("password");
		$uresult = $this->user_model->get_user($username, $password);
		if (count($uresult) > 0)
		{
			//$umenu= $this->user_model->get_menu($uresult[0]->id);

			$sess_data = array('login' => TRUE, 'resheight' => $resheight,'uname' => $uresult[0]->username,'name' => $uresult[0]->name,'photo' => $uresult[0]->photo,'designation' => $uresult[0]->designation,'mobile' => $uresult[0]->mobile,'whatsapp' => $uresult[0]->whatsapp, 'uid' => $uresult[0]->id,'staffid' => $uresult[0]->staff_id,'role' => $uresult[0]->role,'stdid' => $uresult[0]->staff_key);
				$this->session->set_userdata($sess_data);

			

			redirect("administ/");
				
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                Wrong Username or Password!<br /> Please try again.
              </div>');
			redirect('login/index');
		}
		
		
	}
	function logout()
	{
		$user_data = $this->session->all_userdata();
	    $this->session->sess_destroy();
	    redirect('login');
	}
	
}?>
