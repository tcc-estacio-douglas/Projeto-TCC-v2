<?php

class ConfigView {

    private $Nome;
    private $Dados;
    private $Menu;

    public function __construct($Nome, array $Menu = null, array $Dados = null) {
        $this->Nome = (string) $Nome;
        $this->Dados = $Dados;
        $this->Menu = $Menu;
    }

    public function renderizar() {
        include 'views/include/header.php';
        include 'views/include/menu.php';
        if (file_exists('views/' . $this->Nome . '.php')):
            include 'views/' . $this->Nome . '.php';
        else:
            echo "Erro ao carregar a VIEW: {$this->Nome}";
        endif;
        include 'views/include/footer.php';
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
