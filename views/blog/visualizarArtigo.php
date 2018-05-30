<?php
if (isset($this->Dados[0])):
    $Artigo = $this->Dados[0];
endif;
?>
<div class="jumbotron cursos-titulo">
    <div class="container">
        <?php if (isset($Artigo[0]['titulo_artigo'])): 
            echo $Artigo[0]['titulo_artigo'];
        endif;  ?>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <?php if (isset($Artigo[0]['id'])): ?>
                <div class = "col-sm-6">
                    <?php $imagem_artigo = URL . "adm/assets/imagens/artigo/{$Artigo[0]['id']}/{$Artigo[0]['foto']}"; ?>
                    <img class = "featurette-image img-responsive center-block" src = "<?php echo $imagem_artigo; ?>" alt = "<?php echo $Artigo[0]['titulo_artigo']; ?>">
                </div>
                <?php
                echo $Artigo[0]['conteudo_artigo'];
            else:
                echo "<div class='alert alert-danger'>Nenhum artigo encontrado!</div>";
            endif;
            ?>
        </div>
        <div class="col-sm-4">
            <div class="well">
                <p>Sobre Mim</p>
                <p>Integer augue nisl, pharetra ut dapibus at, hendrerit id dui. Nunc hendrerit iaculis tortor ac tincidunt. Pellentesque quis placerat neque, eget consequat ligula. Integer in urna viverra, luctus magna id, sagittis erat. Praesent turpis ipsum, varius in est quis, dapibus vehicula sem. Donec imperdiet pellentesque neque, sit amet accumsan odio ultrices ut.</p>
            </div>
            <div class="well">
                <?php $imagem_propaganda = URL . "assets/imagens/site/curso.png"; ?>
                <p>
                    <a href="http://celke.com.br/"><img class="img-responsive" src="<?php echo $imagem_propaganda; ?>" alt="Curso de PHP"></a>
                </p>
            </div>

            <div class="well">
                <p>Modelo</p>
            </div> 
        </div>
    </div>
    <hr>
</div>
