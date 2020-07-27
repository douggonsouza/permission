<?php

namespace permission\admin\controllers;

use permission\admin\controllers\baseControl;
use permission\common\models\areas;

class areaNew extends baseControl
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

        if(array_key_exists('YXJlYQ==',$_POST)){
            $area = new areas();
            $area->populate($_POST);
            if(!$area->save()){
                $error = $area->getError();
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