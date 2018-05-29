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
        <a href="<?php echo URL; ?>controle-video/visualizar/<?php echo $valorForm['id']; ?>"><button type="button" class="btn btn-sm btn-primary">Visualizar</button></a>
    </div>
    <div class="page-header">
        <h1>Editar Vídeo</h1>
    </div>
    <H1></H1>
    <?php
    if (isset($_SESSION['msg'])):
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    endif;
    ?>
    <form name="EditVideo"  class="form-horizontal" action="" method="post" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?php
        if (isset($valorForm['id'])):
            echo $valorForm['id'];
        endif;
        
        ?>">

        
        <div class="form-group">
            <label class="col-sm-2 control-label">Embed Vídeo:</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="3" name="url"> <?php
                if (isset($valorForm['url'])):
                    echo $valorForm['url'];
                endif;
                ?></textarea>
            </div>
        </div>   

        <input type="hidden" name="modified" value="<?php echo date("Y-m-d H:i:s"); ?>">

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-warning" value="Editar" name="SendEditVideo">
            </div>
        </div>
    </form>
    <?php
    //var_dump($this->Dados);
    ?>
</div>