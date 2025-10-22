<?php

namespace Ajt\Test\services;

use Ajt\ApiBase\BaseService;
use Ajt\Test\models\HostsModel;

class HostsService extends BaseService {
    protected static string $modelClass = HostsModel::class;

    // Aquí pots afegir lògica extra si cal
    public static function findHostsWithRules(int $portalId, array $user): array {

        $hosts = HostsModel::getByIdPortal($portalId);

        // Filtra segons permisos i regles de negoci
        return $hosts;
    }
}
