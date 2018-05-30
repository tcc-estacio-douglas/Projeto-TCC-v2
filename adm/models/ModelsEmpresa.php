<?php

class ModelsEmpresa {
    
    private $Resultado;
    private $EmpresaId;
    private $Dados;
    private $Msg;
    private $RowCount;
    
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
        $Listar->ExeRead('empresas');
        $this->Resultado = $Listar->getResultado();
        //var_dump($this->Resultado);
        return $this->Resultado;
    }
    
    public function cadastrar(array $Dados) {
        $this->Dados = $Dados;
        $this->validarDados();
        //var_dump($this->Dados);
        if ($this->Resultado):
            if (empty($this->Foto['name'])):
                $this->inserir();
            else:
                $SlugImagem = new ModelsValidacao();
                $SlugImagem->nomeSlug($this->Foto['name']);
                $this->Foto['name'] = $SlugImagem->getNome();
                $this->Dados['foto'] = $this->Foto['name'];
                $this->inserir();
                $UploadFoto = new ModelsUpload();
                $UploadFoto->upload($this->Foto, 'empresa/' . $this->Resultado . '/', $this->Dados['foto']);

            endif;
        endif;
    }
    
    private function inserir() {
        $Create = new ModelsCreate;
        $Create->ExeCreate('empresas', $this->Dados);
        if ($Create->getResultado()):
            $this->Resultado = $Create->getResultado();
        endif;
    }
    
    private function validarDados() {
        $this->Foto = $this->Dados['foto'];
        unset($this->Dados['foto']);
        //var_dump($this->Dados);
        $this->Dados = array_map('strip_tags', $this->Dados);
        $this->Dados = array_map('trim', $this->Dados);
        if (in_array('', $this->Dados)):
            $this->Resultado = false;
        else:
            $this->Resultado = true;
        endif;
    }
    
    public function visualizar($EmpresaId) {
        $this->EmpresaId = (int) $EmpresaId;
        $Visualizar = new ModelsRead();
        $Visualizar->ExeRead('empresas', 'WHERE id =:id LIMIT :limit', "id={$this->EmpresaId}&limit=1");
        $this->Resultado = $Visualizar->getResultado();
        $this->RowCount = $Visualizar->getRowCount();
        return $this->Resultado;
    }
    
    public function editar($EmpresaId, array $Dados) {
        $this->EmpresaId = (int) $EmpresaId;
        $this->Dados = $Dados;
        $this->EmpresaId = $this->Dados['id'];
        $this->Foto['foto_antiga'] = $this->Dados['foto_antiga'];
        unset($this->Dados['foto_antiga']);

        $this->validarDados();
        if ($this->Resultado):
            if (empty($this->Foto['name'])):
                $this->alterar();
            else:
                if (file_exists('assets/imagens/empresa/' . $this->EmpresaId . '/' . $this->Foto['foto_antiga'])):
                    unlink('assets/imagens/empresa/' . $this->EmpresaId . '/' . $this->Foto['foto_antiga']);
                endif;

                $SlugImagem = new ModelsValidacao();
                $SlugImagem->nomeSlug($this->Foto['name']);
                $this->Foto['name'] = $SlugImagem->getNome();
                $this->Dados['foto'] = $this->Foto['name'];

                $this->alterar();

                $UploadFoto = new ModelsUpload();
                $UploadFoto->upload($this->Foto, 'empresa/' . $this->EmpresaId . '/', $this->Dados['foto']);

            endif;
        endif;
    }
    
    private function alterar() {
        $Update = new ModelsUpdate();
        $Update->ExeUpdate('empresas', $this->Dados, "WHERE id = :id", "id={$this->EmpresaId }");
        if ($Update->getResultado()):
            $this->Resultado = true;
        else:
            $this->Resultado = false;
        endif;
    }
    
    public function apagar($EmpresaId) {
        $this->EmpresaId = (int) $EmpresaId;
        $this->Dados = $this->visualizar($this->EmpresaId);
        if ($this->getRowCount() >= 0):
            $ApagarEmpresa = new ModelsDelete();
            $ApagarEmpresa->ExeDelete('empresas', 'WHERE id =:id', "id={$this->EmpresaId}");

            if (file_exists('assets/imagens/empresa/' . $this->EmpresaId . '/' . $this->Dados[0]['foto'])):
                unlink('assets/imagens/empresa/' . $this->EmpresaId . '/' . $this->Dados[0]['foto']);
            endif;

            $_SESSION['msg'] = "<div class='alert alert-success'>Sobre a empresa apagado com sucesso!</div>";
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Sobre a empresa não foi apagado com sucesso!</div>";
        endif;
    }
    
}
