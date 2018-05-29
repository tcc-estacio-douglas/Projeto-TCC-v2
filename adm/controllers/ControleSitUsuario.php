<?php

/**
 * Descricao de ControleSitUsuario
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class ControleSitUsuario {

    private $Menu;
    private $PostId;
    private $Dados;
    private $SitUsuarioId;

    public function index($PageId = null) {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->PostId = ((int) $PageId ? $PageId : 1);
        $ListarSitUsuario = new ModelsSitUsuario();
        $this->Dados = $ListarSitUsuario->listar($this->PostId);

        $CarregarView = new ConfigView('situsuario/listarSitUsuario', $this->Menu, $this->Dados);
        $CarregarView->renderizar();
    }

    public function cadastrar() {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if ($this->Dados['SendCadSitUsuario']):
            unset($this->Dados['SendCadSitUsuario']);
            $CadSitUsuario = new ModelsSitUsuario();
            $CadSitUsuario->cadastrar($this->Dados);
            if ($CadSitUsuario->getResultado()):
                $_SESSION['msgcad'] = "<div class='alert alert-success'>Situação Usuário cadastrado com sucesso!</div>";
                $UrlDestino = URL . 'controle-sit-usuario/index';
                header("Location: $UrlDestino");
            else:
                $_SESSION['msg'] = "<div class='alert alert-danger'>Para cadastrar o situação usuário preencha todos os campos!</div>";
            endif;
        endif;
        $CarregarView = new ConfigView('situsuario/cadastrarSitUsuario', $this->Menu);
        $CarregarView->renderizar();
    }

    public function visualizar($SitUsuarioId = null) {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->SitUsuarioId = (int) $SitUsuarioId;
        if (!empty($this->SitUsuarioId)):
            $VerSitUsuario = new ModelsSitUsuario();
            $this->Dados = $VerSitUsuario->visualizar($this->SitUsuarioId);
            if ($VerSitUsuario->getResultado()):
                $CarregarView = new ConfigView('situsuario/visualizarSitUsuario', $this->Menu, $this->Dados);
                $CarregarView->renderizar();
            else:
                $_SESSION['msgcad'] = "<div class='alert alert-danger'>Necessário selecionar uma situação usuário!</div>";
                $UrlDestino = URL . 'controle-sit-usuario/index';
                header("Location: $UrlDestino");
            endif;
        else:
            $_SESSION['msgcad'] = "<div class='alert alert-danger'>Necessário selecionar uma situação usuário!</div>";
            $UrlDestino = URL . 'controle-sit-usuario/index';
            header("Location: $UrlDestino");
        endif;
    }

    public function editar($SitUsuarioId = null) {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->SitUsuarioId = (int) $SitUsuarioId;
        if (!empty($this->SitUsuarioId)):
            $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $this->alterarPrivato();

            $VerSitUsario = new ModelsSitUsuario();
            $this->Dados = $VerSitUsario->visualizar($this->SitUsuarioId);


            $CarregarView = new ConfigView('situsuario/editarSitUsuario', $this->Menu, $this->Dados);
            $CarregarView->renderizar();
        else:

        endif;
    }

    private function alterarPrivato() {
        if (!empty($this->Dados['SenEditSitUsuario'])):
            unset($this->Dados['SenEditSitUsuario']);
            $EditaSitUsuario = new ModelsSitUsuario();
            $EditaSitUsuario->editar($this->SitUsuarioId, $this->Dados);
            if (!$EditaSitUsuario->getResultado()):
                $_SESSION['msg'] = "<div class='alert alert-danger'>Para editar situação usuário preencha todos os campos!</div>";
            else:
                $_SESSION['msgcad'] = "<div class='alert alert-success'>Situação Usuário editado com sucesso!</div>";
                $UrlDestino = URL . 'controle-sit-usuario/index';
                header("Location: $UrlDestino");
            endif;
        else:
            $VerSitUsuario = new ModelsSitUsuario();
            $this->Dados = $VerSitUsuario->visualizar($this->SitUsuarioId);
            if ($VerSitUsuario->getRowCount() <= 0):
                $_SESSION['msgcad'] = "<div class='alert alert-danger'>Necessário selecionar uma situação usuário!</div>";
                $UrlDestino = URL . 'controle-sit-usuario/index';
                header("Location: $UrlDestino");
            endif;
        endif;
    }

    public function apagar($SitUsuarioId = null) {
        $this->SitUsuarioId = (int) $SitUsuarioId;
        if (!empty($this->SitUsuarioId)):
            $ApagarSitUsuario = new ModelsSitUsuario();
            $ApagarSitUsuario->apagar($this->SitUsuarioId);
        else:
            $_SESSION['msg'] = $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar uma situação usuário!</div>";
            $UrlDestino = URL . 'controle-sit-usuario/index';
            header("Location: $UrlDestino");
        endif;
        $UrlDestino = URL . 'controle-sit-usuario/index';
        header("Location: $UrlDestino");
    }

}
