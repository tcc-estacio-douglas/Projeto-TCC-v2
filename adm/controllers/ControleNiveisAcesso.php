<?php

/**
 * Descricao de ControleNiveisAcesso
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class ControleNiveisAcesso {

    private $Menu;
    private $PostId;
    private $Dados;
    private $NivelAcessoId;

    public function index($PageId = null) {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->PostId = ((int) $PageId ? $PageId : 1);
        $ListarNiveisAcesso = new ModelsNiveisAcesso();
        $this->Dados = $ListarNiveisAcesso->listar($this->PostId);

        $CarregarView = new ConfigView('niveisacesso/listarNiveisAcesso', $this->Menu, $this->Dados);
        $CarregarView->renderizar();
    }

    public function cadastrar() {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty(($this->Dados['SendCadNivelAcesso']))):
            unset($this->Dados['SendCadNivelAcesso']);
            $CadNivelAcesso = new ModelsNiveisAcesso();
            $CadNivelAcesso->cadastrar($this->Dados);
            if ($CadNivelAcesso->getResultado()):
                $SincrinizarClasse = new ModelsLogin();
                $SincrinizarClasse->cadastrarClasse();
                $_SESSION['msgcad'] = "<div class='alert alert-success'>Nivel de acesso cadastrado com sucesso!</div>";
                $UrlDestino = URL . 'controle-niveis-acesso/index';
                header("Location: $UrlDestino");
            else:
                $_SESSION['msg'] = "<div class='alert alert-danger'>Para cadastrar o nivel de acesso preencha todos os campos!</div>";
            endif;
        endif;
        $CarregarView = new ConfigView('niveisacesso/cadastarNivelAcesso', $this->Menu);
        $CarregarView->renderizar();
    }

    public function visualizar($NivelAcessoId = null) {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->NivelAcessoId = (int) $NivelAcessoId;
        if (!empty($this->NivelAcessoId)):
            $VerNivelAcesso = new ModelsNiveisAcesso();
            $this->Dados = $VerNivelAcesso->visualizar($this->NivelAcessoId);

            if ($VerNivelAcesso->getResultado()):
                $CarregarView = new ConfigView('niveisacesso/visualizarNivelAcesso', $this->Menu, $this->Dados);
                $CarregarView->renderizar();
            else:
                $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário seleciona um nivel de acesso!</div>";
                $UrlDestino = URL . 'controle-niveis-acesso/index';
                header("Location: $UrlDestino");
            endif;
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário seleciona um nivel de acesso!</div>";
            $UrlDestino = URL . 'controle-niveis-acesso/index';
            header("Location: $UrlDestino");
        endif;
    }

    public function editar($NivelAcessoId = null) {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->NivelAcessoId = (int) $NivelAcessoId;
        if (!empty($this->NivelAcessoId)):
            $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $this->alterarPrivado();
            $verNivelAcesso = new ModelsNiveisAcesso();
            $this->Dados = $verNivelAcesso->visualizar($this->NivelAcessoId);
            $CarregarView = new ConfigView('niveisacesso/editarNivelAcesso', $this->Menu, $this->Dados);
            $CarregarView->renderizar();

        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um nivel de acesso!</div>";
            $UrlDestino = URL . 'controle-niveis-acesso/index';
            header("Location: $UrlDestino");
        endif;
    }

    private function alterarPrivado() {
        if (!empty($this->Dados['SendEditNivelAcesso'])):
            unset($this->Dados['SendEditNivelAcesso']);
            $EditaNivelAcesso = new ModelsNiveisAcesso();
            $EditaNivelAcesso->editar($this->NivelAcessoId, $this->Dados);
            if (!$EditaNivelAcesso->getResultado()):
                $_SESSION['msg'] = "<div class='alert alert-danger'>Para editar nivel de acesso preencha todos os campos!</div>";
            else:
                $_SESSION['msgcad'] = "<div class='alert alert-success'>Nivel de acesso editado com sucesso!</div>";
                $UrlDestino = URL . 'controle-niveis-acesso/index';
                header("Location: $UrlDestino");
            endif;
        else:
            $VerNivelAcesso = new ModelsNiveisAcesso();
            $this->Dados = $VerNivelAcesso->visualizar($this->NivelAcessoId);
            if ($VerNivelAcesso->getRowCount() <= 0):
                $_SESSION['msgcad'] = "<div class='alert alert-danger'>Necessário selecionar um Nivel de Acesso</div>";
                $UrlDestino = URL . 'controle-niveis-acesso/index';
                header("Location: $UrlDestino");
            endif;
        endif;
    }

    public function apagar($NivelAcessoId = null) {
        $this->NivelAcessoId = (int) $NivelAcessoId;
        if (!empty($this->NivelAcessoId)):
            $ApagarNivelAcesso = new ModelsNiveisAcesso();
            $ApagarNivelAcesso->apagar($this->NivelAcessoId);
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um nivel de acesso!</div>";
            $UrlDestino = URL . 'controle-niveis-acesso/index';
            header("Location: $UrlDestino");
        endif;
        
        $UrlDestino = URL . 'controle-niveis-acesso/index';
        header("Location: $UrlDestino");
    }

}
