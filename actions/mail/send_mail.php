<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require $_SERVER['DOCUMENT_ROOT'] . '/actions/mail/phpMailer/src/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'] . '/actions/mail/phpMailer/src/SMTP.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/settings.php';

/**
 * @param $email
 * @param $title
 * @param $body
 * @return bool
 * @throws \PHPMailer\PHPMailer\Exception
 */
function send_mail_smtp($email, $title, $body): bool
{
	$mail = new PHPMailer(true);
	$mail->isSMTP();
//	$mail->SMTPDebug = 2;
	$mail->CharSet = 'UTF-8';
	$mail->Host   = SMTP_HOST;
	$mail->SMTPAuth   = true;
	$mail->Username   = SMTP_LOGIN;
	$mail->Password   = SMTP_PASSWORD;
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
	$mail->Port   = SMTP_PORT;
	$mail->setFrom(EMAIL['sender']['address'], EMAIL['sender']['name']);
    $mail->isHTML(true);
    $mail->Subject = $title;
    $mail->Body = $body;

    if (is_array($email)) {
        foreach ($email as $recipient) {
            $mail->addAddress($recipient);
            if (!$mail->send()) return false;
            $mail->clearAddresses();
        }

        return true;
    } else {
        $mail->addAddress($email);
        return $mail->send();
    }
}

/**
 * @param $email
 * @param $title
 * @param $body
 * @return bool
 * @throws \PHPMailer\PHPMailer\Exception
 */
function send_mail_server($email, $title, $body): bool
{
	$mail = new PHPMailer();
	$mail->CharSet = 'UTF-8';
    $mail->setFrom(EMAIL['sender']['address'], EMAIL['sender']['name']);
    $mail->Subject = $title;
    $mail->msgHTML($body);

    if (is_array($email)) {
        foreach ($email as $recipient) {
            $mail->addAddress($recipient);
            if (!$mail->send()) return false;
            $mail->clearAddresses();
        }

        return true;
    } else {
        $mail->addAddress($email);
        return $mail->send();
    }
}
