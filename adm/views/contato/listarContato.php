<div class="well">

    <div class="page-header">
        <h1>Listar Mensagens de Contato</h1>
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
    
    if (!empty($this->Dados)):
        ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th class="hidden-xs">E-mail</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($this->Dados as $contato) {
                    extract($contato);
                    ?>               
                    <tr>
                        <td><?php echo $id; ?></td>
                        <td><?php echo $nome_cliente; ?></td>
                        <td class="hidden-xs"><?php echo $email_cliente; ?></td>
                        <td>
                            <a href="<?php echo URL; ?>controle-contato/visualizar/<?php echo $id; ?>"><button type="button" class="btn btn-primary">Visualizar</button></a>
                        </td>
                    </tr>

                    <?php
                }
                ?>
            </tbody>
        </table>
        <?php
    endif;
    echo $paginacao;
    ?>
</div>

