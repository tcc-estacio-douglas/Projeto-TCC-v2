<?php

/**
 * Descrição de Home
 *
 * @copyright (c) 2018, Douglas Caetano Lima
 */
class Home {
    
    public function index() {
        $CarregarView = new ConfigView('home/home');
        $CarregarView->renderizar();
    }
}
