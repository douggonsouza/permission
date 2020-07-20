<?php

namespace permission\admin\controllers;

use driver\control\action;

class baseControl extends action
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