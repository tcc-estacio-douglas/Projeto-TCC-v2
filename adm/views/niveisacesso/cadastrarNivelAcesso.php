<div class="well">
    <div class="page-header">
        <h1>Cadastrar Nivel Acesso</h1>
    </div>

    <form name="CadNivelAcesso" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label class="col-sm-2 control-label">Nome:</label>
            <div class="col-sm-10">
                <input type="text"  class="form-control" name="nome_niveis_acesso" placeholder="Nivel acesso" value="<?php
                //if (isset($valorForm['name'])): echo $valorForm['name'];
                //endif;
                ?>"></div>
        </div>

        <input type="hidden" name="created" value="<?php echo date("Y-m-d H:i:s"); ?>">

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-sm btn-success" value="Cadastrar" name="SendCadNivelAcesso">
            </div>
        </div>
    </form>
    <?php
    //var_dump($this->Dados);
    ?>
</div>