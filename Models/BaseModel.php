<?php

namespace Models;

use core\DBDriver;
use core\Validator;

abstract class BaseModel
{
    protected $db;
    protected $table;
    protected $validator;

    public function __construct(DBDriver $db, Validator $validator, $table)
    {
        $this->db = $db;
        $this->table = $table;
        $this->validator = $validator;
    }

    public function getAll()
    {
        $sql = sprintf('SELECT * FROM %s ORDER BY date DESC', $this->table);
        return $this->db->select($sql);
    }

    public function getOne($id)
    {
        $sql = sprintf('SELECT * FROM %s WHERE id = :id', $this->table);
        return $this->db->select($sql, ['id' => $id], DBDriver::FETCH_ONE);
    }

    public function add(array $params, $needValidate = true)
    {
        if($needValidate) {
            $this->validator->execute($params);

            if(!$this->validator->success) {
                // error
                $this->validator->errors;
            }
        }

        return $this->db->insert($this->table, $params);
    }

    public function update(array $params, string $where)
    {
        $this->db->change($this->table, $params, $where);
    }

    public function delete($where)
    {
        $this->db->delete($this->table, $where);
    }

    public function checkError($query)
    {
        $info = $query->errorInfo();
        if($info[0] != \PDO::ERR_NONE) {
            exit($info[2]);
        }
    }
}