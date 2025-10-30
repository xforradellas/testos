<?php

namespace Ajt\Test\pub\services;

use Ajt\ApiBase\BaseService;
use Ajt\DB\ConexionsDB;
use Ajt\Test\pub\models\MenusModel;

class MenusService extends BaseService {

    public function __construct(?ConexionsDB $db,?string $modelClass = null) {
        parent::__construct($db,$modelClass ?? MenusModel::class);
    }
    // Aquí pots afegir lògica extra si cal

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
