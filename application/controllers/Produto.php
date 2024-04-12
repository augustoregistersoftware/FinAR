<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produto extends CI_Controller {

	//Função Construct para trazer o carregamento da modal
    public function __construct()
    {
		parent::__construct();
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
		$data["produtos"] =  $this->produtos_model->index();
		$data["empresa_produtos"] =  $this->produtos_model->select_empresas();
		$data["title"] = "Produtos - FinAR";

		if($this->session->userdata('product')!="T"){
			$this->load->view('templates/header',$data);
			$this->load->view('templates/nav-top',$data);
			$this->load->view('pages/pagina_bloqueio',$data);
		}else{
			$this->load->view('templates/header',$data);
			$this->load->view('templates/nav-top',$data);
			$this->load->view('js/script_produto');
			$this->load->view('pages/produtos',$data);
		}

	
	}

	public function obter_dados() {
		$idDoProduto = $this->input->get('idDoProduto');
        $dados = $this->produtos_model->select_pedido_compra($idDoProduto);
        echo json_encode($dados);
    }

    public function produto_empresa($id)
	{
		$data["produtos"] =  $this->produtos_model->select_produto_por_empresa($id);
		$data["empresa_produtos"] =  $this->produtos_model->select_empresas();
		$data["title"] = "Produtos - FinAR";

		$this->load->view('templates/header',$data);
		$this->load->view('templates/nav-top',$data);
		$this->load->view('pages/produtos',$data);
	}

    public function new_produto()
	{
		$data["empresas"] =  $this->produtos_model->select_empresas();
		$data["fornecedor"] =  $this->produtos_model->select_fornecedor();
		$data["localizacao"] =  $this->produtos_model->select_localizacao();
		$data["title"] = "Cadastro De Produtos - FinAR";

		$this->load->view('templates/header',$data);
		$this->load->view('templates/nav-top',$data);
		$this->load->view('pages/cadastro_produto',$data);
        $this->load->view('templates/footer',$data);
		$this->load->view('templates/js',$data);
	}

	public function new_foto()
	{
		$data["empresas_produto"] =  $this->produtos_model->select_produto_por_empresa_sem_id();
		$data["title"] = "Cadastro De Fotos Produtos - FinAR";

		$this->load->view('templates/header',$data);
		$this->load->view('templates/nav-top',$data);
		$this->load->view('pages/cadastro_foto_produto',$data);
        $this->load->view('templates/footer',$data);
		$this->load->view('templates/js',$data);
	}

	public function fotos_produto($id)
	{
		$data["fotos"] =  $this->produtos_model->select_fotos_produto($id);
		$data["title"] = "Cadastro De Fotos De Produtos - FinAR";

		$this->load->view('templates/header',$data);
		$this->load->view('templates/nav-top',$data);
		$this->load->view('pages/fotos_produto',$data);
		$this->load->view('templates/footer',$data);
		$this->load->view('templates/js',$data);
	}


	public function historico_produto($id)
	{
		$data["historico"] =  $this->produtos_model->select_historico($id);
		$data["title"] = "Historico De Produtos - FinAR";

		$this->load->view('templates/header',$data);
		$this->load->view('templates/nav-top',$data);
		$this->load->view('pages/historico_produto',$data);
		$this->load->view('templates/footer',$data);
		$this->load->view('templates/js',$data);
	}


	public function inserte()
	{
		$data["descricao"] = $_POST['descricao'];
		$data["cod_barras"] = $_POST['cod_barra'];
		$data["cod_aux"] = $_POST['cod_aux'];
		$data["custo"] = $_POST['custo'];
		$data["preco_venda"] = $_POST['preco_venda'];
		$data["estoque_minimo"] = $_POST['estoque_minimo'];
		$data["estoque_atual"] = $_POST['estoque_atual'];
		$data["id_localizacao"] = $_POST['localizacao'];
		$data["id_fornecedor"] = $_POST['fornecedor'];
		$data["id_empresa"] = $_POST['empresa'];
		$data["status"] = "T";
		$data_foto["nome"] = $_POST['nome_foto'];
		$data_foto['arquivo'] = $_FILES['file']['name'];
       
		$this->produtos_model->inserte($data);
		$data_foto["id_produto"] = $this->db->insert_id();
		
		if(isset($_FILES["file"]) && !empty($_FILES["file"])){
			move_uploaded_file($_FILES['file']['tmp_name'], 'imagens/' .$_FILES['file']['name']);
			$this->produtos_model->inserte_documento($data_foto);
			redirect("produto?aviso=sucesso");
		}else{
			echo"<p style='color: #f00;'>Erro/p>";
		}
	}

	public function inserte_foto()
	{
		$data_foto["nome"] = $_POST['nome_documento'];
		$data_foto['arquivo'] = $_FILES['file']['name'];
		$data_foto["id_produto"] =  $_POST['produto'];
		
		if(isset($_FILES["file"]) && !empty($_FILES["file"])){
			move_uploaded_file($_FILES['file']['tmp_name'], 'imagens/' .$_FILES['file']['name']);
			$this->produtos_model->inserte_documento($data_foto);
			redirect("produto");
		}else{
			echo"<p style='color: #f00;'>Erro/p>";
		}
	}	

	public function editar($id)
	{
		$data["produto_editar"] =  $this->produtos_model->select_editar($id);
		$data["title"] = "Editar Produto - FinAR";

		$this->load->view('templates/header',$data);
		$this->load->view('templates/nav-top',$data);
		$this->load->view('pages/cadastro_produto',$data);
        $this->load->view('templates/footer',$data);
		$this->load->view('templates/js',$data);
	}

	public function update($id)
	{
        $produto_info['descricao'] = $_POST['descricao'];
		$produto_info['cod_barras'] = $_POST['cod_barra'];
		$produto_info['cod_aux'] = $_POST['cod_aux'];
		$produto_info['custo'] = $_POST['custo'];
		$produto_info['preco_venda'] = $_POST['preco_venda'];
		$produto_info['estoque_atual'] = $_POST['estoque_atual'];
		$produto_info['estoque_minimo'] = $_POST['estoque_minimo'];
		$this->produtos_model->update_produto($id,$produto_info);

		redirect("produto?aviso=updt");
	}

	public function form_update_localizacao($id)
	{
		$data["produto_localizacao_editar"] =  $this->produtos_model->select_form_edit_localizacao($id);
		$data["localizacao"] =  $this->produtos_model->select_localizacao();
		$data["title"] = "Editar Localização Produto - FinAR";

		$this->load->view('templates/header',$data);
		$this->load->view('templates/nav-top',$data);
		$this->load->view('pages/atualizacao_produto_localizacao',$data);
        $this->load->view('templates/footer',$data);
		$this->load->view('templates/js',$data);
	}

	public function form_update_fornecedor($id)
	{
		$data["produto_fornecedor_editar"] =  $this->produtos_model->select_form_edit_fornecedor($id);
		$data["fornecedor"] =  $this->produtos_model->select_fornecedor();
		$data["title"] = "Editar Fornecedor Produto - FinAR";

		$this->load->view('templates/header',$data);
		$this->load->view('templates/nav-top',$data);
		$this->load->view('pages/atualizacao_produto_fornecedor',$data);
        $this->load->view('templates/footer',$data);
		$this->load->view('templates/js',$data);
	}

	public function form_update_empresa($id)
	{
		$data["produto_empresa_editar"] =  $this->produtos_model->select_form_edit_empresa($id);
		$data["empresa"] =  $this->produtos_model->select_empresas();
		$data["title"] = "Editar Empresa Produto - FinAR";

		$this->load->view('templates/header',$data);
		$this->load->view('templates/nav-top',$data);
		$this->load->view('pages/atualizacao_produto_empresa',$data);
        $this->load->view('templates/footer',$data);
		$this->load->view('templates/js',$data);
	}

	public function update_localizacao($id)
	{
		$produto_info['id_localizacao'] = $_POST['localizacao'];
		$this->produtos_model->update_localizacao($id,$produto_info);

		redirect("produto?aviso=updt_localizacao");
	}

	public function update_fornecedor($id)
	{
		$produto_info['id_fornecedor'] = $_POST['fornecedor'];
		$this->produtos_model->update_fornecedor($id,$produto_info);

		redirect("produto?aviso=updt_fornecedor");
	}

	public function update_empresa($id)
	{
		$produto_info['id_empresa'] = $_POST['empresa'];
		$this->produtos_model->update_empresa($id,$produto_info);

		redirect("produto?aviso=updt_empresa");
	}

	public function inativa($id)
	{
        $data['status'] = "F";
		$this->produtos_model->update_produto_inativa($id,$data);

		redirect("produto");
	}

	public function ativa($id)
	{
        $data['status'] = "T";
		$this->produtos_model->update_produto_ativa($id,$data);

		redirect("produto");
	}


	public function delete_foto($id)
	{
		$this->produtos_model->delete_foto($id);

		redirect("produto?aviso=del_foto");
	}

}