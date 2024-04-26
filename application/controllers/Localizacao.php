<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Localizacao extends CI_Controller {

	//Função Construct para trazer o carregamento da modal
    public function __construct()
    {
		parent::__construct();
		$this->load->model("localizacao_model");
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
		$data["localizacao"] =  $this->localizacao_model->index();
		$data["title"] = "Localização - FinAR";

		if($this->session->userdata('location')!="T"){
			$this->load->view('templates/header',$data);
			$this->load->view('templates/nav-top',$data);
			$this->load->view('pages/pagina_bloqueio',$data);
		}else{
			$this->load->view('templates/header',$data);
			$this->load->view('templates/navbar',$data);
			$this->load->view('templates/sidebarsettings');
			$this->load->view('pages/localizacao',$data);
			$this->load->view('templates/footer');
		}
		
	}

    public function documentos($id)
	{
		$data["documentos"] =  $this->localizacao_model->select_documentos($id);
		$data["title"] = "Documentos Localização - FinAR";

		$this->load->view('templates/header',$data);
		$this->load->view('templates/navbar',$data);
		$this->load->view('templates/sidebarsettings');
		$this->load->view('pages/documentos_localizacao',$data);
		$this->load->view('templates/footer');
	}

    public function new_documentos()
    {
        $data["documentos_localizacao"] =  $this->localizacao_model->index();
		$data["title"] = "Cadastro Localização - FinAR";

		$this->load->view('templates/header',$data);
		$this->load->view('templates/navbar',$data);
		$this->load->view('templates/sidebarsettings');
		$this->load->view('pages/cadastro_documento_localizacao',$data);
		$this->load->view('templates/footer');
    }
    
    public function abir_documento($id)
    {
        $result_arquivo = $this->localizacao_model->select_arquivo($id);
    
        if ($result_arquivo) {
            extract($result_arquivo);
            header("Content-Type: application/pdf");
            echo $result_arquivo["arquivo"];
        } else {
            echo "Arquivo não encontrado.";
        }
    }

	public function delete_documento($id)
	{
		$this->localizacao_model->delete_documento($id);

		redirect("localizacao");
	}
    
    public function editar($id)
	{
		$data["localizacao_editar"] =  $this->localizacao_model->select_editar($id);
		$data['empresa'] = $this->localizacao_model->select_empresas();
		$data["title"] = "Editar Localizacao - FinAR";
		
		$this->load->view('templates/header',$data);
		$this->load->view('templates/navbar',$data);
		$this->load->view('templates/sidebarsettings');
		$this->load->view('pages/cadastro_localizacao',$data);
		$this->load->view('templates/footer');
	}

    public function new()
	{	
		$data['empresa'] = $this->localizacao_model->select_empresas();
		$data["title"] = "Cadastrar Localização - FinAR";

		$this->load->view('templates/header',$data);
		$this->load->view('templates/navbar',$data);
		$this->load->view('templates/sidebarsettings');
		$this->load->view('pages/cadastro_localizacao',$data);
		$this->load->view('templates/footer');
	}

    public function inserte_documentos()
	{
        $localizacao["nome_documento"] = $_POST["nome_documento"];
        $localizacao["id_localizacao"] = $_POST["localizacao"];
        $arquivo_pdf = $_FILES['file'];
        $localizacao["arquivo"] = file_get_contents($arquivo_pdf['tmp_name']);
		$this->localizacao_model->inserte_documentos($localizacao);

		redirect("localizacao");
	}

    public function inserte()
	{
        $localizacao_info["nome"] = $_POST["nome_loc"];
        $localizacao_info["id_empresa"] = $_POST["empresa"];
        $localizacao_info["status"] = "T";
		$this->localizacao_model->inserte_localizacao($localizacao_info);

		redirect("localizacao");
	}

    public function ativa($id)
	{
        $localizacao_info['status'] = "T";
		$this->localizacao_model->update_localizacao_ativa($id,$localizacao_info);

		redirect("localizacao");
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