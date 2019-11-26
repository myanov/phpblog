<?php

namespace Models;

use core\DBDriver;
use core\Validator;

class ArticleModel extends BaseModel
{
    protected $scheme = [
        'id' => [
            'type' => 'integer',
            'require' => false
        ],
        'title' => [
            'type' => 'string',
            'length' => 150,
            'not_blank' => true,
            'require' => true
        ],
        'date' => [
            'type' => 'string',
            'not_blank' => false,
            'require' => false
        ],
        'content' => [
            'type' => 'string',
            'not_blank' => true,
            'require' => true
        ]
    ];

    public function __construct(DBDriver $db, Validator $validator)
    {
        parent::__construct($db, $validator, 'news');
        $this->validator->setRules($this->scheme);
    }
}