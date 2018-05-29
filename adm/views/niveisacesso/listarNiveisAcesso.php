<div class="well well-personalizado">

    <div class="page-header">
        <h1>Listar Niveis Acesso</h1>
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
        <a href="<?php echo URL; ?>controle-niveis-acesso/cadastrar"><button type="button" class="btn btn-sm btn-success">Cadastrar</button></a>
    </div>

    <?php
    if (!empty($this->Dados)):
        ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nivel de acesso</th>
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
                        <td><?php echo $nome_niveis_acesso; ?></td>
                        <td>
                            <a href="<?php echo URL; ?>controle-niveis-acesso/visualizar/<?php echo $id; ?>"><button type="button" class="btn btn-primary">Visualizar</button></a>

                            <a href="<?php echo URL; ?>controle-niveis-acesso/editar/<?php echo $id; ?>"><button type="button" class="btn btn-warning">Editar</button></a>

                            <a href="<?php echo URL; ?>controle-niveis-acesso/apagar/<?php echo $id; ?>"><button type="button" class="btn btn-danger">Apagar</button></a>
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

