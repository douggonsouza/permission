<?php

namespace permission\admin\controllers;

use permission\admin\controllers\baseControl;

class permissionList extends baseControl
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
        // license
        // $this->isLicensed('permission-page-teachers', licenseActions::PERMISSIONS_TYPE_LIST);
        
        // if(array_key_exists('Y3JpYcOnw6NvIGRlIG5vdmEgcGVybWlzc8Ojbw==',$_POST)){
        //     $licensePermission = new licensePermissions();
        //     $licensePermission->setValue('slug', $_POST['slug']);
        //     $licensePermission->setValue('description', $_POST['description']);
        //     if(!$licensePermission->save()){
        //         alerts::set("Erro no salvamento da permissão.",'error');
        //         parent::view(null, [
        //             'title'      => 'Permissão',
        //             'subtitle'   => 'Insere um nova permissão.',
        //             'breadcump'  => [
        //                 'Admin'  => BASE_URL.'/admin/index',
        //                 'Permissão' => false
        //             ]
        //         ]);
        //     }
        //     alerts::set("Permissão salva.",'success');
        // }

        if(array_key_exists('cHJvZmlsZVVwZGF0ZQ==',$_POST)){

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