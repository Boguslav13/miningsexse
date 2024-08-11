<?php
include $_SERVER['DOCUMENT_ROOT'] . '/settings.php';
include $_SERVER['DOCUMENT_ROOT'] . '/functions.php';
include data_base(DB_DRIVER);
include $_SERVER['DOCUMENT_ROOT']. '/actions/mail/send_mail.php';

if (isset($_POST['gender'])) {
    foreach ($_POST as $key => $value) {
        $data[$key] = clean_elem_form($value);
    }

    // Base validation
    if (!isset($data['not-robot']) || !$data['not-robot']) {
        $json['error']['not-robot'] = 'Confirm that you are not a robot';
    }

    if (isset($data['gender']) && ($data['gender'] == 'other-gender') && (!isset($data['gender-variant']) || !$data['gender-variant'])) {
        $json['error']['gender-variant'] = 'Please enter your gender';
    }

    if (isset($data['years']) && $data['years'] == 'other-years' && (!isset($data['years-variant']) || !$data['years-variant'])) {
        $json['error']['years-variant'] = 'Please enter your age';
    }

    if (isset($data['virginity']) && $data['virginity'] == 'other-virginity' && (!isset($data['virginity-variant']) || !$data['virginity-variant'])) {
        $json['error']['virginity-variant'] = 'At what age do you lose your virginity';
    }

    if (!isset($data['email-for-contact']) || !$data['email-for-contact'] || !($data['email-for-contact'] = validation_email($data['email-for-contact']))) {
        $json['error']['email-for-contact'] = 'Please enter a valid email';
    }

    // Length input symbol
    if (isset($data['gender-variant']) && strlen($data['gender-variant']) > 255) {
        $json['error']['gender-variant'] = 'Maximum number of characters 255';
    }
    if (isset($data['years-variant']) && strlen($data['years-variant']) > 10) {
        $json['error']['years-variant'] = 'Maximum number of characters 10';
    }
    if (isset($data['virginity-variant']) && strlen($data['virginity-variant']) > 10) {
        $json['error']['virginity-variant'] = 'Maximum number of characters 10';
    }
    if (isset($data['partners-variant']) && strlen($data['partners-variant']) > 5) {
        $json['error']['partners-variant'] = 'Maximum number of characters 5';
    }
    if (isset($data['orgasm-variant']) && strlen($data['orgasm-variant']) > 100) {
        $json['error']['orgasm-variant'] = 'Maximum number of characters 100';
    }
    if (isset($data['pose-variant']) && strlen($data['pose-variant']) > 255) {
        $json['error']['pose-variant'] = 'Maximum number of characters 255';
    }
    if (isset($data['place-variant']) && strlen($data['place-variant']) > 255) {
        $json['error']['place-variant'] = 'Maximum number of characters 255';
    }
    if (isset($data['oral-caresses-variant']) && strlen($data['oral-caresses-variant']) > 100) {
        $json['error']['oral-caresses-variant'] = 'Maximum number of characters 100';
    }
    if (isset($data['anal-sex-variant']) && strlen($data['anal-sex-variant']) > 100) {
        $json['error']['anal-sex-variant'] = 'Maximum number of characters 100';
    }
    if (isset($data['group-sex-variant']) && strlen($data['group-sex-variant']) > 50) {
        $json['error']['group-sex-variant'] = 'Maximum number of characters 50';
    }
    if (isset($data['pornography-watch-variant']) && strlen($data['pornography-watch-variant']) > 100) {
        $json['error']['pornography-watch-variant'] = 'Maximum number of characters 100';
    }
    if (isset($data['masturbate-how-often-variant']) && strlen($data['masturbate-how-often-variant']) > 255) {
        $json['error']['masturbate-how-often-variant'] = 'Maximum number of characters 255';
    }
    if (isset($data['biggest-complex-variant']) && strlen($data['biggest-complex-variant']) > 255) {
        $json['error']['biggest-complex-variant'] = 'Maximum number of characters 255';
    }
    if (isset($data['active-passive-variant']) && strlen($data['active-passive-variant']) > 100) {
        $json['error']['active-passive-variant'] = 'Maximum number of characters 100';
    }
    if (isset($data['one-night-variant']) && strlen($data['one-night-variant']) > 100) {
        $json['error']['one-night-variant'] = 'Maximum number of characters 100';
    }
    if (isset($data['bdsm-sex-variant']) && strlen($data['bdsm-sex-variant']) > 255) {
        $json['error']['bdsm-sex-variant'] = 'Maximum number of characters 255';
    }
    if (isset($data['important-in-variant']) && strlen($data['important-in-variant']) > 1000) {
        $json['error']['important-in-variant'] = 'Maximum number of characters 1000';
    }
    if (isset($data['desired-fantasy-variant']) && strlen($data['desired-fantasy-variant']) > 1000) {
        $json['error']['desired-fantasy-variant'] = 'Maximum number of characters 1000';
    }

    if (isset($json['error'])) responseJson($json);

    $data['timestamp'] = strtotime('NOW');
    $data['user_ip'] = get_user_ip();

    try {
        add_test($data);
    } catch (Exception $e) {
        $json['fatal'] = 'The form is temporarily disabled. Contact support.';
        responseJson($json);
    }

    $title = 'MINING SEX Questionnaire';
    $body = json_encode($data);

    try {
        send_mail_smtp(EMAIL['recipients'], $title, $body);
        $json['success'] = true;
    } catch (\PHPMailer\PHPMailer\Exception $e) {
        $json['fatal'] = 'The form is temporarily disabled. Contact support.';
    }

    responseJson($json);
}