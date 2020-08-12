<?php

namespace permission\admin\controllers;

use driver\helper\html;
use alerts\alerts\alerts;
use permission\admin\controllers\baseControl;
use permission\common\models\menus;

class menuSidebar extends baseControl
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
        self::setLayout(__DIR__.'/../responses/menuSidebar.phtml');

        $this->param('menus', new menus());
        if(isset($_SESSION['login'])){
            $this->param('menus', (new menus())->menuPermissions($_SESSION['login']['profile_id']));
        }

        return $this->view();
    }
}