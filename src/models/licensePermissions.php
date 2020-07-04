<?php

namespace root\home\models;

use Nuclear\system\model\models;
use Nuclear\system\model\modelsInterface;

class licensePermissions extends models implements modelsInterface
{
    public $table = 'license_permissions';
    public $key   = 'permission_id';

    protected $dicionarySQL = "SELECT
            permission_id as value,
            description as label
        FROM license_permissions;";

    public function dicionary()
    {
        return parent::dicionary($this->dicionarySQL);
    }

    public function slugs()
    {
        $slugs = [];
        $sql = "SELECT permission_id as value, slug as label FROM license_permissions;";

        $resource = $this->select($sql);
        if(!isset($resource) && $resource->num_rows == 0)
            return null;

        $arrayResource = $this->fetchAll($resource);
        foreach($arrayResource as $item){
            $slugs[$item['value']] = $item['label'];
        }

        return $slugs;
    }

    /**
     * Valida a permissão para itens do Menu
     *
     * @param string $slug
     * @param array $slugs
     * @param array $views
     * @return void
     */
    public function menuPermission(string $slug, array $slugs, array $views)
    {
        if(empty($slug) || empty($slugs) || empty($views))
            return false;

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