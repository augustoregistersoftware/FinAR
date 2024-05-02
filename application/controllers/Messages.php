<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Messages extends CI_Controller {

	//Função Construct para trazer o carregamento da modal
    public function __construct()
    {
		parent::__construct();
		$this->load->model("message_model");
    }

	public function index()
	{
        $id = $this->session->userdata('id');

        $data["quantidade_messagem"] =  $this->message_model->quantidade_mensagem($id);
        $data["listagem"] =  $this->message_model->conteudos_mensagem_listagem($id);

        $this->load->view('templates/navbar',$data);
	}

    public function ciencia_mensagem()
    {
        $id = $this->session->userdata('id');

        $this->message_model->ciencia_mensagem($id);
    }

    public function load_page()
    {
        $this->load->view('templates/header');
		$this->load->view('templates/navbar');
		$this->load->view('templates/sidebarsettings');
		$this->load->view('pages/messagem');
		$this->load->view('templates/footer');
    }
}