<?php

class ControleContato {
    
    private $Menu;
    private $Dados;
    private $ContatoId;
    private $PageId;

    public function index($PageId = null) {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->PageId = ((int) $PageId ? $PageId : 1);

        $ListarContatos = new ModelsContato();
        $this->Dados = $ListarContatos->listar($this->PageId);
        $CarregarView = new ConfigView("contato/listarContato", $this->Menu, $this->Dados);
        $CarregarView->renderizar();
    }
    
    public function visualizar($ContatoId = null) {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->ContatoId = (int) $ContatoId;
        if (!empty($this->ContatoId)):
            $VerContato = new ModelsContato();
            $this->Dados = $VerContato->visualizar($ContatoId);

            if ($VerContato->getResultado()):
                $CarregarView = new ConfigView("contato/visualizarContato", $this->Menu, $this->Dados);
                $CarregarView->renderizar();
            else:
                $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário seleciona um Contato!</div>";
                $UrlDestino = URL . 'controle-contato/index';
                header("Location: $UrlDestino");
            endif;

        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário seleciona um Contato!</div>";
            $UrlDestino = URL . 'controle-contato/index';
            header("Location: $UrlDestino");
        endif;
    }
}
