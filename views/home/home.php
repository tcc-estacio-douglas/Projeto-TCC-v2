<?php
if (isset($this->Dados[0])):
    $Carousels = $this->Dados[0];
//var_dump($Carousels);
endif;

if (isset($this->Dados[1])):
    $Servicos = $this->Dados[1];
//var_dump($Carousels);
endif;

if (isset($this->Dados[2])):
    $Video = $this->Dados[2];
//var_dump($Carousels);
endif;

if (isset($this->Dados[3])):
    $Artigos = $this->Dados[3];
//var_dump($Artigos);
endif;
?>
<!-- Inicio Carousel -->
<div class="espaco-topo">			
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators hidden-xs">
            <?php
            if (!empty($Carousels)):
                $cont_ativo = 0;
                foreach ($Carousels as $carousel) {
                    extract($carousel);
                    ?>
                    <li data-target="#myCarousel" data-slide-to="<?php echo $cont_ativo; ?>" class="<?php
                    if ($cont_ativo == 0):
                        echo "active";
                    endif;
                    ?>"></li>
                        <?php
                        $cont_ativo++;
                    }
                endif;
                ?>
        </ol>
        <div class="carousel-inner" role="listbox">
            <?php
            if (!empty($Carousels)):
                $cont_ativo = 0;
                foreach ($Carousels as $carousel) {
                    extract($carousel);
                    ?>
                    <div class="item <?php
                    if ($cont_ativo == 0):
                        echo "active";
                    endif;
                    ?>">
                        <a href="<?php echo $link; ?>">
                            <img class="second-slide" src="adm/assets/imagens/carousel/<?php echo $id; ?>/<?php echo $foto; ?>" alt="<?php echo $titulo_carousel; ?>">
                        </a>
                    </div>
                    <?php
                    $cont_ativo++;
                }
            endif;
            ?>
        </div>
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Próximo</span>
        </a>
    </div>
</div>
<!-- Fim Carousel -->  

<!-- Inicio Conteúdo Site antes vídeo -->
<div class="container theme-showcase" role="main">

    <!-- Inicio Serviços -->
    <div class="container-fluid text-center">   
        <div class="row servicos">
            <?php
            if (!empty($Servicos)):
                foreach ($Servicos as $servico) :
                    extract($servico);
                    ?>
                    <a href="<?php echo $link; ?>">
                        <div class="col-sm-4 servicos">
                            <span class="<?php echo $imagem; ?> logo-small"></span>
                            <h4><?php echo $nome_servico; ?></h4>
                            <p><?php echo $descricao_servico; ?></p>
                        </div>
                    </a><?php
                endforeach;
            endif;
            ?>


        </div>
    </div>
</div>
<!-- Fim Conteúdo Site antes vídeo -->  

<!-- Inicio Vídeo -->
<div class="jumbotron video-home">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
            </div>
            <div class="col-sm-6">
                <div class="embed-responsive embed-responsive-16by9">
                    <?php
                    echo $Video[0]['url'];
                    ?>
                </div>
            </div>

            <div class="col-sm-3">
            </div>
        </div>
    </div>
</div>

<!-- Inicio artigos recentes -->
<div class="espaco-artigo">
    <div class="container">
        <div class="row espaco-artigo-titulo">
            <h2>Artigos Recentes</h2>
        </div>
        <div class="row link-blog-titulo">
            <?php
            if (!empty($Artigos)):
                foreach ($Artigos as $artigo) {
                    extract($artigo);
                    ?>
                    <div class="col-sm-4">
                        <div class="thumbnail">
                            <a href="<?php echo URL . "artigo/" . $slug_artigo; ?>"><img src="adm/assets/imagens/artigo/<?php echo $id; ?>/<?php echo $foto; ?>" alt="<?php echo $titulo_artigo; ?>"></a>
                            <a href="<?php echo URL . "artigo/" . $slug_artigo; ?>"><h3 class="text-center"><?php echo $titulo_artigo; ?></h3></a>
                            <p><?php echo $descricao_artigo; ?></p>
                        </div>
                    </div> <?php
                }
            endif;
            ?>

        </div>
    </div>
</div>
<!-- Fim artigos recentes -->



