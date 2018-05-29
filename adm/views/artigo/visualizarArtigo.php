<div class="well">
    <div class="pull-right">
        <a href="<?php echo URL; ?>controle-artigo/index"><button type="button" class="btn btn-sm btn-success">Listar</button></a>
        <a href="<?php echo URL; ?>controle-artigo/editar/<?php echo $this->Dados[0]['id']; ?>"><button type="button" class="btn btn-sm btn-warning">Editar</button></a>
        <a href="<?php echo URL; ?>controle-artigo/apagar/<?php echo $this->Dados[0]['id']; ?>"><button type="button" class="btn btn-sm btn-danger">Apagar</button></a>
    </div>
    <div class="page-header">
        <h1>Detalhes do artigo</h1>
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
                $imagem_artigo = URL . "assets/imagens/artigo/{$this->Dados[0]['id']}/{$this->Dados[0]['foto']}";
                echo "<img src='$imagem_artigo' height='65' width='105' alt='{$this->Dados[0]['titulo_artigo']}'>";
                ?>
            </dd>

            <dt>ID</dt>
            <dd><?php echo $this->Dados[0]['id']; ?></dd>

            <dt>Titulo do Artigo</dt>
            <dd><?php echo $this->Dados[0]['titulo_artigo']; ?></dd>

            <dt>Categoria do artigo</dt>
            <dd><?php echo $this->Dados[0]['categorias_artigos']; ?></dd>

            <dt>Slug</dt>
            <dd><?php echo $this->Dados[0]['slug_artigo']; ?></dd>

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

            <dt>Descrição</dt>
            <dd><?php echo $this->Dados[0]['descricao_artigo']; ?></dd>

            <dt>Conteúdo</dt>
            <dd><?php echo $this->Dados[0]['conteudo_artigo']; ?></dd>
        </dl>
        <?php
    else:
        echo "<div class='alert alert-danger'>Nenhum dado encontrado.</div>";
    endif;
    //var_dump($this->Dados);
    ?>
</div>    