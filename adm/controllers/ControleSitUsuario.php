<?php

/**
 * Descrição de ControleSitUsuario
 *
 * @copyright (c) 2018, Douglas Caetano Lima
 */
class ControleSitUsuario {

    private $PostId;
    private $Dados;
    private $SitUsuarioId;

    public function index($PageId = null) {
        $this->PostId = ((int) $PageId ? $PageId : 1);
        $ListarSitUsuario = new ModelsSitUsuario();
        $this->Dados = $ListarSitUsuario->listar($this->PostId);

        $CarregarView = new ConfigView('situsuario/listarSitUsuario', $this->Dados);
        $CarregarView->renderizar();
    }

    public function cadastrar() {

        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if ($this->Dados['SendCadSitUsuario']):
            unset($this->Dados['SendCadSitUsuario']);
            $CadSitUsuario = new ModelsSitUsuario();
            $CadSitUsuario->cadastrar($this->Dados);
            if ($CadSitUsuario->getResultado()):
                $_SESSION['msgcad'] = "<div class='alert alert-success'>Situação do usuário cadastrada com sucesso!</div>";
                $UrlDestino = URL . 'controle-sit-usuario/index';
                header("Location: $UrlDestino");
            else:
                $_SESSION['msg'] = "<div class='alert alert-danger'><b>Erro ao cadastrar situação do usuário: </b>Para cadastrar preencha todos os campos!</div>";
            endif;
        endif;

        $CarregarView = new ConfigView('situsuario/cadastrarSitUsuario');
        $CarregarView->renderizar();
    }

    public function visualizar($SitUsuarioId = null) {
        $this->SitUsuarioId = (int) $SitUsuarioId;
        if (!empty($this->SitUsuarioId)):
            $VerSitUsuario = new ModelsSitUsuario();
            $this->Dados = $VerSitUsuario->visualizar($this->SitUsuarioId);
            If ($VerSitUsuario->getResultado()):
                $CarregarView = new ConfigView('situsuario/visualizarSitUsuario', $this->Dados);
                $CarregarView->renderizar();
            else:
                $_SESSION['msgcad'] = "<div class='alert alert-danger'>Necessário selecionar uma situação!</div>";
                $UrlDestino = URL . 'controle-sit-usuario/index';
                header("Location: $UrlDestino");
            endif;

        else:
            $_SESSION['msgcad'] = "<div class='alert alert-danger'>Necessário selecionar uma situação!</div>";
            $UrlDestino = URL . 'controle-sit-usuario/index';
            header("Location: $UrlDestino");
        endif;
    }

    public function editar($SitUsuarioId = null) {
        $this->SitUsuarioId = (int) $SitUsuarioId;
        if (!empty($SitUsuarioId)):
            $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $this->alterarPrivado();

            $VerSitUsuario = new ModelsSitUsuario();
            $this->Dados = $VerSitUsuario->visualizar($this->SitUsuarioId);

            $CarregarView = new ConfigView('situsuario/editarSitUsuario', $this->Dados);
            $CarregarView->renderizar();
        else:

        endif;
    }

    private function alterarPrivado() {
        if (!empty($this->Dados['SendEditSitUsuario'])):
            unset($this->Dados['SendEditSitUsuario']);
            $EditaSitUsuario = new ModelsSitUsuario();
            $EditaSitUsuario->editar($this->SitUsuarioId, $this->Dados);
            if (!$EditaSitUsuario->getResultado()):
                $_SESSION['msg'] = "<div class='alert alert-danger'>Para editar a situação do usuário preencha todos os campos!</div>";
            else:
                $_SESSION['msgcad'] = "<div class='alert alert-success'>Situação do usuário editada com sucesso!</div>";
                $UrlDestino = URL . 'controle-sit-usuario/index';
                header("Location: $UrlDestino");
            endif;
        else:
            $VerSitUsuario = new ModelsSitUsuario();
            $this->Dados = $VerSitUsuario->visualizar($this->SitUsuarioId);
            if ($VerSitUsuario->getRowCount() <= 0):
                $_SESSION['msgcad'] = "<div class='alert alert-danger'>Situação do usuário não selecionada!</div>";
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
            $_SESSION['msgcad'] = "<div class='alert alert-danger'>Situação do usuário não foi selecionada!</div>";
            $UrlDestino = URL . 'controle-sit-usuario/index';
            header("Location: $UrlDestino");
        endif;
        $UrlDestino = URL . 'controle-sit-usuario/index';
        header("Location: $UrlDestino");
    }

}
