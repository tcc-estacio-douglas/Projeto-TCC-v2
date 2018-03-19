<div class="well">
    <div class="page-header">
        <h1>Editar Usuário</h1>
    </div>

    <?php
    if (isset($this->Dados[0]['msg'])) {
        echo $this->Dados[0]['msg'];
    } elseif (isset($this->Dados['msg'])) {
        echo $this->Dados['msg'];
    }
    ?>
    <form class="form-horizontal" name="CadUsuario" action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label class="col-sm-2 control-label">Nome:</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="name" placeholder="Nome completo" value="<?php
                if (isset($this->Dados[0]['name'])) {
                    echo $this->Dados[0]['name'];
                } elseif (isset($this->Dados['name'])) {
                    echo $this->Dados['name'];
                }
                ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">E-mail:</label>
            <div class="col-sm-10">
                <input class="form-control" type="email" name="email" placeholder="E-mail principal" value="<?php
                if (isset($this->Dados[0]['email'])) {
                    echo $this->Dados[0]['email'];
                } elseif (isset($this->Dados['email'])) {
                    echo $this->Dados['email'];
                }
                ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Senha:</label>
            <div class="col-sm-10">
                <input class="form-control" type="password" name="password" placeholder="Senha">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input class="btn btn-warning" type="submit" value="Editar" name="SendEditUsuario">
            </div>
        </div>
    </form>

</div>
