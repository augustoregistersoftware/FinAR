<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro_login extends CI_Controller {

	//Função Construct para trazer o carregamento da modal
    public function __construct()
    {
		parent::__construct();
		$this->load->model("cadastro_login_model");
    }

	public function index()
	{
		if($this->session->userdata('log')!="logged"){
			redirect('login');
		}else{
			$this->load_page();
		}
	}

	public function load_page()
	{
		$data["cadastro_login"] =  $this->cadastro_login_model->index();
		$data["title"] = "Cadastro De Login - FinAR";

		if($this->session->userdata('user')!="T"){
			$this->load->view('templates/header',$data);
			$this->load->view('templates/nav-top',$data);
			$this->load->view('pages/pagina_bloqueio',$data);
		}else{
			$this->load->view('templates/header',$data);
			$this->load->view('templates/nav-top',$data);
			$this->load->view('js/script_cadastro_login');
			$this->load->view('pages/cadastro_login',$data);
		}
		
	}

	public function obter_dados() {
		$idDoLogin = $this->input->get('idDoLogin');
        $dados = $this->cadastro_login_model->select_perfil($idDoLogin);
        echo json_encode($dados);
    }

    public function obter_senha()
	{
		$senha_para_crip = 'bNzLsJB3/H$dasrg654fg';
		$idDoLogin = $this->input->get('id_login');
		$dados =  $this->cadastro_login_model->select_senha($idDoLogin);
		$dados_descrypt = openssl_decrypt($dados,"AES-128-ECB",$senha_para_crip);
		echo json_encode($dados_descrypt);
	}

    
    public function editar($id)
	{
		$data["localizacao_editar"] =  $this->localizacao_model->select_editar($id);
		$data['empresa'] = $this->localizacao_model->select_empresas();
		$data["title"] = "Editar Localizacao - FinAR";

		$this->load->view('templates/header',$data);
		$this->load->view('templates/nav-top',$data);
		$this->load->view('pages/cadastro_localizacao',$data);
        $this->load->view('templates/footer',$data);
		$this->load->view('templates/js',$data);
	}

    public function new_login()
	{	
		$data['perfil'] = $this->cadastro_login_model->select_perfil_cadastro();
		$data['empresas'] = $this->cadastro_login_model->select_empresa_cadastro();

		$data["title"] = "Cadastrar Login - FinAR";

		$this->load->view('templates/header',$data);
		$this->load->view('templates/nav-top',$data);
		$this->load->view('js/script_cadastrar_login');
		$this->load->view('pages/cadastrar_login',$data);
        $this->load->view('templates/footer',$data);
		$this->load->view('templates/js',$data);
	}


    public function inserte()
	{
		$senha_para_crip = 'bNzLsJB3/H$dasrg654fg';
        $login_info["nome"] = $this->input->post('nome');
        $login_info["email"] = $this->input->post('email');
		$login_info["senha"] = openssl_encrypt($this->input->post('senha_confirma'), "AES-128-ECB", $senha_para_crip);
        $login_info["id_perfil"] = $this->input->post('perfil');
        $login_info["id_empresa"] = $this->input->post('empresa');
		$this->cadastro_login_model->inserte_login($login_info);

		redirect("cadastro_login?aviso=sucesso");
	}


    public function inativa($id)
	{
        $localizacao_info['status'] = "F";
		$this->localizacao_model->update_localizacao_inativa($id,$localizacao_info);

		redirect("localizacao");
	}

    public function update($id)
	{
        $localizacao_info['nome'] = $_POST['nome_loc'];
		$localizacao_info['id_empresa'] = $_POST['empresa'];
		$this->localizacao_model->update_localizacao($id,$localizacao_info);

		redirect("localizacao");
	}

}
