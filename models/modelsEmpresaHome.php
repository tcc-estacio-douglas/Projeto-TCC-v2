<?php

class modelsEmpresaHome {
   
    private $Resultado;
    
    function getResultado() {
        return $this->Resultado;
    }

    public function listar() {
        $ListarEmpresa = new ModelsRead();
        $ListarEmpresa->ExeRead('empresas');
        $this->Resultado = $ListarEmpresa->getResultado();
        return $this->Resultado;
    }
}
