<?php

namespace root\home\controllers\license;

use Nuclear\alerts\alerts;
use root\home\controllers\JcnController;
use root\home\models\licenseProfiles;
use root\home\models\licensePermissions;
use root\home\models\licenseActions;

class action extends JcnController
{    
    public function __construct()
    {
        parent::setLayout('admin.phtml');
        alerts::setModelo(DRT.'/root/home/views/notika/alert.phtml');
    }

    public function main(...$param)
    {
        // license
        // $this->isLicensed('permission-page-teachers', licenseActions::PERMISSIONS_TYPE_LIST);
        
        $licenseProfiles    = new licenseProfiles();
        $licensePermissions = new licensePermissions();
        if(array_key_exists('Y3JpYcOnw6NvIGRlIGHDp8O1ZXMgcGVybWl0aWRhcw==',$_POST)){
            if(isset($_POST['action']) && !empty($_POST['action'])){
                $licenseAction = new licenseActions();
                // inicia sessão
                $licenseAction->beginTransaction();
                // limpa registros pré-existentes
                if(!$licenseAction->deleteActions((int) $_POST['profile_id'], (int) $_POST['permission_id'])){
                    $licenseAction->rollbackTransaction();
                    alerts::set("Erro na deleção de ações pré-existentes.",'error');
                    parent::view(null, [
                        'profiles'   => $licenseProfiles->dicionary(),
                        'permissions'=> $licensePermissions->dicionary(),
                        'title'      => 'Ação',
                        'subtitle'   => 'Insere nova ações permitidas.',
                        'breadcump'  => [
                            'Admin'  => BASE_URL.'/admin/index',
                            'Ação'   => false
                        ]
                    ]);
                }
                foreach($_POST['action'] as $indice => $value){
                    $action = new licenseActions();
                    $action->setValue('profile_id', $_POST['profile_id']);
                    $action->setValue('permission_id', $_POST['permission_id']);
                    $action->setValue('action', $indice);
                    if(!$action->save()){
                        $licenseAction->rollbackTransaction();
                        alerts::set("Erro no salvamento da ação.",'error');
                        parent::view(null, [
                            'profiles'   => $licenseProfiles->dicionary(),
                            'permissions'=> $licensePermissions->dicionary(),
                            'title'      => 'Ação',
                            'subtitle'   => 'Insere nova ações permitidas.',
                            'breadcump'  => [
                                'Admin'  => BASE_URL.'/admin/index',
                                'Ação'   => false
                            ]
                        ]);
                    }
                }
            }
            $licenseAction->commitTransaction();
            alerts::set("Ações foram salvas.",'success');
        }

        parent::view(null, [
            'profiles'   => $licenseProfiles->dicionary(),
            'permissions'=> $licensePermissions->dicionary(),
            'title'      => 'Ação',
            'subtitle'   => 'Insere nova ações permitidas.',
            'breadcump'  => [
                'Admin'  => BASE_URL.'/admin/index',
                'Ação'   => false
            ]
        ]);
    }
}