<div class="well">
    <div class="page-header">
        <h1>Cadastrar usuário</h1>
    </div>
    <?php
    if (isset($_SESSION['msg'])):
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    endif;
    ?>
    <form name="CadUsuario" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label class="col-sm-2 control-label">Nome:</label>
            <div class="col-sm-10">
                <input type="text"  class="form-control" name="name" placeholder="Nome completo" value="<?php
                if (isset($this->Dados)): echo $this->Dados['name'];
                endif;
                ?>"></div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">E-mail:</label>
            <div class="col-sm-10">
                <input type="email" class="form-control"  name="email" placeholder="Seu melhor e-mail" value="<?php
                if (isset($this->Dados)): echo $this->Dados['email'];
                endif;
                ?>"></div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Senha:</label>
            <div class="col-sm-10">
                <input type="password"  class="form-control" name="password" placeholder="Senha"></div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-sm btn-success" value="Cadastrar" name="SendCadUsuario">
            </div>
        </div>
    </form>
</div>