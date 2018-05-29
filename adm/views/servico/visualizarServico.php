<div class="well">
    <div class="pull-right">
        <a href="<?php echo URL; ?>controle-servicos/index"><button type="button" class="btn btn-sm btn-success">Listar</button></a>
        <a href="<?php echo URL; ?>controle-servicos/editar/<?php echo $this->Dados[0]['id']; ?>"><button type="button" class="btn btn-sm btn-warning">Editar</button></a>
    </div>
    <div class="page-header">
        <h1>Detalhes do Nivel de Acesso</h1>
    </div>
    <?php
    if (isset($_SESSION['msg'])):
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    endif;
    //var_dump($this->Dados);
    if (!empty($this->Dados[0]['id'])):
        ?>
        <dl class="dl-horizontal">
            <dt>ID</dt>
            <dd><?php echo $this->Dados[0]['id']; ?></dd>

            <dt>Nome</dt>
            <dd><?php echo $this->Dados[0]['nome_servico']; ?></dd>
            
            <dt>Descrição</dt>
            <dd><?php echo $this->Dados[0]['descricao_servico']; ?></dd>
            
            <dt>Link</dt>
            <dd><?php echo $this->Dados[0]['link']; ?></dd>
            
            <dt>Inserido</dt>
            <dd><?php echo date('d/m/Y H:i:s', strtotime($this->Dados[0]['created'])); ?></dd>

            <dt>Alterado</dt>
            <dd>
                <?php
                if(!empty($this->Dados[0]['modified'])):
                    echo date('d/m/Y H:i:s', strtotime($this->Dados[0]['modified']));        
                endif;
                ?>
            </dd>
            
            <dt>Imagem</dt>
            <dd class="icone"><?php echo "<span class='".$this->Dados[0]['imagem']."' aria-hidden='true'></span>"; ?></dd>
        </dl>
        <?php
    else:
        echo "<div class='alert alert-danger'>Nenhum dado encontrado.</div>";
    endif;
    ?>
</div>


