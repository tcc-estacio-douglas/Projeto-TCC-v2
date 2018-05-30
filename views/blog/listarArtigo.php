<?php
if (isset($this->Dados[0])):
    $Artigos = $this->Dados[0];
    //var_dump($Artigos);
endif;
if (isset($this->Dados[1])):
    $Paginacao = $this->Dados[1];
//var_dump($Paginacao);
endif;
?>
<div class="jumbotron cursos-titulo">
    <div class="container">
        Blog
    </div>
</div>

<!-- Inicio Conteúdo Site antes vídeo -->
<div class="container theme-showcase link-blog-titulo" role="main">   
    <?php
    if (!empty($Artigos)):
        foreach ($Artigos as $artigo) :
            extract($artigo);
            ?>
            <div class="row featurette">
                <div class="col-md-7 col-md-push-5">
                    <a href="<?php echo URL . "artigo/" . $slug_artigo; ?>" > <h2 class="featurette-heading"><?php echo $titulo_artigo; ?></h2></a>
                    <p class="lead"><?php echo $descricao_artigo; ?></p>
                </div>
                <div class="col-md-5 col-md-pull-7">
                    <?php $imagem_artigo = URL . "adm/assets/imagens/artigo/$id/$foto"; ?>
                    <img class="featurette-image img-responsive center-block" src="<?php echo $imagem_artigo; ?>" alt="<?php echo $titulo_artigo; ?>">
                </div>
            </div>
            <hr class="featurette-divider">
            <?php
        endforeach;
    endif;
    ?>




</div>



<?php
//echo $Paginacao;
?>
</div>
<?php
//var_dump($this->Dados);
