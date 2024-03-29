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
		$data["fornecedor_editar"] =  $this->fornecedor_model->select_editar($id);
		$data["title"] = "Editar Fornecedor - FinAR";

		$this->load->view('templates/header',$data);
		$this->load->view('templates/nav-top',$data);
		$this->load->view('pages/cadastro_fornecedor',$data);
        $this->load->view('templates/footer',$data);
		$this->load->view('templates/js',$data);
	}

    public function new()
	{
		$data["title"] = "Cadastrar Fornecedor - FinAR";
		$data["empresa"] =  $this->fornecedor_model->select_empresas();

		$this->load->view('templates/header',$data);
		$this->load->view('templates/nav-top',$data);
		$this->load->view('pages/cadastro_fornecedor',$data);
        $this->load->view('templates/footer',$data);
		$this->load->view('templates/js',$data);
	}

    public function inserte()
	{
        $fornecedor_info["nome"] = $_POST["nome_fornecedor"];
        $fornecedor_info["cnpj"] = $_POST["cnpj"];
        $fornecedor_info["cep"] = $_POST["cep"];
        $fornecedor_info["endereco"] = $_POST["endereco"];
        $fornecedor_info["bairro"] = $_POST["bairro"];
        $fornecedor_info["complemento"] = $_POST["complemento"];
        $fornecedor_info["cidade"] = $_POST["cidade"];
        $fornecedor_info["numero"] = $_POST["numero"];
        $fornecedor_info["ie"] = $_POST["ie"];
        $fornecedor_info["telefone"] = $_POST["telefone"];
        $fornecedor_info["email"] = $_POST["email"];
        $fornecedor_info["id_empresa"] = $_POST["empresa"];
        $fornecedor_info["status"] = "T";
		$this->fornecedor_model->inserte_fornecedor($fornecedor_info);

		redirect("fornecedor?aviso=sucess");
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

	public function delete_documento($id)
	{
		$this->fornecedor_model->delete_documento($id);

		redirect("fornecedor");
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
        $fornecedor_info["nome"] = $_POST["nome_fornecedor"];
        $fornecedor_info["cnpj"] = $_POST["cnpj"];
        $fornecedor_info["cep"] = $_POST["cep"];
        $fornecedor_info["endereco"] = $_POST["endereco"];
        $fornecedor_info["bairro"] = $_POST["bairro"];
        $fornecedor_info["complemento"] = $_POST["complemento"];
        $fornecedor_info["cidade"] = $_POST["cidade"];
        $fornecedor_info["numero"] = $_POST["numero"];
        $fornecedor_info["ie"] = $_POST["ie"];
        $fornecedor_info["telefone"] = $_POST["telefone"];
        $fornecedor_info["email"] = $_POST["email"];
		$this->fornecedor_model->update_fornecedor($id,$fornecedor_info);

		redirect("fornecedor?aviso=updt");
	}

}
