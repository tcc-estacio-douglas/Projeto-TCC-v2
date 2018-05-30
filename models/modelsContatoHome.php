<?php

class modelsContatoHome {

    private $Dados;
    private $Resultado;
    private $DadosEmailCliente;
    private $DadosEmailAdm;

    function getResultado() {
        return $this->Resultado;
    }

    public function cadastrar(array $Dados) {
        $this->Dados = $Dados;
        $this->validarDados();
        if ($this->Resultado):
            $this->inserir();
            $this->enviarEmailCliente();
            $this->enviarEmailAdm();
        endif;
    }

    private function validarDados() {
        $this->Dados = array_map('strip_tags', $this->Dados);
        $this->Dados = array_map('trim', $this->Dados);
        if (in_array('', $this->Dados)):
            $_SESSION['msg'] = "<div class='alert alert-danger'>Para enviar a mensagem preencha todos os campos!</div>";
            $this->Resultado = false;
        else:
            $validarEmail = new ModelsValidacao();
            $validarEmail->email($this->Dados['email_cliente']);
            if ($validarEmail->getResultado()):                
                $this->Resultado = true;
            else:
                $_SESSION['msg'] = "<div class='alert alert-danger'>E-mail inválido!</div>";
                $this->Resultado = false;
            endif;            
        endif;
    }

    private function inserir() {
        $Create = new ModelsCreate();
        $Create->ExeCreate('contatos', $this->Dados);
        if ($Create->getResultado()):
            $this->Resultado = $Create->getResultado();
        endif;
    }
    
    private function enviarEmailCliente() {
        $this->DadosEmailCliente['assunto'] = 'Mensagem de contato';
        $this->DadosEmailCliente['destinoNome'] = $this->Dados['nome_cliente'];
        $this->DadosEmailCliente['destinoEmail'] = $this->Dados['email_cliente'];
        
        $this->DadosEmailCliente['mensagem'] = "Olá {$this->Dados['nome_cliente']}<br><br>";
        $this->DadosEmailCliente['mensagem'] .= "Seu email foi recebido.<br>";
        $this->DadosEmailCliente['mensagem'] .= "Será lido o mais rápido possível.<br>";
        $this->DadosEmailCliente['mensagem'] .= "Em breve será respondido.<br><br>";
        $this->DadosEmailCliente['mensagem'] .= "Respeitosamente, celke.com.br<br>";
        
        $EnviarEmail = new ModelsEnviaEmail();
        $EnviarEmail->Enviar($this->DadosEmailCliente);
    }
    
    private function enviarEmailAdm() {
        $this->DadosEmailAdm['assunto'] = 'Nova mensagem de contato';
        $this->DadosEmailAdm['destinoNome'] = 'Jessica';
        $this->DadosEmailAdm['destinoEmail'] = 'celkeadm@gmail.com';
        
        $this->DadosEmailAdm['mensagem'] = "Nome: {$this->Dados['nome_cliente']} <br>";
        $this->DadosEmailAdm['mensagem'] .= "Email: {$this->Dados['email_cliente']} <br>";
        $this->DadosEmailAdm['mensagem'] .= "Mensagem: {$this->Dados['comentario_contato']} <br>";
                
        $EnviarEmail = new ModelsEnviaEmail();
        $EnviarEmail->Enviar($this->DadosEmailAdm);
    }

}
