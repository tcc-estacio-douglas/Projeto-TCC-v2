<?php

/**
 * Descricao de ControleHome
 *
 * @copyright (c) 2018, Douglas Caetano Lima
 */
class ControleHome {
    
    public function index() {
        $CarregarView = new ConfigView("home/home");
        $CarregarView->renderizar();
    }
}
