<?php

class ControleServicos {
    
    private $Menu;
    private $Dados;
    private $ServicoId;

    public function index() {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $ListarServicos = new ModelsServicos();
         $this->Dados = $ListarServicos->listar();
        
        $CarregarView = new ConfigView('servico/listarServico', $this->Menu, $this->Dados);
        $CarregarView->renderizar();
    }
    
    public function visualizar($ServicoId = null) {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->ServicoId = (int) $ServicoId;
        if (!empty($this->ServicoId)):
            $VerServico = new ModelsServicos();
            $this->Dados = $VerServico->visualizar($this->ServicoId);

            if ($VerServico->getResultado()):
                $CarregarView = new ConfigView('servico/visualizarServico', $this->Menu, $this->Dados);
                $CarregarView->renderizar();
            else:
                $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário seleciona um serviço!</div>";
                $UrlDestino = URL . 'controle-servico/index';
                header("Location: $UrlDestino");
            endif;
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário seleciona um serviço!</div>";
            $UrlDestino = URL . 'controle-servico/index';
            header("Location: $UrlDestino");
        endif;
    }
    
    public function editar($ServicoId = null) {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->ServicoId = (int) $ServicoId;
        if (!empty($this->ServicoId)):
            $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $this->alterarPrivado();
            $verServico= new ModelsServicos();
            $this->Dados = $verServico->visualizar($this->ServicoId);
            $CarregarView = new ConfigView('servico/editarServico', $this->Menu, $this->Dados);
            $CarregarView->renderizar();

        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um serviço!</div>";
            $UrlDestino = URL . 'controle-servicos/index';
            header("Location: $UrlDestino");
        endif;
    }

    private function alterarPrivado() {
        if (!empty($this->Dados['SendEditServico'])):
            unset($this->Dados['SendEditServico']);
            $EditaServico = new ModelsServicos();
            $EditaServico->editar($this->ServicoId, $this->Dados);
            if (!$EditaServico->getResultado()):
                $_SESSION['msg'] = "<div class='alert alert-danger'>Para editar serviço preencha todos os campos!</div>";
            else:
                $_SESSION['msgcad'] = "<div class='alert alert-success'>Serviço editado com sucesso!</div>";
                $UrlDestino = URL . 'controle-servicos/index';
                header("Location: $UrlDestino");
            endif;
        else:
            $VerServico = new ModelsServicos();
            $this->Dados = $VerServico->visualizar($this->ServicoId);
            if ($VerServico->getRowCount() <= 0):
                $_SESSION['msgcad'] = "<div class='alert alert-danger'>Necessário selecionar um serviço</div>";
                $UrlDestino = URL . 'controle-servicos/index';
                header("Location: $UrlDestino");
            endif;
        endif;
    }
}
