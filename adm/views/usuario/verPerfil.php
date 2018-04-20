<div class="well">
    <div class="pull-right">

        <a href="<?php echo URL; ?>controle-usuario/editar-perfil"><button type="button" class="btn btn-sm btn-warning">Editar</button></a>

    </div>
    <div class="page-header">
        <h1>Meus Dados</h1>
    </div>
    <?php
    if (isset($_SESSION['msg'])):
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    endif;
    if (!empty($this->Dados[0]['id'])):
        ?>
        <dl class="dl-horizontal">

            <dt>Imagem</dt>
            <dd><?php
                if (!empty($_SESSION['foto'])):
                    echo "<img src='$foto' height='150' width='150' alt='Avatar'>";
                else:
                    $foto = URL . "assets/imagens/adm/perfil-adm.jpg";
                    echo "<img src='$foto' height='150' width='150' alt='Avatar'>";
                endif;
                ?></dd>

            <dt>Inscrição</dt>
            <dd><?php echo $this->Dados[0]['id']; ?></dd>

            <dt>Nome</dt>
            <dd><?php echo $this->Dados[0]['name']; ?></dd>

            <dt>E-mail</dt>
            <dd><?php echo $this->Dados[0]['email']; ?></dd>

        </dl>
        <?php
    else:
        echo "<div class='alert alert-danger'>Nenhum dado encontrado.</div>";
    endif;
    ?>
</div>


