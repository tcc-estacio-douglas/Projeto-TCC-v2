<?php

class ModelsMethodo {

    private $Resultado;
    private $MethodoId;
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
    
    private function validarDados() {
        $this->Dados = array_map('strip_tags', $this->Dados);
        $this->Dados = array_map('trim', $this->Dados);
        if (in_array('', $this->Dados)):
            $this->Resultado = false;
        else:
            $this->Resultado = true;
        endif;
    }
        
    public function visualizar($MethodoId) {
        $this->MethodoId = (int) $MethodoId;
        $Visulizar = new ModelsRead();
        $Visulizar->ExeRead('methodos', 'WHERE id =:id LIMIT :limit', "id={$this->MethodoId}&limit=1");
        $this->Resultado = $Visulizar->getResultado();
        $this->RowCount = $Visulizar->getRowCount();
        return $this->Resultado;
    }
    
    public function editar($MethodoId, array $Dados) {
        $this->MethodoId = (int) $MethodoId;
        $this->Dados = $Dados;
        $this->validarDados();
        if ($this->Resultado):
            $this->alterar();
        endif;
    }
    
    private function alterar() {
        $Update = new ModelsUpdate();
        $Update->ExeUpdate('methodos', $this->Dados, 'WHERE id =:id', "id={$this->Dados['id']}");
        if ($Update->getResultado()):
            $this->Resultado = true;
        else:
            $this->Resultado = false;
        endif;
    }

}
