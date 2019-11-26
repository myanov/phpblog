<?php


namespace Models;


use core\DBDriver;
use core\Validator;
use mysql_xdevapi\Exception;

class UserModel extends BaseModel
{
    private $schema = [
        'id' => [
            'primary' => true
        ],

        'login' => [
            'type' => 'string',
            'length' => [3, 50],
            'not_blank' => true,
            'require' => true
        ],

        'password' => [
            'type' => 'string',
            'length' => [8, 50],
            'not_blank' => true,
            'require' => true
        ],
    ];

    public function __construct(DBDriver $db, Validator $validator)
    {
        parent::__construct($db, $validator, 'users');
        $this->validator->setRules($this->schema);
    }

    public function signUp(array $fields)
    {
        $this->validator->execute($fields);

        if(!$this->validator->success) {
            throw new Exception('Error of validation');
        }

        return $this->add([
            'login' => $this->validator->clean['login'],
            'password' => $this->getHash($this->validator->clean['password'])
        ], false);
    }

    public function signIn(array $fields)
    {
        $this->validator->execute($fields);

        if(!$this->validator->success) {
            //return $error = $this->validator->errors;
        }

        return $this->db->select(
            sprintf("SELECT * FROM %s WHERE login=:login AND password=:password", $this->table),
            [
                'login' => $fields['login'],
                'password' => $this->getHash($fields['password'])
            ],
            $this->db::FETCH_ONE
        );
    }

    public function getHash($password)
    {
        return md5($password . 'sdfslj_fhs2342lsh');
    }
}