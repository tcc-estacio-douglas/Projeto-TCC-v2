<div class="well well-personalizado">

    <div class="page-header">
        <h1>Listar Permissões de Acesso</h1>
    </div>

    <div class="pull-right">
        <p><a href="<?php echo URL; ?>controle-login/cadastrar-classe"><button type="button" class="btn btn-sm btn-primary">Sincronizar</button></a></p>
    </div>
    <?php
    if (isset($_SESSION ['msg'])):
        echo $_SESSION ['msg'];
        unset($_SESSION ['msg']);
    endif;
    
    if (!empty($this->Dados)):
        $cont_niveis_acesso = 1;
        ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Classe - Método</th>
                    <th class="hidden-xs">Administrador</th>
                    <th class="hidden-xs">Colaborador</th>
                    <th class="hidden-xs">Cliente</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($this->Dados as $permissoes):
                    extract($permissoes);
                    $nome_permissao = ($situacao_permissao == 1) ? "<span class='label label-success'>Liberado</span>" : "<span class='label label-danger'>Bloqueado</span>";
                    //echo "Situação da permissão: $nome_permissao<br>";

                    if ($cont_niveis_acesso == 1):
                        echo "<tr><td><b>" . $classes . "</b> - " . $methodos . "</td>";
                        echo "<td class='hidden-xs'>" . $nome_permissao . "</td>";
                        $cont_niveis_acesso++;
                    elseif ($cont_niveis_acesso == 3):
                        echo "<td class='hidden-xs'>" . $nome_permissao . "</td>";
                        $url_destino = URL . "controle-login/editar-permissao/$methodo_id";
                        echo "<td><a href='$url_destino'><buttom type='buttom' class='btn btn-warning'>Editar</buttom></a></td>";
                        echo "</tr>";
                        $cont_niveis_acesso = 1;
                    else:
                        echo "<td class='hidden-xs'>" . $nome_permissao . "</td>";
                        $cont_niveis_acesso++;
                    endif;
                endforeach;
                ?>
            </tbody>
        </table>

        <?php
    endif;


    //var_dump($this->Dados);
    ?>
</div>