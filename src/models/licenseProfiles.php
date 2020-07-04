<?php

namespace root\home\models;

use Nuclear\system\model\models;
use Nuclear\system\model\modelsInterface;

class licenseProfiles extends models implements modelsInterface
{
    public $table = 'license_profiles';
    public $key   = 'profile_id';

    protected $dicionarySQL = "SELECT
            profile_id as value,
            label
        FROM license_profiles;";

    public function dicionary()
    {
        return parent::dicionary($this->dicionarySQL);
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