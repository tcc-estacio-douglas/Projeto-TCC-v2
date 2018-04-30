<?php

// ASSISTIR AULA "LOGIN- ENVIA E-MAIL PARA RECUPERAR SENHA" ANTES DE PROSSEGUIR...

class ModelsEnviaEmail {
    
    private $Dados;
    private $Assunto;
    private $Mensagem;
    private $RemetenteNome;
    private $RemetenteEmail;
    private $DestinoNome;
    private $DestinoEmail;
    private $Mail;
    
    public function Enviar(array $Dados) {
        $this->Dados = $Dados;
        var_dump($this->Dados);
        $this->setMail();
    }
    
    private function setMail() {
        $this->Assunto = $this->Dados['assunto'];
        $this->Mensagem = $this->Dados['mensagem'];
        $this->RemetenteNome = "Suporte";
        $this->RemetenteEmail = "suporte@loja.com.br";
        $this->DestinoNome = $this->Dados['destinoNome'];
        $this->DestinoEmail = $this->Dados['destinoEmail'];
    }
    
    
}
