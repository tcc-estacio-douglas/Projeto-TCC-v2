<?php

/**
 * Descricao de ModelsContato
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class ModelsContato {
    private $Resultado;
    private $ContatoId;
    private $Dados;
    private $Msg;
    private $RowCount;
    private $ResultadoPaginacao;

    function getResultado() {
        return $this->Resultado;
    }

    function getMsg() {
        return $this->Msg;
    }

    function getRowCount() {
        return $this->RowCount;
    }

    public function listar($PageId) {
        $Paginacao = new ModelsPaginacao(URL . 'controle-contato/index/');
        $Paginacao->condicao($PageId, 10);
        $this->ResultadoPaginacao = $Paginacao->paginacao('contatos');

        $Listar = new ModelsRead();
        $Listar->ExeRead('contatos', 'LIMIT :limit OFFSET :offset', "limit={$Paginacao->getLimiteResultado()}&offset={$Paginacao->getOffset()}");
        if ($Listar->getResultado()):
            $this->Resultado = $Listar->getResultado();
            return array($this->Resultado, $this->ResultadoPaginacao);
        else:
            //echo "Nenhum usuário encontrado<br>";
            $Paginacao->paginaInvalida();
        endif;
    }
    
    public function visualizar($ContatoId) {
        $this->ContatoId = (int) $ContatoId;
        $Visualizar = new ModelsRead();
        $Visualizar->ExeRead('contatos', 'WHERE id =:id LIMIT :limit', "id={$this->ContatoId}&limit=1");
        $this->Resultado = $Visualizar->getResultado();
        $this->RowCount = $Visualizar->getRowCount();
        return $this->Resultado;
    }
}
