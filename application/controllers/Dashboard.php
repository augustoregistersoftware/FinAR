<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	//Função Construct para trazer o carregamento da modal
    public function __construct()
    {
		
		parent::__construct();
		$this->load->model("produtos_model");
		$this->load->model("clientes_model");
		$this->load->model("dashboard_model");
    }

	public function index()
	{
		$data["clientes"] =  $this->clientes_model->index();
		$data["produtos"] =  $this->produtos_model->select_dashboard();
		$data["produtos_grafico"] = $this->produtos_model->select_total();
		$data["total_cobranca"] = $this->dashboard_model->select_total_cobranca();
		$data["total_compra"] = $this->dashboard_model->select_total_viagem();
		$data["total_receber"] = $this->dashboard_model->select_total_receber();
		$data["title"] = "Dashboard - FinAR";

		$this->load->view('templates/header',$data);
		$this->load->view('templates/nav-top',$data);
		$this->load->view('pages/dashboard',$data);
		$this->load->view('templates/footer',$data);
		$this->load->view('templates/js',$data);


		
	}

}
