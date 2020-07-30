<?php

namespace permission\admin\controllers;

use permission\admin\controllers\baseControl;
use permission\common\models\actions;

class actionUpdate extends baseControl
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

        $this->param('action', null);
        if(array_key_exists('cHJvZmlsZVVwZGF0ZQ==',$_POST)){
            $action = new actions();
            $action->populate($_POST);
            if(!$action->save()){
                $error = $action->getError();
            }
        }

        $action = (new actions())->search(
            array(
                'action_id' => $info['url'][1]
            )
        );
        if(!$action->isNew()){
            $this->param('action', $action);
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