<?php

namespace permission\admin\controllers;

use permission\admin\controllers\baseControl;
use permission\common\models\sections;

class sectionUpdate extends baseControl
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

        $this->param('section', null);
        if(array_key_exists('dWlwZGF0ZVNlY3Rpb25z',$_POST)){
            $section = new sections();
            $section->populate($_POST);
            if(!$section->save()){
                $error = $section->getError();
            }
        }

        $section = (new sections())->search(
            array(
                'section_id' => $info['url'][1]
            )
        );
        if(!$section->isNew()){
            $this->param('section', $section);
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