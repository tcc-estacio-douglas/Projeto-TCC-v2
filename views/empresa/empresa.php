<?php
if (isset($this->Dados[0])):
    $Empresas = $this->Dados[0];
endif;
?>
<div class="jumbotron cursos-titulo">
    <div class="container">
        Sobre a Empresa
    </div>
</div>

<!-- Inicio Conteúdo Site antes vídeo -->
<div class="container theme-showcase" role="main">
    <?php
    if (!empty($Empresas)):
        $controle = 0;
        foreach ($Empresas as $empresa) :
            extract($empresa);
            if ($controle == 0):
                ?>
                <div class="row featurette">
                    <div class="col-md-7">
                        <h2 class="featurette-heading"><?php echo $titulo_empresa; ?></h2>
                        <p class="lead"><?php echo $descricao_empresa; ?></p>
                    </div>
                    <div class="col-md-5">
                        <img class="featurette-image img-responsive center-block" src="adm/assets/imagens/empresa/<?php echo $id; ?>/<?php echo $foto; ?>" alt="<?php echo $titulo_empresa; ?>">
                    </div>
                </div><?php
                $controle++;
            else:
                ?>
                <hr class="featurette-divider">
                <div class="row featurette">
                    <div class="col-md-7 col-md-push-5">
                        <h2 class="featurette-heading"><?php echo $titulo_empresa; ?></h2>
                        <p class="lead"><?php echo $descricao_empresa; ?></p>
                    </div>
                    <div class="col-md-5 col-md-pull-7">
                        <img class="featurette-image img-responsive center-block" src="adm/assets/imagens/empresa/<?php echo $id; ?>/<?php echo $foto; ?>" alt="<?php echo $titulo_empresa; ?>">
                    </div>
                </div>
                <hr class="featurette-divider"><?php
                $controle = 0;
            endif;
        endforeach;

    endif;
    ?>
</div><br><br>