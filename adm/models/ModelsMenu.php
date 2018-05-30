<?php

class ModelsMenu {

    private $Resultado;
    private $PermissaoId;
    private $Dados;
    private $Msg;
    private $RowCount;
    private $NivelAcessoId;
    private $ResultPerMenor;
    private $DadosPerMenor;
    private $DadosPerMaior;

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
        $Listar->fullRead("SELECT
                met.nome_method, met.nome_menu,
                clas.nome_classe
                FROM permissoes per
                INNER JOIN methodos met ON met.id=per.methodo_id
                INNER JOIN classes clas ON clas.id=per.classe_id
                WHERE per.menu =:menu AND per.niveis_acesso_id=:niveis_acesso_id AND per.situacao_permissao=:situacao_permissao ORDER BY ordem ASC", "menu=1&niveis_acesso_id=" . $_SESSION['niveis_acesso_id'] . "&situacao_permissao=1");
        $this->Resultado = $Listar->getResultado();

        foreach ($this->Resultado as $key => $itemenu) {
            $this->Resultado[$key]['nome_method'] = $this->slugController($this->Resultado[$key]['nome_method']);
            $this->Resultado[$key]['nome_classe'] = $this->slugController($this->Resultado[$key]['nome_classe']);
        }

        return $this->Resultado;
    }

    private function slugController($SlugController) {
        //Contar qnt caracteres
        $num_caracteres = strlen($SlugController);

        $endereco = "";
        //Ler cada caracter da string
        for ($i = 0; $i < $num_caracteres; $i++) :
            //Verificar se não é a primeira letra, sendo a primeira não necessário verificar se a mesma é maiuscula
            if ($i <= 0):
                $endereco .= $SlugController[$i];
            else:
                //Converter o caracter para ASCII
                $letra = ord($SlugController[$i]);
                //se o código ASCII estiver entre 65 e 90, é maiusculo, necessário inserir o traço antes da letra, regra da URL
                if (($letra >= 65) AND ( $letra <= 90)):
                    $endereco .= "-" . $SlugController[$i];
                else:
                    $endereco .= $SlugController[$i];
                endif;
            endif;

        endfor;
        return strtolower($endereco);
    }

    public function visualizar($PermissaoId) {
        $this->PermissaoId = (int) $PermissaoId;
        $Visulizar = new ModelsRead();
        $Visulizar->ExeRead('permissoes', 'WHERE id =:id LIMIT :limit', "id={$this->PermissaoId}&limit=1");
        $this->Resultado = $Visulizar->getResultado();
        $this->RowCount = $Visulizar->getRowCount();
        return $this->Resultado;
    }

    public function editar($PermissaoId) {
        $this->PermissaoId = (int) $PermissaoId;
        $this->visualizar($this->PermissaoId);
        if ($this->Resultado):
            if ($this->Resultado[0]['menu'] == 2):
                $this->Dados = array('menu' => 1, 'modified' => date("Y-m-d H:i:s"));
            else:
                $this->Dados = array('menu' => 2, 'modified' => date("Y-m-d H:i:s"));
            endif;
            $this->alterar();
        endif;
    }

    private function alterar() {
        $Update = new ModelsUpdate();
        $Update->ExeUpdate('permissoes', $this->Dados, 'WHERE id =:id', "id={$this->PermissaoId}");
        if ($Update->getResultado()):
            $this->Resultado = true;
        else:
            $this->Resultado = false;
        endif;
    }

    public function listarMenuOrdem($NivelAcessoId) {
        $this->NivelAcessoId = (int) $NivelAcessoId;
        $Listar = new ModelsRead();
        $Listar->fullRead("SELECT per.id, per.situacao_permissao, per.menu, per.ordem,
                met.nome_method, met.nome_menu,
                clas.nome_classe
                FROM permissoes per
                INNER JOIN methodos met ON met.id=per.methodo_id
                INNER JOIN classes clas ON clas.id=per.classe_id
                WHERE per.niveis_acesso_id=:niveis_acesso_id ORDER BY ordem ASC", "niveis_acesso_id={$this->NivelAcessoId}");
        $this->Resultado = $Listar->getResultado();
        return $this->Resultado;
    }

    public function editarOrdem($PermissaoID) {
        $this->PermissaoId = (int) $PermissaoID;
        $this->visualizar($this->PermissaoId);
        if ($this->Resultado):
            //var_dump($this->Resultado);
            $this->visPerMenor();
            //var_dump($this->ResultPerMenor);
            $this->alterarOrdemMenu();
            if ($this->Resultado):
                $_SESSION['msg'] = "<div class='alert alert-success'>Ordem do item alterado com sucesso!</div>";
                $UrlDestino = URL . 'controle-menu/index/'.$this->ResultPerMenor[0]['niveis_acesso_id'];
                header("Location: $UrlDestino");
            else:
                $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um item de menu!</div>";
                $UrlDestino = URL . 'controle-menu/index/'.$this->ResultPerMenor[0]['niveis_acesso_id'];
                header("Location: $UrlDestino");
            endif;
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um item de menu!</div>";
            $UrlDestino = URL . 'controle-login/listar-classe-methodo';
            header("Location: $UrlDestino");
        endif;
    }

    private function visPerMenor() {
        $Visualizar = new ModelsRead();
        $ordem_num_menor = $this->Resultado[0]['ordem'] - 1;
        $Visualizar->ExeRead('permissoes', 'WHERE ordem =:ordem AND niveis_acesso_id =:niveis_acesso_id LIMIT :limit', "ordem=$ordem_num_menor&niveis_acesso_id={$this->Resultado[0]['niveis_acesso_id']}&limit=1");
        $this->ResultPerMenor = $Visualizar->getResultado();
        return $this->ResultPerMenor;
    }

    private function alterarOrdemMenu() {
        $Update = new ModelsUpdate();
        $this->DadosPerMenor = array('ordem' => $this->Resultado[0]['ordem'], 'modified' => date("Y-m-d H:i:s"));
        $Update->ExeUpdate('permissoes', $this->DadosPerMenor, "WHERE id =:id", "id={$this->ResultPerMenor[0]['id']}");
        if ($Update->getResultado()):
            $this->alterarOrdemMaior();
        else:
            $this->Resultado = false;
        endif;
    }

    private function alterarOrdemMaior() {
        $Update = new ModelsUpdate();
        $this->DadosPerMaior = array('ordem' => $this->ResultPerMenor[0]['ordem'], 'modified' => date("Y-m-d H:i:s"));
        $Update->ExeUpdate('permissoes', $this->DadosPerMaior, "WHERE id =:id", "id={$this->Resultado[0]['id']}");
        if ($Update->getResultado()):
            $this->Resultado = true;
        else:
            $this->Resultado = false;
        endif;
    }

}
