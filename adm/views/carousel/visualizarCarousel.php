<div class="well">
    <div class="pull-right">
        <a href="<?php echo URL; ?>controle-carousel/index"><button type="button" class="btn btn-sm btn-success">Listar</button></a>
        <a href="<?php echo URL; ?>controle-carousel/editar/<?php echo $this->Dados[0]['id']; ?>"><button type="button" class="btn btn-sm btn-warning">Editar</button></a>
        <a href="<?php echo URL; ?>controle-carousel/apagar/<?php echo $this->Dados[0]['id']; ?>"><button type="button" class="btn btn-sm btn-danger">Apagar</button></a>
    </div>
    <div class="page-header">
        <h1>Detalhes Carousel</h1>
    </div>
    <?php
    if (isset($_SESSION['msg'])):
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    endif;
    if (!empty($this->Dados[0]['id'])):
        ?>
        <dl class="dl-horizontal">
            <dt>ID</dt>
            <dd><?php echo $this->Dados[0]['id']; ?></dd>

            <dt>Titulo</dt>
            <dd><?php echo $this->Dados[0]['titulo_carousel']; ?></dd>

            <dt>Link</dt>
            <dd><?php echo $this->Dados[0]['link']; ?></dd>

            <dt>Situação Carousel</dt>
            <dd><?php
                if ($this->Dados[0]['situacao_carousel'] == 1):
                    echo "Habilitado";
                else:
                    echo "Desabilitado";
                endif;
                ?></dd>            

            <dt>Inserido</dt>
            <dd>
                <?php
                if (!empty($this->Dados[0]['created'])):
                    echo date('d/m/Y H:i:s', strtotime($this->Dados[0]['created']));
                endif;
                ?>
            </dd>

            <dt>Alterado</dt>
            <dd>
                <?php
                if (!empty($this->Dados[0]['modified'])):
                    echo date('d/m/Y H:i:s', strtotime($this->Dados[0]['modified']));
                endif;
                ?>
            </dd>

            <dt>Foto</dt>
            <dd><?php
                $imagem_carousel = URL . "assets/imagens/carousel/{$this->Dados[0]['id']}/{$this->Dados[0]['foto']}";
                echo "<img src='$imagem_carousel' height='55' width='200';>";
                ?></dd>

        </dl>
        <?php
    else:
        echo "<div class='alert alert-danger'>Nenhum dado encontrado.</div>";
    endif;
    ?>
</div>


