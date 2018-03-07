<H1>Cadastrar usuário</H1>
<?php
echo $this->Dados['msg'];
?>
<form name="CadUsuario" action="" method="post" enctype="multipart/form-data">

    <label>Nome:</label>
    <input type="text" name="name" placeholder="Nome completo" value="<?php if (isset($this->Dados)): echo $this->Dados['name'];
endif; ?>"><br><br>


    <label>E-mail:</label>
    <input type="email" name="email" placeholder="Seu melhor e-mail" value="<?php if (isset($this->Dados)): echo $this->Dados['email'];
endif; ?>"><br><br>

    <label>Senha:</label>
    <input type="password" name="password" placeholder="Senha"><br><br>

    <input type="submit" value="Cadastrar" name="SendCadUsuario">
</form>
