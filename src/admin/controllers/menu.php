<?php

namespace permission\admin\controllers;

use driver\helper\html;
use alerts\alerts\alerts;
use permission\admin\controllers\baseControl;
use permission\common\models\profiles;
use permission\common\models\sections;
use permission\common\models\areas;
use permission\common\models\menus;

class menu extends baseControl
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
        $this->param('sections', (new sections())->dicionary());
        $this->param('areas', (new areas())->dicionary());

        $search = $this->where();
        if(array_key_exists('c2VhcmNoTWVudXM=',$_POST)){
            $search = $this->where($_POST);
        }

        $this->param('registros', null);
        $menus = (new menus())->seek($search);
        if(!$menus->isNew()){
            $this->param('registros', $menus);
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
        $search = array('mns.active = 1');

        if(!isset($post) || empty($post)){
            return $search;
        }

        if(isset($_POST['profile_id']) && !empty($_POST['profile_id'])){
            $search['profile_id'] = "mns.profile_id = ".$_POST['profile_id'];
        }

        if(isset($_POST['area_id']) && !empty($_POST['area_id'])){
            $search['area_id'] = "mns.area_id = ".$_POST['area_id'];
        }

        if(isset($_POST['label']) && !empty($_POST['label'])){
            $search['label'] = "mns.label = ".$_POST['label'];
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