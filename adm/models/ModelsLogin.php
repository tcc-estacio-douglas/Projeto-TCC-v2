<?php

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
    private $MethodosValue;
    private $DadosOrdem;

    function getResultado() {
        return $this->Resultado;
    }

    function getMsg() {
        return $this->Msg;
    }

    function getRowCount() {
        return $this->RowCount;
    }

    public function listar($MethodoId = null) {
        $this->IdMethod = (int) $MethodoId;

        $Listar = new ModelsRead;
        if (!empty($this->IdMethod)):
            $Listar->fullRead("select per.*, cla.nome_classe classes, met.nome_method methodos, niv.nome_niveis_acesso niveis_acessos
            from permissoes per
            INNER JOIN classes cla on cla.id = per.classe_id
            INNER JOIN methodos met on met.id = per.methodo_id
            INNER JOIN niveis_acessos niv on niv.id = per.niveis_acesso_id
            WHERE per.methodo_id =:id_define_met
            ORDER BY met.id ASC, niv.id ASC", "id_define_met={$this->IdMethod}");
            $this->Resultado = $Listar->getResultado();
        else:
            $Listar->fullRead("select per.*, cla.nome_classe classes, met.nome_method methodos, niv.nome_niveis_acesso niveis_acessos
            from permissoes per
            INNER JOIN classes cla on cla.id = per.classe_id
            INNER JOIN methodos met on met.id = per.methodo_id
            INNER JOIN niveis_acessos niv on niv.id = per.niveis_acesso_id
            ORDER BY met.id ASC, niv.id ASC");

            $ListarNiveisAcesso = new ModelsRead();
            $ListarNiveisAcesso->ExeRead('niveis_acessos');

            $this->Resultado = array($Listar->getResultado(), $ListarNiveisAcesso->getResultado());

        endif;

        //var_dump($this->Resultado);
        return $this->Resultado;
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
                $this->MethodosValue = array('nome_menu' => $Methodo, 'modified' => date("Y-m-d H:i:s"));
                $this->complCadMethodo();
                $this->inserirPermissoes();
            else:
                $this->Dados = array('nome_method' => $Methodo, 'nome_menu' => $Methodo, 'classe_id' => $this->IdClasse, 'created' => date("Y-m-d H:i:s"));
                $this->cadastrarMethod($this->Dados);
                $this->IdMethod = $this->getResultado();
                //echo "Id do Méthod: {$this->IdMethod}<br>";
                $this->inserirPermissoes();
            endif;
        endforeach;
    }
    
    private function complCadMethodo() {
        if(empty($this->Dados[0]['nome_menu'])):
            $Update = new ModelsUpdate();
            $Update->ExeUpdate('methodos', $this->MethodosValue, "WHERE id =:id", "id={$this->IdMethod}");
        endif;
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
        $Visualizar->ExeRead("methodos", "WHERE nome_method = :pesquisa AND classe_id = :classe_id LIMIT :limit", "pesquisa={$this->Dados['nome_method']}&classe_id={$this->IdClasse}&limit=1");
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
            $Visualizar->ExeRead('permissoes', "WHERE classe_id = :classe_id AND methodo_id = :methodo_id AND niveis_acesso_id = :niveis_acesso_id LIMIT :limit", "classe_id={$this->IdClasse}&methodo_id={$this->IdMethod}&niveis_acesso_id=$id&limit=1");
            $this->Resultado = $Visualizar->getResultado();
            //var_dump($this->Resultado);
            $this->DadosOrdem = $id;
            if ($Visualizar->getResultado()):
                //echo "Já está cadastrado <br>";
                $this->inserirOrdem();
            else:
                $this->pesqMaiorOrdem();
                $this->Dados = array('classe_id' => $this->IdClasse, 'methodo_id' => $this->IdMethod, 'niveis_acesso_id' => $id, 'situacao_permissao' => $ValorSituacaoPermissao, 'ordem' => $this->DadosOrdem, 'created' => date("Y-m-d H:i:s"));
                $this->cadastrarPermissao();
            endif;
        }
    }
    
    private function inserirOrdem() {
        if(empty($this->Resultado[0]['ordem'])):
            $this->pesqMaiorOrdem();
            $this->DadosOrdem = array('ordem' => $this->DadosOrdem, 'modified' => date('Y-m-d H:i:s'));
            $Update = new ModelsUpdate();
            $Update->ExeUpdate('permissoes', $this->DadosOrdem, "WHERE id =:id", "id={$this->Resultado[0]['id']}");
        endif;
    }

    private function pesqMaiorOrdem() {
        $Visualizar = new ModelsRead();
        $Visualizar->ExeRead('permissoes', "WHERE niveis_acesso_id =:niveis_acesso_id ORDER BY ordem DESC LIMIT :limit", "niveis_acesso_id={$this->DadosOrdem}&limit=1");
        $this->DadosOrdem = $Visualizar->getResultado();
        $this->DadosOrdem = $this->DadosOrdem[0]['ordem'] + 1;
    }
    
    private function cadastrarPermissao() {
        $Create = new ModelsCreate();
        $Create->ExeCreate('permissoes', $this->Dados);
        if ($Create->getResultado()):
            $this->Resultado = $Create->getResultado();
            echo "Permissão cadastrada <br>";
        endif;
    }

    public function editarPermissoes($MethodId, array $Dados) {
        $this->IdMethod = (int) $MethodId;
        $this->Dados = $Dados;
        foreach ($this->Dados['nome'] as $id => $permissao) :
            $situacao_permissao = $permissao;
            $id_permissao = $id;
            $this->Methodos = array('situacao_permissao' => $situacao_permissao);
            $Update = new ModelsUpdate();
            $Update->ExeUpdate('permissoes', $this->Methodos, "WHERE id =:id", "id={$id_permissao}");
            if ($Update->getResultado()):
                $this->Resultado = true;
            else:
                $this->Resultado = false;
            endif;
        endforeach;
    }

    public function permitirAcesso($Classe, $Metodo) {
        $this->Classe = (string) $Classe;
        $this->Methodos = (string) $Metodo;
        if (isset($_SESSION['niveis_acesso_id'])):
            $niveis_acesso_id = $_SESSION['niveis_acesso_id'];
        else:
            $niveis_acesso_id = 2;
        endif;
        if ($niveis_acesso_id == 1):
            $this->Resultado = true;
        else:
            $Listar = new ModelsRead();
            $Listar->fullRead("select per.*, cla.nome_classe classes, met.nome_method methodos, niv.nome_niveis_acesso niveis_acessos  from permissoes per INNER JOIN classes cla on cla.id = per.classe_id INNER JOIN methodos met on met.id = per.methodo_id INNER JOIN niveis_acessos niv on niv.id = per.niveis_acesso_id WHERE cla.nome_classe =:nome_classe AND met.nome_method =:nome_method AND per.niveis_acesso_id =:niveis_acesso_id AND per.situacao_permissao =:situacao_permissao LIMIT :limit", "nome_classe={$this->Classe}&nome_method={$this->Methodos}&niveis_acesso_id=$niveis_acesso_id&situacao_permissao=1&limit=1");

            $this->Resultado = $Listar->getResultado();
            //var_dump($this->Resultado);
            if ($Listar->getResultado()):
                //echo "Acesso Liberado <br>";
                $this->Resultado = true;
            else:
                //echo "Acesso Bloqueado <br>";
                $this->Resultado = false;
            endif;
        endif;
    }

}
