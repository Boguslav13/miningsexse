<?php
namespace Actions\Database;

use Exception;
use PDO;

include_once $_SERVER['DOCUMENT_ROOT'] . '/settings.php';

class ClassMySQL
{
    private PDO $connect;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        try {
            $this->connect = new PDO('mysql:host=' . DB_HOSTNAME . ';dbname=' . DB_DATABASE . ';charset=utf8;', DB_USERNAME, DB_PASSWORD);
        } catch (Exception $Exception) {
            throw new Exception($Exception->getMessage(), $Exception->getCode());
        }
    }

    /**
     * Обновляет значения в БД
     * @throws Exception
     */
    public function update($sql, $param = []): bool
    {
        if (!$this->connect) $this->__construct();

        $stmt = $this->connect->prepare($sql);
        return $stmt->execute($param);
    }

    /**
     * Подсчитывает количество строк исходя из запроса
     */
    public function count($sql, $param = [])
    {
        $stmt = $this->connect->prepare($sql);
        $stmt->execute($param);
        return $stmt->fetchColumn();
    }

    /**
     * Проверяет есть ли совпадение в БД
     */
    public function exists($sql, $param = []): int
    {
        $stmt = $this->connect->prepare($sql);
        $stmt->execute($param);
        return $stmt->fetch(PDO::FETCH_COLUMN);
    }

    /**
     * Выбирает одну строку из БД
     */
    public function selectRow($sql, $param = [])
    {
        $stmt = $this->connect->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute($param);
        return $stmt->fetch();
    }

    /**
     * Выбирает из БД все совпадения
     */
    public function selectAll($sql, $param = []): array
    {
        $stmt = $this->connect->prepare($sql);
        $stmt->execute($param);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Выбирает из БД все совпадения, которые между собой не повторяются
     */
    public function selectDistinctColumn($sql, $param = []): array
    {
        $stmt = $this->connect->prepare($sql);
        $stmt->execute($param);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    /**
     * Добавляет запись в БД
     */
    public function add($query, $param = []): string
    {
        $stmt = $this->connect->prepare($query);
        $stmt->execute($param);
        return $this->connect->lastInsertId();
    }

    /**
     * Удаляет запись из БД
     */
    public function delete($query, $param = []): bool
    {
        $stmt = $this->connect->prepare($query);
        return $stmt->execute($param);
    }
}

?>