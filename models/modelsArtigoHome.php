<?php

class modelsArtigoHome {

    private $Resultado;
    private $ResultadoPaginacao;
    private $Artigo;

    function getResultado() {
        return $this->Resultado;
    }

    public function listar() {
        $ListarArtigo = new ModelsRead();
        $ListarArtigo->ExeRead('artigos', 'LIMIT :limit', "limit=6");
        $this->Resultado = $ListarArtigo->getResultado();
        //var_dump($this->Resultado);
        return $this->Resultado;
    }

    public function listarBlog($PageId) {
        $Paginacao = new ModelsPaginacao(URL . 'blog/');
        $Paginacao->condicao($PageId, 3);
        $this->ResultadoPaginacao = $Paginacao->paginacao('artigos');

        $Listar = new ModelsRead();
        $Listar->ExeRead('artigos', 'LIMIT :limit OFFSET :offset', "limit={$Paginacao->getLimiteResultado()}&offset={$Paginacao->getOffset()}");
        if ($Listar->getResultado()):
            $this->Resultado = $Listar->getResultado();
            return array($this->Resultado, $this->ResultadoPaginacao);
        else:
            $Paginacao->paginaInvalida();
        endif;
    }

    public function verArtigo($Artigo) {
        $this->Artigo = $Artigo;
        $Visulizar = new ModelsRead();
        $Visulizar->fullRead("select art.*, cat.nome_cat_artigo categorias_artigos from artigos art 
            INNER JOIN categorias_artigos cat on cat.id = art.categorias_artigo_id   
            WHERE art.slug_artigo =:slug_artigo LIMIT :limit", "slug_artigo={$this->Artigo}&limit=1");
            
        $this->Resultado = $Visulizar->getResultado();
        return $this->Resultado;
    }

}
