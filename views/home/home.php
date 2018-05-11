<?php
if (isset($this->Dados[0])):
    $Carousels = $this->Dados[0];
//var_dump($Carousels);
endif;
?>
<!-- inicio carousel-->
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
                    if ($cont_ativo == 0): echo "active";
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
<!-- fim carousel-->