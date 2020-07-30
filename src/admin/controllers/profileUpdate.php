<?php

namespace permission\admin\controllers;

use permission\admin\controllers\baseControl;
use permission\common\models\profiles;

class profileUpdate extends baseControl
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
        $this->param('profile', null);
        if(array_key_exists('cHJvZmlsZVVwZGF0ZQ==',$_POST)){
            $profile = new profiles();
            $profile->populate($_POST);
            if(!$profile->save()){
                $error = $profile->getError();
            }
        }

        $profile = (new profiles())->search(
            array(
                'profile_id' => $info['url'][1]
            )
        );
        if(!$profile->isNew()){
            $this->param('profile', $profile);
        }

        self::setLayout(self::getHeartwoodLayouts().'/cooladmin1.phtml');
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