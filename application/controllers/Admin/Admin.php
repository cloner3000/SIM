<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('M_admin');

		if (!$this->session->userdata('isLoggedIn')){
			$this->load->view('v_redirect_login');
			return;
		}
	}
	
	public function index(){
		$data['admin']=$this->M_admin->select_all();
		$this->load->view('admin/v_admin', $data);

	}
}
