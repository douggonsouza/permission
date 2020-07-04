<?php

namespace root\home\models;

use Nuclear\system\model\models;
use Nuclear\system\model\modelsInterface;

class users extends models implements modelsInterface
{
    public $table = 'users';
    public $key   = 'user_id';

    protected $dicionarySQL = "SELECT user_id as value, name as label FROM users;";

    public function dicionary()
    {
        return parent::dicionary($this->dicionarySQL);
    }

    public function session()
    {
        return [
            'user_id'    => $this->getValue('user_id'),
            'profile_id' => $this->getValue('profile_id'),
            'jobs'   => $this->getValue('jobs'),
            'email' => $this->getValue('email'),
            'birth' => $this->getValue('birth'),
            'ddd'   => $this->getValue('ddd'),
            'phone' => $this->getValue('phone')
        ];
    }

    /**
     * Colhe o valor para table
     */ 
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Define o valor para table
     *
     * @param string $table
     * 
     * @return  self
     */ 
    public function setTable(string $table)
    {
        if(isset($table))
            $this->table = $table;

        return $this;
    }

    /**
     * Colhe o valor para key
     */ 
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Define o valor para key
     *
     * @param string $key
     *
     * @return  self
     */ 
    public function setKey(string $key)
    {
        if(isset($key))
            $this->key = $key;

        return $this;
    }
}