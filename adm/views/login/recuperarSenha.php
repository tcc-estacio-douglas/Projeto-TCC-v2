<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Celke - Administrativo</title>
        <link rel="icon" href="<?php echo URL; ?>assets/imagens/adm/favicon.ico">
        <link href="<?php echo URL; ?>assets/css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo URL; ?>assets/css/signin.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <form method="POST" action="" class="form-signin">
                <h2 class="form-signin-heading text-center">Recuperação de Senha</h2>

                <?php
                if (isset($_SESSION['msg'])):
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                endif;
                ?>

                <div style="padding-bottom: 20px;">
                    <label class="sr-only">Usuário: </label>
                    <input type="text" class="form-control" name="email" placeholder="Digite seu email">
                </div>

                <input type="submit" class="btn btn-lg btn-danger btn-block" value="Recuperar" name="SendRecupSenha">    
                <div class="row text-center" style="margin-top: 20px;">
                    Lembrou? <a href="<?php echo URL; ?>controle-login/login">Clique aqui</a> para logar.
                </div>
            </form>
        </div>
    </body>
</html>