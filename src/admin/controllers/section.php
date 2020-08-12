<?php

namespace permission\admin\controllers;

use driver\helper\html;
use permission\admin\controllers\baseControl;
use permission\common\models\sections;

class section extends baseControl
{
    const _LOCAL = __DIR__;

    /**
     * Função a ser executada no contexto da section
     *
     * @param array $info
     * @return void
     */
    public function main(array $info)
    {
        self::setLayout(self::getHeartwoodLayouts().'/cooladmin1.phtml');

        $search = $this->search();
        if(array_key_exists('c2VhcmNoQWN0aW9ucw==',$_POST)){
            $search = $this->search($_POST);
        }

        $this->param('registros', null);
        $sections = (new sections())->seek($search);
        if(!$sections->isNew()){
            $this->param('registros', $sections);
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
    protected function where(array $post = null)
    {
        $search = array('active = 1');

        if(!isset($post) || empty($post)){
            return $search;
        }

        if(isset($_POST['label']) && !empty($_POST['label'])){
            $search['label'] = "label like '%".$_POST['label']."%'";
        }

        if(isset($_POST['description']) && !empty($_POST['description'])){
            $search['description'] = "description like '%".$_POST['label']."%'";
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