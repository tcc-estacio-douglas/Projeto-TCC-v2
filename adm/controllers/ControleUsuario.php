<?php

class ControleUsuario {

    private $Menu;
    private $Dados;
    private $UserId;
    private $PageId;

    public function index($PageId = null) {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->PageId = ((int) $PageId ? $PageId : 1);
        //echo "Número da página: {$this->PageId}<br>";

        $ListarUsuarios = new ModelsUsuario();
        $this->Dados = $ListarUsuarios->listar($this->PageId);
        $CarregarView = new ConfigView("usuario/listarUsuario", $this->Menu, $this->Dados);
        $CarregarView->renderizar();
    }

    public function cadastrar() {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $CadUsuario = new ModelsUsuario();
        if (!empty($this->Dados['SendCadUsuario'])):
            unset($this->Dados['SendCadUsuario']);
            $this->Dados['foto'] = ($_FILES['foto'] ? $_FILES['foto'] : null);
            //var_dump($this->Dados);
            $CadUsuario->cadastrar($this->Dados);
            if (!$CadUsuario->getResultado()):
                $_SESSION['msg'] = "<div class='alert alert-danger'><b>Erro ao cadastrar: </b>Para cadastrar o usuário preencha todos os campos!</div>";
            else:
                $_SESSION['msgcad'] = "<div class='alert alert-success'>Usuário cadastrado com sucesso!</div>";
                $UrlDestino = URL . 'controle-usuario/index';
                header("Location: $UrlDestino");
            endif;
        endif;

        $Registros = $CadUsuario->listarCadastrar();
        $this->Dados = array($Registros[0], $Registros[1], $this->Dados);
        $CarregarView = new ConfigView("usuario/cadastrarUsuario", $this->Menu, $this->Dados);
        $CarregarView->renderizar();
    }

    public function visualizar($UserId = null) {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->UserId = (int) $UserId;
        if (!empty($this->UserId)):
            $VerUsuario = new ModelsUsuario();
            $this->Dados = $VerUsuario->visualizar($UserId);

            if ($VerUsuario->getResultado()):
                $CarregarView = new ConfigView("usuario/visualizarUsuario", $this->Menu, $this->Dados);
                $CarregarView->renderizar();
            else:
                $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário seleciona um Usuário!</div>";
                $UrlDestino = URL . 'controle-usuario/index';
                header("Location: $UrlDestino");
            endif;

        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário seleciona um Usuário!</div>";
            $UrlDestino = URL . 'controle-usuario/index';
            header("Location: $UrlDestino");
        endif;
    }

    public function verPerfil() {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->UserId = (int) $_SESSION['id'];
        if (!empty($this->UserId)):
            $VerUsuario = new ModelsUsuario();
            $this->Dados = $VerUsuario->visualizar($this->UserId);
            if ($VerUsuario->getResultado()):
                $CarregarView = new ConfigView('usuario/verPerfil', $this->Menu, $this->Dados);
                $CarregarView->renderizar();
            else:
                $_SESSION['msg'] = "<div class='alert alert-danger'>Area Restrita!</div>";
                $UrlDestino = URL . 'controle-login/login';
                header("Location: $UrlDestino");
            endif;
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Area Restrita!</div>";
            $UrlDestino = URL . 'controle-login/login';
            header("Location: $UrlDestino");
        endif;
    }

    public function editar($UserId = null) {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->UserId = (int) $UserId;
        if (!empty($this->UserId)):
            $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $this->alterarPrivado();

            $EditaUsuario = new ModelsUsuario();
            $Registros = $EditaUsuario->listarCadastrar();
            //var_dump($Registros);
            $this->Dados = array($Registros[0], $Registros[1], $this->Dados);
            $CarregarView = new ConfigView("usuario/editarUsuario", $this->Menu, $this->Dados);
            $CarregarView->renderizar();
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um usuário</div>";
            $UrlDestino = URL . 'controle-usuario/index';
            header("Location: $UrlDestino");
        endif;
    }

    private function alterarPrivado() {
        if (!empty($this->Dados['SendEditUsuario'])):
            unset($this->Dados['SendEditUsuario']);
            $this->Dados['foto'] = ($_FILES['foto'] ? $_FILES['foto'] : null);
            $EditaUsuario = new ModelsUsuario();
            $EditaUsuario->editar($this->UserId, $this->Dados);
            if (!$EditaUsuario->getResultado()):
                $_SESSION['msg'] = "<div class='alert alert-danger'>Para editar o usuário preencha todos os campos!</div>";
            else:
                $_SESSION['msg'] = "<div class='alert alert-success'>Usuário editado com sucesso!</div>";
                $UrlDestino = URL . 'controle-usuario/visualizar/' . $this->UserId;
                header("Location: $UrlDestino");
            endif;
        else:
            $VerUsuario = new ModelsUsuario();
            $this->Dados = $VerUsuario->visualizar($this->UserId);
            if ($VerUsuario->getRowCount() <= 0):
                $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um usuário</div>";
                $UrlDestino = URL . 'controle-usuario/index';
                header("Location: $UrlDestino");
            endif;
        //var_dump($this->Dados);
        endif;
    }

    public function editarPerfil() {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->UserId = (int) $_SESSION['id'];
        if (!empty($this->UserId)):
            $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $this->alterarPerfilPrivado();

            $CarregarView = new ConfigView("usuario/editarPerfil", $this->Menu, $this->Dados);
            $CarregarView->renderizar();
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Area restrita</div>";
            $UrlDestino = URL . 'controle-login/login';
            header("Location: $UrlDestino");
        endif;
    }

    private function alterarPerfilPrivado() {
        if (!empty($this->Dados['SendEditUsuario'])):
            unset($this->Dados['SendEditUsuario']);
            $this->Dados['foto'] = ($_FILES['foto'] ? $_FILES['foto'] : null);
            $EditarUsuario = new ModelsUsuario();
            $EditarUsuario->editar($this->UserId, $this->Dados);
            if (!$EditarUsuario->getResultado()):
                $_SESSION['msg'] = "<div class='alert alert-danger'>Para editar necessário preencher todos os campos</div>";
            else:
                $AtualizarSessao = new ModelsUsuario();
                $AtualizarSessao->atualizaSessao($this->UserId);
                $_SESSION['msg'] = "<div class='alert alert-success'>Dados editado com sucesso</div>";
                $UrlDestino = URL . 'controle-usuario/ver-perfil';
                header("Location: $UrlDestino");
            endif;
        else:
            $VerUsuario = new ModelsUsuario();
            $this->Dados = $VerUsuario->visualizar($this->UserId);
        endif;
    }

    public function apagar($UserId = null) {
        $this->UserId = (int) $UserId;
        if (!empty($this->UserId)):
            echo "Usuário a ser apagado: {$this->UserId}<br>";
            $ApagarUsuario = new ModelsUsuario();
            $ApagarUsuario->apagar($this->UserId);
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um usuário</div>";
        endif;

        $UrlDestino = URL . 'controle-usuario/index';
        header("Location: $UrlDestino");
    }

}
