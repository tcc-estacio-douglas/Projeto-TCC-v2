<?php

class Artigo {

    private $Artigo;
    private $DadosArtigo;
    private $Dados;

    public function index($Artigo = null) {
        $this->Artigo = (string) $Artigo;
        
        $VerArtigos = new modelsArtigoHome();
        $this->DadosArtigo = $VerArtigos->verArtigo($this->Artigo);
        
        $this->Dados = array($this->DadosArtigo);
        $CarregarView = new ConfigView('blog/visualizarArtigo', $this->Dados);
        $CarregarView->renderizar();
    }

}
