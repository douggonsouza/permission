<?php

namespace root\home\models;

use data\model\model;
use data\model\modelInterface;

class users extends model implements modelInterface
{
    public $table = 'users';
    public $key   = 'user_id';
    public $dicionary = "SELECT user_id as value, name as label FROM users;";

    /**
     * Evento construtor da classe
     */
    public function __construct()
    {
        if(!empty($this->getTable()) && !empty($this->getKey())){
            parent::__construct($this->getTable(), $this->getKey());
        }
    }

    /**
     * Informações das colunas visíveis
     *
     * @return void
     */
    public function visibleColumns()
    {
        return array(
            'table'   => 'users',
            'key'     => 'user_id',
            'columns' => array(
                'user_id' => array(
                    'label' => 'Id',
                    'pk'    => true,
                    'type'  => 'integer',
                    'limit' => 11
                ),
                'name' => array(
                    'label' => 'Nome',
                    'pk'    => false,
                    'type'  => 'varchar',
                    'limit' => 120
                ),
                'profile_id' => array(
                    'label' => 'Perfil',
                    'pk'    => false,
                    'type'  => 'integer',
                    'limit' => 11
                ),
                'email' => array(
                    'label' => 'E-mail',
                    'pk'    => false,
                    'type'  => 'varchar',
                    'limit' => 160
                ),
                'birth' => array(
                    'label' => 'Nascimento',
                    'pk'    => false,
                    'type'  => 'date',
                    'limit' => 20
                ),
                'ddd' => array(
                    'label' => 'DDD',
                    'pk'    => false,
                    'type'  => 'varchar',
                    'limit' => 3
                ),
                'phone' => array(
                    'label' => 'Fone',
                    'pk'    => false,
                    'type'  => 'varchar',
                    'limit' => 15
                ),
                'password' => array(
                    'label' => 'Senha',
                    'pk'    => false,
                    'type'  => 'varchar',
                    'limit' => 90
                ),
            ),
        );
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