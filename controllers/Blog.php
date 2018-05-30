<?php

class Blog {
    
    private $Dados;
    private $DadosArtigos;
    private $PageId;
    
    public function index($PageId = null) {
        $this->PageId = ((int) $PageId ? $PageId : 1);
        //echo "<br><br><br><br><br><br>";
        $ListarArtigos = new modelsArtigoHome();
        $this->DadosArtigos = $ListarArtigos->listarBlog($this->PageId);
        
        $this->Dados = array($this->DadosArtigos[0], $this->DadosArtigos[1]);
        $CarregarView = new ConfigView('blog/listarArtigo', $this->Dados);
        $CarregarView->renderizar();
        
    }
}
