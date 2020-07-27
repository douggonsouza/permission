<?php

namespace permission\common\models;

use data\model\model;
use data\model\modelInterface;

class areas extends model implements modelInterface
{
    public $table = 'areas';
    public $key   = 'area_id';
    public $dicionary = "SELECT area_id as value, slug as label FROM areas;";

    /**
     * Evento construtor da classe
     */
    public function __construct()
    {
        if(!empty($this->getTable()) && !empty($this->getKey())){
            parent::__construct($this->getTable(), $this->getKey());
        };
    }

    /**
     * Informações das colunas visíveis
     *
     * @return void
     */
    public function visibleColumns()
    {
        return array(
            'table'   => 'areas',
            'key'     => 'area_id',
            'columns' => array(
                'area_id' => array(
                    'label' => 'Id',
                    'pk'    => true,
                    'type'  => 'integer',
                    'limit' => 11
                ),
                'slug' => array(
                    'label' => 'Identificador',
                    'pk'    => false,
                    'type'  => 'varchar',
                    'limit' => 90
                ),
                'label' => array(
                    'label' => 'Etiqueta',
                    'pk'    => false,
                    'type'  => 'varchar',
                    'limit' => 45
                ),
                'description' => array(
                    'label' => 'Descrição',
                    'pk'    => false,
                    'type'  => 'varchar',
                    'limit' => 160
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