<?php
session_start();
define('URL', 'http://localhost/tcc-login/');

define('CONTROLER', 'home');
define('METODO', 'index');

function __autoload($Class) {
    $dirName = array(
        'controllers',
        'models',
        'adm/models/helper',
        'views',
        'config'
    );
    foreach ($dirName as $diretorios) {
        if (file_exists("{$diretorios}/{$Class}.php")):
            require("{$diretorios}/{$Class}.php");        
        endif;
    }
    
}