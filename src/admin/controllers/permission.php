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

        $search = array();
        if(array_key_exists('cGVybWlzc2lvbkxpc3Q=',$_POST)){
            $search = $this->search($_POST);
        }

        $this->param('registros', null);
        $permissions = (new permissions())->seek();
        if(!$permissions->isNew()){
            $this->param('registros', $permissions);
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
        if(!empty($actions)){
            $this->param('actions', $actions);
        }

        return $this->view(array(
            'html' => new html()
        ));
    }

    /**
     * Cria o array de busca
     *
     * @param array $post
     * @return void
     */
    protected function search(array $post)
    {
        $search = array('active = 1');

        if(!isset($post) || empty($post)){
            return $search;
        }

        if(isset($_POST['profile_id']) && !empty($_POST['profile_id'])){
            $search['profile_id'] = "profile_id = ".$_POST['profile_id'];
        }

        if(isset($_POST['area_id']) && !empty($_POST['area_id'])){
            $search['area_id'] = "area_id = ".$_POST['area_id'];
        }

        if(isset($_POST['action_slug']) && !empty($_POST['action_slug'])){
            $search['action_slug'] = "action_slug = ".$_POST['action_slug'];
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