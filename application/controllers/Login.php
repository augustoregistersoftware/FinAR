<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	//Função Construct para trazer o carregamento da modal
    public function __construct()
    {
		parent::__construct();
		$this->load->model("login_model");
    }

	public function index()
	{
		#$data["login"] =  $this->empresa_model->index();
		$data["title"] = "Login - FinAR";

		$this->load->view('pages/login',$data);
	}

    public function password()
	{
		#$data["login"] =  $this->empresa_model->index();
		$data["title"] = "Login - FinAR";

		$this->load->view('pages/esqueceu_senha',$data);
	}


}
