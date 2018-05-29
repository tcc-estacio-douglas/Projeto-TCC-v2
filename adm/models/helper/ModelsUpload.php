<?php

/**
 * Descricao de ModelsUpload
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class ModelsUpload {

    private $Arquivo;
    private $Nome;
    private $Resultado;
    private $Msg;
    private static $Diretorio;
    private $Imagem;
    private $Folder;

    function getResultado() {
        return $this->Resultado;
    }

    function getMsg() {
        return $this->Msg;
    }

    function getNome() {
        return $this->Nome;
    }

    function __construct($Diretorio = null) {
        self::$Diretorio = ((string) $Diretorio ? $Diretorio : 'assets/imagens/');
        if (!file_exists(self::$Diretorio) && !is_dir(self::$Diretorio)):
            mkdir(self::$Diretorio, 0777);
        endif;
        //var_dump(self::$Diretorio);
    }

    public function upload(array $Imagem, $Folder, $Nome, $Diretorio = null) {
        $this->Arquivo = $Imagem;
        $this->Nome = (string) $Nome;
        self::$Diretorio = ((string) $Diretorio ? $Diretorio : 'assets/imagens/');
        $this->Folder = ((string) $Folder ? $Folder : '');
        $this->validarImagem();
        if ($this->Resultado):
            $this->moverArquivo();
        endif;
    }

    public function validarImagem() {
        switch ($this->Arquivo['type']):
            case 'image/jpeg';
            case 'image/pjpeg';
                $this->Imagem = imagecreatefromjpeg($this->Arquivo['tmp_name']);
                break;
            case 'image/png':
            case 'image/x-png';
                $this->Imagem = imagecreatefrompng($this->Arquivo['tmp_name']);
                break;
        endswitch;
        if (!$this->Imagem):
            $this->Resultado = false;
        //echo "Tipo de imagem inválida";
        else:
            $this->Resultado = true;
        //echo "Tipo de imagem válida";
        endif;
    }

    public function moverArquivo() {
        self::$Diretorio = self::$Diretorio . $this->Folder;
        //echo self::$Diretorio;
        if (!file_exists(self::$Diretorio) && !is_dir(self::$Diretorio)):
            mkdir(self::$Diretorio, 0777);
        endif;
        $this->realizarUpload();
    }

    private function realizarUpload() {
        if (move_uploaded_file($this->Arquivo['tmp_name'], self::$Diretorio . $this->Nome)):
            $this->Resultado = true;
        //echo "Upload realizado com sucesso";
        else:
            $this->Resultado = false;
        //echo "Erro ao realizar o upload";
        endif;
    }

}
