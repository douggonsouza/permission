<?php

namespace permission\common\models;

use data\model\model;

class permissions extends model
{
    public $table = 'actions';
    public $key   = 'action_id';
    public $dicionary = "SELECT permission_id as value, action_slug as label FROM permissions;";

    /**
     * Evento construtor da classe
     */
    public function __construct()
    {
        parent::__construct($this->getTable(), $this->getKey());
    }

    /**
     * Informações das colunas visíveis
     *
     * @return void
     */
    public function visibleColumns()
    {
        return array(
            'table'   => 'permissions',
            'key'     => 'permission_id',
            'columns' => array(
                'permission_id' => array(
                    'label' => 'Id',
                    'pk'    => true,
                    'type'  => 'integer',
                ),
                'profile_id' => array(
                    'label' => 'Perfil',
                    'pk'    => false,
                    'type'  => 'integer',
                ),
                'area_id' => array(
                    'label' => 'Area',
                    'pk'    => false,
                    'type'  => 'integer',
                ),
                'action_slug' => array(
                    'label' => 'Ação',
                    'pk'    => false,
                    'type'  => 'varchar',
                ),
            ),
        );
    }

    public function licenses(int $profileId)
    {
        if(!isset($profileId) || empty($profileId))
            return false;

        $sql = "SELECT
                ac.action,
                GROUP_CONCAT(DISTINCT ac.permission_id) as slugs
            FROM actions as ac
            JOIN profiles AS lpr ON lpr.profile_id = ac.profile_id AND lpr.active = 1
            JOIN permissions AS lpe ON lpe.permission_id = ac.permission_id AND lpe.active = 1
            WHERE
                lpr.profile_id = $profileId
            GROUP BY
                ac.profile_id,
                ac.action;";

        $data = [];
        $resource = (new resource())::query($sql);
        foreach($this->fetchAll($resource) as $item){
            $data[$item['action']] = $item['slugs'];
        }

        return $data;
    }

    public function isLicensed(string $permission, string $action)
    {
        if(!isset($permission) || !isset($action)){
            return false;
        }

        $permissionId = null;
        $permissions = (new permissions())->slugs();
        foreach($permissions as $index => $value){
            if( (string) $value == (string) $permission){
                $permissionId = $index;
                break;
            }
                
        }
        if(!isset($permissionId))
            return false;

        if(!in_array($permissionId, $action)){
            return false;
        }

        return true;
    }

    public function deleteActions(int $profileId, int $permissionId)
    {
        $sql = sprintf(
            'DELETE FROM actions WHERE profile_id=%d AND permission_id=%d;',
            $profileId,
            $permissionId
        );
        return $this->query($sql);
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