<div class="well">
    <div class="page-header">
        <h1>Cadastrar Carousel</h1>
    </div>
    <?php
    if (isset($_SESSION['msg'])):
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    endif;
    ?>
    <form name="CadCarousel" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
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
        
        <div class="form-group">
            <label class="col-sm-2 control-label">Tamanho da Imagem:</label>
            <div class="col-sm-10">
                1902 x 448
            </div>
        </div>

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
                        echo "<option value='2' selected>Desabilitado</option>";
                    else:
                        echo "<option value='2'>Desabilitado</option>";
                    endif;
                    ?>
                </select> 
            </div>
        </div>


        <input type="hidden" name="created" value="<?php echo date("Y-m-d H:i:s"); ?>">

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-sm btn-success" value="Cadastrar" name="SendCadCarousel">
            </div>
        </div>
    </form>
    <?php
    //var_dump($this->Dados);
    ?>
</div>
