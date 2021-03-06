<div class="well well-personalizado">

    <div class="page-header">
        <h1>Listar Permissões de Acesso</h1>
    </div>

    <div class="pull-right">
        <p><a href="<?php echo URL; ?>controle-login/cadastrar-classe"><button type="button" class="btn btn-sm btn-primary">Sincronizar</button></a></p>
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

    $niveisAcessos = $this->Dados[1];
    $this->Dados = $this->Dados[0];
    if (!empty($this->Dados)):
        $cont_niveis_acesso = 1;
        $quant_niveis_acesso = 0;
        ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Classe - Método</th>
                    <?php
                    foreach ($niveisAcessos as $nivelAcesso):
                        extract($nivelAcesso);
                        echo "<th class='hidden-xs'> $nome_niveis_acesso <a href='".URL."controle-menu/index/$id'><button type='button' class='btn btn-xs btn-info'>Ordem</button></a></th>";
                        $quant_niveis_acesso++;
                    endforeach;
                    ?>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($this->Dados as $permissoes) :
                    extract($permissoes);
                    $nome_permissao = ($situacao_permissao == 1 ) ? "<span class='label label-success'>Liberado</span>" : "<span class='label label-danger'>Bloqueado</span>";
                    
                    $menu = ($menu == 1 ) ? "<a href='".URL."controle-menu/editar/$id'><button type='button' class='btn btn-xs btn-success'>Menu</button></a>" : "<a href='".URL."controle-menu/editar/$id'><button type='button' class='btn btn-xs btn-danger'>Menu</button></a>";
                    //echo "Situacao da permissão: $nome_permissao <br>";

                    if ($cont_niveis_acesso == 1):
                        echo "<tr><td><b>" . $classes . "</b> - " . $methodos . "</td>";
                        echo "<td class='hidden-xs'>" . $nome_permissao;
                        echo " - " .$menu. "</td>";
                        $cont_niveis_acesso++;

                    elseif ($cont_niveis_acesso == $quant_niveis_acesso):
                        echo "<td class='hidden-xs'>" . $nome_permissao ;
                        echo " - " .$menu. "</td>";
                        echo "<td>";
                        $url_destino = URL . "controle-login/editar-permissao/$methodo_id";
                        
                        echo "<a href='".URL ."controle-methodo/editar/$methodo_id'><button type='button' class='btn btn-xs btn-warning'>Editar Menu</button></a> ";
                        
                        echo "<a href='$url_destino'><button type='button' class='btn btn-xs btn-primary'>Editar Permissão</button></a>";
                        echo "</td>";
                        echo "</tr>";
                        $cont_niveis_acesso = 1;
                    else:
                        echo "<td class='hidden-xs'>" . $nome_permissao;
                        echo " - " .$menu. "</td>";
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