<?php

class modelsCarouselHome {
    
    private $Resultado;
    
    function getResultado() {
        return $this->Resultado;
    }

    public function listar() {
        $ListarCarousel = new ModelsRead();
        $ListarCarousel->ExeRead('carousels', 'WHERE situacao_carousel =:situacao_carousel', "situacao_carousel=1");
        $this->Resultado = $ListarCarousel->getResultado();
        return $this->Resultado;
    }

}
