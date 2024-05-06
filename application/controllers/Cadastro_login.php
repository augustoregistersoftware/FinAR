<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro_login extends CI_Controller {

	//Função Construct para trazer o carregamento da modal
    public function __construct()
    {
		parent::__construct();
		$this->load->model("cadastro_login_model");
		$this->load->model("produtos_model");
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
			$this->load->view('templates/navbar',$data);
			$this->load->view('templates/sidebarsettings');
			$this->load->view('pages/pagina_bloqueio',$data);
			$this->load->view('templates/footer');
		}else{
			$this->load->view('templates/header',$data);
			$this->load->view('templates/navbar',$data);
			$this->load->view('templates/sidebarsettings');
			$this->load->view('js/script_cadastro_login');
			$this->load->view('pages/cadastro_login',$data);
			$this->load->view('templates/footer');
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
		$dados_decrypt = openssl_decrypt($dados['senha'],"AES-128-ECB",$senha_para_crip);
		echo json_encode(array('senha' => $dados_decrypt));
	}

    
    public function editar($id)
	{

		$data["login_editar"] =  $this->cadastro_login_model->select_editar($id);
		$data["title"] = "Editar Login - FinAR";

		$this->load->view('templates/header',$data);
		$this->load->view('templates/navbar',$data);
		$this->load->view('templates/sidebarsettings');
		$this->load->view('js/script_cadastrar_login');
		$this->load->view('pages/cadastrar_login',$data);
		$this->load->view('templates/footer');
	}

    public function new_login()
	{	
		$data['perfil'] = $this->cadastro_login_model->select_perfil_cadastro();
		$data['empresas'] = $this->cadastro_login_model->select_empresa_cadastro();

		$data["title"] = "Cadastrar Login - FinAR";

		$this->load->view('templates/header',$data);
		$this->load->view('templates/navbar',$data);
		$this->load->view('templates/sidebarsettings');
		$this->load->view('js/script_cadastrar_login');
		$this->load->view('pages/cadastrar_login',$data);
		$this->load->view('templates/footer');

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


    public function deletar($id)
	{
		$this->cadastro_login_model->deleta($id);

		redirect("cadastro_login?aviso=delete");
	}

    public function update($id)
	{
		$senha_para_crip = 'bNzLsJB3/H$dasrg654fg';
        $cadastro_login_info['nome'] = $this->input->post('nome');
		$cadastro_login_info['email'] = $this->input->post('email');
		$cadastro_login_info['senha'] = openssl_encrypt($this->input->post('senha'), "AES-128-ECB", $senha_para_crip);
		$this->cadastro_login_model->update_login($id,$cadastro_login_info);

		redirect("cadastro_login?aviso=updt");
	}

	public function form_update_empresa($id)
	{
		$data["login_empresa_editar"] =  $this->cadastro_login_model->select_form_edit_empresa($id);
		$data["empresa"] =  $this->produtos_model->select_empresas();

		$this->load->view('templates/header',$data);
		$this->load->view('templates/navbar',$data);
		$this->load->view('templates/sidebarsettings');
		$this->load->view('pages/atualizacao_login_empresa',$data);
		$this->load->view('templates/footer');
	}

	public function form_update_perfil($id)
	{
		$data["login_perfil_editar"] =  $this->cadastro_login_model->select_form_edit_perfil($id);
		$data["perfil"] =  $this->cadastro_login_model->select_perfil_cadastro_row();

		$this->load->view('templates/header',$data);
		$this->load->view('templates/navbar',$data);
		$this->load->view('templates/sidebarsettings');
		$this->load->view('pages/atualizacao_login_perfil',$data);
		$this->load->view('templates/footer');
	}

	public function update_empresa($id)
	{
		$cadastro_login_info['id_empresa'] = $this->input->post('empresa');
		$this->cadastro_login_model->update_empresa($id,$cadastro_login_info);

		redirect("cadastro_login?aviso=updt_empresa");
	}

}
