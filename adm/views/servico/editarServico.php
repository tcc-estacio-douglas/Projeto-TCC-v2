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
        <a href="<?php echo URL; ?>controle-servicos/index"><button type="button" class="btn btn-sm btn-success">Listar</button></a>
        <a href="<?php echo URL; ?>controle-servicos/visualizar/<?php echo $valorForm['id']; ?>"><button type="button" class="btn btn-sm btn-primary">Visualizar</button></a>
    </div>
    <div class="page-header">
        <h1>Editar Serviço</h1>
    </div>
    <H1></H1>
    <?php
    if (isset($_SESSION['msg'])):
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    endif;
    ?>
    <form name="EditServico"  class="form-horizontal" action="" method="post" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?php
        if (isset($valorForm['id'])):
            echo $valorForm['id'];
        endif;
        ?>">


        <div class="form-group">
            <label class="col-sm-2 control-label">Nome do Serviço:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="nome_servico" placeholder="Nome do serviço prestado" value="<?php
                if (isset($valorForm['nome_servico'])):
                    echo $valorForm['nome_servico'];
                endif;
                ?>">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 control-label">Descrição do Serviço:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="descricao_servico" placeholder="Descrição do serviço prestado" value="<?php
                if (isset($valorForm['descricao_servico'])):
                    echo $valorForm['descricao_servico'];
                endif;
                ?>">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 control-label">Link:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="link" placeholder="Link da página de destino" value="<?php
                if (isset($valorForm['link'])):
                    echo $valorForm['link'];
                endif;
                ?>">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 control-label">Imagem do Serviço:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="imagem" placeholder="Nome do serviço prestado" value="<?php
                if (isset($valorForm['imagem'])):
                    echo $valorForm['imagem'];
                endif;
                ?>">
            </div>
        </div>
        

        <input type="hidden" name="modified" value="<?php echo date("Y-m-d H:i:s"); ?>">

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-warning" value="Editar" name="SendEditServico">
            </div>
        </div>
    </form>
    <?php
    //var_dump($this->Dados);
    ?>
</div>