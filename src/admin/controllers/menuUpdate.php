<?php

namespace permission\admin\controllers;

use driver\helper\html;
use data\connection\conn;
use alerts\alerts\alerts;
use permission\admin\controllers\baseControl;
use permission\common\models\profiles;
use permission\common\models\sections;
use permission\common\models\areas;
use permission\common\models\menus;

class menuUpdate extends baseControl
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
        $this->param('menu', null);

        if(array_key_exists('dXBkYXRlTWVudXM=',$_POST)){
            $menu = new menus();
            $menu->populate($_POST);
            if(!$menu->save()){
                alerts::set($menu->getError(), alerts::BADGE_DANGER);
                return $this->view();
            }

            alerts::set('Permissões salvas com sucesso.');
        }

        // Levanta as menus
        $menu = (new menus())->licenses(
            $info['url'][1],
            $info['url'][2]
        );
        if(!empty($menu)){
            $this->param('menu', $menu);
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