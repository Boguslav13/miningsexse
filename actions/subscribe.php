<?php
include $_SERVER['DOCUMENT_ROOT'] . '/settings.php';
include $_SERVER['DOCUMENT_ROOT'] . '/functions.php';
include data_base(DB_DRIVER);
include $_SERVER['DOCUMENT_ROOT']. '/actions/mail/send_mail.php';

if (isset($_POST['email'])) {
    $data['email'] = clean_elem_form($_POST['email']);

    if (!$data['email'] || !($data['email'] = validation_email($data['email']))) {
        $json['error']['email'] = 'Please enter a valid email';
    }

    if (isset($json['error'])) responseJson($json);

    $data['timestamp'] = strtotime('NOW');
    $data['user_ip'] = get_user_ip();

    try {
        add_subscribe($data);
    } catch (Exception $e) {
        $json['fatal'] = 'The form is temporarily disabled. Contact support.';
        responseJson($json);
    }

    $title = 'MINING SEX New Subscription';
    $body = json_encode($data);

    try {
        send_mail_smtp(EMAIL['recipients'], $title, $body);
        $json['success'] = true;
    } catch (\PHPMailer\PHPMailer\Exception $e) {
        $json['fatal'] = 'The form is temporarily disabled. Contact support.';
    }

    responseJson($json);
}