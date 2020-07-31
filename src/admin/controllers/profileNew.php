<?php

namespace permission\admin\controllers;

use permission\admin\controllers\baseControl;
use permission\common\models\profiles;

class profileNew extends baseControl
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
        
        if(array_key_exists('cHJvZmlsZQ==',$_POST)){
            $profile = new profiles();
            $profile->populate($_POST);
            if(!$profile->save()){
                $error = $profile->getError();
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