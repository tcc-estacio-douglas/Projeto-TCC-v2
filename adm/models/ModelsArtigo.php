<?php

/**
 * Descricao de ModelsArtigo
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class ModelsArtigo {

    private $Resultado;
    private $ArtigoId;
    private $Dados;
    private $Msg;
    private $RowCount;
    private $ResultadoPaginacao;
    private $Foto;

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
        $Paginacao = new ModelsPaginacao(URL . 'controle-artigo/index/');
        $Paginacao->condicao($PageId, 20);
        $this->ResultadoPaginacao = $Paginacao->paginacao('artigos');

        $Listar = new ModelsRead();
        $Listar->fullRead("select art.*, cat.nome_cat_artigo categorias_artigos from artigos art 
            INNER JOIN categorias_artigos cat on cat.id = art.categorias_artigo_id             
            ORDER BY id ASC LIMIT :limit OFFSET :offset", "limit={$Paginacao->getLimiteResultado()}&offset={$Paginacao->getOffset()}");
        //var_dump($Listar->getResultado());
        if ($Listar->getResultado()):
            $this->Resultado = $Listar->getResultado();
            return array($this->Resultado, $this->ResultadoPaginacao);
        else:
            $Paginacao->paginaInvalida();
        endif;
    }

    public function visualizar($ArtigoId) {
        $this->ArtigoId = (int) $ArtigoId;
        $Visualizar = new ModelsRead();
        $Visualizar->fullRead("select art.*, cat.nome_cat_artigo categorias_artigos from artigos art 
            INNER JOIN categorias_artigos cat on cat.id = art.categorias_artigo_id   
            WHERE art.id =:id LIMIT :limit", "id={$this->ArtigoId}&limit=1");

        //var_dump($Visualizar->getResultado());
        $this->Resultado = $Visualizar->getResultado();
        $this->RowCount = $Visualizar->getRowCount();
        return $this->Resultado;
    }

    public function listarCadastrar() {
        $Listar = new ModelsRead();
        $Listar->ExeRead('categorias_artigos');
        $CatArtigos = $Listar->getResultado();
        $this->Resultado = array($CatArtigos);
        return $this->Resultado;
    }

    public function cadastrar(array $Dados) {
        $this->Dados = $Dados;
        $this->validarDados();
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
                $UploadFoto->upload($this->Foto, 'artigo/' . $this->Resultado . '/', $this->Dados['foto']);
            endif;
        endif;
    }

    private function validarDados() {
        $this->Foto = $this->Dados['foto'];
        unset($this->Dados['foto']);
        $this->Dados = array_map('trim', $this->Dados);
        if (in_array('', $this->Dados)):
            $this->Resultado = false;
        else:
            $this->Resultado = true;
        endif;
    }

    private function inserir() {
        $Create = new ModelsCreate;
        $Create->ExeCreate('artigos', $this->Dados);
        if ($Create->getResultado()):
            $this->Resultado = $Create->getResultado();
        endif;
    }

    public function editar($AritgoId, array $Dados) {
        $this->ArtigoId = (int) $AritgoId;
        $this->Dados = $Dados;
        $this->ArtigoId = $this->Dados['id'];
        $this->Foto['foto_antiga'] = $this->Dados['foto_antiga'];
        unset($this->Dados['foto_antiga']);

        $this->validarDados();
        if ($this->Resultado):
            if (empty($this->Foto['name'])):
                $this->alterar();
            else:
                if (file_exists('assets/imagens/artigo/' . $this->ArtigoId . '/' . $this->Foto['foto_antiga'])):
                    unlink('assets/imagens/artigo/' . $this->ArtigoId . '/' . $this->Foto['foto_antiga']);
                
                $SlugImagem = new ModelsValidacao();
                $SlugImagem->nomeSlug($this->Foto['name']);
                $this->Foto['name'] = $SlugImagem->getNome();
                $this->Dados['foto'] = $this->Foto['name'];
                
                $this->alterar();
                
                $UploadFoto = new ModelsUpload();
                $UploadFoto->upload($this->Foto, 'artigo/' . $this->ArtigoId . '/', $this->Dados['foto']);
                
                endif;
            endif;
        endif;
    }
    
    private function alterar() {
        $Update = new ModelsUpdate();
        $Update->ExeUpdate('artigos', $this->Dados, "WHERE id = :id", "id={$this->ArtigoId }");
        if ($Update->getResultado()):
            $this->Resultado = true;
        else:
            $this->Resultado = false;
        endif;
    }
    
    public function apagar($ArtigoId) {
        $this->ArtigoId = (int) $ArtigoId;
        $this->Dados = $this->visualizar($this->ArtigoId);
        if ($this->getRowCount() >= 0):
            $ApagarArtigo = new ModelsDelete();
            $ApagarArtigo->ExeDelete('artigos', 'WHERE id =:id', "id={$this->ArtigoId}");
            $this->Resultado = $ApagarArtigo->getResultado();
             $_SESSION['msg'] = "<div class='alert alert-success'>Artigo apagado com sucesso!</div>";
        else:
            $_SESSION['msg'] = "<div class='alert alert-success'>Artigo não foi apagado com sucesso!</div>";
        endif;
    }

}
