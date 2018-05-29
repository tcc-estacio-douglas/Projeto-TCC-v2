<?php

/**
 * Descricao de ModelsServicos
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class ModelsServicos {

    private $Resultado;
    private $ServicoId;
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
        $Listar->ExeRead('servicos');
        $this->Resultado = $Listar->getResultado();
        //var_dump($this->Resultado);
        return $this->Resultado;
    }
    
    public function visualizar($ServicoId) {
        $this->ServicoId = (int) $ServicoId;
        $Visulizar = new ModelsRead();
        $Visulizar->ExeRead('servicos', 'WHERE id =:id LIMIT :limit', "id={$this->ServicoId}&limit=1");
        $this->Resultado = $Visulizar->getResultado();
        $this->RowCount = $Visulizar->getRowCount();
        return $this->Resultado;
    }
    
    public function editar($ServicoId, array $Dados) {
        $this->ServicoId = (int) $ServicoId;
        $this->Dados = $Dados;
        $this->validarDados();
        if ($this->Resultado):
            $this->alterar();
        endif;
    }

    private function alterar() {
        $Update = new ModelsUpdate();
        $Update->ExeUpdate('servicos', $this->Dados, 'WHERE id =:id', "id={$this->Dados['id']}");
        if ($Update->getResultado()):
            $this->Resultado = true;
        else:
            $this->Resultado = false;
        endif;
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

}
