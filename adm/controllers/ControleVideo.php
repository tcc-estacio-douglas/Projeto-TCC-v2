<?php

/**
 * Descricao de ControleVideo
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class ControleVideo {
    
    private $Menu;
    private $VideoId;
    private $Dados;
    
    public function visualizar($VideoId = null) {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->VideoId = (int) $VideoId;
        if (!empty($this->VideoId)):
            $VerVideo = new ModelsVideo();
            $this->Dados = $VerVideo->visualizar($this->VideoId);

            if ($VerVideo->getResultado()):
                $CarregarView = new ConfigView('video/visualizarVideo', $this->Menu, $this->Dados);
                $CarregarView->renderizar();
            else:
                $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário seleciona um Vídeo!</div>";
                $UrlDestino = URL . 'controle-video/visualizar/1';
                header("Location: $UrlDestino");
            endif;
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário seleciona um Vídeo!</div>";
            $UrlDestino = URL . 'controle-video/visualizar/1';
            header("Location: $UrlDestino");
        endif;
    }
    
    public function editar($VideoId = null) {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->VideoId  = (int) $VideoId ;
        if (!empty($this->VideoId )):
            $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $this->alterarPrivado();
            $verVideo = new ModelsVideo();
            $this->Dados = $verVideo->visualizar($this->VideoId );
            $CarregarView = new ConfigView('video/editarVideo', $this->Menu, $this->Dados);
            $CarregarView->renderizar();

        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um Vídeo!</div>";
            $UrlDestino = URL . 'controle-video/visualizar/1';
            header("Location: $UrlDestino");
        endif;
    }
    
    private function alterarPrivado() {
        if (!empty($this->Dados['SendEditVideo'])):
            unset($this->Dados['SendEditVideo']);
            //var_dump($this->Dados);
            $EditaVideo = new ModelsVideo();
            $EditaVideo->editar($this->VideoId, $this->Dados);
            if (!$EditaVideo->getResultado()):
                $_SESSION['msg'] = "<div class='alert alert-danger'>Para editar vídeo preencha todos os campos!</div>";
            else:
                $_SESSION['msgcad'] = "<div class='alert alert-success'>Vídeo editado com sucesso!</div>";
                $UrlDestino = URL . 'controle-video/visualizar/1';
                header("Location: $UrlDestino");
            endif;
        else:
            $VerVideo = new ModelsVideo();
            $this->Dados = $VerVideo->visualizar($this->VideoId);
            if ($VerVideo->getRowCount() <= 0):
                $_SESSION['msgcad'] = "<div class='alert alert-danger'>Necessário selecionar um Vídeo</div>";
                $UrlDestino = URL . 'controle-video/visualizar/1';
                header("Location: $UrlDestino");
            endif;
        endif;
    }
    
}
