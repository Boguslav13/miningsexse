<?php
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);

$time_now = time();
$time_now_Y = date('Y', $time_now);
$time_now_m = date('m', $time_now);
$time_now_d = date('d', $time_now);

// Email's
const EMAIL = [
    'sender' => [
        'address' => 'sex@mining.sex',
        'name' => 'MINING SEX'
    ],
    'recipients' => [
        'sex@mining.sex',
    ]
];

const SMTP_HOST = 'us2.smtp.mailhostbox.com';
const SMTP_PORT = 25;
const SMTP_LOGIN = 'sex@mining.sex';
const SMTP_PASSWORD = '!IHVvs(5';

// Урл сайта
const SITE_URL = 'https://new.mining.sex/';

// База данных
const DB_DRIVER = 'json';

const DB_HOSTNAME = '';
const DB_DATABASE = '';
const DB_USERNAME = '';
const DB_PASSWORD = '';

const DIR_JSON = '../data/';

// Array of json file names
// Leave the keys of the array unchanged, only change the values.
// The value is the name of the file on the server where the information will be written.
// If there is no such file, it will be created automatically when you try to write information to it.
const JSON_FILE_NAMES = [
    'test' => 'questionnaire',
    'subscribe' => 'subscribe'
];

// Админская часть приложения
const LOGIN = 'smad';
const PASSWORD = 'pasmord56743';
const ADMIN_HREF = '/admin-dt/';