<?php

namespace Ajt\Test\adm\v2\services;

use Ajt\ApiBase\BaseService;
use Ajt\Test\adm\v2\models\PortalsModel;

class PortalsService extends BaseService {

    /** @var class-string<PortalsModel> */
    protected string $modelClass = PortalsModel::class;

    public function getAllPortals($permisos) {

        // recuperem tots els portals
        $resultat = PortalsModel::getAllPortals();

        foreach ($resultat as &$portal) {
            $vId = $portal['id'];
            $portal['permisos'] = $this->calcularPermisos($vId,$permisos);
            $portal['permis_plantilla'] = $this->calcularPermisosPlantilla($vId,$permisos);

            $portal['i18n'] = PortalsModel::getI18nByPortal($vId);
            $portal['tipusDestacats'] = PortalsModel::getTipusDestacats($vId);
            $portal['tipusDescriptors'] = PortalsModel::getTipusDescriptors($vId);

            $portal['teDestacats'] = $this->tePermis($permisos, "destacats", $vId) && !empty($portal['tipusDestacats'] ?? []);
            $portal['teDescriptors'] = $this->tePermis($permisos, "descriptors", $vId)&& !empty($portal['tipusDescriptors'] ?? []);
        }

        return $resultat;
    }

    private function calcularPermisos($vId,$permisos) {
        $permis = 0;
        if ($this->tePermis($permisos, "root", $vId)) {
            $permis = 3;
        } elseif ($this->tePermis($permisos, "portals", $vId)) {
            if ($this->tePermis($permisos, "menus", $vId,'*')) {
                $permis = 2;
            } else {
                $permis = 1;
            }
            //falta verificar si te permisos parcials
        }

        return $permis;
    }
    private function calcularPermisosPlantilla($vId,$permisos) {
        $permis = 0;
        if ($this->tePermis($permisos, "plantilles", $vId)) {
            $permis = 1;
        }

        return $permis;
    }


}
