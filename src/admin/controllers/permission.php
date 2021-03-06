<?php

namespace permission\admin\controllers;

use driver\helper\html;
use alerts\alerts\alerts;
use permission\admin\controllers\baseControl;
use permission\common\models\permissions;
use permission\common\models\profiles;
use permission\common\models\areas;
use permission\common\models\actions;

class permission extends baseControl
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

        $search = $this->where();
        if(array_key_exists('c2VhcmNoUGVybWlzc2lvbnM=',$_POST)){
            $search = $this->where($_POST);
        }

        $this->param('registros', null);
        $permissions = (new permissions())->seek($search);
        if(!$permissions->isNew()){
            $this->param('registros', $permissions);
        }

        return $this->view();
    }

    /**
     * Cria o array de busca
     *
     * @param array $post
     * @return void
     */
    protected function where(array $post = null)
    {
        $search = array('prm.active = 1');

        if(!isset($post) || empty($post)){
            return $search;
        }

        if(isset($_POST['profile_id']) && !empty($_POST['profile_id'])){
            $search['profile_id'] = "prm.profile_id = ".$_POST['profile_id'];
        }

        if(isset($_POST['area_id']) && !empty($_POST['area_id'])){
            $search['area_id'] = "prm.area_id = ".$_POST['area_id'];
        }

        if(isset($_POST['action_slug']) && !empty($_POST['action_slug'])){
            $search['action_slug'] = "prm.action_slug = ".$_POST['action_slug'];
        }

        return $search;
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