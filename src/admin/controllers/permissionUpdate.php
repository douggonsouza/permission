<?php

namespace permission\admin\controllers;

use permission\admin\controllers\baseControl;
use permission\common\models\permissions;
use permission\common\models\profiles;
use permission\common\models\areas;
use permission\common\models\actions;

class permissionUpdate extends baseControl
{
    const _LOCAL = __DIR__;

    /**
     * Função a ser executada no contexto da action
     *
     * @param array $info
     * @return void
     */
    public function main(array $info)
    {
        self::setLayout(self::getHeartwoodLayouts().'/cooladmin1.phtml');

        $this->param('permission', null);
        if(array_key_exists('cGVybWlzc2lvblVwZGF0ZQ==',$_POST)){
            $permission = new permissions();
            $permission->populate($_POST);
            if(!$permission->save()){
                $error = $permission->getError();
            }
        }

        // Levanta as permissions
        $permission = (new permissions())->search(
            array(
                'profile_id' => $info['url'][1],
                'area_id'    => $info['url'][2]
            )
        );
        if(!$permission->isNew()){
            $this->param('permission', $permission);
        }

        // Levanta as opções de profiles
        $profiles = (new profiles())->dicionary();
        if(!empty($profiles)){
            $this->param('profiles', $profiles);
        }

        // Levanta as opções de areas
        $areas    = (new areas())->dicionary();
        if(!empty($profiles)){
            $this->param('areas', $areas);
        }

        // Levanta as opões de actions
        $actions  = (new actions())->dicionary();
        if(!empty($profiles)){
            $this->param('actions', $action);
        }

        return $this->view();
    }

    /**
     * Para ser disparado antes
     *
     * @return void
     */
    public function _before()
    {

    }

    /**
     * Para ser disparado depois
     *
     * @return void
     */
    public function _after()
    {

    }
}