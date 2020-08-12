<?php

namespace permission\common\models;

use data\model\model;
use data\resource\resource;
use data\model\modelInterface;
use permission\common\models\profiles;
use permission\common\models\sections;

class menus extends model implements modelInterface
{
    public $table = 'menus';
    public $key   = 'menu_id';
    public $dicionary = "SELECT menu_id as value, label FROM menus;";

    /**
     * Evento construtor da classe
     */
    public function __construct()
    {
        if(!empty($this->getTable()) && !empty($this->getKey())){
            parent::__construct($this->visibleCOlumns()['table'], $this->visibleCOlumns()['key']);
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
            'table'   => 'menus',
            'key'     => 'menu_id',
            'columns' => array(
                'menu_id' => array(
                    'label' => 'Id',
                    'pk'    => true,
                    'type'  => 'integer',
                    'limit' => 11
                ),
                'profile_id' => array(
                    'label' => 'Perfil',
                    'pk'    => false,
                    'type'  => 'integer',
                    'limit' => 11
                ),
                'section_id' => array(
                    'label' => 'Sessão',
                    'pk'    => false,
                    'type'  => 'integer',
                    'limit' => 11
                ),
                'area_id' => array(
                    'label' => 'Area',
                    'pk'    => false,
                    'type'  => 'integer',
                    'limit' => 11
                ),
                'label' => array(
                    'label' => 'Etiqueta',
                    'pk'    => false,
                    'type'  => 'varchar',
                    'limit' => 25
                ),
                'url' => array(
                    'label' => 'Url',
                    'pk'    => false,
                    'type'  => 'varchar',
                    'limit' => 160
                ),
            ),
        );
    }

    /**
     * Devolve sql para a realização da busca
     *
     * @param string $where
     * @return string
     */
    public function sqlSeek(array $where = null)
    {
        if(!isset($where) || empty($where)){
            $where = array('mns.active = 1');
        }

        return sprintf("SELECT
            mns.*,
            prf.label profile_label,
            ars.label area_label
        FROM menus AS mns
        JOIN profiles AS prf ON prf.profile_id = mns.profile_id AND prf.active = 1
        JOIN areas AS ars ON ars.area_id = mns.area_id AND ars.active = 1
        WHERE
            %1\$s;",
            implode(' AND ', $where)
        );
    }

    public function profile()
    {
        if(empty($this->getField('profile_id'))){
            return null;
        }

        return $this->manyForOne(new profiles(), 'profile_id');
    }

    public function section()
    {
        if(empty($this->getField('section_id'))){
            return null;
        }

        return $this->manyForOne(new sections(), 'section_id');
    }

    /**
     * Menus conforme o perfil
     *
     * @param integer $profileID
     * @return void
     */
    public function menuPermissions(int $profileID)
    {
        if(!isset($profileID) || empty($profileID)){
            return false;
        }

        $sql = sprintf("SELECT
                mns.profile_id,
                mns.section_id,
                sct.label AS section_label,
                sct.icon AS section_icon,
                mns.label,
                mns.url
            FROM menus as mns
            JOIN permissions AS prm ON prm.profile_id = mns.profile_id AND prm.area_id = mns.area_id AND prm.action_slug = 'menu' AND prm.active = 1
            JOIN profiles AS prf ON prf.profile_id = mns.profile_id AND prf.active = 1
            JOIN sections AS sct ON sct.section_id = mns.section_id AND sct.active = 1
            JOIN areas AS ars ON ars.area_id = mns.area_id AND ars.active = 1
            WHERE
                mns.active = 1
                %1\$s
            ORDER BY
                mns.profile_id,
                sct.label,
                mns.label;",
            $profileId
        );

        if(!$this->query($sql)){
            return false;
        }

        return $this;
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