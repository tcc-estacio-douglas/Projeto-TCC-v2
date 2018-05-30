<?php

class ModelsCatArtigo {

    private $Resultado;
    private $CatArtigoId;
    private $Dados;
    private $Msg;
    private $RowCount;
    private $ResultadoPaginacao;

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
        $Paginacao = new ModelsPaginacao(URL . 'controle-cat-artigo/index/');
        $Paginacao->condicao($PageId, 20);
        $this->ResultadoPaginacao = $Paginacao->paginacao('categorias_artigos');

        $Listar = new ModelsRead();
        $Listar->ExeRead('categorias_artigos', 'LIMIT :limit OFFSET :offset', "limit={$Paginacao->getLimiteResultado()}&offset={$Paginacao->getOffset()}");
        if ($Listar->getResultado()):
            $this->Resultado = $Listar->getResultado();
            return array($this->Resultado, $this->ResultadoPaginacao);
        else:
            $Paginacao->paginaInvalida();
        endif;
    }
    
    public function cadastrar(array $Dados) {
        $this->Dados = $Dados;
        $this->validarDados();
        if ($this->Resultado):
            $this->inserir();
        endif;
    }
    
    private function validarDados() {
        $this->Dados = array_map('strip_tags', $this->Dados);
        $this->Dados = array_map('trim', $this->Dados);
        if (in_array('', $this->Dados)):
            $this->Resultado = false;
        else:
            $this->Resultado = true;
        endif;
    }
    
    private function inserir() {
        $Create = new ModelsCreate();
        //var_dump($this->Dados);
        $Create->ExeCreate('categorias_artigos', $this->Dados);
        if ($Create->getResultado()):
            $this->Resultado = $Create->getResultado();
        endif;
    }
    
    public function visualizar($CatArtigoId) {
        $this->CatArtigoId = (int) $CatArtigoId;
        $Visulizar = new ModelsRead();
        $Visulizar->ExeRead('categorias_artigos', 'WHERE id =:id LIMIT :limit', "id={$this->CatArtigoId}&limit=1");
        $this->Resultado = $Visulizar->getResultado();
        $this->RowCount = $Visulizar->getRowCount();
        return $this->Resultado;
    }
    
    public function editar($CatArtigoId, array $Dados) {
        $this->CatArtigoId = (int) $CatArtigoId;
        $this->Dados = $Dados;
        $this->validarDados();
        if ($this->Resultado):
            $this->alterar();
        endif;
    }
    
    private function alterar() {
        $Update = new ModelsUpdate();
        $Update->ExeUpdate('categorias_artigos', $this->Dados, 'WHERE id =:id', "id={$this->Dados['id']}");
        if ($Update->getResultado()):
            $this->Resultado = true;
        else:
            $this->Resultado = false;
        endif;
    }
    
    public function apagar($CatArtigoId) {
        $this->CatArtigoId = (int) $CatArtigoId;
        $this->Dados = $this->visualizar($this->CatArtigoId);
        if ($this->getRowCount() >= 0):
            $ApagarCatArtigo = new ModelsDelete();
            $ApagarCatArtigo->ExeDelete('categorias_artigos', 'WHERE id =:id', "id={$this->CatArtigoId}");
            $this->Resultado = $ApagarCatArtigo->getResultado();
             $_SESSION['msg'] = "<div class='alert alert-success'>Categoria de Artigo apagado com sucesso!</div>";
        else:
            $_SESSION['msg'] = "<div class='alert alert-success'>Categoria de artigo não foi apagado com sucesso!</div>";
        endif;
    }

}
