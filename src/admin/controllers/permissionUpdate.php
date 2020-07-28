<?php

namespace permission\admin\controllers;

use permission\admin\controllers\baseControl;
use permission\common\models\permissions;

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

        $permission = (new permissions())->search(
            array(
                'permission_id = '.$info['url'][1]
            )
        );
        if(!$permission->isNew()){
            $this->param('permission', $permission);
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