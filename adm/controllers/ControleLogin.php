<?php

/**
 * Descrição de ControleLogin
 *
 * @copyright (c) 2018, Douglas Caetano Lima
 */
class ControleLogin {

    private $Dados;

    public function login() {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['SendLogin'])):
            unset($this->Dados['SendLogin']);
            $this->Dados['password'] = md5($this->Dados['password']);
            var_dump($this->Dados);
        else:
            $this->Dados = null;
        endif;

        
        $CarregarView = new ConfigView("login/login", $this->Dados);
        $CarregarView->renderizarLogin();
    }

}
