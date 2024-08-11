<?php
use Actions\Database\ClassJson;

require_once $_SERVER['DOCUMENT_ROOT'] . '/actions/database/ClassJson.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/settings.php';

/**
 * @param array $data
 * @return mixed
 * @throws Exception
 */
function add_test(array $data){
	return ClassJson::add(JSON_FILE_NAMES['test'], $data);
}

/**
 * @param array $data
 * @return mixed
 * @throws Exception
 */
function add_subscribe(array $data){
	return ClassJson::add(JSON_FILE_NAMES['subscribe'], $data);
}

/**
 * @param array $data
 * @return mixed
 * @throws Exception
 */
function add_feedback(array $data){
	return ClassJson::add(JSON_FILE_NAMES['feedback'], $data);
}

?>