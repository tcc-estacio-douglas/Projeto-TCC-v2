<?php
if (isset($this->Dados[0])):
    $valorForm = $this->Dados[0];
    //var_dump($valorForm);
elseif (isset($this->Dados)):
    $valorForm = $this->Dados;
    //var_dump($valorForm);
endif;

?>
<div class="well">
    <div class="pull-right">
        <a href="<?php echo URL; ?>controle-empresa/index"><button type="button" class="btn btn-sm btn-success">Listar</button></a>
        <a href="<?php echo URL; ?>controle-empresa/visualizar/<?php echo $valorForm['id']; ?>"><button type="button" class="btn btn-sm btn-primary">Visualizar</button></a>
        <a href="<?php echo URL; ?>controle-empresa/apagar/<?php echo $valorForm['id']; ?>"><button type="button" class="btn btn-sm btn-danger">Apagar</button></a>
    </div>
    <div class="page-header">
        <h1>Editar Sobre Empresa</h1>
    </div>
    <H1></H1>
    <?php
    if (isset($_SESSION['msg'])):
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    endif;
    ?>
    <form name="EditEmpresa"  class="form-horizontal" action="" method="post" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?php
        if (isset($valorForm['id'])):
            echo $valorForm['id'];
        endif;
        ?>">


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
        
        <input type="hidden" name="foto_antiga" value="<?php
        if (!empty($valorForm['foto_antiga'])):
            echo $valorForm['foto_antiga'];
        elseif (isset($valorForm['foto'])):
            echo $valorForm['foto'];
        endif;
        ?>">

        <div class="form-group">
            <label class="col-sm-2 control-label">Imagem:</label>
            <div class="col-sm-10">
                <input type="file"  name="foto"/>
            </div>
        </div>

        <input type="hidden" name="modified" value="<?php echo date("Y-m-d H:i:s"); ?>">

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-warning" value="Editar" name="SendEditEmpresa">
            </div>
        </div>
    </form>
    <?php
    //var_dump($this->Dados);
    ?>
</div>