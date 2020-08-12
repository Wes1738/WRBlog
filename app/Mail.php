<?php

namespace App;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;

class Mail
{
    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function send(array $to, string $template, string $subject, array $payload)
    {
        $mail = new PHPMailer(true);
        
        try {
            $mail->isSMTP();
            $mail = new PHPMailer(true);
            $mail->Host = 'smtp.ethereal.email';
            $mail->SMTPAuth = true;
            $mail->Username = 'isac.cassin@ethereal.email';
            $mail->Password = 'DBgsgs8VwYxevswxzu';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->CharSet = 'utf-8';
            $mail->setFrom('from@example.com', 'Marcus Pereira');
            $mail->addAddress($to['email'], $to['name']);

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $this->container->view->render(
                $this->container->response,
                'mails/'. $template,
                $payload
            );

            $mail->send();
        } catch (PHPMailerException $e) {
            echo 'Houve um erro na tentativa de enviar um e-mail';
        }
    }
}