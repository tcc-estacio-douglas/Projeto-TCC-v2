<?php

/**
 * Descricao de ControleLogin
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class ControleLogin {

    private $Dados;

    public function login() {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['SendLogin'])):
            unset($this->Dados['SendLogin']);
            $Login = new ModelsLogin();
            $Login->logar($this->Dados);
            if(!$Login->getResultado()):
                $_SESSION['msg'] = $Login->getMsg();
            else:
                $this->Dados = $Login->getResultado();
                $_SESSION['id'] = $this->Dados[0]['id'];
                $_SESSION['name'] = $this->Dados[0]['name'];
                $_SESSION['email'] = $this->Dados[0]['email'];
                $UrlDestino = URL . 'controle-home/index';
                header("Location: $UrlDestino");
            endif;
        else:
            $this->Dados = null;
        endif;

        $CarregarView = new ConfigView("login/login", $this->Dados);
        $CarregarView->renderizarlogin();
    }
    
    public function logout() {
        unset($_SESSION['id'], $_SESSION['name'], $_SESSION['email']);
        $_SESSION['msg'] = "<div class='alert alert-success'>Deslogado com sucesso</div>";
        $UrlDestino = URL . 'controle-login/login';
        header("Location: $UrlDestino");        
    }

}
