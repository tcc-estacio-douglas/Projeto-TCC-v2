<?php

/**
 * Descrição de Home
 *
 * @copyright (c) 2018, Douglas Caetano Lima
 */
class Home {    
    private $DadosCarousel;
    private $Dados;


    public function index() {
        $Listarcarousel = new modelsCarouselHome();
        $this->DadosCarousel = $Listarcarousel->listar();
        
        $this->Dados = array($this->DadosCarousel);
        $CarregarView = new ConfigView('home/home', $this->Dados);
        $CarregarView->renderizar();
    }
}
