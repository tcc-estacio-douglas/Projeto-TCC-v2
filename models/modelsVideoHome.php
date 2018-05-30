<?php

class modelsVideoHome {
    
    private $Resultado;
    
    function getResultado() {
        return $this->Resultado;
    }

    public function listar() {
        $ListarVideo = new ModelsRead();
        $ListarVideo->ExeRead('videos', 'LIMIT :limit', "limit=1");
        $this->Resultado = $ListarVideo->getResultado();
        return $this->Resultado;
    }
}
