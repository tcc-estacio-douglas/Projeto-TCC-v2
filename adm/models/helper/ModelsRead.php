<?php

/**
 * Descricao de Creat.class
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class ModelsRead extends ModelsConn {

    private $Select;
    private $Values;
    private $Resultado;
    private $Msg;
    private $Query;
    private $Conn;

    public function ExeRead($Tabela, $Termos = null, $ParseString = null) {
        if (!empty($ParseString)):
            parse_str($ParseString, $this->Values);
        endif;

        $this->Select = "SELECT * FROM {$Tabela} {$Termos}";
        $this->ExecutarInstrucao();
    }

    public function getResultado() {
        return $this->Resultado;
    }

    public function getMsg() {
        return $this->Msg;
    }
    
    
    public function getRowCount() {
        return $this->Query->rowCount();
    }

    private function Conexao() {
        $this->Conn = parent::getConn();
        $this->Query = $this->Conn->prepare($this->Select);
        $this->Query->setFetchMode(PDO::FETCH_ASSOC);
    }

    private function getInstrucao() {
        if ($this->Values):
            foreach ($this->Values as $Link => $Valor):
                if ($Link == 'limit' || $Link == 'offset'):
                    $Valor = (int) $Valor;
                endif;
                $this->Query->bindValue(":{$Link}", $Valor, ( is_int($Valor) ? PDO::PARAM_INT : PDO::PARAM_STR));
            endforeach;
        endif;
    }

    private function ExecutarInstrucao() {
        $this->Conexao();
        try {
            $this->getInstrucao();
            $this->Query->execute();
            $this->Resultado = $this->Query->fetchAll();
        } catch (PDOException $e) {
            $this->Resultado = null;
            return "<b>Erro ao Ler:</b> {$e->getMessage()}";
        }
    }

}
