<?php

/**
 * Descricao de ModelsUsuario
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class ModelsUsuario {

    private $Resultado;
    private $UserId;
    private $Dados;
    private $Msg;
    private $RowCount;
    private $ResultadoPaginacao;

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

    public function listar($PageId) {
        $Paginacao = new ModelsPaginacao(URL . 'controle-usuario/index/');
        $Paginacao->condicao($PageId, 10);
        $this->ResultadoPaginacao = $Paginacao->paginacao('users');

        $Listar = new ModelsRead();
        $Listar->ExeRead('users', 'LIMIT :limit OFFSET :offset', "limit={$Paginacao->getLimiteResultado()}&offset={$Paginacao->getOffset()}");
        if ($Listar->getResultado()):
            $this->Resultado = $Listar->getResultado();
            return array($this->Resultado, $this->ResultadoPaginacao);
        else:
            //echo "Nenhum usuário encontrado<br>";
            $Paginacao->paginaInvalida();
        endif;
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

    public function listarCadastrar() {
        $Listar = new ModelsRead();
        $Listar->ExeRead('niveis_acessos');
        $NivelAcesso = $Listar->getResultado();
        //var_dump($NivelAcesso);
        $Listar->ExeRead('situacoes_users');
        $SituacaoUsers = $Listar->getResultado();
        //var_dump($SituacaoUsers);
        $this->Resultado = array($NivelAcesso, $SituacaoUsers);
        //var_dump($this->Resultado);
        return $this->Resultado;
    }
    private function validarDados() {
        $this->Dados = array_map('strip_tags', $this->Dados);
        $this->Dados = array_map('trim', $this->Dados);
        if (in_array('', $this->Dados)):
            $this->Resultado = false;
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
            $this->Msg = "<div class='alert alert-success'><b>Sucesso: </b>O usuário {$this->Dados['name']} foi editado no sistema!</div>";
            $this->Resultado = true;
        else:
            $this->Msg = "<div class='alert alert-danger'><b>Erro: </b>O usuário {$this->Dados['name']} não foi editado no sistema!</div>";
            $this->Resultado = false;
        endif;
    }

    public function apagar($UserId) {
        $this->Dados = $this->visualizar($UserId);
        var_dump($this->Dados);
        if ($this->getRowCount() > 0):
            echo "O usuario existe: {$this->getRowCount()}<br>";
            $ApagarUsuario = new ModelsDelete();
            $ApagarUsuario->ExeDelete('users', 'WHERE id = :id', "id=$UserId");
            $this->Resultado = $ApagarUsuario->getResultado();
            $_SESSION['msg'] = "<div class='alert alert-success'>Usuário apagado com sucesso.</div>";
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Não foi encontrado o usuário.</div>";
        endif;
    }

}
