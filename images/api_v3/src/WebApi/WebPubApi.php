<?php
namespace Ajt\Test\WebApi;
use Ajt\Debug\Debug;
use Ajt\WebApi\Api;

class WebPubApi extends Api
{
    public function __construct()
    {

        $vUrl = "https://web.manresa.cat/api/web_v2/pub/v2/"; // petició produccio

        parent::__construct($vUrl) ;
        $this->setCacheLocal(true);
    }

    public function getPortal ($vUrl) {

        $oDades['url'] = $vUrl;

        $aRetorn = $this->CallAPI("GET","portals/",$oDades);

        return $aRetorn['dades'];
    }

    public function getMenu ($vIdPortal,$vIdMenu,$vIdioma = "CA",$vLvls = 1) {

        $oDades = [
            'lvls' => $vLvls,
            'lang' => $vIdioma,
        ];

        $aRetorn = $this->CallAPI("GET","portals/".$vIdPortal."/menus/".$vIdMenu,$oDades);

        return $aRetorn['dades'];
    }

    public function getCercaByPortal ($vIdPortal,$vCerca,$vIdioma) {

        $oDades = [
            'lang' => $vIdioma,
        ];
        $aRetorn = $this->CallAPI("GET","portals/".$vIdPortal."/cercar/".urlencode($vCerca ?? ''),$oDades);

        return $aRetorn['dades'];
    }

    public function getMenusUltimesAct ($vIdPortal,$vMaxRes = 5) {

        $oDades['maxres'] = $vMaxRes;

        $aRetorn = $this->CallAPI("GET","portals/".$vIdPortal."/ultimesact",$oDades);

        return $aRetorn['dades'];
    }
}

