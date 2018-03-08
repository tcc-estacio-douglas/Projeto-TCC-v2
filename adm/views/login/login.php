<h1>Login</h1>
<?php
if(isset($_SESSION['msg'])):
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
endif;
?>
<form method="POST" action="">
    <label>Usuário: </label>
    <input type="text" name="email" placeholder="E-mail"><br><br>
    <label>Senha: </label>
    <input type="password" name="password" placeholder="******"><br><br>
    <input type="submit" value="Acessar" name="SendLogin">    
</form>