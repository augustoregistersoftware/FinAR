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
        $produto_info["produto"] = $this->produtos_model->select_produto_por_empresa_sem_id_ativo();
        $produto_info["produto"] = $this->produtos_model->select_produto_por_empresa_sem_id_ativo();

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
		$produto_info["produto"] = $this->produtos_model->select_produto_por_empresa_sem_id_ativo();
		
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
		define('IDDDD',$id);
		$produtos_compra['produtos_compra'] = $this->compra_model->select_produtos_compra(IDDDD);
		$produtos_compra['produtos_compra_subtotal'] = $this->compra_model->subtotal(IDDDD);
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
		define('IDDD',$id);
		$pagamento = $_POST['pagamento'];
		$subtotal = $_POST['subtotal'];

		$this->compra_model->encerrar(IDDD,$pagamento,$subtotal);
		redirect('compra');
	}

	public function encerrar_fechar($id)
	{
		$id_pedido = $id;
		$id_produto = $_POST['produto'];
		$qtde_recebida = $_POST['qtde_recebida'];

		$this->compra_model->updt_recebido_produto($id_pedido,$id_produto,$qtde_recebida);
		$this->compra_model->updt_estoque_produto($id_produto,$qtde_recebida);
		$this->fechar($id_pedido);
	}

	public function end($id)
	{
		$idd = $id;
		$status['status'] = 'T';
		$this->compra_model->update_pedido_fecha($idd,$status);

		redirect("compra");
	}

	public function remover_item($id)
	{
		$ultimo_id = $this->compra_model->ultimo_id_select();
		$id_pedido = $ultimo_id['id_solicitacao'];
		define('IDD',$id_pedido);

		$this->compra_model->remover_item($id,IDD);
		$this->finaliza();
	}

	public function documentos($id)
	{
		$data["documentos"] =  $this->compra_model->select_todos_arquivos($id);
		$data["title"] = "Documentos Compra - FinAR";

		$this->load->view('templates/header',$data);
		$this->load->view('templates/nav-top',$data);
		$this->load->view('pages/documentos_compra',$data);
		$this->load->view('templates/footer',$data);
		$this->load->view('templates/js',$data);
	}

	public function delete_documento($id)
	{
		$this->compra_model->delete_documento($id);

		redirect("compra");
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
        $data["title"] = "Finalizar Pedido - FinAR";
		$data["produtos"] = $this->compra_model->select_produtos_compra($id);
		$data["produtos_condicao"] = $this->compra_model->select_produtos_compra_condicao($id);
		$data["id_pedido"] = $id;

		$this->load->view('templates/header',$data);
		$this->load->view('templates/nav-top',$data);
		$this->load->view('pages/fechar_compra',$data);
		$this->load->view('templates/footer',$data);
		$this->load->view('templates/js',$data);
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

	public function cancela($id)
	{
		$result_select = $this->compra_model->select_cancela($id);
		$num_result_select = count($result_select);
		$num_result_select_ = $num_result_select - 1;
		#echo $result_select['id_produto'];
		echo $num_result_select;
		if ($result_select) {
			for ($i = 0; $i < $num_result_select; $i++) { // Começa do índice 0
				$id_pedido = $id;
				$id_produto = $result_select[$i]['id_produto'];
				$quantidade_recebida = $result_select[$i]['quantidade_recebida'];
		
				$this->compra_model->update_cancela($quantidade_recebida, $id_produto);
			}
			$status = "C";
			$this->compra_model->update_cancela_status($status, $id);
		}
		redirect("compra");
	}
}
