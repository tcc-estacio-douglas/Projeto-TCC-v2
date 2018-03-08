<?php

/**
 * Descricao de ConfigView
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class ConfigView {

    private $Nome;
    private $Dados;

    public function __construct($Nome, array $Dados = null) {
        $this->Nome = (string) $Nome;
        $this->Dados = $Dados;
    }

    public function renderizar() {
        include 'views/include/menu.php';
        if (file_exists('views/' . $this->Nome . '.php')):
            include 'views/' . $this->Nome . '.php';
        else:
            echo "Erro ao carregar a VIEW: {$this->Nome}";
        endif;
    }
    
    public function renderizarlogin() {
        if(file_exists('views/'. $this->Nome . '.php')):
            include 'views/'. $this->Nome . '.php';
        endif;
    }


    public function getdados() {
        return $this->Dados;
    }

}
