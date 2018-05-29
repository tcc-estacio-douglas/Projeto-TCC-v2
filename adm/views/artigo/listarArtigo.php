<div class="well well-personalizado">

    <div class="page-header">
        <h1>Listar Artigos</h1>
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

    $paginacao = $this->Dados[1];
    $this->Dados = $this->Dados[0];
    ?>
    <div class="pull-right">
        <a href="<?php echo URL; ?>controle-artigo/cadastrar"><button type="button" class="btn btn-sm btn-success">Cadastrar</button></a>
    </div>
    <?php
    if (!empty($this->Dados)):
        ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th class="hidden-xs">Foto</th>
                    <th>Titulo</th>
                    <th class="hidden-xs">Categoria</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($this->Dados as $nivelAcesso) :
                    extract($nivelAcesso);
                    ?>               
                    <tr>
                        <td><?php echo $id; ?></td>
                        <td class="hidden-xs"><?php 
                        $imagem_artigo = URL . "assets/imagens/artigo/$id/$foto";
                        echo "<img src='$imagem_artigo' height='45' width='65' alt='$titulo_artigo'>";
                        ?></td>
                        <td><?php echo $titulo_artigo; ?></td>
                        <td class="hidden-xs"><?php echo $categorias_artigos; ?></td>
                        
                        <td>
                            <a href="<?php echo URL; ?>controle-artigo/visualizar/<?php echo $id; ?>"><button type="button" class="btn btn-primary">Visualizar</button></a>

                            <a href="<?php echo URL; ?>controle-artigo/editar/<?php echo $id; ?>"><button type="button" class="btn btn-warning">Editar</button></a>

                            <a href="<?php echo URL; ?>controle-artigo/apagar/<?php echo $id; ?>"><button type="button" class="btn btn-danger">Apagar</button></a>
                        </td>
                    </tr>

                    <?php
                endforeach;
                ?>
            </tbody>
        </table>
        <?php
    endif;
    echo $paginacao;

    //var_dump($this->Dados);
    ?>
</div>