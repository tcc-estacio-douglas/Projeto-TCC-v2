<?php

echo "<h1>Detalhes do usuários</h1>";
if (!empty($this->Dados[0]['id'])):
    echo "ID: " . $this->Dados[0]['id'] . "<br>";
    echo "Nome: " . $this->Dados[0]['name'] . "<br>";
    echo "E-mail: " . $this->Dados[0]['email'] . "<br>";
else:
    echo "Nenhum dado encontrado";
endif;
