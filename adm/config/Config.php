<?php
session_start();
define('URL', 'http://localhost/tcc-login/adm/');

define('CONTROLER', 'controle-home');
define('METODO', 'index');

//Credenciais de acesso ao BD
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DBNAME', 'celke');

function __autoload($Class) {
    $dirName = array(
        'controllers',
        'models',
        'models/helper',
        'views',
        'config'
    );
    foreach ($dirName as $diretorios) {
        if (file_exists("{$diretorios}/{$Class}.php")):
            require("{$diretorios}/{$Class}.php");        
        endif;
    }
    
}
