<?php

class Home {
    private $DadosCarousel;
    private $Dados;
    private $DadosServico;
    private $DadosVideo;
    private $DadosArtigo;


    public function index() {
        $Listarcarousel = new modelsCarouselHome();
        $this->DadosCarousel = $Listarcarousel->listar();
        
        $ListarServico = new modelsServicosHome();
        $this->DadosServico = $ListarServico->listar();
        
        $ListarVideo = new modelsVideoHome();
        $this->DadosVideo = $ListarVideo->listar();
        
        $ListarArtigo = new modelsArtigoHome();
        $this->DadosArtigo = $ListarArtigo->listar();
        
        $this->Dados = array($this->DadosCarousel, $this->DadosServico, $this->DadosVideo, $this->DadosArtigo);
        $CarregarView = new ConfigView('home/home',$this->Dados);
        $CarregarView->renderizar();
    }
}
