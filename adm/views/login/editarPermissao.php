<div class="well">
    <div class="page-header">
        <h1>Editar Permissão</h1>
    </div>

    <?php
    if (!empty($this->Dados)):
        ?>
        <form name="EditPermissao"  class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <?php
            foreach ($this->Dados as $permissoes):
                extract($permissoes);
                if (!isset($classe_valor)):
                    echo "<h3>Classe: $classes </h3>";
                    echo "<h3>Metodo: $methodos </h3>";
                    $classe_valor = $classes;
                endif;
                ?>
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $niveis_acessos; ?>:</label>
                    <div class="col-sm-10">
                        <?php
                        if ($niveis_acesso_id == 1):
                            if ($situacao_permissao == 1) :
                                echo "<label class='radio-inline'><input type='radio' name='nome[$id]' value='1' checked disabled><span class='label label-success'>Liberado</span></label>";
                                echo "<label class='radio-inline'><input type='radio' name='nome[$id]' value='2' disabled><span class='label label-danger'>Bloqueado</span></label>";
                            else:
                                echo "<label class='radio-inline'><input type='radio' name='nome[$id]' value='1' disabled><span class='label label-success'>Liberado</span></label>";
                                echo "<label class='radio-inline'><input type='radio' name='nome[$id]' value='2' checked disabled><span class='label label-danger'>Bloqueado</span></label>";
                            endif;
                        else:
                            if ($situacao_permissao == 1) :
                                echo "<label class='radio-inline'><input type='radio' name='nome[$id]' value='1' checked><span class='label label-success'>Liberado</span></label>";
                                echo "<label class='radio-inline'><input type='radio' name='nome[$id]' value='2'><span class='label label-danger'>Bloqueado</span></label>";
                            else:
                                echo "<label class='radio-inline'><input type='radio' name='nome[$id]' value='1'><span class='label label-success'>Liberado</span></label>";
                                echo "<label class='radio-inline'><input type='radio' name='nome[$id]' value='2' checked><span class='label label-danger'>Bloqueado</span></label>";
                            endif;
                        endif;
                        ?>
                    </div>
                </div>
                <?php
            endforeach;
            ?>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-warning" value="Editar" name="SendEditPermissao">
                </div>
            </div>
        </form>

        <?php
    endif;

    //var_dump($this->Dados);
    ?>

</div>