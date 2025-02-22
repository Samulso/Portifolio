<?php
        //php -S localhost:8000
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;

        require 'vendor/autoload.php';


    if ($_SERVER["REQUEST_METHOD"] == "POST"){

        $nome = htmlspecialchars($_POST['nome']);
        $email = htmlspecialchars($_POST['email']);
        $comentario = htmlspecialchars($_POST['comentario']);

        $email_destino = "sohfsamuelhenrique@gmail.com";

        $assunto = "Comentário de $nome";

        $mensagem = "\nNome: $nome\n\n";
        $mensagem .= "\nE-mail: $email\n\n";
        $mensagem .= "\nComentário: \n$comentario\n";

        //instancia do PHPMailer

        $mail = new PHPMailer(true);
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer'  => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        
        try {

            //configs do serv SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';  // Servidor SMTP do Gmail
            $mail->SMTPAuth = true;
            $mail->Username = 'sh810653@gmail.com';  // Seu e-mail do Gmail
            $mail->Password = 'lrqg dwcr mxgv eifv';  // Sua senha do Gmail (ou App Password se a verificação em 2 etapas estiver ativada)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;
            

            //Destinatário e remetente

            $mail->setFrom($email, $nome);
            $mail->addAddress($email_destino);

            //conteúdo do email

            $mail->isHTML(true);
            $mail->Subject = $assunto;
            $mail->Body    = $mensagem;

            $mail->send();
            echo 'Comentário enviado com sucesso!';
        } catch (Exception $e) {
            echo "Erro ao enviar comentário. Erro: {$mail->ErrorInfo}";
        }


    }
    
    ?>


