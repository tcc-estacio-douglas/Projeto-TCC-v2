<?php

class ControleCatArtigo {
    
    private $Menu;
    private $PostId;
    private $Dados;
    private $CatArtigoId;
    
    public function index($PageId = null) {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->PostId = ((int) $PageId ? $PageId : 1);
        $ListarCatArtigo = new ModelsCatArtigo();
        $this->Dados = $ListarCatArtigo->listar($this->PostId);

        $CarregarView = new ConfigView('catartigos/listarCatArtigo', $this->Menu, $this->Dados);
        $CarregarView->renderizar();
    }
    
    public function cadastrar() {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty(($this->Dados['SendCadCatArtigo']))):
            unset($this->Dados['SendCadCatArtigo']);
            $CadCatArtigo = new ModelsCatArtigo();
            $CadCatArtigo->cadastrar($this->Dados);
            if ($CadCatArtigo->getResultado()):
                $_SESSION['msgcad'] = "<div class='alert alert-success'>Categoria para Artigo cadastrado com sucesso!</div>";
                $UrlDestino = URL . 'controle-cat-artigo/index';
                header("Location: $UrlDestino");
            else:
                $_SESSION['msg'] = "<div class='alert alert-danger'>Para cadastrar a categoria de artigo preencha todos os campos!</div>";
            endif;
        endif;
        $CarregarView = new ConfigView('catartigos/cadastrarCatArtigo', $this->Menu);
        $CarregarView->renderizar();
    }
    
    public function visualizar($CatArtigoId = null) {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->CatArtigoId = (int) $CatArtigoId;
        if (!empty($this->CatArtigoId)):
            $VerCatArtigo = new ModelsCatArtigo();
            $this->Dados = $VerCatArtigo->visualizar($this->CatArtigoId);

            if ($VerCatArtigo->getResultado()):
                $CarregarView = new ConfigView('catartigos/visualizarCatArtigo', $this->Menu, $this->Dados);
                $CarregarView->renderizar();
            else:
                $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário seleciona uma categoria de artigo!</div>";
                $UrlDestino = URL . 'controle-cat-artigo/index';
                header("Location: $UrlDestino");
            endif;
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário seleciona uma categoria de artigo!</div>";
            $UrlDestino = URL . 'controle-cat-artigo/index';
            header("Location: $UrlDestino");
        endif;
    }
    
    public function editar($CatArtigoId = null) {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->CatArtigoId = (int) $CatArtigoId;
        if (!empty($this->CatArtigoId)):
            $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $this->alterarPrivado();
            $verCatArtigo = new ModelsCatArtigo();
            $this->Dados = $verCatArtigo->visualizar($this->CatArtigoId);
            $CarregarView = new ConfigView('catartigos/editarCatArtigo', $this->Menu, $this->Dados);
            $CarregarView->renderizar();

        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar uma categoria de artigo!</div>";
            $UrlDestino = URL . 'controle-cat-artigo/index';
            header("Location: $UrlDestino");
        endif;
    }
    
    private function alterarPrivado() {
        if (!empty($this->Dados['SendEditCatArtigo'])):
            unset($this->Dados['SendEditCatArtigo']);
            $EditaCatArtigo = new ModelsCatArtigo();
            $EditaCatArtigo->editar($this->CatArtigoId, $this->Dados);
            if (!$EditaCatArtigo->getResultado()):
                $_SESSION['msg'] = "<div class='alert alert-danger'>Para editar categoria de artigo preencha todos os campos!</div>";
            else:
                $_SESSION['msgcad'] = "<div class='alert alert-success'>Categoria de artigo editado com sucesso!</div>";
                $UrlDestino = URL . 'controle-cat-artigo/index';
                header("Location: $UrlDestino");
            endif;
        else:
            $VerCatArtigo = new ModelsCatArtigo();
            $this->Dados = $VerCatArtigo->visualizar($this->CatArtigoId);
            if ($VerCatArtigo->getRowCount() <= 0):
                $_SESSION['msgcad'] = "<div class='alert alert-danger'>Necessário selecionar uma categoria de artigo</div>";
                $UrlDestino = URL . 'controle-cat-artigo/index';
                header("Location: $UrlDestino");
            endif;
        endif;
    }
    
    public function apagar($CatArtigoId = null) {
        $this->CatArtigoId = (int) $CatArtigoId;
        if (!empty($this->CatArtigoId)):
            $ApagarCatArtigo = new ModelsCatArtigo();
            $ApagarCatArtigo->apagar($this->CatArtigoId);
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar uma categoria de artigo!</div>";
            $UrlDestino = URL . 'controle-cat-artigo/index';
            header("Location: $UrlDestino");
        endif;
        
        $UrlDestino = URL . 'controle-cat-artigo/index';
        header("Location: $UrlDestino");
    }
    
}
