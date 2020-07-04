<?php

namespace root\home\controllers\license;

use Nuclear\alerts\alerts;
use root\home\controllers\JcnController;
use root\home\models\licenseProfiles;

class profile extends JcnController
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
        
        if(array_key_exists('Y3JpYcOnw6NvIGRlIG5vdm8gcGVyZmls',$_POST)){
            $licenseProfiles = new licenseProfiles();
            $licenseProfiles->setValue('name', $_POST['name']);
            $licenseProfiles->setValue('description', $_POST['description']);
            if(!$licenseProfiles->save()){
                alerts::set("Erro no salvamento do perfil.",'error');
                parent::view(null, [
                    'title'      => 'Perfil',
                    'subtitle'   => 'Insere um novo perfil.',
                    'breadcump'  => [
                        'Admin'  => BASE_URL.'/admin/index',
                        'Perfil' => false
                    ]
                ]);
            }
            alerts::set("Perfil salvo.",'success');
        }

        parent::view(null, [
            'title'      => 'Perfil',
            'subtitle'   => 'Insere um novo perfil.',
            'breadcump'  => [
                'Admin'  => BASE_URL.'/admin/index',
                'Perfil' => false
            ]
        ]);
    }
}