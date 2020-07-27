<?php

namespace permission\common\models;

use data\model\model;
use data\model\modelInterface;

class profiles extends model implements modelInterface
{
    public $table = 'profiles';
    public $key   = 'profile_id';
    public $dicionary = "SELECT profile_id as value, name as label FROM profiles;";

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
            'table'   => 'profiles',
            'key'     => 'profile_id',
            'columns' => array(
                'profile_id' => array(
                    'label' => 'Id',
                    'pk'    => true,
                    'type'  => 'integer',
                    'limit' => 11
                ),
                'name' => array(
                    'label' => 'dentificador',
                    'pk'    => false,
                    'type'  => 'varchar',
                    'limit' => 90
                ),
                'label' => array(
                    'label' => 'Primeiro nome',
                    'pk'    => false,
                    'type'  => 'varchar',
                    'limit' => 90
                ),
                'description' => array(
                    'label' => 'Primeiro nome',
                    'pk'    => false,
                    'type'  => 'varchar',
                    'limit' => 255
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