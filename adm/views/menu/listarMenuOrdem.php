<div class="well well-personalizado">

    <div class="page-header">
        <h1>Listar Ordem do Menu</h1>
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

    if (isset($this->Dados)):
        $Menus = $this->Dados;
    endif;
    ?>

    <div class="pull-right">
        <a href="<?php echo URL; ?>controle-login/listar-classe-methodo"><button type="button" class="btn btn-sm btn-primary">Permissões</button></a>
    </div>

    <?php
    if (!empty($this->Dados)):
        ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="hidden-xs">ID</th>
                    <th class="hidden-xs">Classe</th>
                    <th class="hidden-xs">Método</th>
                    <th>Página</th>
                    <th class="hidden-xs">Status</th>
                    <th class="hidden-xs">Status Menu</th>
                    <th>Ordem</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $qnt_linhas_exe = 1;
                foreach ($Menus as $Menu) :
                    extract($Menu);
                    $nome_permissao = ($situacao_permissao == 1 ) ? "<span class='label label-success'>Liberado</span>" : "<span class='label label-danger'>Bloqueado</span>";

                    $menu = ($menu == 1 ) ? "<a href='" . URL . "controle-menu/editar/$id'><button type='button' class='btn btn-xs btn-success'>Menu</button></a>" : "<a href='" . URL . "controle-menu/editar/$id'><button type='button' class='btn btn-xs btn-danger'>Menu</button></a>";
                    ?>               
                    <tr>
                        <td class="hidden-xs"><?php echo $id; ?></td>
                        <td class="hidden-xs"><?php echo $nome_classe; ?></td>
                        <td class="hidden-xs"><?php echo $nome_method; ?></td>
                        <td><?php echo $nome_menu; ?></td>
                        <td class="hidden-xs"><?php echo $nome_permissao; ?></td>
                        <td class="hidden-xs"><?php echo $menu; ?></td>
                        <td><?php echo $ordem; ?></td>
                        <td>
                            <?php
                            if ($qnt_linhas_exe == 1):
                                echo "<button type='button' class='btn btn-xs btn-info'>";
                                echo "<span class='glyphicon glyphicon-arrow-up'></span>";
                                echo "</button>";
                            else:
                                echo "<a href='".URL."controle-menu/editarOrdem/$id'><button type='button' class='btn btn-xs btn-info'>";
                                echo "<span class='glyphicon glyphicon-arrow-up'></span>";
                                echo "</button></a>";
                            endif;
                            ?>
                        </td>
                    </tr>

                    <?php
                    $qnt_linhas_exe++;
                endforeach;
                ?>
            </tbody>
        </table>
        <?php
    endif;
    ?>
</div>

