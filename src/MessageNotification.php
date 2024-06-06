<?php

/*
 * Vas a implementar un sistema de notificación de mensajes en una aplicación. La aplicación debe ser capaz de enviar notificaciones a los usuarios a través de diferentes canales
 * como correo electrónico, SMS y notificaciones push. Cada tipo de notificación tiene un formato y comportamiento específico.

Requisitos
Notificaciones: Implementa una clase Notification que represente una notificación genérica.
Canales de Notificación: Debes tener clases específicas para manejar las notificaciones a través de correo electrónico, SMS y notificaciones push.
Formato de Mensaje: Cada tipo de notificación debe tener un formato específico.
Por ejemplo, las notificaciones por correo electrónico tendrán un asunto y un cuerpo,
mientras que las notificaciones por SMS solo tendrán un mensaje corto.
Envío de Notificaciones: Implementa una forma de enviar las notificaciones a través de los diferentes canales.
Extensibilidad: El sistema debe ser fácil de extender para agregar nuevos tipos de notificaciones en el futuro sin modificar el código existente.
 */
namespace App;

interface Notification {
    public function send(string $recipient, string $message): void;
}
class SmsNotification implements Notification {
    public function send(string $recipient, string $message): void
    {
        echo "Sending notification to: $recipient by SMS. Body: ". $message;
    }
}
class PushNotification implements Notification {
    public function send(string $recipient, string $message): void
    {
        echo "Sending notification to: $recipient by push. Body: ". $message;
    }
}
class EmailNotification implements Notification {
    private $email;
    private $subject;
    public function __construct($email)
    {
        $this->email = $email;
    }
    public function send(string $recipient, string $message): void
    {
        echo "Sending notification to: $recipient at email $this->email [No subject]. Body: ". $message;
    }

    public function getEmail()
    {
        return $this->email;
    }
}
class EmailWithCustomSubject extends EmailNotification {
    private EmailNotification $notification;
    private $subject;
    private $email;

    /**
     * @param $notification
     * @param $subject
     */
    public function __construct(EmailNotification $notification, $subject)
    {
        $this->notification = $notification;
        $this->email = $this->notification->getEmail();
        $this->subject = $subject;
    }

    public function send($recipient, string $message): void
    {
        echo "Sending Better Email to $recipient at $this->email with: Subject $this->subject. Body: $message";
    }
}
class Notify {
    private $recipient;
    private $message;
    private Notification $notification;
    public function __construct($recipient, $message, Notification $notification)
    {
        $this->recipient = $recipient;
        $this->message = $message;
        $this->notification = $notification;
    }
    public function sendNotification()
    {
        $this->notification->send($this->recipient, $this->message);
    }
}

$sendEmail = new EmailNotification('jhon@mail.com');
$personalizedEmailNotification = new EmailWithCustomSubject($sendEmail, 'Critical message');
$bySms = new SmsNotification();
$byPush = new PushNotification();
$arr = [$byPush,$bySms,$sendEmail, $personalizedEmailNotification];
$rnd = array_rand($arr);
$notify = new Notify('Greg', 'lets go the beach', $personalizedEmailNotification);
$notify->sendNotification();

