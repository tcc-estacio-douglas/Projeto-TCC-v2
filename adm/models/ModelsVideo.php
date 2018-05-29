<?php

/**
 * Descricao de ModelsVideo
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class ModelsVideo {
    private $VideoId;
    private $Resultado;
    private $RowCount;

    function getResultado() {
        return $this->Resultado;
    }

    function getRowCount() {
        return $this->RowCount;
    }
    
    public function visualizar($VideoId) {
        $this->VideoId = (int) $VideoId;
        $Visulizar = new ModelsRead();
        $Visulizar->ExeRead('videos', 'WHERE id =:id LIMIT :limit', "id={$this->VideoId}&limit=1");
        $this->Resultado = $Visulizar->getResultado();
        $this->RowCount = $Visulizar->getRowCount();
        return $this->Resultado;
    }
    
    public function editar($VideoId, array $Dados) {
        $this->VideoId = (int) $VideoId;
        $this->Dados = $Dados;
        $this->validarDados();
        if ($this->Resultado):
            $this->alterar();
        endif;
    }
    
     private function alterar() {
        $Update = new ModelsUpdate();
        $Update->ExeUpdate('videos', $this->Dados, 'WHERE id =:id', "id={$this->Dados['id']}");
        if ($Update->getResultado()):
            $this->Resultado = true;
        else:
            $this->Resultado = false;
        endif;
    }
    
    private function validarDados() {
        $this->Dados = array_map('trim', $this->Dados);
        if (in_array('', $this->Dados)):
            $this->Resultado = false;
        else:
            $this->Resultado = true;
        endif;
    }
}
