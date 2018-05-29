<div class="well">
    <div class="page-header">
        <h1>Cadastrar Categoria para Artigo</h1>
    </div>
    <?php
    if (isset($_SESSION['msg'])):
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    endif;
    ?>
    <form name="CadCatArtigo" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label class="col-sm-2 control-label">Nome:</label>
            <div class="col-sm-10">
                <input type="text"  class="form-control" name="nome_cat_artigo" placeholder="Nome da Categoria para Artigo">
            </div>
        </div>
        <input type="hidden" name="created" value="<?php echo date("Y-m-d H:i:s"); ?>">

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-sm btn-success" value="Cadastrar" name="SendCadCatArtigo">
            </div>
        </div>
    </form>
    <?php
    //var_dump($this->Dados);
    ?>
</div>