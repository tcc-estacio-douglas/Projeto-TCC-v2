<?php

/**
 * Descricao de ControleEmpresa
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class ControleEmpresa {
    
    private $Menu;
    private $Dados;
    private $EmpresaId;

    public function index() {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $ListarEmpresa = new ModelsEmpresa();
        $this->Dados = $ListarEmpresa->listar();

        $CarregarView = new ConfigView('empresa/listarEmpresa', $this->Menu, $this->Dados);
        $CarregarView->renderizar();
    }
    
    public function cadastrar() {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $CadEmpresa = new ModelsEmpresa();
        if (!empty($this->Dados['SendCadEmpresa'])):
            unset($this->Dados['SendCadEmpresa']);
            $this->Dados['foto'] = ($_FILES['foto'] ? $_FILES['foto'] : null);
            //var_dump($this->Dados);
            $CadEmpresa->cadastrar($this->Dados);
            if (!$CadEmpresa->getResultado()):
                $_SESSION['msg'] = "<div class='alert alert-danger'><b>Erro ao cadastrar: </b>Para cadastrar detalhes empresa preencha todos os campos!</div>";
            else:
                $_SESSION['msgcad'] = "<div class='alert alert-success'>Detalhes empresa cadastrado com sucesso!</div>";
                $UrlDestino = URL . 'controle-empresa/index';
                header("Location: $UrlDestino");
            endif;
        endif;

        $CarregarView = new ConfigView("empresa/cadastrarEmpresa", $this->Menu, $this->Dados);
        $CarregarView->renderizar();
    }
    
    public function visualizar($EmpresaId = null) {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->EmpresaId = (int) $EmpresaId;
        if (!empty($this->EmpresaId)):
            $VerEmpresa = new ModelsEmpresa();
            $this->Dados = $VerEmpresa->visualizar($this->EmpresaId);

            if ($VerEmpresa->getResultado()):
                $CarregarView = new ConfigView('empresa/visualizarEmpresa', $this->Menu, $this->Dados);
                $CarregarView->renderizar();
            else:
                $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário seleciona um detalhe empresa!</div>";
                $UrlDestino = URL . 'controle-empresa/index';
                header("Location: $UrlDestino");
            endif;
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário seleciona um detalhe empresa!</div>";
            $UrlDestino = URL . 'controle-empresa/index';
            header("Location: $UrlDestino");
        endif;
    }
    
    public function editar($EmpresaId = null) {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->EmpresaId = (int) $EmpresaId;
        if (!empty($this->EmpresaId)):
            $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $this->alterarPrivado();           
            
            $CarregarView = new ConfigView("empresa/editarEmpresa", $this->Menu, $this->Dados);
            $CarregarView->renderizar();
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um detalhe empresa</div>";
            $UrlDestino = URL . 'controle-empresa/index';
            header("Location: $UrlDestino");
        endif;
    }
    
    private function alterarPrivado() {
        if (!empty($this->Dados['SendEditEmpresa'])):
            unset($this->Dados['SendEditEmpresa']);
            $this->Dados['foto'] = ($_FILES['foto'] ? $_FILES['foto'] : null);
            $EditaEmpresa = new ModelsEmpresa();
            $EditaEmpresa->editar($this->EmpresaId, $this->Dados);
            if (!$EditaEmpresa->getResultado()):
                $_SESSION['msg'] = "<div class='alert alert-danger'>Para editar detalhe empresa preencha todos os campos!</div>";
            else:
                $_SESSION['msg'] = "<div class='alert alert-success'>Detalhe empresa editado com sucesso!</div>";
                $UrlDestino = URL . 'controle-empresa/visualizar/' . $this->EmpresaId;
                header("Location: $UrlDestino");
            endif;
        else:
            $VerEmpresa = new ModelsEmpresa();
            $this->Dados = $VerEmpresa->visualizar($this->EmpresaId);
            if ($VerEmpresa->getRowCount() <= 0):
                $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um detalhe empresa</div>";
                $UrlDestino = URL . 'controle-empresa/index';
                header("Location: $UrlDestino");
            endif;
        //var_dump($this->Dados);
        endif;
    }
    
    public function apagar($EmpresaId = null) {
        $this->EmpresaId = (int) $EmpresaId;
        if (!empty($this->EmpresaId)):
            $ApagarEmpresa = new ModelsEmpresa();
            $ApagarEmpresa->apagar($this->EmpresaId);
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um detalhe empresa!</div>";
            $UrlDestino = URL . 'controle-empresa/index';
            header("Location: $UrlDestino");
        endif;
        
        $UrlDestino = URL . 'controle-empresa/index';
        header("Location: $UrlDestino");
    }
}
