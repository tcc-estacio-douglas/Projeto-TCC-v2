<?php

/**
 * Descricao de ControleArtigo
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class ControleArtigo {
    
    private $Menu;
    private $Dados;
    private $ArtigoId;
    private $PageId;

    public function index($PageId = null) {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();        
        $this->PageId = ((int) $PageId ? $PageId : 1);
        $ListarArtigos = new ModelsArtigo();
        $this->Dados = $ListarArtigos->listar($this->PageId);

        $CarregarView = new ConfigView("artigo/listarArtigo", $this->Menu, $this->Dados);
        $CarregarView->renderizar();
    }

    public function visualizar($ArtigoId = null) {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->ArtigoId = (int) $ArtigoId;
        if ($this->ArtigoId):
            $VerArtigo = new ModelsArtigo();
            $this->Dados = $VerArtigo->visualizar($this->ArtigoId);
            if ($VerArtigo->getResultado()):
                $CarregarView = new ConfigView('artigo/visualizarArtigo', $this->Menu, $this->Dados);
                $CarregarView->renderizar();
            else:
                $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um artigo!</div>";
                $UrlDestino = URL . 'controle-artigo/index';
                header("Location: $UrlDestino");
            endif;
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um artigo!</div>";
            $UrlDestino = URL . 'controle-artigo/index';
            header("Location: $UrlDestino");
        endif;
    }

    public function cadastrar() {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $CadArtigo = new ModelsArtigo();
        if ($this->Dados['SendCadArtigo']):
            unset($this->Dados['SendCadArtigo']);
            $this->Dados['foto'] = ($_FILES['foto'] ? $_FILES['foto'] : null);
            $CadArtigo->cadastrar($this->Dados);
            if (!$CadArtigo->getResultado()):
                $_SESSION['msg'] = "<div class='alert alert-danger'><b>Erro ao cadastrar: </b>Para cadastrar o artigo preencha todos os campos!</div>";
            else:
                $_SESSION['msgcad'] = "<div class='alert alert-success'>Artigo cadastrado com sucesso!</div>";
                $UrlDestino = URL . 'controle-artigo/index';
                header("Location: $UrlDestino");
            endif;
        endif;

        $Registro = $CadArtigo->listarCadastrar();
        $this->Dados = array($Registro[0], $this->Dados);
        $CarregarView = new ConfigView("artigo/cadastrarArtigo", $this->Menu, $this->Dados);
        $CarregarView->renderizar();
    }

    public function editar($ArtigoId = null) {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->ArtigoId = (int) $ArtigoId;
        if (!empty($this->ArtigoId)):
            $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $this->alterarPrivado();

            $EditaArtigo = new ModelsArtigo();
            $Registro = $EditaArtigo->listarCadastrar();
            $this->Dados = array($Registro[0], $this->Dados);
            $CarregarView = new ConfigView('artigo/editarArtigo', $this->Menu, $this->Dados);
            $CarregarView->renderizar();

        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um artigo</div>";
            $UrlDestino = URL . 'controle-artigo/index';
            header("Location: $UrlDestino");
        endif;
    }

    public function alterarPrivado() {
        if (!empty($this->Dados['SendEditArtigo'])):
            unset($this->Dados['SendEditArtigo']);
            $this->Dados['foto'] = ($_FILES['foto'] ? $_FILES['foto'] : null);
            $EditarArtigo = new ModelsArtigo();
            $EditarArtigo->editar($this->ArtigoId, $this->Dados);
            if (!$EditarArtigo->getResultado()):
                $_SESSION['msg'] = "<div class='alert alert-danger'>Para editar o artigo preencha todos os campos!</div>";
            else:
                $_SESSION['msg'] = "<div class='alert alert-success'>Artigo editado com sucesso!</div>";
                $UrlDestino = URL . 'controle-artigo/visualizar/' . $this->ArtigoId;
                header("Location: $UrlDestino");
            endif;
        else:
            $VerArtigo = new ModelsArtigo();
            $this->Dados = $VerArtigo->visualizar($this->ArtigoId);
            if ($VerArtigo->getRowCount() <= 0):
                $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um artigo</div>";
                $UrlDestino = URL . 'controle-artigo/index';
                header("Location: $UrlDestino");
            endif;
        endif;
    }
    
    public function apagar($ArtigoId = null) {
        $this->ArtigoId = (int) $ArtigoId;
        if (!empty($this->ArtigoId)):
            $ApagarArtigo = new ModelsArtigo();
            $ApagarArtigo->apagar($this->ArtigoId);
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um artigo!</div>";
            $UrlDestino = URL . 'controle-artigo/index';
            header("Location: $UrlDestino");
        endif;        
        $UrlDestino = URL . 'controle-artigo/index';
        header("Location: $UrlDestino");
    }

}
