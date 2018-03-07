<?php

/**
 * Descricao de ModelsUsuario
 *
 * @copyright (c) 2018, Douglas Caetano Lima
 */
class ModelsUsuario {

    private $Resultado;
    private $UserId;
    private $Dados;
    private $Msg;
    private $RowCount;

    const Entity = 'users';

    function getResultado() {
        return $this->Resultado;
    }

    function getMsg() {
        return $this->Msg;
    }
    
    function getRowCount() {
        return $this->RowCount;
    }

    
    public function listar() {
        $Listar = new ModelsRead();
        $Listar->ExeRead('users', 'LIMIT :limit', "limit=12");
        $this->Resultado = $Listar->getResultado();
        return $this->Resultado;
    }

    public function visualizar($UserId) {
        $this->UserId = (int) $UserId;
        $Visualizar = new ModelsRead();
        $Visualizar->ExeRead('users', 'WHERE id =:id LIMIT :limit', "id={$this->UserId}&limit=1");
        $this->Resultado = $Visualizar->getResultado();
        $this->RowCount = $Visualizar->getRowCount();
        return $this->Resultado;
    }

    public function cadastrar(array $Dados) {
        $this->Dados = $Dados;
        $this->ValidarDados();
        if ($this->Resultado):
            $this->inserir();
        endif;
    }

    private function validarDados() {
        $this->Dados = array_map('strip_tags', $this->Dados);
        $this->Dados = array_map('trim', $this->Dados);
        if (in_array('', $this->Dados)):
            $this->Resultado = false;
            $this->Msg = "<p style='color:red'><b>Erro ao cadastrar: </b>Para cadastrar o usuário preencha todos os campos!</p>";
        else:
            $this->Dados['password'] = md5($this->Dados['password']);
            $this->Resultado = true;
        endif;
    }

    private function inserir() {
        $Create = new ModelsCreate;
        $Create->ExeCreate(self::Entity, $this->Dados);
        if ($Create->getResultado()):
            $this->Resultado = $Create->getResultado();
            $this->Msg = "<p style='color:green'><b>Sucesso: </b>O usuário {$this->Dados['name']} foi cadastrado com sucesso!</p>";
        endif;
    }

    public function editar($UserId, array $Dados) {
        $this->UserId = (int) $UserId;
        $this->Dados = $Dados;

        $this->validarDados();
        if ($this->Resultado):
            $this->alterar();
        endif;
    }
    
    private function alterar() {
        $Update = new ModelsUpdate();
        $Update->ExeUpdate(self::Entity, $this->Dados, "WHERE id = :id", "id={$this->UserId }");
        if ($Update->getResultado()):
            $this->Msg = "<p style='color: green';><b>Sucesso: </b> O usuário {$this->Dados['name']} foi editado no sistema!</p>";
            $this->Resultado = true;
        else:
            $this->Msg = "<p style='color: red';><b>Erro: </b> O usuário {$this->Dados['name']} não foi editado no sistema!</p>";
            $this->Resultado = false;
        endif;
    }
    
    public function apagar($UserId) {
        $this->Dados = $this->visualizar($UserId);
        var_dump($this->Dados);        
        if($this->getRowCount() > 0):
            echo "O usuario existe: {$this->getRowCount()}<br>";
            $ApagarUsuario = new ModelsDelete();
            $ApagarUsuario->ExeDelete('users', 'WHERE id = :id', "id=$UserId");
            $this->Resultado = $ApagarUsuario->getResultado();
            $_SESSION['msg'] =  "Usuário apagado com sucesso.<br>";
        else:
            $_SESSION['msg'] =  "Não foi encontrado o usuário.<br>";
        endif;
    }

}
