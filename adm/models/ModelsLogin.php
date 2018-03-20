<?php

/**
 * Descricao de ModelsLogin
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class ModelsLogin {

    private $Dados;
    private $Resultado;
    private $Msg;
    private $RowCount;
    private $Diretorio;
    private $Classe;
    private $IdClasse;
    private $Methodos;
    private $NiveisAcesso;
    private $IdMethod;

    function getResultado() {
        return $this->Resultado;
    }

    function getMsg() {
        return $this->Msg;
    }

    function getRowCount() {
        return $this->RowCount;
    }

    public function logar(array $Dados) {
        $this->Dados = $Dados;
        $this->validar();
        if ($this->Resultado):
            $Visulizar = new ModelsRead();
            $Visulizar->ExeRead('users', 'WHERE email =:email AND password =:password LIMIT :limit', "email={$this->Dados['email']}&password={$this->Dados['password']}&limit=1");
            if ($Visulizar->getRowCount() > 0):
                //var_dump($Visulizar->getResultado());
                $this->Resultado = $Visulizar->getResultado();
            else:
                $this->Resultado = false;
                $this->Msg = "<div class='alert alert-danger'>Login ou senha incorreto!</div>";
            endif;
        endif;
    }

    public function validar() {
        $this->Dados = array_map('strip_tags', $this->Dados);
        $this->Dados = array_map('trim', $this->Dados);
        if (in_array('', $this->Dados)):
            $this->Dados['password'] = md5($this->Dados['password']);
            $this->Resultado = false;
            $this->Msg = "<div class='alert alert-danger'>Login ou senha incorreto!</div>";
        else:
            $this->Dados['password'] = md5($this->Dados['password']);
            $this->Resultado = true;
        endif;
    }

    public function cadastrarClasse() {
        $this->listarNiveisAcesso();
        //var_dump($this->NiveisAcesso);
        //echo "Listar Classe<br>";
        $this->Diretorio = "controllers/";
        foreach (new DirectoryIterator($this->Diretorio) as $Classe) {
            if (($Classe != ".") && ($Classe != "..")):
                $this->validarClasse($Classe);
            endif;
        }
    }

    private function validarClasse($Classe) {
        $this->Classe = str_replace(".php", "", $Classe);
        echo "Classe: $this->Classe <br>";
        $this->Dados = array('nome_classe' => $this->Classe);
        //var_dump($this->Dados);
        $this->visualizarClasse($this->Dados);
        if ($this->getResultado()):
            //var_dump($VerClasse->getResultado());
            $this->Dados = $this->getResultado();
            $this->IdClasse = $this->Dados[0]['id'];
        //echo "ID da classe no bd: $this->Id <br>";
        else:
            //echo "Classe não está registrad no BD <br>";
            $this->Dados = array('nome_classe' => $this->Classe, 'created' => date("Y-m-d H:i:s"));
            //var_dump($this->Dados);
            $this->inserirClasse($this->Dados);
            $this->IdClasse = $this->getResultado();
        //echo "O id cadastrado: {$this->Id}<br>";
        endif;
        $this->cadastrarMethodo();
        echo "<hr>";
    }

    private function cadastrarMethodo() {
        $this->Methodos = get_class_methods($this->Classe);
        foreach ($this->Methodos as $Methodo) :
            //echo "Método encontrado: $Methodo <br>";

            $this->Dados = array('nome_method' => $Methodo);
            $this->visualizarMethod($this->Dados);

            if ($this->getResultado()):
                $this->Dados = $this->getResultado();
                $this->IdMethod = $this->Dados[0]['id'];
                //echo "Id do Méthod: {$this->IdMethod}<br>";
                //var_dump($this->Dados);
                $this->inserirPermissoes();
            else:
                $this->Dados = array('nome_method' => $Methodo, 'classe_id' => $this->IdClasse, 'created' => date("Y-m-d H:i:s"));
                $this->cadastrarMethod($this->Dados);
                $this->IdMethod = $this->getResultado();
                //echo "Id do Méthod: {$this->IdMethod}<br>";
                $this->inserirPermissoes();
            endif;
        endforeach;
    }

    private function visualizarClasse($Dados) {
        $this->Dados = $Dados;
        //var_dump($this->Dados);
        $Visualizar = new ModelsRead();
        $Visualizar->ExeRead("classes", "WHERE nome_classe = :pesquisa LIMIT :limit", "pesquisa={$this->Dados['nome_classe']}&limit=1");
        $this->Resultado = $Visualizar->getResultado();
        //var_dump($this->Resultado);
    }

    private function inserirClasse(array $Dados) {
        $this->Dados = $Dados;
        $Create = new ModelsCreate();
        $Create->ExeCreate('classes', $this->Dados);
        if ($Create->getResultado()):
            $this->Resultado = $Create->getResultado();
            echo "Classe cadastrar com sucesso <br>";
        endif;
    }

    private function cadastrarMethod($Dados) {
        $this->Dados = $Dados;
        //var_dump($this->Dados);
        $Create = new ModelsCreate();
        $Create->ExeCreate('methodos', $this->Dados);
        if ($Create->getResultado()):
            $this->Resultado = $Create->getResultado();
        endif;
    }

    private function visualizarMethod($Dados) {
        $this->Dados = $Dados;
        //var_dump($this->Dados);
        $Visualizar = new ModelsRead();
        $Visualizar->ExeRead("methodos", "WHERE nome_method = :pesquisa AND classe_id =:classe_id LIMIT :limit", "pesquisa={$this->Dados['nome_method']}&classe_id={$this->IdClasse}&limit=1");
        $this->Resultado = $Visualizar->getResultado();
    }

    private function listarNiveisAcesso() {
        $Visualizar = new ModelsRead();
        $Visualizar->ExeRead("niveis_acessos");
        $this->NiveisAcesso = $Visualizar->getResultado();
    }

    private function inserirPermissoes() {
        //echo "Classe para a permissão: {$this->IdClasse} <br>";
        //echo "Method para a permissão: {$this->IdMethod} <br";        
        //var_dump($this->NiveisAcesso);

        foreach ($this->NiveisAcesso as $NivelAcesso) {
            extract($NivelAcesso);
            //echo "Nivel de acesso: $id <br>";
            if ($id == 1):
                $ValorSituacaoPermissao = 1;
            else:                
                $ValorSituacaoPermissao = 2;
            endif;

            $Visualizar = new ModelsRead();
            $Visualizar->ExeRead('permissoes', "WHERE classe_id =:classe_id AND methodo_id =:methodo_id AND niveis_acesso_id =:niveis_acesso_id LIMIT :limit", "classe_id={$this->IdClasse}&methodo_id={$this->IdMethod}&niveis_acesso_id=$id&limit=1");
            $this->Resultado = $Visualizar->getResultado();
            //var_dump($this->Resultado);
            if ($Visualizar->getResultado()):
                echo "Já está cadastrado <br>";
            else:
                $this->Dados = array('classe_id' => $this->IdClasse, 'methodo_id' => $this->IdMethod, 'niveis_acesso_id' => $id, 'situacao_permissao' => $ValorSituacaoPermissao, 'created' => date("Y-m-d H:i:s"));
                $this->cadastrarPermissao();
            endif;
        }
    }

    private function cadastrarPermissao() {
        $Create = new ModelsCreate();
        $Create->ExeCreate('permissoes', $this->Dados);
        if ($Create->getResultado()):
            $this->Resultado = $Create->getResultado();
            echo "Permissão cadastrada <br>";
        endif;
    }

}
