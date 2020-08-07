<?php

namespace permission\admin\controllers;

use driver\helper\html;
use data\connection\conn;
use alerts\alerts\alerts;
use permission\admin\controllers\baseControl;
use permission\common\models\permissions;
use permission\common\models\profiles;
use permission\common\models\areas;
use permission\common\models\actions;

class permissionNew extends baseControl
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

        $this->param('html', new html());
        $this->param('profiles', (new profiles())->dicionary());
        $this->param('areas', (new areas())->dicionary());
        $this->param('actions', (new actions())->dicionary());

        if(array_key_exists('cGVybWlzc2lvbg==',$_POST)){
            $permission = new permissions();
            conn::beginTransaction();
            foreach($_POST['action'] as $value){
                $_POST['action_slug'] = $value;
                $permission->populate($_POST);
                if(!$permission->save()){
                    conn::rollbackTransaction();
                    alerts::set($permission->getError(), alerts::BADGE_DANGER);
                    return $this->view();
                }
            }
            conn::commitTransaction();
            alerts::set('Permissões salvas com sucesso.');
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