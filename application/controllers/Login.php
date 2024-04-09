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

		$this->output->cache(1440);
		$this->load->view('pages/login',$data);
	}

    public function password()
	{
		#$data["login"] =  $this->empresa_model->index();
		$data["title"] = "Login - FinAR";

		$this->load->view('pages/esqueceu_senha',$data);
	}

	public function auth()
	{
		$email = $this->input->post('username');
		$senha = $this->input->post('password');

		$validate = $this->login_model->auth($email,$senha);
		$validade_count = count($validate);

		if ($validade_count > 0){
			$username = $this->input->post('username');
			$this->load->helper('cookie');
			$username_cookie = array(
				'name'   => 'username',
				'value'  => $username,
				'expire' => '3600', 
				'path'   => '/'
			);

			$checked = $this->input->post('remember_me');
			$this->load->helper('cookie');
			$checked_cookie = array(
				'name'   => 'checked',
				'value'  => $checked,
				'expire' => '3600', 
				'path'   => '/'
			);
			$this->input->set_cookie($username_cookie);
			$this->input->set_cookie($checked_cookie);
			redirect("dashboard");
		}else{
			redirect("login");
		}


	}

	public function esqueceu_senha()
	{
		#$apelido = $_POST['username'];
		#$email = $_POST['cmail'];

		#mais seguro contra xss
		$apelido = $this->input->post('username'); 
		$email = $this->input->post('cmail'); 
		$subject = 'RECUPERAÇÃO DA SENHA';


		$senhaa = $this->login_model->senha($email,$apelido);
		$senha = $senhaa['senha'];
		$this->login_model->enviarEmail($email,$subject,$senha);
		redirect('login');
	}


}
