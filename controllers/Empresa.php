<?php

/**
 * Descricao de Empresa
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class Empresa {
    
    private $Dados;
    private $DadosEmpresa;
    
    public function index() {
        $ListarEmpresa = new modelsEmpresaHome();
        $this->DadosEmpresa = $ListarEmpresa->listar();
        
        $this->Dados = array($this->DadosEmpresa);
        
        $CarregarView = new ConfigView('empresa/empresa', $this->Dados);
        $CarregarView->renderizar();
    }
}
