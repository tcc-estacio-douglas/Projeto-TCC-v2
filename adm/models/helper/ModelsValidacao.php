<?php

/**
 * Descricao de ModelsValidacao
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class ModelsValidacao {

    private $Nome;
    private $Formato;
    private $Dados;
    private $Resultado;

    function getResultado() {
        return $this->Resultado;
    }

    function getNome() {
        return $this->Nome;
    }

    public function nomeSlug($Nome) {
        $this->Nome = (string) $Nome;
        $this->Formato['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:,\\\'<>°ºª';
        $this->Formato['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                ';

        $this->Nome = strtr(utf8_decode($this->Nome), utf8_decode($this->Formato['a']), $this->Formato['b']);

        $this->Nome = strip_tags(trim($this->Nome));

        $this->Nome = str_replace(' ', '-', $this->Nome);
        $this->Nome = str_replace(array('-----', '----', '---', '--'), '-', $this->Nome);

        $this->Nome = strtolower(utf8_decode($this->Nome));

        //echo "Nome da Imagem com slug: {$this->Nome}<br>";
    }

    public function email($Email) {
        $this->Dados = (string) $Email;
        $this->Formato = '/[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\.\-]+\.[a-z]{2,4}$/';

        if (preg_match($this->Formato, $this->Dados)):
            $this->Resultado = true;
        else:
            $this->Resultado = false;
        endif;
    }

}
