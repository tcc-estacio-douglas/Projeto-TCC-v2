<div class="well text-center">
    Bem vindo
    <?php
    if(isset($_SESSION['msg'])):
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    endif;
    ?>
</div>
