<?php

require ('assets/lib/PHPMailer/class.phpmailer.php');

/**
 * Descricao de ModelsEnviaEmail
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class ModelsEnviaEmail {

    private $Dados;
    private $Assunto;
    private $Mensagem;
    private $RemetenteNome;
    private $RemetenteEmail;
    private $DestinoNome;
    private $DestinoEmail;
    private $Mail;
    private $Resultado;
    
    function getResultado() {
        return $this->Resultado;
    }

    
    public function Enviar(array $Dados) {
        $this->Dados = $Dados;
        //var_dump($this->Dados);
        $this->setMail();
    }

    private function setMail() {
        $this->Assunto = $this->Dados['assunto'];
        $this->Mensagem = $this->Dados['mensagem'];
        $this->RemetenteNome = "Cesar";
        //Inserir abaixo seu email de remetente
        $this->RemetenteEmail = "";
        $this->DestinoNome = $this->Dados['destinoNome'];
        $this->DestinoEmail = $this->Dados['destinoEmail'];
        if (empty($this->RemetenteEmail)):
            $_SESSION['msgcad'] = "<div class='alert alert-danger'>Necessário inserir um email de rementente! Local: adm/models/helper/ModelsEnviaEmail.php / linha: 38 e dados do servidor linha 53 a 56</div>";
            die();
        else:
            $this->configurarEmail();
            $this->sendMail();
        endif;
    }

    private function configurarEmail() {
        //Inserir os Dados do Servidor para enviar o e-mail
        $this->Mail = new PHPMailer;
        $this->Mail->Host = '';
        $this->Mail->Port = '';
        $this->Mail->Username = '';
        $this->Mail->Password = '';
        $this->Mail->CharSet = 'UTF-8';
        
        if (empty($this->Mail->Host)):
            $_SESSION['msgcad'] = "<div class='alert alert-danger'>Necessário inserir os dados do servidor linha 53 a 56</div>";
            die();
        endif;
        
        //SMTP AUTH
        $this->Mail->IsSMTP();
        $this->Mail->SMTPAuth = true;
        $this->Mail->SMTPSecure = 'ssl';
        $this->Mail->IsHTML(true);

        //Remetente e Retorno
        $this->Mail->From = $this->RemetenteEmail;
        $this->Mail->FromName = $this->RemetenteNome;
        $this->Mail->AddReplyTo($this->RemetenteEmail, $this->RemetenteNome);

        //Assunto, mensagem e destino
        $this->Mail->Subject = $this->Assunto;
        $this->Mail->Body = $this->Mensagem;
        $this->Mail->AddAddress($this->DestinoEmail, $this->DestinoNome);
    }

    private function sendMail() {
        if ($this->Mail->Send()):
            $this->Resultado = true;
        else:
            $this->Resultado = false;
        endif;
    }

}
