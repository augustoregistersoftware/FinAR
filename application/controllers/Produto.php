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
		$data["produtos"] =  $this->produtos_model->index();
		$data["empresa_produtos"] =  $this->produtos_model->select_empresas();
		$data["title"] = "Produtos - FinAR";

		$this->load->view('templates/header',$data);
		$this->load->view('templates/nav-top',$data);
		$this->load->view('pages/produtos',$data);
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
			redirect("produto");
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

		redirect("produto");
	}

}
