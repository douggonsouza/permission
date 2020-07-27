<?php

namespace permission\common\models;

use data\model\model;
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

    public function profile()
    {
        if(!empty($this->getField('profile_id'))){
            return null;
        }

        return $this->manyForOne(new profiles(), 'profile_id');
    }

    public function area()
    {
        if(!empty($this->getField('area_id'))){
            return null;
        }

        return $this->manyForOne(new areas(), 'area_id');
    }

    public function actionSlug()
    {
        if(!empty($this->getField('action_slug'))){
            return null;
        }

        return $this->manyForOne(new actions(), 'action_slug');
    }

    /**
     * Valida a permissÃ£o para itens do Menu
     *
     * @param string $slug
     * @param array $slugs
     * @param array $views
     * @return void
     */
    // public function menuPermission(string $slug, array $slugs, array $views)
    // {
    //     if(empty($slug) || empty($slugs) || empty($views)){
    //         return false;
    //     }
            
    //     $idSlug = array_search($slug, $slugs);
    //     if(!isset($idSlug) || empty($idSlug))
    //         return false;

    //     return in_array($idSlug, $views);
    // }

    public function licenses(int $profileId = null)
    {
        if(!isset($profileId) || empty($profileId))
            return false;

        $records = (new resource())->execute(
            sprintf(
                "SELECT
                    prf.profile_id,
                    prm.area_id,
                    ars.label,
                    GROUP_CONCAT(distinct prm.action_slug) AS slugs
                FROM permissions AS prm
                JOIN profiles AS prf ON prf.profile_id = prm.profile_id AND prf.active = 1
                JOIN actions AS act ON act.action_slug = prm.action_slug AND act.active = 1
                JOIN areas AS ars ON ars.area_id = prm.area_id AND ars.active = 1
                %1\Ss
                GROUP BY
                    prf.profile_id,
                    ars.area_id;",
                (!empty($profileId))? 'WHERE prm.active = 1 AND prm.profile_id = '.$profileId: null
            )
        );
        if(!isset($records) || $records == false){
            return false;
        }

        $data = [];
        foreach($records as $item){
            $data[$item['action']] = $item['slugs'];
        }

        return $data;
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