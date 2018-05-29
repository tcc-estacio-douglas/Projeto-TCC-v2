<?php
if (isset($this->Dados[0])):
    $valorForm = $this->Dados[0];
//var_dump($valorForm);
elseif (isset($this->Dados)):
    $valorForm = $this->Dados;
endif;
?>
<div class="well">
    <div class="pull-right">
        <a href="<?php echo URL; ?>controle-usuario/ver-perfil"><button type="button" class="btn btn-sm btn-primary">Visualizar</button></a>
    </div>
    <div class="page-header">
        <h1>Editar Perfil</h1>
    </div>
    <H1></H1>
    <?php
    if (isset($_SESSION['msg'])):
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    endif;
    ?>
    <form name="CadUsuario"  class="form-horizontal" action="" method="post" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?php
        if (isset($valorForm['id'])):
            echo $valorForm['id'];
        endif;
        ?>">


        <div class="form-group">
            <label class="col-sm-2 control-label">Nome:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" placeholder="Nome completo" value="<?php
                if (isset($valorForm['name'])):
                    echo $valorForm['name'];
                endif;
                ?>">
            </div>
        </div>



        <div class="form-group">
            <label class="col-sm-2 control-label">E-mail:</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" name="email" placeholder="Seu melhor e-mail" value="<?php
                if (isset($valorForm['email'])):
                    echo $valorForm['email'];
                endif;
                ?>">
            </div>
        </div>



        <div class="form-group">
            <label class="col-sm-2 control-label">Senha:</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" name="password" placeholder="Senha">

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


        <input type="hidden" name="modified" value="<?php echo date("Y-m-d H:i:s"); ?>">

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-warning" value="Editar" name="SendEditUsuario">
            </div>
        </div>
    </form>
    <?php
    //var_dump($this->Dados);
    ?>
</div>