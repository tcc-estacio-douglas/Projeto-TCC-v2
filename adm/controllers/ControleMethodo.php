<?php

/**
 * Descricao de ControleMethodo
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class ControleMethodo {
    
    private $Menu;
    private $Dados;
    private $MethodoId;
        
    public function editar($MethodoId = null) {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        
        $this->MethodoId = (int) $MethodoId;
        if (!empty($this->MethodoId)):
            $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $this->alterarPrivado();
            $verMethodo = new ModelsMethodo();
            $this->Dados = $verMethodo->visualizar($this->MethodoId);
            $CarregarView = new ConfigView('methodo/editarMethodo', $this->Menu, $this->Dados);
            $CarregarView->renderizar();

        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um item de menu!</div>";
            $UrlDestino = URL . 'controle-login/listar-classe-methodo';
            header("Location: $UrlDestino");
        endif;
    }
    
    private function alterarPrivado() {
        if (!empty($this->Dados['SendEditMethodo'])):
            unset($this->Dados['SendEditMethodo']);
            $Editamethodo = new ModelsMethodo();
            $Editamethodo->editar($this->MethodoId, $this->Dados);
            if (!$Editamethodo->getResultado()):
                $_SESSION['msg'] = "<div class='alert alert-danger'>Para editar o nome do menu preencha todos os campos!</div>";
            else:
                $_SESSION['msgcad'] = "<div class='alert alert-success'>O nome do menu editado com sucesso!</div>";
                $UrlDestino = URL . 'controle-login/listar-classe-methodo';
                header("Location: $UrlDestino");
            endif;
        else:
            $VerMethodo = new ModelsMethodo();
            $this->Dados = $VerMethodo->visualizar($this->MethodoId);
            if ($VerMethodo->getRowCount() <= 0):
                $_SESSION['msgcad'] = "<div class='alert alert-danger'>Necessário selecionar uma categoria de artigo</div>";
                $UrlDestino = URL . 'controle-login/listar-classe-methodo';
                header("Location: $UrlDestino");
            endif;
        endif;
    }
}
