<?php

namespace permission\common\models;

use data\model\model;
use data\resource\resource;
use data\model\modelInterface;
use permission\common\models\profiles;
use permission\common\models\areas;
use permission\common\models\actions;

class permissions extends model implements modelInterface
{
    public $table = 'permissions';
    public $key   = 'permission_id';
    public $dicionary = "SELECT permission_id as value, action_slug as label FROM permissions;";

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
            'table'   => 'permissions',
            'key'     => 'permission_id',
            'columns' => array(
                'permission_id' => array(
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
                'area_id' => array(
                    'label' => 'Area',
                    'pk'    => false,
                    'type'  => 'integer',
                    'limit' => 11
                ),
                'action_slug' => array(
                    'label' => 'Ação',
                    'pk'    => false,
                    'type'  => 'varchar',
                    'limit' => 15
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
            $where = array('prm.active = 1');
        }

        return sprintf("SELECT
            prf.profile_id,
            prf.label profile_label,
            prm.area_id,
            ars.label area_label,
            GROUP_CONCAT(distinct prm.action_slug) actions
        FROM permissions AS prm
        JOIN profiles AS prf ON prf.profile_id = prm.profile_id AND prf.active = 1
        JOIN actions AS act ON act.action_slug = prm.action_slug AND act.active = 1
        JOIN areas AS ars ON ars.area_id = prm.area_id AND ars.active = 1
        WHERE
            %1\$s
        GROUP BY
            prf.profile_id,
            ars.area_id;",
            implode(' AND ', $where)
        );
    }

    public function remove(int $profileId, int $areaId)
    {
        if(!isset($profileId) || empty($profileId)){
            return false;
        }

        if(!isset($areaId) || empty($areaId)){
            return false;
        }

        $sql = sprintf(
            "DELETE FROM permissions
            WHERE
                profile_id = %1\$d
                AND area_id = %2\$d;",
            $profileId,
            $areaId
        );

        return $this->execute($sql);
    }

    public function profile()
    {
        if(empty($this->getField('profile_id'))){
            return null;
        }

        return $this->manyForOne(new profiles(), 'profile_id');
    }

    public function area()
    {
        if(empty($this->getField('area_id'))){
            return null;
        }

        return $this->manyForOne(new areas(), 'area_id');
    }

    public function action()
    {
        if(empty($this->getField('action_slug'))){
            return null;
        }

        return $this->manyForOne(new actions(), 'action_slug');
    }

    public function licenses(int $profileId = null, int $areaId = null, string $actionSlug = null)
    {
        $where = array('prm.active = 1');

        if(isset($profileId) && !empty($profileId)){
            $where[] = 'prm.profile_id = '.$profileId;
        }

        if(isset($areaId) && !empty($areaId)){
            $where[] = 'prm.area_id = '.$areaId;
        }

        if(isset($actionSlug) && !empty($actionSlug)){
            $where[] = "prm.action_slug = '".$actionSlug."'";
        }

        $records = (new resource())->execute(
            sprintf(
                "SELECT
                    prm.profile_id,
                    prf.label,
                    prm.area_id,
                    ars.label,
                    GROUP_CONCAT(distinct prm.action_slug) AS actions
                FROM permissions AS prm
                JOIN profiles AS prf ON prf.profile_id = prm.profile_id AND prf.active = 1
                JOIN actions AS act ON act.action_slug = prm.action_slug AND act.active = 1
                JOIN areas AS ars ON ars.area_id = prm.area_id AND ars.active = 1
                WHERE
                    %1\$s
                GROUP BY
                    prf.profile_id,
                    ars.area_id;",
                implode(' AND ', $where)
            )
        );

        if(!isset($records) || $records == false){
            return array();
        }

        return $records;
    }

    public function isPermissed(string $profile, string $area, string $action)
    {
        if(!isset($profile) || empty($profile)){
            return false;
        }

        if(!isset($area) || empty($action)){
            return false;
        }

        if(!isset($action) || empty($action)){
            return false;
        }

        $areaId = null;
        $permission = (new permissions())->search(array(
            'profile_id'  => $profile,
            'area_id'     => $area,
            'action_slug' => $action
        ));

        return !$permission->isNew();
    }

    public function deleteActions(int $profileId, int $areaId)
    {
        $sql = sprintf(
            'DELETE FROM actions WHERE profile_id = %d AND area_id = %d;',
            $profileId,
            $areaId
        );
        return $this->execute($sql);
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