<?php
include $_SERVER['DOCUMENT_ROOT'] . '/settings.php';
include $_SERVER['DOCUMENT_ROOT'] . '/functions.php';
include data_base(DB_DRIVER);
include $_SERVER['DOCUMENT_ROOT']. '/actions/mail/send_mail.php';

if (isset($_POST['email'])) {
    foreach ($_POST as $key => $value) {
        $data[$key] = clean_elem_form($value);
    }

    if (!isset($data['email']) || !$data['email'] || !($data['email'] = validation_email($data['email']))) {
        $json['error']['email'] = 'Please enter a valid email';
    }

    if (!isset($data['name']) || !$data['name'] || strlen($data['name']) > 128) {
        $json['error']['name'] = 'Please enter a valid name';
    }

    if (isset($data['message']) && $data['message'] && strlen($data['message']) > 1000) {
        $json['error']['message'] = 'Maximum number of characters 1000';
    }

    if (isset($json['error'])) responseJson($json);

    $data['timestamp'] = strtotime('NOW');
    $data['user_ip'] = get_user_ip();

    try {
        add_feedback($data);
    } catch (Exception $e) {
        $json['fatal'] = 'The form is temporarily disabled. Contact support.';
        responseJson($json);
    }

    $title = 'MINING SEX New Feedback';
    $body = json_encode($data);

    try {
        send_mail_smtp(EMAIL['recipients'], $title, $body);
        $json['success'] = true;
    } catch (\PHPMailer\PHPMailer\Exception $e) {
        $json['fatal'] = 'The form is temporarily disabled. Contact support.';
    }

    responseJson($json);
}