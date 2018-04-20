<nav class="navbar navbar-inverse visible-xs">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Loja</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo URL; ?>controle-home/index">Dashboard</a></li>
                <li><a href="<?php echo URL; ?>controle-usuario/index">Usuários</a></li>
                <li><a href="<?php echo URL; ?>controle-login/listar-classe-methodo">Permissões</a></li>
                <li><a href="<?php echo URL; ?>controle-niveis-acesso/index">Nivel de Acesso</a></li>
                <li><a href="<?php echo URL; ?>controle-sit-usuario/index">Situação Usuário</a></li>
                <li><a href="<?php echo URL; ?>controle-login/logout">Sair</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-3 sidenav hidden-xs">
            <div class="well perfil text-center">
                <div class="row">
                    <div class="col-sm-4">
                        <?php
                        $foto = URL . "assets/imagens/usuarios/" . $_SESSION['id'] . "/" . $_SESSION['foto'];
                        if (!empty($_SESSION['foto'])):
                            echo "<img src='$foto' class='img-circle' height='50' width='50' alt='Avatar'>";
                        else:
                            $foto = URL . "assets/imagens/adm/perfil-adm.jpg";
                            echo "<img src='$foto' class='img-circle' height='50' width='50' alt='Avatar'>";
                        endif;
                        ?>
                    </div>
                    <div class="col-sm-8">
                        <p><?php echo current(str_word_count($_SESSION['name'], 2)); ?></p>
                        <a href="<?php echo URL; ?>controle-usuario/ver-perfil">
                            <span class="glyphicon glyphicon-user" aria-hidden="true" title="Perfil"></span>
                        </a>

                        <a href="<?php echo URL; ?>controle-usuario/editar-perfil">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true" title="Editar"></span>
                        </a>

                        <a href="<?php echo URL; ?>controle-login/logout">
                            <span class="glyphicon glyphicon-log-out" aria-hidden="true" title="Sair"></span>
                        </a>
                    </div>
                </div>

            </div> 
            <ul class="nav nav-pills nav-stacked">
                <li><a href="<?php echo URL; ?>controle-home/index">Dashboard</a></li>
                <li><a href="<?php echo URL; ?>controle-usuario/index">Usuários</a></li>
                <li><a href="<?php echo URL; ?>controle-login/listar-classe-methodo">Permissões</a></li>
                <li><a href="<?php echo URL; ?>controle-niveis-acesso/index">Nivel de Acesso</a></li>
                <li><a href="<?php echo URL; ?>controle-sit-usuario/index">Situação Usuário</a></li>
                <li><a href="<?php echo URL; ?>controle-login/logout">Sair</a></li>
            </ul>
        </div><br>
        <div class="col-sm-9">