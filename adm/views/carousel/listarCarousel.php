<div class="well well-personalizado">

    <div class="page-header">
        <h1>Listar Carousel</h1>
    </div>

    <?php
    if (isset($_SESSION['msg'])):
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    endif;
    if (isset($_SESSION['msgcad'])):
        echo $_SESSION['msgcad'];
        unset($_SESSION['msgcad']);
    endif;

    ?>

    <div class="pull-right">
        <a href="<?php echo URL; ?>controle-carousel/cadastrar"><button type="button" class="btn btn-sm btn-success">Cadastrar</button></a>
    </div>

    <?php
    if (!empty($this->Dados)):
        ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagem</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($this->Dados as $carousel) :
                    extract($carousel);
                    ?>               
                    <tr>
                        <td><?php echo $id; ?></td>
                        <td><?php echo $titulo_carousel; ?></td>
                        <td><?php 
                        $imagem_carousel = URL . "assets/imagens/carousel/$id/$foto";
                        echo "<img src='$imagem_carousel' height='45' width='180' alt='$titulo_carousel'>"; 
                        
                        ?></td>
                        <td>
                            <a href="<?php echo URL; ?>controle-carousel/visualizar/<?php echo $id; ?>"><button type="button" class="btn btn-primary">Visualizar</button></a>

                            <a href="<?php echo URL; ?>controle-carousel/editar/<?php echo $id; ?>"><button type="button" class="btn btn-warning">Editar</button></a>

                            <a href="<?php echo URL; ?>controle-carousel/apagar/<?php echo $id; ?>"><button type="button" class="btn btn-danger">Apagar</button></a>
                        </td>
                    </tr>

                    <?php
                endforeach;
                ?>
            </tbody>
        </table>
        <?php
    else:
        echo "<div class='alert alert-danger'>Nenhum carousel encontrado!</div>";
    endif;
    //var_dump($this->Dados);
    ?>
</div>

