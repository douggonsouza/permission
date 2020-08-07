<?php

namespace permission\admin\controllers;

use driver\helper\html;
use permission\admin\controllers\baseControl;
use permission\common\models\profiles;
use alerts\alerts\alerts;
use driver\router\router;

class profile extends baseControl
{
    const _LOCAL = __DIR__;

    /**
     * Funï¿½ï¿½o a ser executada no contexto da action
     *
     * @param array $info
     * @return void
     */
    public function main(array $info)
    {
        self::setLayout(self::getHeartwoodLayouts().'/cooladmin1.phtml');
        
        $search = $this->where();
        if(array_key_exists('c2VhcmNoUHJvZmlsZQ==',$_POST)){
            $search = $this->where($_POST);
        }

        $this->param('registros', null);
        $profile = (new profiles())->seek($search);
        if(!$profile->isNew()){
            $this->param('registros', $profile);
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

        if(isset($_POST['name']) && !empty($_POST['name'])){
            $search['name'] = "name like '%".$_POST['name']."%'";
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