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
        <a href="<?php echo URL; ?>controle-carousel/index"><button type="button" class="btn btn-sm btn-success">Listar</button></a>
        <a href="<?php echo URL; ?>controle-carousel/visualizar/<?php echo $valorForm['id']; ?>"><button type="button" class="btn btn-sm btn-primary">Visualizar</button></a>
        <a href="<?php echo URL; ?>controle-carousel/apagar/<?php echo $valorForm['id']; ?>"><button type="button" class="btn btn-sm btn-danger">Apagar</button></a>
    </div>
    <div class="page-header">
        <h1>Editar Carousel</h1>
    </div>
    <H1></H1>
    <?php
    if (isset($_SESSION['msg'])):
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    endif;
    ?>
    <form name="EditCarousel"  class="form-horizontal" action="" method="post" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?php
        if (isset($valorForm['id'])):
            echo $valorForm['id'];
        endif;
        ?>">

<div class="form-group">
            <label class="col-sm-2 control-label">Titulo:</label>
            <div class="col-sm-10">
                <input type="text"  class="form-control" name="titulo_carousel" placeholder="Nome do Carousel" value="<?php
                if (isset($valorForm['titulo_carousel'])): echo $valorForm['titulo_carousel'];
                endif;
                ?>">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 control-label">Link:</label>
            <div class="col-sm-10">
                <input type="text"  class="form-control" name="link" placeholder="Endereço da página de destino" value="<?php
                if (isset($valorForm['link'])): echo $valorForm['link'];
                endif;
                ?>">
            </div>
        </div>
        
        <input type="hidden" name="foto_antiga" value="<?php
        if (isset($valorForm['foto_antiga'])):
            echo $valorForm['foto_antiga'];
        elseif (isset($valorForm['foto'])):
            echo $valorForm['foto'];
        endif;
        ?>">

        <div class="form-group">
            <label class="col-sm-2 control-label">Foto:</label>
            <div class="col-sm-10">
                <input type="file"  name="foto"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Situação Carousel:</label>
            <div class="col-sm-10">
                <select class="form-control" name="situacao_carousel">
                    <option value="">Selecione</option>
                    <?php
                    if ($valorForm['situacao_carousel'] == 1):
                        echo "<option value='1' selected>Habilitado</option>";
                    else:
                        echo "<option value='1'>Habilitado</option>";
                    endif;
                    
                    if ($valorForm['situacao_carousel'] == 2):
                        echo "<option value='1' selected>Desabilitado</option>";
                    else:
                        echo "<option value='1'>Desabilitado</option>";
                    endif;
                    ?>
                </select> 
            </div>
        </div>




        <input type="hidden" name="modified" value="<?php echo date("Y-m-d H:i:s"); ?>">

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-warning" value="Editar" name="SendEditCarousel">
            </div>
        </div>
    </form>
    <?php
    //var_dump($this->Dados);
    ?>
</div>