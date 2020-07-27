<?php

namespace permission\admin\controllers;

use permission\admin\controllers\baseControl;
use permission\common\models\areas;

class area extends baseControl
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
        if(array_key_exists('cHJvZmlsZVVwZGF0ZQ===',$_POST)){
            $search = $this->search($_POST);
        }

        $this->param('registros', null);
        $areas = (new areas())->seek($search);
        if(!$areas->isNew()){
            $this->param('registros', $areas);
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

        if(isset($_POST['slug']) && !empty($_POST['slug'])){
            $search['slug'] = "slug like '%".$_POST['slug']."%'";
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