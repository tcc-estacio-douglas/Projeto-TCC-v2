<div class="well">
    <div class="page-header">
        <h1>Cadastrar usuário</h1>
    </div>
    <?php
    if (isset($_SESSION['msg'])):
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    endif;

    if (isset($this->Dados[0])):
        $niveisAcessos = $this->Dados[0];
    //var_dump($niveisAcessos);
    endif;
    if (isset($this->Dados[1])):
        $situacaoUsers = $this->Dados[1];
    //var_dump($situacaoUsers);
    endif;
    if (isset($this->Dados[2])):
        $valorForm = $this->Dados[2];
    //var_dump($valorForm);
    endif;
    ?>
    <form name="CadUsuario" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label class="col-sm-2 control-label">Nome:</label>
            <div class="col-sm-10">
                <input type="text"  class="form-control" name="name" placeholder="Nome completo" value="<?php
    if (isset($valorForm['name'])): echo $valorForm['name'];
    endif;
    ?>"></div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">E-mail:</label>
            <div class="col-sm-10">
                <input type="email" class="form-control"  name="email" placeholder="Seu melhor e-mail" value="<?php
                if (isset($valorForm['email'])): echo $valorForm['email'];
                endif;
    ?>"></div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Senha:</label>
            <div class="col-sm-10">
                <input type="password"  class="form-control" name="password" placeholder="Senha"></div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 control-label">Foto:</label>
            <div class="col-sm-10">
                <input type="file"  name="foto"/>
            </div>
        </div>


        <div class="form-group">
            <label class="col-sm-2 control-label">Nivel Acesso:</label>
            <div class="col-sm-10">
                <select class="form-control" name="niveis_acesso_id">
                    <option value="">Selecione</option>
                    <?php
                    foreach ($niveisAcessos as $nivelAcesso):
                        extract($nivelAcesso);                                           
                        if($valorForm['niveis_acesso_id'] == $id):
                            $selecionado = "selected";
                        else:
                            $selecionado = "";
                        endif;
                        echo "<option value='$id' $selecionado>$nome_niveis_acesso</option>";
                    endforeach;
                    ?>
                </select> 
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 control-label">Situação Usuário:</label>
            <div class="col-sm-10">
                <select class="form-control" name="situacoes_user_id">
                    <option value="">Selecione</option>
                    <?php
                    foreach ($situacaoUsers as $situacaoUser):
                        extract($situacaoUser);                                       
                        if($valorForm['situacoes_user_id'] == $id):
                            $selecionado = "selected";
                        else:
                            $selecionado = "";
                        endif;
                        echo "<option value='$id' $selecionado>$nome_sit_user</option>";
                    endforeach;
                    ?>
                </select> 
            </div>
        </div>
        
        <input type="hidden" name="created" value="<?php echo date("Y-m-d H:i:s"); ?>">
        
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-sm btn-success" value="Cadastrar" name="SendCadUsuario">
            </div>
        </div>
    </form>
    <?php
    //var_dump($this->Dados);
    ?>
</div>