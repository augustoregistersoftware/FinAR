<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empresa extends CI_Controller {

	//Função Construct para trazer o carregamento da modal
    public function __construct()
    {
		parent::__construct();
		$this->load->model("empresa_model");
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
		$data["empresa"] =  $this->empresa_model->index();
		$data["title"] = "Empresa - FinAR";

		if($this->session->userdata('company')!="T"){
			$this->load->view('templates/header',$data);
			$this->load->view('templates/navbar',$data);
			$this->load->view('templates/sidebarsettings');
			$this->load->view('pages/pagina_bloqueio',$data);
			$this->load->view('templates/footer');
		}else{
			$this->load->view('templates/header',$data);
			$this->load->view('templates/nav-top',$data);
			$this->load->view('pages/empresa',$data);
		}
	}

    public function editar($id)
	{
		$data["empresa_editar"] =  $this->empresa_model->select_editar($id);
		$data["title"] = "Editar Empresa - FinAR";

		$this->load->view('templates/header',$data);
		$this->load->view('templates/nav-top',$data);
		$this->load->view('pages/cadastro_empresa',$data);
        $this->load->view('templates/footer',$data);
		$this->load->view('templates/js',$data);
	}

    public function new()
	{
		$data["title"] = "Cadastrar Empresa - FinAR";

		$this->load->view('templates/header',$data);
		$this->load->view('templates/nav-top',$data);
		$this->load->view('pages/cadastro_empresa',$data);
        $this->load->view('templates/footer',$data);
		$this->load->view('templates/js',$data);
	}

    public function inserte()
	{
        $empresa_info["razao_social"] = $_POST["razao_social"];
        $empresa_info["nome_fantasia"] = $_POST["nome_fantasia"];
        $empresa_info["cnpj"] = $_POST["cnpj"];
        $empresa_info["cep"] = $_POST["cep"];
        $empresa_info["endereco"] = $_POST["endereco"];
        $empresa_info["numero"] = $_POST["numero"];
        $empresa_info["bairro"] = $_POST["bairro"];
        $empresa_info["complemento"] = $_POST["complemento"];
        $empresa_info["cidade"] = $_POST["cidade"];
        $empresa_info["uf"] = $_POST["uf"];
        $empresa_info["telefone"] = $_POST["telefone"];
        $empresa_info["situacao"] = "T";
		$this->empresa_model->inserte_empresa($empresa_info);

		redirect("empresa");
	}

    public function ativa($id)
	{
        $empresa_info['situacao'] = "T";
		$this->empresa_model->update_empresa_ativa($id,$empresa_info);

		redirect("empresa");
	}

    public function inativa($id)
	{
        $empresa_info['situacao'] = "F";
		$this->empresa_model->update_empresa_inativa($id,$empresa_info);

		redirect("empresa");
	}

    public function update($id)
	{
        $empresa_info = $_POST;
		$this->empresa_model->update_empresa($id,$empresa_info);

		redirect("empresa");
	}

}