<?php

namespace dhope0000\SnapMosaic\Controllers\Snaps;

use \dhope0000\SnapMosaic\Tools\Snaps\GetOverview;

class GetOverviewController
{
    private $getOverview;

    public function __construct(GetOverview  $getOverview)
    {
        $this->getOverview = $getOverview;
    }

    public function get()
    {
        return $this->getOverview->get();
    }
}
