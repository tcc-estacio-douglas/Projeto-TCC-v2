<?php

/**
 * Descricao de ControleUsuario
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class ControleUsuario {

    private $Dados;
    private $UserId;

    public function index() {
        $ListarUsuarios = new ModelsUsuario();
        $this->Dados = $ListarUsuarios->listar();
        $CarregarView = new ConfigView("usuario/listarUsuario", $this->Dados);
        $CarregarView->renderizar();
    }

    public function cadastrar() {
        $Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($Dados['SendCadUsuario'])):
            unset($Dados['SendCadUsuario']);

            $CadUsuario = new ModelsUsuario();
            $CadUsuario->cadastrar($Dados);
            if (!$CadUsuario->getResultado()):
                $Dados['msg'] = $CadUsuario->getMsg();
            else:
                $Dados['msg'] = $CadUsuario->getMsg();
                $UrlDestino = URL . 'controle-usuario/index';
                header("Location: $UrlDestino");
            endif;

        else:
            $Dados = null;
        endif;

        $CarregarView = new ConfigView("usuario/cadastrarUsuario", $Dados);
        $CarregarView->renderizar();
    }

    public function visualizar($UserId = null) {
        $this->UserId = (int) $UserId;
        if (!empty($this->UserId)):
            $VerUsuario = new ModelsUsuario();
            $this->Dados = $VerUsuario->visualizar($UserId);
            $CarregarView = new ConfigView("usuario/visualizarUsuario", $this->Dados);
            $CarregarView->renderizar();
        else:
            $_SESSION['msg'] = "Necessário selecionar um usuário<br>";
            $UrlDestino = URL . 'controle-usuario/index';
            header("Location: $UrlDestino");
        endif;
    }

    public function editar($UserId = null) {
        $this->UserId = (int) $UserId;
        if (!empty($this->UserId)):
            $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $this->alterar();
            $CarregarView = new ConfigView("usuario/editarUsuario", $this->Dados);
            $CarregarView->renderizar();
        else:
            $_SESSION['msg'] = "Necessário selecionar um usuário<br>";
            $UrlDestino = URL . 'controle-usuario/index';
            header("Location: $UrlDestino");
        endif;
    }

    private function alterar() {
        if (!empty($this->Dados['SendEditUsuario'])):
            unset($this->Dados['SendEditUsuario']);
            $EditaUsuario = new ModelsUsuario();
            $EditaUsuario->editar($this->UserId, $this->Dados);
            if (!$EditaUsuario->getResultado()):
                $this->Dados['msg'] = $EditaUsuario->getMsg();
            else:
                $this->Dados['msg'] = $EditaUsuario->getMsg();
                $UrlDestino = URL . 'controle-usuario/visualizar/' . $this->UserId;
                header("Location: $UrlDestino");
            endif;
        else:
            $VerUsuario = new ModelsUsuario();
            $this->Dados = $VerUsuario->visualizar($this->UserId);
            if($VerUsuario->getRowCount() <= 0):
                $_SESSION['msg'] = "Necessário selecionar um usuário<br>";
                $UrlDestino = URL . 'controle-usuario/index';
                header("Location: $UrlDestino");
            endif;
            //var_dump($this->Dados);
        endif;
    }

    public function apagar($UserId = null) {
        $this->UserId = (int) $UserId;
        if (!empty($this->UserId)):
            echo "Usuário a ser apagado: {$this->UserId}<br>";
            $ApagarUsuario = new ModelsUsuario();
            $ApagarUsuario->apagar($this->UserId);
        else:
            $_SESSION['msg'] = "Necessário selecionar um usuário<br>";
        endif;

        $UrlDestino = URL . 'controle-usuario/index';
        header("Location: $UrlDestino");
    }

}
