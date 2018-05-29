<?php

/**
 * Descricao de Contato
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class Contato {

    private $Dados;

    public function index() {

        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['SendCadMsgContato'])):
            unset($this->Dados['SendCadMsgContato']);
            $CadContato = new modelsContatoHome();
            $CadContato->cadastrar($this->Dados);
            if ($CadContato->getResultado()):
                $_SESSION['msg'] = "<div class='alert alert-success'>Mensagem enviada com sucesso!</div>";
                unset($this->Dados['nome_cliente'], $this->Dados['email_cliente'], $this->Dados['comentario_contato']);
            endif;
        else:
            $this->Dados = null;
        endif;

        $CarregarView = new ConfigView('contato/contato', $this->Dados);
        $CarregarView->renderizar();
    }

}
