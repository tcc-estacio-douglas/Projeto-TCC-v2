<?php

class ControleCarousel {
    private $Menu;
    private $Dados;
    private $CarouselId;

    public function index() {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $ListarCarousel = new ModelsCarousel();
        $this->Dados = $ListarCarousel->listar();
        $CarregarView = new ConfigView("carousel/listarCarousel", $this->Menu, $this->Dados);
        $CarregarView->renderizar();
    }

    public function cadastrar() {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if ($this->Dados['SendCadCarousel']):
            unset($this->Dados['SendCadCarousel']);
            $this->Dados['foto'] = ($_FILES['foto'] ? $_FILES['foto'] : null);
            $CadCarousel = new ModelsCarousel();
            $CadCarousel->cadastrar($this->Dados);

            if ($CadCarousel->getResultado()):
                $_SESSION['msgcad'] = "<div class='alert alert-success'>Carousel cadastrado com sucesso!</div>";
                $UrlDestino = URL . 'controle-carousel/index';
                header("Location: $UrlDestino");
            else:
                $_SESSION['msg'] = "<div class='alert alert-danger'>Para cadastrar o carousel preencha todos os campos!</div>";
            endif;
        endif;

        $CarregarView = new ConfigView("carousel/cadastrarCarousel", $this->Menu);
        $CarregarView->renderizar();
    }

    public function visualizar($CarouselId = null) {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->CarouselId = (int) $CarouselId;
        if (!empty($this->CarouselId)):
            $VerCarousel = new ModelsCarousel();
            $this->Dados = $VerCarousel->visualizar($this->CarouselId);

            if ($VerCarousel->getResultado()):
                $CarregarView = new ConfigView("carousel/visualizarCarousel", $this->Menu, $this->Dados);
                $CarregarView->renderizar();
            else:
                $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário seleciona um carousel!</div>";
                $UrlDestino = URL . 'controle-carousel/index';
                header("Location: $UrlDestino");
            endif;
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário seleciona um carousel!</div>";
            $UrlDestino = URL . 'controle-carousel/index';
            header("Location: $UrlDestino");
        endif;
    }

    public function editar($CarouselId = null) {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->CarouselId = (int) $CarouselId;
        if (!empty($this->CarouselId)):
            $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            $this->alterarPrivado();

            $CarregarView = new ConfigView("carousel/editarCarousel", $this->Menu, $this->Dados);
            $CarregarView->renderizar();
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um Carousel</div>";
            $UrlDestino = URL . 'controle-carousel/index';
            header("Location: $UrlDestino");
        endif;
    }

    private function alterarPrivado() {
        if (!empty($this->Dados['SendEditCarousel'])):
            unset($this->Dados['SendEditCarousel']);
            $this->Dados['foto'] = ($_FILES['foto'] ? $_FILES['foto'] : null);
            $EditarCarousel = new ModelsCarousel();
            $EditarCarousel->editar($this->CarouselId, $this->Dados);
            if (!$EditarCarousel->getResultado()):
                $_SESSION['msg'] = "<div class='alert alert-danger'>Para editar o carousel preencha todos os campos!</div>";
            else:
                $_SESSION['msg'] = "<div class='alert alert-success'>Carousel editado com sucesso!</div>";
                $UrlDestino = URL . 'controle-carousel/visualizar/' . $this->CarouselId;
                header("Location: $UrlDestino");
            endif;

        else:
            $VerCarousel = new ModelsCarousel();
            $this->Dados = $VerCarousel->visualizar($this->CarouselId);
            if ($VerCarousel->getRowCount() <= 0):
                $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um Carousel</div>";
                $UrlDestino = URL . 'controle-carousel/index';
                header("Location: $UrlDestino");
            endif;
        endif;
    }

    public function apagar($CarouselId = null) {
        $this->CarouselId = (int) $CarouselId;
        if (!empty($this->CarouselId)):
            $ApagarCarousel = new ModelsCarousel();
            $ApagarCarousel->apagar($this->CarouselId);
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um Carousel</div>";
        endif;
        $UrlDestino = URL . 'controle-carousel/index';
        header("Location: $UrlDestino");
    }

}
