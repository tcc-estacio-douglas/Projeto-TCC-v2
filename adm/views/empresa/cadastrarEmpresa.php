<div class="well">
    <div class="page-header">
        <h1>Cadastrar Sobre Empresa</h1>
    </div>
    <?php
    if (isset($_SESSION['msg'])):
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    endif;

    if (isset($this->Dados)):
        $valorForm = $this->Dados;
    //var_dump($valorForm);
    endif;
    ?>
    <form name="CadEmpresa" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label class="col-sm-2 control-label">Titulo:</label>
            <div class="col-sm-10">
                <input type="text"  class="form-control" name="titulo_empresa" placeholder="Titulo sobre Empresa" value="<?php
                if (isset($valorForm['titulo_empresa'])): echo $valorForm['titulo_empresa'];
                endif;
                ?>">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 control-label">Descrição:</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="3" name="descricao_empresa"> <?php
                if (isset($valorForm['descricao_empresa'])):
                    echo $valorForm['descricao_empresa'];
                endif;
                ?></textarea>
            </div>
        </div> 
        

        <div class="form-group">
            <label class="col-sm-2 control-label">Imagem:</label>
            <div class="col-sm-10">
                <input type="file"  name="foto"/>
            </div>
        </div>

        <input type="hidden" name="created" value="<?php echo date("Y-m-d H:i:s"); ?>">

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-sm btn-success" value="Cadastrar" name="SendCadEmpresa">
            </div>
        </div>
    </form>
    <?php
    //var_dump($this->Dados);
    ?>
</div>