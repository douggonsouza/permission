<?php

namespace permission\admin\controllers;

use permission\admin\controllers\baseControl;
use permission\common\models\actions;

class actionNew extends baseControl
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

        if(array_key_exists('YWN0aW9u',$_POST)){
            $action = new actions();
            $action->populate($_POST);
            if(!$action->save()){
                $error = $action->getError();
            }
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