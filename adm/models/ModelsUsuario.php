<?php

class ModelsUsuario {

    private $Resultado;
    private $UserId;
    private $Dados;
    private $Msg;
    private $RowCount;
    private $ResultadoPaginacao;
    private $Foto;

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
            if (empty($this->Foto['name'])):
                $this->inserir();
            else:
                $SlugImagem = new ModelsValidacao();
                $SlugImagem->nomeSlug($this->Foto['name']);
                $this->Foto['name'] = $SlugImagem->getNome();
                $this->Dados['foto'] = $this->Foto['name'];
                //var_dump($this->Dados);  

                $this->inserir();

                $UploadFoto = new ModelsUpload();
                $UploadFoto->upload($this->Foto, 'usuarios/' . $this->Resultado . '/', $this->Dados['foto']);

            endif;
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
        $this->Foto = $this->Dados['foto'];
        unset($this->Dados['foto']);
        //var_dump($this->Dados);
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
        $this->UserId = $this->Dados['id'];
        $this->Foto['foto_antiga'] = $this->Dados['foto_antiga'];
        unset($this->Dados['foto_antiga']);

        $this->validarDados();
        if ($this->Resultado):
            if (empty($this->Foto['name'])):
                $this->alterar();
            else:
                if (file_exists('assets/imagens/usuarios/' . $this->UserId . '/' . $this->Foto['foto_antiga'])):
                    unlink('assets/imagens/usuarios/' . $this->UserId . '/' . $this->Foto['foto_antiga']);
                endif;
                $SlugImagem = new ModelsValidacao();
                $SlugImagem->nomeSlug($this->Foto['name']);
                $this->Foto['name'] = $SlugImagem->getNome();
                $this->Dados['foto'] = $this->Foto['name'];

                $this->alterar();

                $UploadFoto = new ModelsUpload();
                $UploadFoto->upload($this->Foto, 'usuarios/' . $this->UserId . '/', $this->Dados['foto']);

            endif;

//$this->alterar();
        endif;
    }

    private function alterar() {
        $Update = new ModelsUpdate();
        $Update->ExeUpdate(self::Entity, $this->Dados, "WHERE id = :id", "id={$this->UserId }");
        if ($Update->getResultado()):
            $this->Resultado = true;
        else:
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

    public function atualizaSessao($UserId) {
        $this->UserId = (int) $UserId;
        $this->Dados = $this->visualizar($this->UserId);
        //var_dump($this->Dados);
        $_SESSION['id'] = $this->Dados[0]['id'];
        $_SESSION['name'] = $this->Dados[0]['name'];
        $_SESSION['email'] = $this->Dados[0]['email'];
        $_SESSION['foto'] = $this->Dados[0]['foto'];
        $_SESSION['niveis_acesso_id'] = $this->Dados[0]['niveis_acesso_id'];
    }

}
