<?php

namespace permission\admin\controllers;

use permission\admin\controllers\baseControl;
use permission\common\models\areas;

class areaUpdate extends baseControl
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
        self::setLayout(self::getHeartwoodLayouts().'/cooladmin1.phtml');
        
        $this->param('area', null);
        if(array_key_exists('cHJvZmlsZVVwZGF0ZQ==',$_POST)){
            $area = new areas();
            $area->populate($_POST);
            if(!$area->save()){
                $error = $area->getError();
            }
        }

        $area = (new areas())->search(
            array(
                'area_id = '.$info['url'][1]
            )
        );
        if(!$area->isNew()){
            $this->param('area', $area);
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