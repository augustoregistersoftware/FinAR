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
		$this->session->sess_destroy();

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
		$validate_permission = $this->login_model->auth_permission($email,$senha);

		$name = $validate_permission['nome'];
		$usuario = $validate_permission['usuario'];
		$cliente = $validate_permission['cliente'];
		$produto = $validate_permission['produto'];
		$fornecedor = $validate_permission['fornecedor'];
		$localizacao = $validate_permission['localizacao'];
		$financeiro = $validate_permission['financeiro'];
		$empresa = $validate_permission['empresa'];
		$validade_count = count($validate);

		if ($validade_count > 0){
			$this->cookies($name,$usuario,$cliente,$produto,$fornecedor,$localizacao,$financeiro,$empresa);
		}else{
			$this->session->set_flashdata('warning','Acesso Negado!');
			redirect("login");
		}
	}

	public function cookies($name,$usuario,$cliente,$produto,$fornecedor,$localizacao,$financeiro,$empresa)
	{
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

			$this->session($name,$usuario,$cliente,$produto,$fornecedor,$localizacao,$financeiro,$empresa);
	}

	public function session($name,$usuario,$cliente,$produto,$fornecedor,$localizacao,$financeiro,$empresa)
	{
		$this->session->set_userdata('name',$name);
		$this->session->set_userdata('user',$usuario);
		$this->session->set_userdata('client',$cliente);
		$this->session->set_userdata('product',$produto);
		$this->session->set_userdata('supplier',$fornecedor);
		$this->session->set_userdata('location',$localizacao);
		$this->session->set_userdata('financial',$financeiro);
		$this->session->set_userdata('company',$empresa);
		$this->session->set_userdata('log','logged');
		$this->session->set_flashdata('suc','Login Efetuado!');
		redirect("dashboard?aviso=sucesso");
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
