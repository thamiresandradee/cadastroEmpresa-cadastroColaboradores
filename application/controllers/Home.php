<?php

defined('BASEPATH') or exit('Ação não permitida');

class Home extends CI_Controller{

	public function __construct(){

		parent::__construct();

	}

	public function index(){

		$data = array(
			'titulo'   	=> 'W2O - PROJETO',
		);

		$this->load->view('layout/header', $data);
		$this->load->view('home/index.php');
		$this->load->view('layout/footer.php');

	}

}