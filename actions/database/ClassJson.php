<?php
namespace Actions\Database;
use Exception;

include_once $_SERVER['DOCUMENT_ROOT'] . '/settings.php';

class ClassJson {
    /**
     * @param $file
     * @param $key
     * @return bool|int
     * @throws Exception
     */
	public static function delete($file, $key){
		$file_path = DIR_JSON . $file . '.json';

		if(file_exists($file_path)) {
			$json = file_get_contents($file_path);
			$json = json_decode($json, true);

			unset($json[$key]);

			return file_put_contents($file_path, json_encode($json, JSON_UNESCAPED_UNICODE));
		} else {
            throw new Exception("Файл $file не найден'");
		}
	}

    /**
     * @param $file
     * @param array $param
     * @return false|int
     * @throws Exception
     */
	public static function add($file, $param = []){
		$file_path = DIR_JSON . $file . '.json';

		if(file_exists($file_path)) {
			$json = file_get_contents($file_path);
			$json = json_decode($json, true);

			$json[] = $param;

			return file_put_contents($file_path, json_encode($json, JSON_UNESCAPED_UNICODE));
		} else {
            $file = fopen($file_path, "w");
            fwrite($file, json_encode($param, JSON_UNESCAPED_UNICODE));
            return fclose($file);
		}
	}

    /**
     * @param $file
     * @param $key
     * @return mixed
     * @throws Exception
     */
    public static function select($file, $key){
		$file_path = DIR_JSON . $file . '.json';

		if(file_exists($file_path)) {
			$json = file_get_contents($file_path);
			$json = json_decode($json, true);

			return $json[$key];
		} else {
            throw new Exception("Файл $file не найден'");
		}
	}

    /**
     * @param $file
     * @param $key
     * @param array $param
     * @return int|false
     * @throws Exception
     */
	public static function update($file, $key, $param = []){
		$file_path = DIR_JSON . $file . '.json';

		if(file_exists($file_path)) {
			$json = file_get_contents($file_path);
			$json = json_decode($json, true);
			
			$json[$key] = $param;
			
			return file_put_contents($file_path, json_encode($json, JSON_UNESCAPED_UNICODE));
		} else {
            throw new Exception("Файл $file не найден'");
		}
	}
}

?>