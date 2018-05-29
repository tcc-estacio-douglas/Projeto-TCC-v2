<div class="well">
    <div class="pull-right">
        <a href="<?php echo URL; ?>controle-video/editar/<?php echo $this->Dados[0]['id']; ?>"><button type="button" class="btn btn-sm btn-warning">Editar</button></a>
    </div>
    <div class="page-header">
        <h1>Detalhes do Vídeo</h1>
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
    if (!empty($this->Dados[0]['id'])):
        ?>
        <dl class="dl-horizontal">            

            <dt>Vídeo</dt>
            <dd>
                <div class="embed-responsive embed-responsive-16by9">
                    <?php echo $this->Dados[0]['url']; ?>
                </div>
            </dd>


            <dt>Inserido</dt>
            <dd><?php echo date('d/m/Y H:i:s', strtotime($this->Dados[0]['created'])); ?></dd>

            <dt>Alterado</dt>
            <dd>
                <?php
                if (!empty($this->Dados[0]['modified'])):
                    echo date('d/m/Y H:i:s', strtotime($this->Dados[0]['modified']));
                endif;
                ?>
            </dd>
        </dl>
        <?php
    else:
        echo "<div class='alert alert-danger'>Nenhum dado encontrado.</div>";
    endif;
    ?>
</div>


