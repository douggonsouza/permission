<?php

namespace permission\admin\controllers;

use permission\admin\controllers\baseControl;
use permission\common\models\profiles;

class profileList extends baseControl
{
    const _LOCAL = __DIR__;

    /**
     * Fun��o a ser executada no contexto da action
     *
     * @param array $info
     * @return void
     */
    public function main(array $info)
    {
        $search = array();
        if(array_key_exists('cHJvZmlsZUxpc3Q=',$_POST)){
            $search = $this->search($_POST);
        }

        $profile = (new profiles())->seek($search);
        $this->param('registros', null);
        if(!$profile->isNew()){
            $list = $profile->asArray();
            $this->param('registros', $list);
        }

        self::setLayout(self::getHeartwoodLayouts().'/cooladmin1.phtml');
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
        $search = array();

        if(!isset($post) || empty($post)){
            return $search;
        }

        if(isset($_POST['name']) && !empty($_POST['name'])){
            $search['name'] = "name like '%".$_POST['name']."%'";
        }

        if(isset($_POST['label']) && !empty($_POST['label'])){
            $search['label'] = "label like '%".$_POST['description']."%'";
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