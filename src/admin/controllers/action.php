<?php

namespace permission\admin\controllers;

use permission\admin\controllers\baseControl;

class action extends baseControl
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
        
        // $profiles    = new licenseProfiles();
        // $permissions = new licensePermissions();
        // if(array_key_exists('Y3JpYcOnw6NvIGRlIGHDp8O1ZXMgcGVybWl0aWRhcw==',$_POST)){
        //     if(isset($_POST['action']) && !empty($_POST['action'])){
        //         $licenseAction = new licenseActions();

        //         $licenseAction->beginTransaction();

        //         if(!$licenseAction->deleteActions((int) $_POST['profile_id'], (int) $_POST['permission_id'])){
        //             $licenseAction->rollbackTransaction();
        //             alerts::set("Erro na deleção de ações pré-existentes.",'error');
        //             parent::view(null, [
        //                 'profiles'   => $profiles->dicionary(),
        //                 'permissions'=> $permissions->dicionary(),
        //                 'title'      => 'Ação',
        //                 'subtitle'   => 'Insere nova ações permitidas.',
        //                 'breadcump'  => [
        //                     'Admin'  => BASE_URL.'/admin/index',
        //                     'Ação'   => false
        //                 ]
        //             ]);
        //         }
        //         foreach($_POST['action'] as $indice => $value){
        //             $action = new licenseActions();
        //             $action->setValue('profile_id', $_POST['profile_id']);
        //             $action->setValue('permission_id', $_POST['permission_id']);
        //             $action->setValue('action', $indice);
        //             if(!$action->save()){
        //                 $licenseAction->rollbackTransaction();
        //                 alerts::set("Erro no salvamento da ação.",'error');
        //                 parent::view(null, [
        //                     'profiles'   => $profiles->dicionary(),
        //                     'permissions'=> $permissions->dicionary(),
        //                     'title'      => 'Ação',
        //                     'subtitle'   => 'Insere nova ações permitidas.',
        //                     'breadcump'  => [
        //                         'Admin'  => BASE_URL.'/admin/index',
        //                         'Ação'   => false
        //                     ]
        //                 ]);
        //             }
        //         }
        //     }
        //     $licenseAction->commitTransaction();
        //     alerts::set("Ações foram salvas.",'success');
        // }

        // parent::view(null, [
        //     'profiles'   => $profiles->dicionary(),
        //     'permissions'=> $permissions->dicionary(),
        // ]);


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