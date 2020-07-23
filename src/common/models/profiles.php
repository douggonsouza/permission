<?php

namespace permission\common\models;

use data\model\model;
use data\resource\resource;

class profiles extends model
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
                ),
                'name' => array(
                    'label' => 'Identificador',
                    'pk'    => false,
                    'type'  => 'integer',
                ),
                'label' => array(
                    'label' => 'Primeiro nome',
                    'pk'    => false,
                    'type'  => 'varchar',
                ),
                'description' => array(
                    'label' => 'Primeiro nome',
                    'pk'    => false,
                    'type'  => 'varchar',
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