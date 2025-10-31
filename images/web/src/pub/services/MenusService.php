<?php

namespace Ajt\Test\pub\services;

use Ajt\ApiBase\BaseService;
use Ajt\ApiBase\ExceptionApiBase;
use Ajt\ApiBase\Response;
use Ajt\DB\ConexionsDB;
use Ajt\Test\pub\models\MenusModel;
use Ajt\Test\pub\models\PortalsModel;

class MenusService extends BaseService {

    /** @var class-string<MenusModel> */
    protected string $modelClass = MenusModel::class;
    // Aquí pots afegir lògica extra si cal

    public function getById(int $vIdPortal,int $vIdMenu) {

        $portalSvc=new PortalsService();
        $portal = $portalSvc->find($vIdPortal);
        $resultat = $this->find($vIdMenu);



        if (!empty($aRetorn)) {
            foreach($aRetorn as $vKey => $aObj) {
                if ($aObj['te_fills'] == 1) {
                    $aRetorn[$vKey]['fills'] = $this->getNodeByMenuPare($aObj['id'],$vIdioma);
                }

            }
        }

        return $aRetorn;
    }
    public function getNodeByMenuPare($vMenuPare,$vIdioma) {

        $aRetorn = MenusModel::getMenusByMenuPare($vMenuPare,null,null,$vIdioma) ?? [];

        if (!empty($aRetorn)) {
            foreach($aRetorn as $vKey => $aObj) {
                if ($aObj['te_fills'] == 1) {
                    $aRetorn[$vKey]['fills'] = $this->getNodeByMenuPare($aObj['id'],$vIdioma);
                }

            }
        }

        return $aRetorn;
    }
}
