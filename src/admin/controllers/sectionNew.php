<?php

namespace permission\admin\controllers;

use permission\admin\controllers\baseControl;
use permission\common\models\sections;

class sectionNew extends baseControl
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

        if(array_key_exists('YWN0aW9u',$_POST)){
            $section = new $sections();
            $section->populate($_POST);
            if(!$section->save()){
                $error = $section->getError();
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