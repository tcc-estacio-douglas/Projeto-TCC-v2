<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login - Administrativo</title>
        <link href="<?php echo URL; ?>assets/css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo URL; ?>assets/css/personalizado.css" rel="stylesheet">
    </head>
    <body>

        <div class="header-admin">

        </div>

         <nav class="navbar navbar-inverse visible-xs">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Administrativo</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li><a href="#">Dashboard</a></li>
                        <li><a href="#">Usuários</a></li>
                        <li><a href="#">Nivel de Acesso</a></li>
                        <li><a href="#">Situação Usuário</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row content">
                <div class="col-sm-3 sidenav hidden-xs">
                    <h2>Administrativo</h2>
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="#">Dashboard</a></li>
                        <li><a href="#">Usuários</a></li>
                        <li><a href="#">Nivel de Acesso</a></li>
                        <li><a href="#">Situação Usuário</a></li>
                    </ul>
                </div><br>
                <div class="col-sm-9">
                    <div class="well text-center">
                        Bem vindo
                    </div>
                </div>                
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="<?php echo URL; ?>assets/js/bootstrap.min.js"></script>
    </body>
</html>