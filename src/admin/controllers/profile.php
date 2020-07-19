<?php

namespace permission\admin\controllers;

use permission\admin\controllers\baseControl;

class profile extends baseControl
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
        // license
        // $this->isLicensed('permission-page-teachers', licenseActions::PERMISSIONS_TYPE_LIST);
        
        // if(array_key_exists('Y3JpYcOnw6NvIGRlIG5vdm8gcGVyZmls',$_POST)){
        //     $licenseProfiles = new licenseProfiles();
        //     $licenseProfiles->setValue('name', $_POST['name']);
        //     $licenseProfiles->setValue('description', $_POST['description']);
        //     if(!$licenseProfiles->save()){
        //         alerts::set("Erro no salvamento do perfil.",'error');
        //         parent::view(null, [
        //             'title'      => 'Perfil',
        //             'subtitle'   => 'Insere um novo perfil.',
        //             'breadcump'  => [
        //                 'Admin'  => BASE_URL.'/admin/index',
        //                 'Perfil' => false
        //             ]
        //         ]);
        //     }
        //     alerts::set("Perfil salvo.",'success');
        // }

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