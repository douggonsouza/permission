<?php

namespace permission\admin\controllers;

use permission\admin\controllers\baseControl;

class permission extends baseControl
{
    const _LOCAL = __DIR__;

    /**
     * Fun艫o a ser executada no contexto da action
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
        //         alerts::set("Erro no salvamento da permiss達o.",'error');
        //         parent::view(null, [
        //             'title'      => 'Permiss達o',
        //             'subtitle'   => 'Insere um nova permiss達o.',
        //             'breadcump'  => [
        //                 'Admin'  => BASE_URL.'/admin/index',
        //                 'Permiss達o' => false
        //             ]
        //         ]);
        //     }
        //     alerts::set("Permiss達o salva.",'success');
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