<?php

namespace permission\common\models;

use data\model\model;
use data\resource\resource;

class actions extends model
{
    public $table = 'actions';
    public $key   = 'action_id';
    public $dicionary = "SELECT action_id as value, slug as label FROM actions;";

    /**
     * Evento construtor da classe
     */
    public function __construct()
    {
        parent::__construct($this->getTable(), $this->getTable());
    }

    /**
     * Informações das colunas visíveis
     *
     * @return void
     */
    public function visibleColumns()
    {
        return array(
            'table'   => 'actions',
            'key'     => 'action_id',
            'columns' => array(
                'action_id' => array(
                    'label' => 'Id',
                    'pk'    => true,
                    'type'  => 'integer',
                ),
                'slug' => array(
                    'label' => 'Identificador',
                    'pk'    => false,
                    'type'  => 'varchar',
                ),
                'label' => array(
                    'label' => 'Etiqueta',
                    'pk'    => false,
                    'type'  => 'integer',
                ),
                'description' => array(
                    'label' => 'Descrição',
                    'pk'    => false,
                    'type'  => 'varchar',
                ),
            ),
        );
    }

    public function slugs()
    {
        $slugs = [];
        $sql = "SELECT action_id as value, slug as label FROM actions;";

        $slugsResouce = new resource();
        if(!$slugsResouce::query($sql)){
            return false;
        }

        foreach($slugsResouce::asAllArray() as $item){
            $slugs[$item['value']] = $item['label'];
        }

        return $slugs;
    }

    /**
     * Valida a permissÃ£o para itens do Menu
     *
     * @param string $slug
     * @param array $slugs
     * @param array $views
     * @return void
     */
    public function menuPermission(string $slug, array $slugs, array $views)
    {
        if(empty($slug) || empty($slugs) || empty($views)){
            return false;
        }
            
        $idSlug = array_search($slug, $slugs);
        if(!isset($idSlug) || empty($idSlug))
            return false;

        return in_array($idSlug, $views);
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