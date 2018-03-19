<?php

/**
 * Descrição de ModelsPaginacao
 *
 * @copyright (c) 2018, Douglas Caetano Lima
 */
class ModelsPaginacao {

    private $Link;
    private $MaxLink;
    private $Pagina;
    private $LimiteResultado;
    private $Offset;
    private $Tabela;
    private $Termos;
    private $ParseString;
    private $Rows;
    private $ResultadoPaginacao;
    
    function getPagina() {
        return $this->Pagina;
    }

    function getLimiteResultado() {
        return $this->LimiteResultado;
    }

    function getOffset() {
        return $this->Offset;
    }

    function getResultadoPaginacao() {
        return $this->ResultadoPaginacao;
    }
    
    function __construct($Link) {
        $this->Link = $Link;
        $this->MaxLink = 2;
        //echo "link {$this->Link}<br>";
    }

    public function condicao($Pagina, $LimiteResultado) {
        $this->Pagina = ((int) $Pagina ? $Pagina : 1);
        $this->LimiteResultado = (int) $LimiteResultado;
        $this->Offset = ($this->Pagina) * ($this->LimiteResultado) - $this->LimiteResultado;
        
//        echo "pagina atual {$this->Pagina}<br>";
//        echo "limite {$this->LimiteResultado}<br>";
//        echo "offset {$this->Offset}<br>";
    }
    
    public function paginaInvalida() {
        header("Location: {$this->Link}");
    }

    public function paginacao($Tabela, $Termos = null, $ParseString = null) {
        $this->Tabela = (string) $Tabela;
        $this->Termos = (string) $Termos;
        $this->ParseString = (string) $ParseString;
        $this->instrucao();
        return $this->ResultadoPaginacao;
    }

    // responsavl por criar a paginacao
    private function instrucao() {
        $Listar = new ModelsRead();
        $Listar->ExeRead($this->Tabela, $this->Termos, $this->ParseString);
        $this->Rows = $Listar->getRowCount();
        if ($this->Rows > $this->LimiteResultado):
            $this->instrucaoPaginacao();
        endif;
    }

    private function instrucaoPaginacao() {
        //echo "Quantidade de linhas {$this->Rows}<br>";
        $Paginas = ceil($this->Rows / $this->LimiteResultado);
        
        $this->validaQntLink($Paginas);
        //echo "Quantidade de paginas: {$Paginas}<br>";
        $this->ResultadoPaginacao = "<nav class='text-center'>";
        $this->ResultadoPaginacao .= "<ul class='pagination'>";
        $this->ResultadoPaginacao .= "<li><a href=\"{$this->Link}1\">Primeira</a></li>";
        
        for($iPag = $this->Pagina - $this->MaxLink; $iPag <= $this->Pagina - 1 ; $iPag ++):
            if($iPag >= 1):
                $this->ResultadoPaginacao .= "<li><a href=\"{$this->Link}{$iPag}\">{$iPag}</a></li>";
            endif;
        endfor;
            
        $this->ResultadoPaginacao .= "<li class='active'><a href=\"#\">{$this->Pagina}</a></li>";
        
        for($dPag = $this->Pagina + 1; $dPag <= $this->Pagina + $this->MaxLink; $dPag ++):
            if($dPag <= $Paginas):
                $this->ResultadoPaginacao .= "<li><a href=\"{$this->Link}{$dPag}\">{$dPag}</a></li>";
            endif;
        endfor;

        $this->ResultadoPaginacao .= "<li><a href=\"{$this->Link}{$Paginas}\">Última</a></li>";
        $this->ResultadoPaginacao .= "</ul></nav>";
        
        //echo $this->ResultadoPaginacao;
    }
    
    private function validaQntLink($Paginas) {
        if(($this->Pagina == 1) || ($this->Pagina == $Paginas)):
            $this->MaxLink = 4;
        elseif(($this->Pagina == 2) || ($this->Pagina == $Paginas - 1)):
            $this->MaxLink = 3;
        endif;
    }
}
