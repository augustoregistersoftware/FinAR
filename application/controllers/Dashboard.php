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
		$data["produto"] =  $this->produtos_model->select_dashboard();
		$data["produtos_grafico"] = $this->produtos_model->select_total();
		$data["total_cobranca"] = $this->dashboard_model->select_total_cobranca();
		$data["total_compra"] = $this->dashboard_model->select_total_viagem();
		$data["total_receber"] = $this->dashboard_model->select_total_receber();
		$data["total_devendo"] = $this->dashboard_model->select_total_devendo();
		$data["diferenca_compra"] = $this->dashboard_model->select_diferenca_compra();
		$data["title"] = "Dashboard - FinAR";

		if($this->session->userdata('log')!="logged"){
			redirect("login");
		}else{
			$this->load->view('templates/header',$data);
			$this->load->view('templates/navbar');
			$this->load->view('templates/sidebarsettings');
			$this->load->view('pages/dashboard',$data);
			$this->load->view('templates/footer');


			
		}
		
	}

}