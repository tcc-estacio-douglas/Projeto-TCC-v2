<div class="jumbotron cursos-titulo">
    <div class="container">
        Contato
    </div>
</div>

<!-- Container (Contact Section) -->
<div class="container theme-showcase" role="main">
    <div id="contact" class="container-fluid bg-grey">
        <?php
        if (isset($_SESSION['msg'])):
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        endif;
        if (isset($_SESSION['msgcad'])):
            echo $_SESSION['msgcad'];
            unset($_SESSION['msgcad']);
        endif;
        if (isset($this->Dados)):
            $valorForm = $this->Dados;
        endif;
        ?>
        <div class="row">
            <div class="col-sm-5">
                <h2>Empresa</h2>
                <p>Entre em contato conosco para divulgar suas noticias.</p>
                <p><span class="glyphicon glyphicon-map-marker"></span> Recife, PE</p>
                <p><span class="glyphicon glyphicon-phone"></span> (81) 99780-5098</p>
                <p><span class="glyphicon glyphicon-envelope"></span> douglas.cto.lima@gmail.com</p>

            </div>
            <div class="col-sm-7">
                <form name="CadMsgContato" action="" method="post" enctype="multipart/form-data">
                    <h2>Formulário de Contato</h2>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <input class="form-control" name="nome_cliente" placeholder="Nome" type="text" value="<?php
                            if (isset($valorForm['nome_cliente'])): echo $valorForm['nome_cliente'];
                            endif;
                            ?>" required>
                        </div>
                        <div class="col-sm-6 form-group">
                            <input class="form-control" name="email_cliente" placeholder="Email" type="email" value="<?php
                            if (isset($valorForm['email_cliente'])): echo $valorForm['email_cliente'];
                            endif;
                            ?>" required>
                        </div>
                    </div>
                    <textarea class="form-control" id="comments" name="comentario_contato" placeholder="Comentário" rows="5"><?php
                        if (isset($valorForm['comentario_contato'])): echo $valorForm['comentario_contato'];
                        endif;
                        ?></textarea><br>

                    <input type="hidden" name="created" value="<?php echo date("Y-m-d H:i:s"); ?>">
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <input type="submit" class="btn btn-default pull-right" value="Enviar" name="SendCadMsgContato">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>