<?php

namespace permission\admin\controllers;

use permission\admin\controllers\baseControl;
use permission\common\models\actions;

class action extends baseControl
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
        if(array_key_exists('cHJvZmlsZVVwZGF0ZQ==',$_POST)){
            $search = $this->search($_POST);
        }

        $this->param('registros', null);
        $actions = (new actions())->seek($search);
        if(!$actions->isNew()){
            $this->param('registros', $actions);
        }

        return $this->view();
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

        if(isset($_POST['action_slug']) && !empty($_POST['action_slug'])){
            $search['action_slug'] = "action_slug like '%".$_POST['action_slug']."%'";
        }

        if(isset($_POST['label']) && !empty($_POST['label'])){
            $search['label'] = "label like '%".$_POST['label']."%'";
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