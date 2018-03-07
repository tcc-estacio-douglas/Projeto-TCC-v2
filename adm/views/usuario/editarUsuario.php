<H1>Editar usuário</H1>
<?php
if (isset($this->Dados[0]['msg'])) {
    echo $this->Dados[0]['msg'];
} elseif (isset($this->Dados['msg'])) {
    echo $this->Dados['msg'];
}
?>
<form name="CadUsuario" action="" method="post" enctype="multipart/form-data">

    <label>Nome:</label>
    <input type="text" name="name" placeholder="Nome completo" value="<?php
    if (isset($this->Dados[0]['name'])) {
        echo $this->Dados[0]['name'];
    } elseif (isset($this->Dados['name'])) {
        echo $this->Dados['name'];
    }
    ?>"><br><br>


    <label>E-mail:</label>
    <input type="email" name="email" placeholder="Seu melhor e-mail" value="<?php 
        if (isset($this->Dados[0]['email'])) {
        echo $this->Dados[0]['email'];
    } elseif (isset($this->Dados['email'])) {
        echo $this->Dados['email'];
    }
    ?>"><br><br>

    <label>Senha:</label>
    <input type="password" name="password" placeholder="Senha"><br><br>

    <input type="submit" value="Editar" name="SendEditUsuario">
</form>
