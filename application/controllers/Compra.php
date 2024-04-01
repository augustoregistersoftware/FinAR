<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compra extends CI_Controller {
	

	//Função Construct para trazer o carregamento da modal
    public function __construct()
    {
		parent::__construct();
		$this->load->model("compra_model");
		$this->load->model("fornecedor_model");
		$this->load->model("produtos_model");
    }

	public function index()
	{
		$data["compra"] =  $this->compra_model->index();
		$data["atrasado"] =  $this->compra_model->select_qtdd_atrasado();
		$data["title"] = "Compra - FinAR";

		$this->load->view('templates/header',$data);
		$this->load->view('templates/nav-top',$data);
		$this->load->view('pages/compra',$data);
	}

	public function obter_dados() {
		$idDoPedido = $this->input->get('idDoPedido');
        $dados = $this->compra_model->select_dados_produto($idDoPedido);
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

    public function inserte_compra_documentacao()
	{

        $compra_info["descricao"] = $_POST['descricao'];
        $compra_info["data_pedido"] = $_POST['data_pedido'];
        $compra_info["data_entrega"] = $_POST['data_entrega'];
        $compra_info["id_fornecedor"] = $_POST['fornecedor'];
		$compra_info["status"] = "F";
		$arquivo_pdf = $_FILES['file'];
        
		$produto_info['title'] = "Escolhas De Produto - FinAR";
        $produto_info["produto"] = $this->produtos_model->select_produto_por_empresa_sem_id();
        $produto_info["produto"] = $this->produtos_model->select_produto_por_empresa_sem_id();

		$ultimo_id = $this->compra_model->inserte_compra_documentacao($compra_info);
		$compra_arquivo["arquivo"] = file_get_contents($arquivo_pdf['tmp_name']);
        $compra_arquivo["id_compra"] = $ultimo_id;
		$this->compra_model->inserte_compra_documento($compra_arquivo);
		$this->montagem_produtos($produto_info);
	}

	public function inserte_compra_produto()
	{
		$compra_produto["id_produto"] = $_POST['id_produto'];
		$compra_produto["quantidade"] = $_POST['quantidade'];
		$ultimo_id = $this->compra_model->ultimo_id_select();
		$valor_id = $ultimo_id['id_solicitacao'];
		define('ID', $valor_id); // Note que alterei 'id' para 'ID' para seguir as convenções de nomenclatura de constantes em maiúsculas
		$compra_produto["id_pedido"] = ID; // Aqui você usa a constante corretamente
		$produto_info['title'] = "Escolhas De Produto - FinAR";
		$produto_info["produto"] = $this->produtos_model->select_produto_por_empresa_sem_id();
		
		$this->compra_model->inserte_compra_produto($compra_produto);
		$this->montagem_produtos($produto_info);
		
	}

	public function montagem_produtos($produto_info)
	{
		$this->load->view('templates/header',$produto_info);
		$this->load->view('templates/nav-top',$produto_info);
		$this->load->view('pages/cadastro_de_compra_produto',$produto_info);
		$this->load->view('templates/footer',$produto_info);
		$this->load->view('templates/js',$produto_info);
	}

	public function finaliza()
	{
		$produtos_compra['title'] = "Produtos Da Compra - FinAR";
		$ultimo_id = $this->compra_model->ultimo_id_select();
		$id = $ultimo_id['id_solicitacao'];
		define('ID',$id);
		$produtos_compra['produtos_compra'] = $this->compra_model->select_produtos_compra(ID);
		$produtos_compra['produtos_compra_subtotal'] = $this->compra_model->subtotal(ID);
		$produtos_compra['forma_pagto'] = $this->compra_model->select_formas_pagto();

		$this->load->view('templates/header',$produtos_compra);
		$this->load->view('templates/nav-top',$produtos_compra);
		$this->load->view('pages/finalizar_compra',$produtos_compra);
		$this->load->view('templates/footer',$produtos_compra);
		$this->load->view('templates/js',$produtos_compra);
	}

	public function encerrar()
	{
		$ultimo_id = $this->compra_model->ultimo_id_select();
		$id = $ultimo_id['id_solicitacao'];
		define('ID',$id);
		$pagamento = $_POST['pagamento'];
		$subtotal = $_POST['subtotal'];

		$this->compra_model->encerrar(ID,$pagamento,$subtotal);
		redirect('compra');
	}

	public function remover_item($id)
	{
		$ultimo_id = $this->compra_model->ultimo_id_select();
		$id_pedido = $ultimo_id['id_solicitacao'];
		define('ID',$id_pedido);

		$this->compra_model->remover_item($id,ID);
		$this->finaliza();
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

	public function new_compra()
	{
		$data["fornecedor"] =  $this->fornecedor_model->index();
		$data["title"] = "Cadastro De Compra - FinAR";

		$this->load->view('templates/header',$data);
		$this->load->view('templates/nav-top',$data);
		$this->load->view('pages/cadastro_de_compra_documentacao',$data);
		$this->load->view('templates/footer',$data);
		$this->load->view('templates/js',$data);
	}


	public function fechar($id)
	{
        $status["status"] = "T";
		$dados_produto = $this->compra_model->select_qtd_id_produto($id);
		$qtde['estoque_atual'] = $dados_produto['quantidade'];
		$id_produto = $dados_produto['id_produto'];

		$this->compra_model->update_pedido_fecha($id,$status);
		$this->compra_model->updt_estoque_produto($id_produto,$qtde);

		redirect("compra");
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

		redirect("fornecedor");
	}

}
