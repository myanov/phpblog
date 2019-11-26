<?php


namespace core;


class DBDriver
{
    const FETCH_ALL = 'all';
    const FETCH_ONE = 'one';

    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function select($sql, $params = [], $mode = self::FETCH_ALL)
    {
        $query = $this->pdo->prepare($sql);
        $query->execute($params);
        return $mode === self::FETCH_ALL ? $query->fetchAll() : $query->fetch();
    }

    public function insert($table, array $params)
    {
        $columns = sprintf('(%s)', implode(', ', array_keys($params)));
        $values = sprintf('(:%s)', implode(', :', array_keys($params)));

        $sql = sprintf('INSERT INTO %s %s VALUES %s', $table, $columns, $values);
        $query = $this->pdo->prepare($sql);
        $query->execute($params);
        return $this->pdo->lastInsertId();
    }

    public function change($table, array $params, $where)
    {
        $part = '';
        foreach($params as $key => $value) {
            $part .= "`$key`=:$key, ";
        }
        $part = substr($part, 0, mb_strlen($part) - 2);
        $sql = sprintf('UPDATE %s SET %s WHERE %s', $table, $part, $where);
        $query = $this->pdo->prepare($sql);
        $query->execute($params);
    }

    public function delete($table, $where)
    {
        $sql = sprintf('DELETE FROM %s WHERE %s', $table, $where);
        $query = $this->pdo->prepare($sql);
        $query->execute();
    }
}