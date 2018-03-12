<?php

/**
 * Descricao de ModelsLogin
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class ModelsLogin {

    private $Dados;
    private $Resultado;
    private $Msg;
    private $RowCount;

    function getResultado() {
        return $this->Resultado;
    }

    function getMsg() {
        return $this->Msg;
    }

    function getRowCount() {
        return $this->RowCount;
    }

    public function logar(array $Dados) {
        $this->Dados = $Dados;
        $this->validar();
        if ($this->Resultado):
            $Visulizar = new ModelsRead();
            $Visulizar->ExeRead('users', 'WHERE email =:email AND password =:password LIMIT :limit', "email={$this->Dados['email']}&password={$this->Dados['password']}&limit=1");
            if ($Visulizar->getRowCount() > 0):
                //var_dump($Visulizar->getResultado());
                $this->Resultado = $Visulizar->getResultado();
            else:
                $this->Resultado = false;
                $this->Msg = "<div class='alert alert-danger'>Login ou senha incorreto!</div>";
            endif;
        endif;
    }

    public function validar() {
        $this->Dados = array_map('strip_tags', $this->Dados);
        $this->Dados = array_map('trim', $this->Dados);
        if (in_array('', $this->Dados)):
            $this->Dados['password'] = md5($this->Dados['password']);
            $this->Resultado = false;
            $this->Msg = "<div class='alert alert-danger'>Login ou senha incorreto!</div>";
        else:
            $this->Dados['password'] = md5($this->Dados['password']);
            $this->Resultado = true;
        endif;
    }

}
