<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fornecedor extends CI_Controller {

	//Função Construct para trazer o carregamento da modal
    public function __construct()
    {
		parent::__construct();
		$this->load->model("fornecedor_model");
    }

	public function index()
	{
		$data["fornecedor"] =  $this->fornecedor_model->index();
		$data["empresa_fornecedor"] =  $this->fornecedor_model->select_empresas();
		$data["title"] = "Fornecedor - FinAR";

		$this->load->view('templates/header',$data);
		$this->load->view('templates/nav-top',$data);
		$this->load->view('pages/fornecedor',$data);
	}

    public function fornecedor_empresa($id)
	{
		$data["fornecedor"] =  $this->fornecedor_model->select_fornecedor_por_empresa($id);
		$data["empresa_fornecedor"] =  $this->fornecedor_model->select_empresas();
		$data["title"] = "Fornecedor - FinAR";

		$this->load->view('templates/header',$data);
		$this->load->view('templates/nav-top',$data);
		$this->load->view('pages/fornecedor',$data);
	}

	public function obter_dados() {
		$idDoFornecedor = $this->input->get('idDoFornecedor');
        $dados = $this->fornecedor_model->obter_dados($idDoFornecedor);
        echo json_encode($dados);
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

	public function documentos($id)
	{
		$data["documentos"] =  $this->fornecedor_model->select_documentos($id);
		$data["title"] = "Documentos Fornecedor - FinAR";

		$this->load->view('templates/header',$data);
		$this->load->view('templates/nav-top',$data);
		$this->load->view('pages/documentos_fornecedor',$data);
		$this->load->view('templates/footer',$data);
		$this->load->view('templates/js',$data);
	}

	public function new_documentos()
	{
		$data["fornecedor"] =  $this->fornecedor_model->index();
		$data["title"] = "Cadastro De Documentos Fornecedor - FinAR";

		$this->load->view('templates/header',$data);
		$this->load->view('templates/nav-top',$data);
		$this->load->view('pages/cadastro_documento_fornecedor',$data);
		$this->load->view('templates/footer',$data);
		$this->load->view('templates/js',$data);
	}

	public function inserte_documentos()
	{
        $fornecedor["nome"] = $_POST["nome_documento"];
        $fornecedor["id_fornecedor"] = $_POST["fornecedor"];
        $arquivo_pdf = $_FILES['file'];
        $fornecedor["arquivo"] = file_get_contents($arquivo_pdf['tmp_name']);
		$this->fornecedor_model->inserte_documentos($fornecedor);

		redirect("fornecedor");
	}

	public function abir_documento($id)
    {
        $result_arquivo = $this->fornecedor_model->select_arquivo($id);
    
        if ($result_arquivo) {
            extract($result_arquivo);
            header("Content-Type: application/pdf");
            echo $result_arquivo["arquivo"];
        } else {
            echo "Arquivo não encontrado.";
        }
    }

    public function ativa($id)
	{
        $fornecedor_info['status'] = "T";
		$this->fornecedor_model->update_fornecedor_ativa($id,$fornecedor_info);

		redirect("fornecedor");
	}

    public function inativa($id)
	{
        $fornecedor_info['status'] = "F";
		$this->fornecedor_model->update_fornecedor_inativa($id,$fornecedor_info);

		redirect("fornecedor");
	}

    public function update($id)
	{
        $empresa_info = $_POST;
		$this->empresa_model->update_empresa($id,$empresa_info);

		redirect("empresa");
	}

}
