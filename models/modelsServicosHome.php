<?php

/**
 * Descricao de modelsServicosHome
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class modelsServicosHome {
    
    private $Resultado;
    
    function getResultado() {
        return $this->Resultado;
    }

    public function listar() {
        $ListarServico = new ModelsRead();
        $ListarServico->ExeRead('servicos', 'LIMIT :limit', "limit=6");
        $this->Resultado = $ListarServico->getResultado();
        return $this->Resultado;
    }
}
