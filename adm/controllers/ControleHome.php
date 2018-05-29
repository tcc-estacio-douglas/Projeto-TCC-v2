<?php

/**
 * Descricao de ControleHome
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class ControleHome {
    
    private $Menu;

    public function index() {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        
        $CarregarView = new ConfigView("home/home", $this->Menu);
        $CarregarView->renderizar();
    }
}
