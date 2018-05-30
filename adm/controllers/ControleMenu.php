<?php

class ControleMenu {

    private $Menu;
    private $Dados;
    private $PermissaoId;
    private $NivelAcessoId;

    public function index($NivelAcessoId) {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();

        $this->NivelAcessoId = (int) $NivelAcessoId;
        $ListarMenuOrdem = new ModelsMenu();
        $this->Dados = $ListarMenuOrdem->listarMenuOrdem($this->NivelAcessoId);

        $CarregarView = new ConfigView('menu/listarMenuOrdem', $this->Menu, $this->Dados);
        $CarregarView->renderizar();
    }

    public function editar($PermissaoId = null) {
        $this->PermissaoId = (int) $PermissaoId;
        if (!empty($this->PermissaoId)):
            $EditaMenu = new ModelsMenu();
            $EditaMenu->editar($this->PermissaoId);
            if (!$EditaMenu->getResultado()):
                $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um item de menu!</div>";
                $UrlDestino = URL . 'controle-login/listar-classe-methodo';
                header("Location: $UrlDestino");
            else:
                $_SESSION['msg'] = "<div class='alert alert-success'>Item de menu editado com sucesso!</div>";
                $UrlDestino = URL . 'controle-login/listar-classe-methodo';
                header("Location: $UrlDestino");
            endif;


        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um item de menu!</div>";
            $UrlDestino = URL . 'controle-login/listar-classe-methodo';
            header("Location: $UrlDestino");
        endif;
    }

    public function editarOrdem($PermissaoId = null) {
        $this->PermissaoId = (int) $PermissaoId;
        if (!empty($this->PermissaoId)):
            $EditaMenu = new ModelsMenu();
            $EditaMenu->editarOrdem($this->PermissaoId);
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um item de menu!</div>";
            $UrlDestino = URL . 'controle-login/listar-classe-methodo';
            header("Location: $UrlDestino");
        endif;
    }

}
