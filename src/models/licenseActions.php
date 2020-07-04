<?php

namespace root\home\models;

use Nuclear\system\model\models;
use Nuclear\system\model\modelsInterface;
use Nuclear\alerts\alerts;
use root\home\models\licensePermissions;

class licenseActions extends models implements modelsInterface
{
    const PERMISSIONS_TYPE_VIEW = 'view';
    const PERMISSIONS_TYPE_LIST = 'list';
    const PERMISSIONS_TYPE_INSERT   = 'insert';
    const PERMISSIONS_TYPE_UPDATE   = 'update';
    const PERMISSIONS_TYPE_DELETE   = 'delete';
    const PERMISSIONS_TYPE_UPLOAD   = 'upload';
    const PERMISSIONS_TYPE_DOWNLOAD = 'download';

    public $table = 'license_actions';
    public $key   = 'action_id';

    protected $dicionarySQL = "SELECT
            MAX(action_id) as value,
            action as label
        FROM license_actions
        GROUP BY
            action;";

    public function dicionary()
    {
        return parent::dicionary($this->dicionarySQL);
    }

    public function licenses(int $profileId)
    {
        if(!isset($profileId) || empty($profileId))
            return false;

        $sql = "SELECT
                lac.action,
                GROUP_CONCAT(DISTINCT lac.permission_id) as slugs
            FROM license_actions as lac
            JOIN license_profiles AS lpr ON lpr.profile_id = lac.profile_id AND lpr.active = 1
            JOIN license_permissions AS lpe ON lpe.permission_id = lac.permission_id AND lpe.active = 1
            WHERE
                lpr.profile_id = $profileId
            GROUP BY
                lac.profile_id,
                lac.action;";

        $data = [];
        $resource = $this->select($sql);
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
        
        if(!isset($_SESSION['user']['licenses'][$action]))
            return false;

        $permissionId = null;
        $permissions = (new licensePermissions())->slugs();
        foreach($permissions as $index => $value){
            if( (string) $value == (string) $permission){
                $permissionId = $index;
                break;
            }
                
        }
        if(!isset($permissionId))
            return false;

        $action = explode(',',$_SESSION['user']['licenses'][$action]);
        if(!in_array($permissionId, $action)){
            return false;
        }

        return true;
    }

    public function deleteActions(int $profileId, int $permissionId)
    {
        $sql = sprintf(
            'DELETE FROM license_actions WHERE profile_id=%d AND permission_id=%d;',
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