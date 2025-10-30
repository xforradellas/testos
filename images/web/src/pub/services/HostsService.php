<?php

namespace Ajt\Test\pub\services;

use Ajt\ApiBase\BaseService;
use Ajt\DB\ConexionsDB;
use Ajt\Test\models\HostsModel;

class HostsService extends BaseService {

    public function __construct(?ConexionsDB $db,?string $modelClass = null) {
        parent::__construct($db,$modelClass ?? HostsModel::class);
    }
    // Aquí pots afegir lògica extra si cal
    public function findHostsWithRules(int $portalId, array $user): array {

        $hosts = $this->modelClass::getByIdPortal($portalId);

        // Filtra segons permisos i regles de negoci
        return $hosts;
    }
}
