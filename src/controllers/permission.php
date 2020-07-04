<?php

namespace root\home\controllers\license;

use Nuclear\alerts\alerts;
use root\home\controllers\JcnController;
use root\home\models\licensePermissions;

class permission extends JcnController
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
        
        if(array_key_exists('Y3JpYcOnw6NvIGRlIG5vdmEgcGVybWlzc8Ojbw==',$_POST)){
            $licensePermission = new licensePermissions();
            $licensePermission->setValue('slug', $_POST['slug']);
            $licensePermission->setValue('description', $_POST['description']);
            if(!$licensePermission->save()){
                alerts::set("Erro no salvamento da permissão.",'error');
                parent::view(null, [
                    'title'      => 'Permissão',
                    'subtitle'   => 'Insere um nova permissão.',
                    'breadcump'  => [
                        'Admin'  => BASE_URL.'/admin/index',
                        'Permissão' => false
                    ]
                ]);
            }
            alerts::set("Permissão salva.",'success');
        }

        parent::view(null, [
            'title'      => 'Permissão',
            'subtitle'   => 'Insere um nova permissão.',
            'breadcump'  => [
                'Admin'  => BASE_URL.'/admin/index',
                'Permissão' => false
            ]
        ]);
    }
}