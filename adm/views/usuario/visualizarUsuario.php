<div class="well">
    <div class="pull-right">
        <a href="<?php echo URL; ?>controle-usuario/index"><button type="button" class="btn btn-sm btn-success">Listar</button></a>
        <a href="<?php echo URL; ?>controle-usuario/editar/<?php echo $this->Dados[0]['id']; ?>"><button type="button" class="btn btn-sm btn-warning">Editar</button></a>
        <a href="<?php echo URL; ?>controle-usuario/apagar/<?php echo $this->Dados[0]['id']; ?>"><button type="button" class="btn btn-sm btn-danger">Apagar</button></a>
    </div>
    <div class="page-header">
        <h1>Detalhes do usuário</h1>
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
            
            <dt>Nome</dt>
            <dd><?php echo $this->Dados[0]['name']; ?></dd>
            
            <dt>E-mail</dt>
            <dd><?php echo $this->Dados[0]['email']; ?></dd>
            
            <dt>Imagem</dt>
            <dd><?php echo $this->Dados[0]['foto']; ?></dd>
            
            <dt>Nivel de Acesso</dt>
            <dd><?php echo $this->Dados[0]['niveis_acesso_id']; ?></dd>
            
            <dt>Situação do Usuário</dt>
            <dd><?php echo $this->Dados[0]['situacoes_user_id']; ?></dd>
            
            <dt>Inserido</dt>
            <dd>
                <?php
                if(!empty($this->Dados[0]['created'])):
                    echo date('d/m/Y H:i:s', strtotime($this->Dados[0]['created']));
                endif;                 
                ?>
            </dd>
            
            <dt>Alterado</dt>
            <dd>
                <?php
                if(!empty($this->Dados[0]['modified'])):
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


