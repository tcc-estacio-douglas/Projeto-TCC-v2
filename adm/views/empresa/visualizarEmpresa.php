<div class="well">
    <div class="pull-right">
        <a href="<?php echo URL; ?>controle-empresa/index"><button type="button" class="btn btn-sm btn-success">Listar</button></a>
        <a href="<?php echo URL; ?>controle-empresa/editar/<?php echo $this->Dados[0]['id']; ?>"><button type="button" class="btn btn-sm btn-warning">Editar</button></a>
        <a href="<?php echo URL; ?>controle-empresa/apagar/<?php echo $this->Dados[0]['id']; ?>"><button type="button" class="btn btn-sm btn-danger">Apagar</button></a>
    </div>
    <div class="page-header">
        <h1>Detalhes Sobre Empresa</h1>
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
            <dd><?php echo $this->Dados[0]['titulo_empresa']; ?></dd>

            <dt>Descrição</dt>
            <dd><?php echo $this->Dados[0]['descricao_empresa']; ?></dd>
            
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
            
            <dt>Imagem</dt>            
            <dd><?php
                if (!empty($this->Dados[0]['foto'])):
                    $foto = URL . "assets/imagens/empresa/".$this->Dados[0]['id']."/".$this->Dados[0]['foto'];
                    echo "<img src='$foto' height='100' width='150' alt='Empresa'>";
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


