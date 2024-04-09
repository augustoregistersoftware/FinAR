<?php

class Login_model extends CI_Model {
    public function index()
    {
        return $this->db->query("SELECT * FROM empresa")->result_array();
    }

    public function senha($email,$apelido)
    {
        return $this->db->query("SELECT senha FROM login WHERE email = ".$this->db->escape($email)." AND nome = ".$this->db->escape($apelido)."")->row_array();
    }

    public function auth($email,$senha)
    {
        return $this->db->query("SELECT
        *
        FROM login
        WHERE email = ".$this->db->escape($email)." AND senha = ".$this->db->escape($senha)."")->result_array();
    }

    public function enviarEmail($email,$subject,$senha) {
        $this->email->set_newline("\r\n");
        $this->email->from('registersoftwaresistemas@gmail.com', 'RegisterSoftware');
        $this->email->to($email); // Para quem o email será enviado
        $this->email->subject($subject);
    
        // Construir a mensagem com HTML
        $htmlMessage = '<html><body>';
        $htmlMessage .= '<p><strong>Olá,tudo bem?</strong></p>';
        $htmlMessage .= '<p><strong>Recuperação de Senha:</strong></p>';
        $htmlMessage .= '<p>Perder ou esquecer uma senha pode ser uma experiência frustrante e preocupante. No entanto, estamos aqui para ajudar a resolver esse problema de forma rápida e segura.</p>';
        $htmlMessage .= '<p>Sua senha:</p>';
        $htmlMessage .= '<p>' . $senha . '</p>';
        $htmlMessage .= '<p>NÃO COMPARTILHE COM NINGUEM</p>';
        $htmlMessage .= '<p>caso seja necessario você pode mudar</p>';
        $htmlMessage .= '<p>Att. RegisterSoftware</p>';
        $htmlMessage .= '</body></html>';
    
        // Definir a mensagem como HTML
        $this->email->set_mailtype("html");
        $this->email->message($htmlMessage);
    
        // Enviar email e verificar sucesso
        if($this->email->send()) {
            return "Email enviado com sucesso.";
        } else {
            return "Email Não enviado com sucesso";
        }
    }

}