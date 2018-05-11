<?php

/**
 * Descrição de ControleCarousel
 *
 * @copyright (c) 2018, Douglas Caetano Lima
 */
class ModelsCarousel {

    private $Resultado;
    private $CarrouselId;
    private $Dados;
    private $Msg;
    private $RowCount;
    private $Foto;

    function getResultado() {
        return $this->Resultado;
    }

    function getMsg() {
        return $this->Msg;
    }

    function getRowCount() {
        return $this->RowCount;
    }

    public function listar() {
        $Listar = new ModelsRead();
        $Listar->ExeRead('carousels');
        $this->Resultado = $Listar->getResultado();
        return $this->Resultado;
    }

    public function cadastrar(array $Dados) {
        $this->Dados = $Dados;
        $this->ValidarDados();
        if ($this->Resultado):
            if (empty($this->Foto['name'])):
                $this->inserir();
            else:
                $SlugImagem = new ModelsValidacao();
                $SlugImagem->nomeSlug($this->Foto['name']);
                $this->Foto['name'] = $SlugImagem->getNome();
                $this->Dados['foto'] = $this->Foto['name'];
                //var_dump($this->Dados);  

                $this->inserir();

                $UploadFoto = new ModelsUpload();
                $UploadFoto->upload($this->Foto, 'carousel/' . $this->Resultado . '/', $this->Dados['foto']);

            endif;
        endif;
    }

    private function inserir() {
        $Create = new ModelsCreate;
        $Create->ExeCreate('carousels', $this->Dados);
        if ($Create->getResultado()):
            $this->Resultado = $Create->getResultado();
        endif;
    }

    private function validarDados() {
        $this->Foto = $this->Dados['foto'];
        $this->Foto['foto_antiga'] = $this->Dados['foto_antiga'];
        unset($this->Dados['foto'], $this->Dados['foto_antiga']);
        //var_dump($this->Dados);
        $this->Dados = array_map('strip_tags', $this->Dados);
        $this->Dados = array_map('trim', $this->Dados);
        if (in_array('', $this->Dados)):
            $this->Resultado = false;
        else:
            $this->Resultado = true;
        endif;
    }

    public function visualizar($CarouselId) {
        $this->CarrouselId = (int) $CarouselId;
        $Visualizar = new ModelsRead();
        $Visualizar->ExeRead('carousels', 'WHERE id =:id LIMIT :limit', "id={$this->CarrouselId}&limit=1");
        $this->Resultado = $Visualizar->getResultado();
        $this->RowCount = $Visualizar->getRowCount();
        return $this->Resultado;
    }

    public function editar($CarouselId, array $Dados) {
        $this->CarrouselId = (int) $CarouselId;
        $this->Dados = $Dados;
        $this->CarrouselId = $this->Dados['id'];

        $this->validarDados();
        if ($this->Resultado):
            if (empty($this->Foto['name'])):
                $this->alterar();
            else:
                if (file_exists('assets/imagens/carousel/' . $this->CarrouselId . '/' . $this->Foto['foto_antiga'])):
                    unlink('assets/imagens/carousel/' . $this->CarrouselId . '/' . $this->Foto['foto_antiga']);
                endif;

                $SlugImagem = new ModelsValidacao();
                $SlugImagem->nomeSlug($this->Foto['name']);
                $this->Foto['name'] = $SlugImagem->getNome();
                $this->Dados['foto'] = $this->Foto['name'];

                $this->alterar();

                $UploadFoto = new ModelsUpload();
                $UploadFoto->upload($this->Foto, 'carousel/' . $this->CarrouselId . '/', $this->Dados['foto']);
            endif;
        endif;
    }

    private function alterar() {
        $Update = new ModelsUpdate();
        $Update->ExeUpdate('carousels', $this->Dados, 'WHERE id =:id', "id={$this->CarrouselId}");
        if ($Update->getResultado()):
            $this->Resultado = true;
        else:
            $this->Resultado = false;
        endif;
    }

    public function apagar($CarouselId) {
        $this->CarrouselId = (int) $CarouselId;
        $this->Dados = $this->visualizar($this->CarrouselId);
        if ($this->getRowCount() >= 0):
            $ApagarCarousel = new ModelsDelete();
            $ApagarCarousel->ExeDelete('carousels', 'WHERE id =:id', "id={$this->CarrouselId}");

            if (file_exists('assets/imagens/carousel/' . $this->CarrouselId . '/' . $this->Dados[0]['foto'])):
                unlink('assets/imagens/carousel/' . $this->CarrouselId . '/' . $this->Dados[0]['foto']);
            endif;

            $_SESSION['msg'] = "<div class='alert alert-success'>Carousel apagado com sucesso!</div>";
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Carousel não foi apagado com sucesso!</div>";
        endif;
    }

}
