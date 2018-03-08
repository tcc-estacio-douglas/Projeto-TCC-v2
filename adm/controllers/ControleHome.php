<?php

/**
 * Descricao de ControleHome
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class ControleHome {
    
    public function index() {
        $CarregarView = new ConfigView("home/home");
        $CarregarView->renderizar();
    }
}
