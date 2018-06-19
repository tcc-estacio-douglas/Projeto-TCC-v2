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
                <p>Curiosidade</p>
                <p>Muitas companhias de software, redes sociais e desenvolvedores de aplicativos recorrem à Nova Zelândia para testar e aperfeiçoar seus produtos e serviços.</p> 
                
                <p>O motivo? O país da Oceania é considerado isolado o suficiente para evitar vazamentos, com o benefício de que a população fala inglês, tem gostos e poder econômico semelhantes aos ocidentais.</p>
                
                <p>Lá, é possível descobrir e consertar bugs antes do lançamento, inclusive testando o suporte para um grande número de usuários. Microsoft, Facebook e Yahoo, por exemplo, já fizeram testes no mercado neozelandês.</p>
            </div>
            
        </div>
    </div>
    <hr>
</div>
